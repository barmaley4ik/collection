<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\TranslationLoader\LanguageLine;
/* use App\Imports\TranslationsImport;
use App\Exports\TranslationsExport;
use Maatwebsite\Excel\Facades\Excel; */
use App\Language;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class TranslationsController extends Controller
{
    public function index()
	{
        $search = Request::all('search') ?? null;
        return Inertia::render('Translations/Index', [
            'filters' => Request::all('search'),
            'translations' => LanguageLine
                ::whereRaw('lower(text) like lower(?)', ["%{$search['search']}%"])
                ->paginate()
                ->transform(function ($translation) {
                    return [
                        'id' => $translation->id,
                        'group' => $translation->group,
                        'text' => $translation->text['ru'],
                        'key' => $translation->key,
                    ];
                }),
        ]);        
    }
    
    public function create()
    {
        return Inertia::render('Translations/Create' );        
    }

    public function store()
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'text.*' => ['required'],
            'group' => ['required'],
            'key' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        LanguageLine::create(
            [
                'text' => Request::input('text'),
                'group' => Request::input('group'),
                'key' => Request::input('key'),
            ]
        );

        return Redirect::route('translations')->with('success', 'Перевод добавлен.');
    }
 
     public function edit(LanguageLine $translation)
    {
        return Inertia::render('Translations/Edit', [
            'translation' => [
                'id' => $translation->id,
                'text' => $translation->text,
                'group' =>  $translation->group,
                'key' =>  $translation->key,
            ],
        ]);
    }

   public function update(LanguageLine $translation)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];
        $validator = Validator::make(Request::all(), [
            'text.*' => ['required'],
            'group' => ['required'],
            'key' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $translation->update(
            [
                'text' => Request::input('text'),
                'group' => Request::input('group'),
                'key' => Request::input('key'),
            ]
        );

         return Redirect::route('translations')->with('success', 'Перевод обновлен.');
    }

    public function destroy(LanguageLine $translation)
    {
        $translation->delete();
        return Redirect::back()->with('success', 'Перевод удален!');
    }
/* 	public function destroy(LanguageLine  $translation)
    {
        $translation->delete();
        return redirect()->route('translations.index');
    }

    public function update(Request $request, LanguageLine $translation)
    {
        $translation->update($request->all());
        return redirect()->route('translations.index')
            ->with('success','Translate updated successfully');
    }

    public function store(Request $request)
    {
        try {
            LanguageLine::create($request->all());
            return redirect()->route('translations.index');
        } catch (Exception $e){
            return about(404);
        }
    }

    public function import(Request $request)
    {
        Excel::import(new TranslationsImport, $request->file('import'));

        return redirect()->route('translations.index')->with('success', 'Import Completed Successfully!');
    }
    public function export()
    {
        return Excel::download(new TranslationsExport, 'translations.xlsx');
    } */
}
