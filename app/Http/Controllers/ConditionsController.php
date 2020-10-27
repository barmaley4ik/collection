<?php

namespace App\Http\Controllers;

use App\Condition;
use App\Festival;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class ConditionsController extends Controller
{
    public function index()
    {
        return Inertia::render('Conditions/Index', [
            'conditions' => Condition
                ::with('festival')
                ->paginate()
                ->transform(function ($condition) {
                    return [
                        'id' => $condition->id,
                        'festival' => $condition->festival ? $condition->festival->only('name') : null,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Conditions/Create', [
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
            'description.*' => ['required'],
            'header.*' => ['required'],
            'festival_id' => ['required','unique:conditions'],
            'meta_title.*' => ['required', 'max:150'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Condition::create(
            [
                'description' => json_encode(Request::input('description')),
                'header' => json_encode(Request::input('header')),
                'meta_title' => json_encode(Request::input('meta_title')),
                'meta_description' => json_encode(Request::input('meta_description')),
                'festival_id' => Request::input('festival_id'),
            ]
        );

        return Redirect::route('conditions')->with('success', 'Условие участия добавлено.');
    }

     public function edit(Condition $condition)
    {
        return Inertia::render('Conditions/Edit', [
            'condition' => [
                'id' => $condition->id,
                'header' => $condition->header,
                'description' => $condition->description,
                'meta_title' => $condition->meta_title,
                'meta_description' => $condition->meta_description,
                'festival_id' => $condition->festival_id,
                'festival' => $condition->festival ? $condition->festival->only('name') : null,
            ],
            'festivals' => Festival
                ::orderByName()
                ->get()            
        ]);
    }

   public function update(Condition $condition)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'description.*' => ['required'],
            'header.*' => ['required'],
            'festival_id' => ['required', 'unique:conditions,festival_id,' . $condition->id,],
            'meta_title.*' => ['required', 'max:150'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $condition->update(
            [
                'header' => json_encode(Request::input('header')),
                'description' => json_encode(Request::input('description')),
                'meta_title' => json_encode(Request::input('meta_title')),
                'meta_description' => json_encode(Request::input('meta_description')),
                'festival_id' => Request::input('festival_id'),
            ]
        );


         return Redirect::route('conditions')->with('success', 'Условие участия обновлено.');
    }

    public function destroy(Condition $condition)
    {
        $condition->delete();

        return Redirect::back()->with('success', 'Условие участия удалено!');
    }

}
