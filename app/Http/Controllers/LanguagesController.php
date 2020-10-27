<?php

namespace App\Http\Controllers;

use App\Language;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class LanguagesController extends Controller
{
    public function index()
    {
        return Inertia::render('Languages/Index', [
            'filters' => Request::all('search'),
            'languages' => Language
                ::orderByName()
                ->filter(Request::only('search'))
                ->paginate()
                ->transform(function ($language) {
                    return [
                        'id' => $language->id,
                        'name' => $language->name,
                        'name_ru' => json_decode($language->name)->ru,
                        'code' => $language->code,
                        'encoding' => $language->encoding,
                        'is_default' => $language->is_default,
                        'status' => $language->status,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Languages/Create');
    }

    public function store()
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
        ];
        $validator = Validator::make(Request::all(), [
            'name.*' => ['required', 'max:100'],
            'code' => ['required', 'max:8'],
            'encoding' => ['required', 'max:8'],
            'is_default' => ['required', 'max:1'],
            'status' => ['required', 'max:1'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Language::create(
            [
                'name' => json_encode(Request::input('name')),
                'code' => Request::input('code'),
                'encoding' => Request::input('encoding'),
                'is_default' => Request::input('is_default'),
                'status' => Request::input('status'),

            ]
        );

        return Redirect::route('languages')->with('success', 'Язык добавлен.');
    }

     public function edit(Language $language)
    {
        return Inertia::render('Languages/Edit', [
            'language' => [
                'id' => $language->id,
                'name' => $language->name,
                'name_ru' => json_decode($language->name)->ru,
                'code' => $language->code,
                'encoding' => $language->encoding,
                'is_default' => $language->is_default,
                'status' => $language->status,
            ]
        ]);
    }

   public function update(Language $language)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
        ];
        $language->update(
            Request::validate([
                'name.*' => ['required', 'max:100'],
                'code' => ['required', 'max:8'],
                'encoding' => ['required', 'max:8'],
                'is_default' => ['required', 'max:1'],
                'status' => ['required', 'max:1'],
            ],$messages)
        );

         return Redirect::route('languages')->with('success', 'Язык обновлен.');
    }

    public function destroy(Language $language)
    {
        $language->delete();

        return Redirect::back()->with('success', 'Язык удален!');
    }

}
