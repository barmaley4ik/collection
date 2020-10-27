<?php

namespace App\Http\Controllers;

use App\Disposition;
use App\DispositionPlace;
use App\Festival;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DispositionsController extends Controller
{
    public function index()
    {
        return Inertia::render('Dispositions/Index', [

            'dispositions' => Disposition
                ::with('festival')
                ->paginate()
                ->transform(function ($disposition) {
                    return [
                        'id' => $disposition->id,
                        'festival' => $disposition->festival ? $disposition->festival->only('name') : null,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Dispositions/Create',[
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
            'image' => ['required'],
            'meta_title.*' => ['required', 'max:200'],
            'festival_id' => ['required','unique:conditions'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
		try {

			\DB::beginTransaction();        
            $disposition= Disposition::create(
                [
                    'header' => json_encode(Request::input('header')),
                    'meta_title' => json_encode(Request::input('meta_title')),
                    'meta_description' => json_encode(Request::input('meta_description')),
                    'image' => Request::input('image'),
                    'festival_id' => Request::input('festival_id'),
                ]
            );

            $disposition_places = [];
            if (Request::get('disposition_places')) {
                foreach (Request::get('disposition_places') as $item) {
                    $disposition_place = new DispositionPlace;
                    $disposition_place->place = json_encode($item['place']);
                    $disposition_place->member = json_encode($item['member']);
                    $disposition_places[] = $disposition_place;
                }
                $disposition->dispositionPlaces()->saveMany($disposition_places);
            }
            \DB::commit();
            
		} catch (\Exception $e) {

            \DB::rollback();
            
            return Redirect::route('dispositions')->withErrors('При сохранении возникла ошибка: ' . $e->getMessage());	
        }
        
        return Redirect::route('dispositions')->with('success', 'Схема размещения добавлена.');
    }

     public function edit(Disposition $disposition)
    {
        return Inertia::render('Dispositions/Edit', [
            'disposition' => [
                'id' => $disposition->id,
                'header' => $disposition->header,
                'meta_title' => $disposition->meta_title,
                'meta_description' => $disposition->meta_description,
                'image' => $disposition->image,
                'festival_id' => $disposition->festival_id,
                'festival' => $disposition->festival ? $disposition->festival->only('name') : null,
                'disposition_places' => $disposition->dispositionPlaces,
            ],
            'festivals' => Festival
                ::orderByName()
                ->get()

        ]);
    }

   public function update(Disposition $disposition)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];

        $validator = Validator::make(Request::all(), [
            'header.*' => ['required'],
            'image' => ['required'],
            'meta_title.*' => ['required', 'max:200'],
            'festival_id' => ['required', 'unique:conditions,festival_id,' . $disposition->id,],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
		try {

			\DB::beginTransaction();        
            $disposition->update(
                [
                    'header' => json_encode(Request::input('header')),
                    'meta_title' => json_encode(Request::input('meta_title')),
                    'meta_description' => json_encode(Request::input('meta_description')),
                    'image' => Request::input('image'),
                    'festival_id' => Request::input('festival_id'),
                ]
            );

            $disposition_places = [];
            if (Request::get('disposition_places')) {

                $disposition->dispositionPlaces()->delete();
                
                foreach (Request::get('disposition_places') as $item) {
                    $disposition_place = new DispositionPlace;
                    $disposition_place->place = json_encode($item['place']);
                    $disposition_place->member = json_encode($item['member']);
                    $disposition_places[] = $disposition_place;

                }
                $disposition->dispositionPlaces()->saveMany($disposition_places);
            }
            \DB::commit();
            
		} catch (\Exception $e) {

            \DB::rollback();
            
            return Redirect::route('dispositions')->withErrors('При сохранении возникла ошибка: ' . $e->getMessage());	
        }

         return Redirect::route('dispositions')->with('success', 'Схема размещения обновлена.');
    }

    public function destroy(Disposition $disposition)
    {
        $disposition->dispositionPlaces()->delete();
        $disposition->delete();

        return Redirect::back()->with('success', 'Схема размещения удалена!');
    }

}
