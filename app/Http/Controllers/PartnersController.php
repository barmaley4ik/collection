<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Festival;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class PartnersController extends Controller
{
    public function index()
    {
        return Inertia::render('Partners/Index', [
            'filters' => Request::all('search'),
            'partners' => Partner
                ::orderByName()
                ->filter(Request::only('search'))
                ->paginate()
                ->transform(function ($partner) {
                    return [
                        'id' => $partner->id,
                        'name' => $partner->name,
                        'name_ru' => json_decode($partner->name)->ru,
                        'description' => $partner->description,
                        'logo' => $partner->logo,
                    ];
                }),
        ]);
    }

    public function create()
    {
        $festivals = Festival::all();

        return Inertia::render('Partners/Create',[
            'festivals' => $festivals,
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
            'name.*' => ['required', 'max:100'],
            'description.*' => ['nullable'],
            'meta_title.*' => ['required', 'max:200'],
            'slug' => ['required', 'unique:members', 'max:150'],
            'logo' => ['nullable', 'max:100'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try{
            \DB::beginTransaction();

            $partner = Partner::create(
                [
                    'name' => json_encode(Request::input('name')),
                    'description' => json_encode(Request::input('description')),
                    'meta_title' => json_encode(Request::input('meta_title')),
                    'meta_description' => json_encode(Request::input('meta_description')),
                    'slug' => Request::input('slug'),
                    'logo' => Request::input('logo'),
                ]
            );

            $festivals = Request::input('festivals');

            $partnerFestival = [];

            foreach($festivals as $festival){
                $partnerFestival[] = $festival['id'];
            }

            $partner->festivals()->attach($partnerFestival);

            \DB::commit();

        
        } catch(\Exception $e){

            \DB::rollback();

            return Redirect::route('partners')->withErrors('При сохранении возникла ошибка: ' . $e->getMessage());			
            
        }        

        return Redirect::route('partners')->with('success', 'Партнер добавлен.');
    }

     public function edit(Partner $partner)
    {
        $festivals = Festival::all();
        return Inertia::render('Partners/Edit', [
            'partner' => [
                'id' => $partner->id,
                'name' => $partner->name,
                'name_ru' => json_decode($partner->name)->ru,
                'description' => $partner->description,
                'meta_title' => $partner->meta_title,
                'meta_description' => $partner->meta_description,
                'slug' => $partner->slug,
                'logo' => $partner->logo,
                'festivals' => $partner->festivals,
            ],
            'festivals'=> $festivals,
        ]);
    }

   public function update(Partner $partner)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
            'unique' => 'Ошибка. Значение должно быть уникальным. Такое значение уже есть.',
        ];

        $validator = Validator::make(Request::all(), [
            'name.*' => ['required', 'max:100'],
            'description.*' => ['nullable'],
            'meta_title.*' => ['required', 'max:200'],
            'slug' => ['required', 'unique:members,slug,' . $partner->id, 'max:150'],
            'logo' => ['nullable', 'max:100'],
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try{
            \DB::beginTransaction();

            $partner->update(
                [
                    'name' => json_encode(Request::input('name')),
                    'description' => json_encode(Request::input('description')),
                    'meta_title' => json_encode(Request::input('meta_title')),
                    'meta_description' => json_encode(Request::input('meta_description')),
                    'slug' => Request::input('slug'),
                    'logo' => Request::input('logo'),
                ]
            );

            $festivals = Request::input('festivals');

            $partnerFestival = [];

            foreach($festivals as $festival){
                $partnerFestival[] = $festival['id'];
            }

            $partner->festivals()->sync($partnerFestival);

            \DB::commit();

        } catch(\Exception $e){

            \DB::rollback();

            return Redirect::route('partners')->withErrors('При сохранении возникла ошибка: ' . $e->getMessage());			
        }
                   
         return Redirect::route('partners')->with('success', 'Партнер обновлен.');
    }

    public function destroy(Partner $partner)
    {
        
        
        $partner->delete();
        $partner->festivals()->detach();
        return Redirect::back()->with('success', 'Партнер удален!');
    }

}
