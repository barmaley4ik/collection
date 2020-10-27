<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Festival;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class HotelsController extends Controller
{
    public function index()
    {
        return Inertia::render('Hotels/Index', [
            'hotels' => Hotel
                ::with('festival')
                ->paginate()
                ->transform(function ($hotel) {
                    return [
                        'id' => $hotel->id,
                        'hotel' => json_decode($hotel->hotel)->ru,
                        'header' => json_decode($hotel->header)->ru,
                        'festival' => $hotel->festival ? $hotel->festival->only('name') : null,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Hotels/Create', [
            'festivals' => Festival
                ::orderByName()
                ->get()
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
            'header.*' => ['required'],
            'hotel.*' => ['required'],
            'festival_id' => ['required','unique:hotels'],
            'meta_title.*' => ['required', 'max:150'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Hotel::create(
            [
                'header' => json_encode(Request::input('header')),
                'hotel' => json_encode(Request::input('hotel')),
                'images' => json_encode(Request::input('images')),
                'meta_title' => json_encode(Request::input('meta_title')),
                'meta_description' => json_encode(Request::input('meta_description')),
                'festival_id' => Request::input('festival_id'),
            ]
        );

        return Redirect::route('hotels')->with('success', 'Место добавлено.');
    }

     public function edit(Hotel $hotel)
    {
        return Inertia::render('Hotels/Edit', [
            'hotel' => [
                'id' => $hotel->id,
                'header' => $hotel->header,
                'hotel' => $hotel->hotel,
                'images' => $hotel->images,
                'meta_title' => $hotel->meta_title,
                'meta_description' => $hotel->meta_description,
                'festival_id' => $hotel->festival_id,
                'festival' => $hotel->festival ? $hotel->festival->only('name') : null,
            ],
            'festivals' => Festival
                ::orderByName()
                ->get()            
        ]);
    }

   public function update(Hotel $hotel)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'header.*' => ['required'],
            'hotel.*' => ['required'],
            'festival_id' => ['required', 'unique:hotels,festival_id,' . $hotel->id,],
            'meta_title.*' => ['required', 'max:150'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $hotel->update(
            [
                'header' => json_encode(Request::input('header')),
                'hotel' => json_encode(Request::input('hotel')),
                'images' => json_encode(Request::input('images')),
                'meta_title' => json_encode(Request::input('meta_title')),
                'meta_description' => json_encode(Request::input('meta_description')),
                'festival_id' => Request::input('festival_id'),
            ]
        );


         return Redirect::route('hotels')->with('success', 'Место обновлено.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return Redirect::back()->with('success', 'Место удалено!');
    }

}
