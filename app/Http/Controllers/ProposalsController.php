<?php

namespace App\Http\Controllers;

use App\Proposal;
use App\Festival;
use App\Country;
use App\Member;
use App\Specialization;
use App\PlaceFormat;
use App\Language;
use App\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Notifications\ProposalNew;
use App\Notifications\ProposalSendImage;
use Notification;
use Helpme;

class ProposalsController extends Controller
{
    public function index()
    {
        return Inertia::render('Proposals/Index', [
            'filters' => Request::all('search', 'status'),
            'proposals' => Proposal
                ::orderByDate()
                ->with(['festival', 'country','specialization'])
                ->filter(Request::only('search', 'status'))
                ->paginate()
                ->transform(function ($proposal) {
                    return [
                        'id' => $proposal->id,
                        'member' => json_decode($proposal->member)->ru,
                        'specialization' => $proposal->specialization ? $proposal->specialization->only('name') : null,
                        'studio' => json_decode($proposal->studio)->ru,
                        'date' => $proposal->created_at->format('Y-m-d'),
                        'status' => $proposal->status_id,
                        'festival' => $proposal->festival ? $proposal->festival->only('name') : null,
                        'country' => $proposal->country ? $proposal->country->only('name') : null,
                        'place_number' =>  $proposal->place_number,
                    ];
                }),
        ]);
    }
    public function getMembers(Request $request)
    {
        $members = Member
        ::orderByName()
        ->filter(Request::only('search'))
        ->get();

        return response()->json([
            'success' => true,
            'members' => $members,
        ], 200);
    }

    public function create()
    {
        $defaultLanguage = Language::select('id')->isDefault()->first()->value('id');
        
        return Inertia::render('Proposals/Create', [
            'festivals' => Festival
                ::orderByName()
                ->get(),
            'countries' => Country
                ::orderByName()
                ->get(),
            'members' => Member
                ::orderByName()
                ->get(),                
            'specializations' => Specialization
                ::forMembers()
                ->get(),
            'language_id' => $defaultLanguage ? $defaultLanguage : null,
            'placeformats' => PlaceFormat
                ::forMembers()
                ->get(),                                            
        ]);        
    }

    public function store()
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'member.*' => ['required'],
            'specialization_id' => ['required'],
            'city.*' => ['required'],
            'phone' => ['required'],
            'place_number' => ['required'],
            'country_id' => ['required'],
            'festival_id' => ['required'],
            'status_id' => ['required'],
            'place_format_id' => ['required'],
            'language_id' => ['required'],
            'social.email' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $proposal = Proposal::create(
            [
                'member' => json_encode(Request::input('member')),
                'city' => json_encode(Request::input('city')),
                'studio' => json_encode(Request::input('studio')),
                'social' => json_encode(Request::input('social')),
                'portfolio' => json_encode(Request::input('portfolio')) == '[null]' ? '[""]' : json_encode(Request::input('portfolio')),
                'phone' => Request::input('phone'),
                'logo' => Request::input('logo'),
                'place_number' => Request::input('place_number'),
               // 'count_worker' => Request::input('count_worker'),
                'comment' => Request::input('comment'),
                'place_format_id' => Request::input('place_format_id'),
                'language_id' => Request::input('language_id'),
                'specialization_id' => Request::input('specialization_id'),
                'country_id' => Request::input('country_id'),
                'festival_id' => Request::input('festival_id'),
                'status_id' => Request::input('status_id'),

            ]
        );

        $subject="Новоя заявка на участие";

        Helpme::sendProposalMail($proposal, $subject);

        $users = User::whereRole(User::ROLE_ADMIN)->get();

        Notification::send($users, new ProposalNew($proposal,$subject));

        Notification::send($users, new ProposalSendImage('Фото профиля', config('app.url') . $proposal->logo));

        $files = json_decode($proposal->portfolio); 

        if($files > 0) {
            foreach ($files as $file) { 
                if(!empty(trim($file))) {
                Notification::send($users, new ProposalSendImage('Портфолио', config('app.url') . $file));
                }
            }
        }
        
