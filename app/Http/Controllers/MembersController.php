<?php

namespace App\Http\Controllers;

use App\Member;
use App\Country;
use App\Festival;
use App\Proposal;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Arr;


class MembersController extends Controller
{
    public function index()
    {
        return Inertia::render('Members/Index', [
            'filters' => Request::all('search'),
            'members' => Member
                ::with(['country', 'festival'])
                ->orderByName()
                ->filter(Request::only('search'))
                ->paginate()
                ->transform(function ($member) {
                    return [
                        'id' => $member->id,
                        'name_ru' => json_decode($member->name)->ru,
                        'studio_ru' => json_decode($member->studio)->ru,
                        'country' =>  $member->country ? json_decode(data_get($member->country->only('name'),'name'))->ru : null,
                        'festival' =>  $member->festival ? json_decode(data_get($member->festival->only('name'),'name'))->ru : null,
                        'city_ru' => json_decode($member->city)->ru,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Members/Create', [
            'countries' => Country
                ::orderByName()
                ->get()
                ->map
                ->only('id', 'name'),
            'festivals' => Festival
                ::orderByName()
                ->get()
                ->map
                ->only('id', 'name'),                
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
            'name.*' => ['required', 'max:100'],
            'festival_id' => ['required'],
            'slug' => ['required', 'unique:members',  'max:150'],
            'title.*' => ['required', 'max:200'],
            'logo' => ['nullable', 'max:100'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Member::create(
            [
                'name' => json_encode(Request::input('name')),
                'slug' => Request::input('slug'),
                'title' => json_encode(Request::input('title')),
                'description' => json_encode(Request::input('description')),
                'studio' => json_encode(Request::input('studio')),
                'social' => json_encode(Request::input('social')),
                'logo' => Request::input('logo'),
                'portfolio' => json_encode(Request::input('portfolio')),
                'country_id' => Request::input('country_id'),
                'festival_id' => Request::input('festival_id'),
                'city' => json_encode(Request::input('city')),
            ]
        );

        return Redirect::route('members')->with('success', 'Участник добавлен.');
    }

     public function edit(Member $member)
    {
        return Inertia::render('Members/Edit', [
            'member' => [
                'id' => $member->id,
                'name_ru' => json_decode($member->name)->ru,
                'name' => $member->name,
                'slug' => $member->slug,
                'title' => $member->title,
                'description' => $member->description,
                'studio' => $member->studio,
                'social' => $member->social,
                'logo' => $member->logo,
                'portfolio' => $member->portfolio,
                'country_id' => $member->country_id,
                'city' => $member->city,
                'festival_id' => $member->festival_id,
            ],
            'countries' => Country
                ::orderByName()
                ->get()
                ->map
                ->only('id', 'name'),
            'festivals' => Festival
                ::orderByName()
                ->get()
                ->map
                ->only('id', 'name'),                  
        ]);
    }
/*
unique:posts,title,{$this->post->id}
*/
   public function update(Member $member)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'name.*' => ['required', 'max:100'],
            'festival_id' => ['required'],
            'slug' => ['required', 'unique:members,slug,' . $member->id, 'max:150'],
            'title.*' => ['required', 'max:200'],
            'logo' => ['nullable', 'max:100'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }        
        $member->update([            
            'name' => json_encode(Request::input('name')),
            'slug' => Request::input('slug'),
            'title' => json_encode(Request::input('title')),
            'description' => json_encode(Request::input('description')),
            'studio' => json_encode(Request::input('studio')),
            'social' => json_encode(Request::input('social')),
            'logo' => Request::input('logo'),
            'portfolio' => json_encode(Request::input('portfolio')),
            'country_id' => Request::input('country_id'),
            'festival_id' => Request::input('festival_id'),
            'city' => json_encode(Request::input('city')),
            ]
        );

         return Redirect::route('members')->with('success', 'Участник обновлен.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return Redirect::back()->with('success', 'Участник удален!');
    }

    public function createFromPorposal()
    {
        
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $request = Request::all();

        $proposal = Proposal::whereId($request[0])->first();

        $data['name'] = json_decode($proposal->member, true);
        $data['studio'] = json_decode($proposal->studio, true);
        $data['social'] = json_decode($proposal->social, true);
        $data['city'] = json_decode($proposal->city, true);
        $data['portfolio'] = json_decode($proposal->portfolio, true);
        $data['logo'] = $proposal->logo;
        $data['festival_id'] = $proposal->festival_id;
        $data['country_id'] = $proposal->country_id; 
       

       $validator = Validator::make($data, [
            'name.*' => ['required', 'max:100'],
            'studio' => ['required'],
            'social.*' => ['required', 'max:100'],
            'city.*' => ['required', 'max:100'],
            'festival_id' => ['required'],
            'country_id' => ['required'],
            'logo' => ['nullable', 'max:100'],
        ], $messages);

        if ($validator->fails()) {

            $message = 'Невозможно создать участника не все поля заполнены!';

            return Redirect::back()->with('error', $message);
        }

        return Inertia::render('Members/Create', [
            'countries' => Country
                ::orderByName()
                ->get()
                ->map
                ->only('id', 'name'),
            'festivals' => Festival
                ::orderByName()
                ->get()
                ->map
                ->only('id', 'name'),
            'proposal' => $proposal,
        ]);        
    }
}
