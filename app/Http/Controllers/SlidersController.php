<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Festival;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class SlidersController extends Controller
{
    public function index()
    {
        return Inertia::render('Sliders/Index', [
            'filters' => Request::all('search'),
            'sliders' => Slider
                ::with('festival')
                ->paginate()
                ->transform(function ($slider) {
                    return [
                        'id' => $slider->id,
                        'text_slider' => json_decode($slider->text_slider)->ru,
                        'festival' => $slider->festival ? $slider->festival->only('name') : null,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Sliders/Create', [
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
            'text_slider.*' => ['nullable'],
            'image' => ['required', 'max:100'],
            'sort' => ['required', 'max:3'],

        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Slider::create(
            [
                'text_slider' => json_encode(Request::input('text_slider')),
                'sort' => Request::input('sort'),
                'image' => Request::input('image'),
                'is_button' => Request::input('is_button'),
                'festival_id' => Request::input('festival_id'),
                'url' => Request::input('url'),

            ]
        );

        return Redirect::route('sliders')->with('success', 'Слайдер добавлен.');
    }

     public function edit(Slider $slider)
    {
        return Inertia::render('Sliders/Edit', [
            'slider' => [
                'id' => $slider->id,
                'text_slider' => $slider->text_slider,
                'sort' =>  $slider->sort,
                'image' =>  $slider->image,
                'is_button' =>  $slider->is_button,
                'festival_id' => $slider->festival_id,
                'url' => $slider->url,

            ],
            'festivals' => Festival
                ::orderByName()
                ->get()            
        ]);
    }

   public function update(Slider $slider)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'text_slider.*' => ['nullable'],
            'image' => ['required', 'max:100'],
            'sort' => ['required', 'max:3'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $slider->update(
            [
                'text_slider' => json_encode(Request::input('text_slider')),
                'sort' => Request::input('sort'),
                'image' => Request::input('image'),
                'is_button' => Request::input('is_button'),
                'festival_id' => Request::input('festival_id'),
                'url' => Request::input('url'),
            ]
        );


         return Redirect::route('sliders')->with('success', 'Слайдер обновлен.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        return Redirect::back()->with('success', 'Слайдер удален!');
    }

}
