<?php

namespace App\Http\Controllers;

use App\PlaceFormat;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class PlaceFormatsController extends Controller
{

    public function index()
    {
        return Inertia::render('PlaceFormats/Index', [
            'placeformats' => PlaceFormat
                ::paginate()
                ->transform(function ($placeformat) {
                    return [
                        'id' => $placeformat->id,
                        'name' => $placeformat->name,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('PlaceFormats/Create');
    }

    public function store()
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'name.*' => ['required'],

        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        PlaceFormat::create(
            [
                'name' => json_encode(Request::input('name')),
                'type' => Request::input('type'),

            ]
        );
        return Redirect::route('placeformats')->with('success', 'Формат места создан.');
    }

    public function edit(PlaceFormat $placeformat)
    {
         return Inertia::render('PlaceFormats/Edit', [
            'placeformat' => [
                'id' => $placeformat->id,
                'name' => $placeformat->name,
                'type' => $placeformat->type,
            ],
        ]);
    }

    public function update(PlaceFormat $placeformat)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'name.*' => ['required'],

        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }        
        $placeformat->update(
            [
                'name' => json_encode(Request::input('name')),
                'type' => Request::input('type'),
            ]
        );

        return Redirect::back()->with('success', 'Формат места обновлен.');
    }

    public function destroy(PlaceFormat $placeformat)
    {
        $placeformat->delete();

        return Redirect::back()->with('success', 'Формат места удален!');
    }

}
