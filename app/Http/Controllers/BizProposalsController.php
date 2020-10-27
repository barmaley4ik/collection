<?php

namespace App\Http\Controllers;

use App\BizProposal;
use App\Festival;
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
use Helpme;
use Notification;
use App\Notifications\BizProposalNew;
use App\Notifications\ProposalSendImage;

class BizProposalsController extends Controller
{
    public function index()
    {
        return Inertia::render('BizProposals/Index', [
            'filters' => Request::all('search', 'status'),
            'biz_proposals' => BizProposal
                ::orderByDate()
                ->with(['festival', 'specialization'])
                ->filter(Request::only('search', 'status'))
                ->paginate()
                ->transform(function ($biz_proposal) {
                    return [
                        'id' => $biz_proposal->id,
                        'member' => json_decode($biz_proposal->member)->ru,
                        'specialization' => $biz_proposal->specialization ? $biz_proposal->specialization->only('name') : null,
                        'phone' => $biz_proposal->phone,
                        'date' => $biz_proposal->created_at->format('Y-m-d'),
                        'status' => $biz_proposal->status_id,
                        'place_number'=> $biz_proposal->place_number,
                        'festival' => $biz_proposal->festival ? $biz_proposal->festival->only('name') : null,
                    ];
                }),
        ]);
    }

    public function create()
    {
        $defaultLanguage = Language::select('id')->isDefault()->first()->value('id');
        
        return Inertia::render('BizProposals/Create', [
            'festivals' => Festival
                ::orderByName()
                ->get(),
            'members' => Member
                ::orderByName()
                ->get(),                
            'specializations' => Specialization
                ::forShopPlaces()
                ->get(),
            'language_id' => $defaultLanguage ? $defaultLanguage : null,
            'placeformats' => PlaceFormat
                ::forShopPlaces()
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
            'phone' => ['required'],
            'place_number' => ['required'],
            'festival_id' => ['required'],
            'fitting_room' => ['required'],
            'product' => ['required','max:250'],
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
        $bizProposal = BizProposal::create(
            [
                'member' => json_encode(Request::input('member')),
                'social' => json_encode(Request::input('social')),
                'fotos' => json_encode(Request::input('fotos')) == '[null]' ? '[""]' : json_encode(Request::input('fotos')),
                'phone' => Request::input('phone'),
                'place_number' => Request::input('place_number'),
                'count_worker' => Request::input('count_worker'),
                'product' => Request::input('product'),
                'fitting_room' => Request::input('fitting_room'),
                'illumination' => Request::input('illumination'),
                'comment' => Request::input('comment'),
                'place_format_id' => Request::input('place_format_id'),
                'language_id' => Request::input('language_id'),
                'specialization_id' => Request::input('specialization_id'),
                'festival_id' => Request::input('festival_id'),
                'status_id' => Request::input('status_id'),

            ]
        );

        $subject="Новоя заявка на торговое место";

        Helpme::sendBizProposalMail($bizProposal, $subject);  

        $users = User::whereRole(User::ROLE_ADMIN)->get();

        Notification::send($users, new BizProposalNew($bizProposal,$subject));

        $files = json_decode($bizProposal->fotos); 

        if($files > 0) {
            foreach ($files as $file) { 
                if(!empty(trim($file))) {
                Notification::send($users, new ProposalSendImage('Изображения', config('app.url') . $file));
                }
            }
        }

        return Redirect::route('biz-proposals')->with('success', 'Заявка на торговое место добавлена.');
    }
 
     public function edit(BizProposal $biz_proposal)
    {
        return Inertia::render('BizProposals/Edit', [
            'biz_proposal' => [
                'id' => $biz_proposal->id,
                'member' => $biz_proposal->member,
                'social' =>  $biz_proposal->social,
                'fotos' =>  $biz_proposal->fotos,
                'phone' => $biz_proposal->phone,
                'place_number' => $biz_proposal->place_number,
                'count_worker' => $biz_proposal->count_worker,
                'comment' => $biz_proposal->comment,
                'place_format_id' => $biz_proposal->place_format_id,
                'language_id' => $biz_proposal->language_id,
                'specialization_id' => $biz_proposal->specialization_id,
                'festival_id' => $biz_proposal->festival_id,
                'status_id' => $biz_proposal->status_id,
                'fitting_room' => $biz_proposal->fitting_room,
                'illumination' => $biz_proposal->illumination,
                'product' => $biz_proposal->product,

            ],
            'festivals' => Festival
                ::orderByName()
                ->get(),
            'specializations' => Specialization
                ::forShopPlaces()
                ->get(),
            'placeformats' => PlaceFormat
            ::forShopPlaces()
            ->get(),                                           
        ]);
    }

   public function update(BizProposal $biz_proposal)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'member.*' => ['required'],
            'specialization_id' => ['required'],
            'phone' => ['required'],
            'place_number' => ['required'],
            'festival_id' => ['required'],
            'fitting_room' => ['required'],
            'product' => ['required','max:250'],
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

        $oldStatus = $biz_proposal->status_id;

        $biz_proposal->update(
            [
                'member' => json_encode(Request::input('member')),
                'social' => json_encode(Request::input('social')),
                'fotos' => json_encode(Request::input('fotos')) == '[null]' ? '[""]' : json_encode(Request::input('fotos')),
                'phone' => Request::input('phone'),
                'place_number' => Request::input('place_number'),
                'count_worker' => Request::input('count_worker'),
                'product' => Request::input('product'),
                'fitting_room' => Request::input('fitting_room'),
                'illumination' => Request::input('illumination'),
                'comment' => Request::input('comment'),
                'place_format_id' => Request::input('place_format_id'),
                'language_id' => Request::input('language_id'),
                'specialization_id' => Request::input('specialization_id'),
                'festival_id' => Request::input('festival_id'),
                'status_id' => Request::input('status_id'),
            ]
        );

        if($this->checkStatus($biz_proposal, $oldStatus)) {

            $subject="Заявка подтверждена. Данные для маркетолога";

            Helpme::sendBizProposalMail($biz_proposal, $subject);
           
            $users = User::whoSend()->get();

            Notification::send($users, new BizProposalNew($biz_proposal,$subject));

            $files = json_decode($biz_proposal->fotos); 

            if($files > 0) {
                foreach ($files as $file) { 
                    if(!empty(trim($file))) {
                    Notification::send($users, new ProposalSendImage('Фотографии', config('app.url') . $file));
                    }
                }
            }  

            return Redirect::route('biz-proposals')->with('success', 'Заявка на торговое место обновлена. Письмо маркетологу будет отправлено в течении 5 минут');
        }

        return Redirect::route('biz-proposals')->with('success', 'Заявка на торговое место обновлена.');
    }

    public function destroy(BizProposal $biz_proposal)
    {
        $biz_proposal->delete();

        return Redirect::back()->with('success', 'Заявка на торговое место удалена!');
    }

    public function checkStatus(BizProposal $proposal, $oldStatus)
    {
        
        return $proposal->status_id != $oldStatus  &&  $proposal->status_id == $proposal::STATUS_PAYMENT;

    } 
}