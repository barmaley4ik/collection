<?php

namespace App\Http\Controllers;

use App\Festival;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class FestivalsController extends Controller
{
    public function index()
    {
        return Inertia::render('Festivals/Index', [
            'filters' => Request::all('search'),
            'festivals' => Festival
                ::orderByName()
                ->filter(Request::only('search'))
                ->paginate()
                ->transform(function ($festival) {
                    return [
                        'id' => $festival->id,
                        'name_ru' => json_decode($festival->name)->ru,
                        'date_start' => $festival->date_start,
                        'date_end' =>  $festival->date_end,
                        'city_ru' => json_decode($festival->city)->ru,
                        'status' =>  ($festival->status>0) ? 'Включен' : 'Выключен',
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Festivals/Create');        
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
            'city.*' => ['required', 'max:50'],
            'slug' => ['required', 'unique:festivals',  'max:150'],
            'meta_title.*' => ['required', 'max:200'],
            'is_default' => ['required'],
            'status' => ['required'],
            'date_start' => ['required'],
            'date_end' => ['required'],
            'video_url' => ['nullable','max:100'],
            'concert_ua_url' => ['nullable','max:100'],
            'google_map_coordinates' => ['nullable','max:400'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Festival::create(
            [
                'name' => json_encode(Request::input('name')),
                'slug' => Request::input('slug'),
                'custom_text' => json_encode(Request::input('custom_text')),
                'meta_title' => json_encode(Request::input('meta_title')),
                'meta_description' => json_encode(Request::input('meta_description')),
                'gallery' => json_encode(Request::input('gallery')),
                'adress' => json_encode(Request::input('adress')),
                'supervisor_project' => json_encode(Request::input('supervisor_project')),
                'supervisor_sponsors' => json_encode(Request::input('supervisor_sponsors')),
                'supervisor_members' => json_encode(Request::input('supervisor_members')),
                'phones' => json_encode(Request::input('phones')),
                'city' => json_encode(Request::input('city')),
                'video_url' => Request::input('video_url'),
                'concert_ua_url' => Request::input('concert_ua_url'),
                'google_map_coordinates' => Request::input('google_map_coordinates'),
                'is_default' => Request::input('is_default'),
                'date_start' => Request::input('date_start'),
                'date_end' => Request::input('date_end'),
                'status' => Request::input('status'),
            ]
        );

        return Redirect::route('festivals')->with('success', 'Фестиваль добавлен.');
    }

     public function edit(Festival $festival)
    {
        return Inertia::render('Festivals/Edit', [
            'festival' => [
                'id' => $festival->id,
                'name_ru' => json_decode($festival->name)->ru,
                'name' => $festival->name,
                'slug' =>  $festival->slug,
                'custom_text' =>  $festival->custom_text,
                'meta_title' =>  $festival->meta_title,
                'meta_description' =>  $festival->meta_description,
                'gallery' => $festival->gallery,
                'adress' =>  $festival->adress,
                'supervisor_project' =>  $festival->supervisor_project,
                'supervisor_sponsors' =>  $festival->supervisor_sponsors,
                'supervisor_members' =>  $festival->supervisor_members,
                'phones' =>  $festival->phones,
                'city' =>  $festival->city,
                'video_url' =>  $festival->video_url,
                'concert_ua_url' =>  $festival->concert_ua_url,
                'google_map_coordinates' =>  $festival->google_map_coordinates,
                'is_default' =>  $festival->is_default,
                'date_start' =>  $festival->date_start,
                'date_end' =>  $festival->date_end,
                'status' =>  $festival->status,
            ],
        ]);
    }

   public function update(Festival $festival)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'name.*' => ['required', 'max:100'],
            'city.*' => ['required', 'max:50'],
            'slug' => ['required', 'unique:festivals,slug,' . $festival->id,  'max:150'],
            'meta_title.*' => ['required', 'max:200'],
            'is_default' => ['required'],
            'status' => ['required'],
            'date_start' => ['required'],
            'date_end' => ['required'],
            'video_url' => ['nullable','max:100'],
            'concert_ua_url' => ['nullable','max:100'],
            'google_map_coordinates' => ['nullable','max:400'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $festival->update(
            [
                'name' => json_encode(Request::input('name')),
                'slug' => Request::input('slug'),
                'custom_text' => json_encode(Request::input('custom_text')),
                'meta_title' => json_encode(Request::input('meta_title')),
                'meta_description' => json_encode(Request::input('meta_description')),
                'gallery' => json_encode(Request::input('gallery')),
                'adress' => json_encode(Request::input('adress')),
                'supervisor_project' => json_encode(Request::input('supervisor_project')),
                'supervisor_sponsors' => json_encode(Request::input('supervisor_sponsors')),
                'supervisor_members' => json_encode(Request::input('supervisor_members')),
                'phones' => json_encode(Request::input('phones')),
                'city' => json_encode(Request::input('city')),
                'video_url' => Request::input('video_url'),
                'concert_ua_url' => Request::input('concert_ua_url'),
                'google_map_coordinates' => Request::input('google_map_coordinates'),
                'is_default' => Request::input('is_default'),
                'date_start' => Request::input('date_start'),
                'date_end' => Request::input('date_end'),
                'status' => Request::input('status'),
            ]
        );


         return Redirect::route('festivals')->with('success', 'Фестиваль обновлен.');
    }

    public function destroy(Festival $festival)
    {
        $festival->delete();

        return Redirect::back()->with('success', 'Фестиваль удален!');
    }

}
