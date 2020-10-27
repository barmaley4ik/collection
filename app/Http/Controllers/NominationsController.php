<?php

namespace App\Http\Controllers;

use App\Nomination;
use App\Festival;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class NominationsController extends Controller
{
    public function index()
    {
        return Inertia::render('Nominations/Index', [
            'nominations' => Nomination
                ::with('festival')
                ->paginate()
                ->transform(function ($nomination) {
                    return [
                        'id' => $nomination->id,
                        'day' => $nomination->day,
                        'festival' => $nomination->festival ? $nomination->festival->only('name') : null,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Nominations/Create', [
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
            'text_day.*' => ['required'],
            'day' => ['required'],


        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Nomination::create(
            [
                'text_day' => json_encode(Request::input('text_day')),
                'day' => Request::input('day'),
                'festival_id' => Request::input('festival_id'),

            ]
        );

        return Redirect::route('nominations')->with('success', 'Номинация добавлена.');
    }

     public function edit(Nomination $nomination)
    {
        return Inertia::render('Nominations/Edit', [
            'nomination' => [
                'id' => $nomination->id,
                'day' => $nomination->day,
                'text_day' =>  $nomination->text_day,
                'festival_id' => $nomination->festival_id,

            ],
            'festivals' => Festival
                ::orderByName()
                ->get()            
        ]);
    }

   public function update(Nomination $nomination)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'text_day.*' => ['required'],
            'day' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $nomination->update(
            [
                'text_day' => json_encode(Request::input('text_day')),
                'day' => Request::input('day'),
                'festival_id' => Request::input('festival_id'),
            ]
        );


         return Redirect::route('nominations')->with('success', 'Номинация обновлена.');
    }

    public function destroy(Nomination $nomination)
    {
        $nomination->delete();

        return Redirect::back()->with('success', 'Номинация удалена.!');
    }

}
