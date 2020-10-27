<?php

namespace App\Http\Controllers;

use App\Country;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class CountriesController extends Controller
{
    public function index()
    {
        return Inertia::render('Countries/Index', [
            'filters' => Request::all('search'),
            'countries' => Country
                ::orderByName()
                ->filter(Request::only('search'))
                ->paginate()
                ->transform(function ($country) {
                    return [
                        'id' => $country->id,
                        'name' => $country->name,
                        'name_ru' => json_decode($country->name)->ru,
                        'logo' => $country->logo,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Countries/Create');
    }

    public function store()
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
        ];
        $validator = Validator::make(Request::all(), [
            'name.*' => ['required', 'max:100'],
            'logo' => ['nullable', 'max:100'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        Country::create(
            [
                'name' => json_encode(Request::input('name')),
                'logo' => Request::input('logo'),
            ]
        );

        return Redirect::route('countries')->with('success', 'Страна добавлена.');
    }

     public function edit(Country $country)
    {
        return Inertia::render('Countries/Edit', [
            'country' => [
                'id' => $country->id,
                'name' => $country->name,
                'name_ru' => json_decode($country->name)->ru,
                'logo' => $country->logo,
            ]
        ]);
    }

   public function update(Country $country)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
        ];
        $country->update(
            Request::validate([
                'name.*' => ['required', 'max:100'],
                'logo' => ['nullable', 'max:100'],
            ],$messages)
        );

         return Redirect::route('countries')->with('success', 'Страна обновлена.');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return Redirect::back()->with('success', 'Страна удалена!');
    }

}