        return Redirect::route('proposals')->with('success', 'Заявка на участие добавлена. Письмо о новой Заявке отправлено');
    }

     public function edit(Proposal $proposal)
    {
        return Inertia::render('Proposals/Edit', [
            'proposal' => [
                'id' => $proposal->id,
                'member' => $proposal->member,
                'city' =>  $proposal->city,
                'studio' =>  $proposal->studio,
                'social' =>  $proposal->social,
                'portfolio' =>  $proposal->portfolio,
                'phone' => $proposal->phone,
                'logo' => $proposal->logo,
                'place_number' => $proposal->place_number,
               // 'count_worker' => $proposal->count_worker,
                'comment' => $proposal->comment,
                'place_format_id' => $proposal->place_format_id,
                'language_id' => $proposal->language_id,
                'specialization_id' => $proposal->specialization_id,
                'country_id' => $proposal->country_id,
                'festival_id' => $proposal->festival_id,
                'status_id' => $proposal->status_id,

            ],
            'festivals' => Festival
                ::orderByName()
                ->get(),
            'countries' => Country
                ::orderByName()
                ->get(),
            'specializations' => Specialization
                ::forMembers()
                ->get(),
            'placeformats' => PlaceFormat
            ::forMembers()
            ->get(),                                           
        ]);
    }

   public function update(Proposal $proposal)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'member.*' => ['required'],
            'specialization_id' => ['required'],
            'city.*' => ['required'],
            'phone' => ['required'],
            'place_number' => ['required'],
            'country_id' => ['required'],
            'festival_id' => ['required'],
            'status_id' => ['required'],
            'place_format_id' => ['required'],
            'language_id' => ['required'],
            'social.email' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $oldStatus= $proposal->status_id;
       
        $proposal->update(
            [
                'member' => json_encode(Request::input('member')),
                'city' => json_encode(Request::input('city')),
                'studio' => json_encode(Request::input('studio')),
                'social' => json_encode(Request::input('social')),
                'portfolio' => json_encode(Request::input('portfolio')) == '[null]' ? '[""]' : json_encode(Request::input('portfolio')),
                'phone' => Request::input('phone'),
                'logo' => Request::input('logo'),
                'place_number' => Request::input('place_number'),
                //'count_worker' => Request::input('count_worker'),
                'comment' => Request::input('comment'),
                'place_format_id' => Request::input('place_format_id'),
                'language_id' => Request::input('language_id'),
                'specialization_id' => Request::input('specialization_id'),
                'country_id' => Request::input('country_id'),
                'festival_id' => Request::input('festival_id'),
                'status_id' => Request::input('status_id'),
            ]
        );

        //если статус изменился

        if($this->checkStatus($proposal, $oldStatus)) {

            $subject="Заявка подтверждена. Данные для маркетолога";

            Helpme::sendProposalMail($proposal, $subject);

            $users = User::whoSend()->get();

            Notification::send($users, new ProposalNew($proposal,$subject));

            Notification::send($users, new ProposalSendImage('Фото профиля', config('app.url') . $proposal->logo));

            $files = json_decode($proposal->portfolio); 

            if($files > 0) {
                foreach ($files as $file) { 
                    if(!empty(trim($file))) {
                    Notification::send($users, new ProposalSendImage('Портфолио', config('app.url') . $file));
                    }
                }
            }

            return Redirect::route('proposals')->with('success', 'Заявка на участие обновлена. Письмо маркетологу будет отправлено в течении 5 минут');
        }

        return Redirect::route('proposals')->with('success', 'Заявка на участие обновлена.');
    }

    public function destroy(Proposal $proposal)
    {
        $proposal->delete();

        return Redirect::back()->with('success', 'Заявка на участие удалена!');
    }

    public function checkStatus(Proposal $proposal, $oldStatus)
    {
        
        return $proposal->status_id != $oldStatus  &&  $proposal->status_id == $proposal::STATUS_PAYMENT;

    }    

}