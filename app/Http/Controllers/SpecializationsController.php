<?php

namespace App\Http\Controllers;

use App\Specialization;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class SpecializationsController extends Controller
{

    public function index()
    {
        return Inertia::render('Specializations/Index', [
            'specializations' => Specialization
                ::paginate()
                ->transform(function ($specialization) {
                    return [
                        'id' => $specialization->id,
                        'name' => $specialization->name,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Specializations/Create');
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
        Specialization::create(
            [
                'name' => json_encode(Request::input('name')),
                'type' => Request::input('type'),
            ]
        );
        return Redirect::route('specializations')->with('success', 'Специализация создана.');
    }

    public function edit(Specialization $specialization)
    {
        
         return Inertia::render('Specializations/Edit', [
            'specialization' => [
                'id' => $specialization->id,
                'name' => $specialization->name,
                'type' => $specialization->type,
            ],
        ]);
    }

    public function update(Specialization $specialization)
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
        $specialization->update(
            [
                'name' => json_encode(Request::input('name')),
                'type' => Request::input('type'),
            ]
        );

        return Redirect::back()->with('success', 'Специализация обновлена.');
    }

    public function destroy(Specialization $specialization)
    {
        $specialization->delete();

        return Redirect::back()->with('success', 'Специализация удалена!');
    }

}
