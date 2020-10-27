<?php

namespace App\Http\Controllers;

use App\Setting;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function edit(Setting $setting)
    {
        return Inertia::render('Settings/Edit', [
            'setting' => [
                'id' => $setting->id,
                'name' => $setting->name,
                'social' => $setting->social,
                'logo' => $setting->logo,
                'footer_logo' => $setting->footer_logo,
                'footer_logo_second' => $setting->footer_logo_second,
                'favicon' => $setting->favicon,
                'google_maps_api' => $setting->google_maps_api,
                'google_analytics' => $setting->google_analytics,
            ]
        ]);
    }

    public function update(Setting $setting)
    {
        $messages = [
            'required' => 'Ошибка. Поле обязательное.',
            'max' => 'Ошибка. Поле должно содержать не более :max символов',
        ];
        $setting->update(
            Request::validate([
                'name.*' => ['required'],
                'social' => ['nullable'],
                'logo' => ['nullable', 'max:100'],
                'footer_logo' => ['nullable', 'max:100'],
                'footer_logo_second' => ['nullable', 'max:100'],
                'favicon' => ['nullable', 'max:100'],
                'google_maps_api' => ['nullable', 'max:100'],
                'google_analytics' => ['nullable', 'max:500'],
            ],$messages)
        );

         return Redirect::route('dashboard')->with('success', 'Настройки обновлены.');
    }


}
