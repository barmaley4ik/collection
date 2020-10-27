<?php

namespace App\Http\Controllers;

use App\Program;
use App\Festival;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class ProgramsController extends Controller
{
    public function index()
    {
        return Inertia::render('Programs/Index', [
            'programs' => Program
                ::with('festival')
                ->paginate()
                ->transform(function ($program) {
                    return [
                        'id' => $program->id,
                        'day' => $program->day,
                        'festival' => $program->festival ? $program->festival->only('name') : null,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Programs/Create', [
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
        Program::create(
            [
                'text_day' => json_encode(Request::input('text_day')),
                'day' => Request::input('day'),
                'festival_id' => Request::input('festival_id'),
            ]
        );

        return Redirect::route('programs')->with('success', 'Программа добавлена.');
    }

     public function edit(Program $program)
    {
        return Inertia::render('Programs/Edit', [
            'program' => [
                'id' => $program->id,
                'day' => $program->day,
                'text_day' =>  $program->text_day,
                'festival_id' => $program->festival_id,

            ],
            'festivals' => Festival
                ::orderByName()
                ->get()            
        ]);
    }

   public function update(Program $program)
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
        $program->update(
            [
                'text_day' => json_encode(Request::input('text_day')),
                'day' => Request::input('day'),
                'festival_id' => Request::input('festival_id'),

            ]
        );


         return Redirect::route('programs')->with('success', 'Программа обновлена.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return Redirect::back()->with('success', 'Программа удалена.!');
    }

}
