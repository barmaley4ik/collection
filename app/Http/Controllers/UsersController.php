<?php

namespace App\Http\Controllers;

use App\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'filters' => Request::all('search', 'role', 'trashed'),
            'users' => User
                ::orderByName()
                ->filter(Request::only('search', 'role', 'trashed'))
                ->get()
                ->transform(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'telegram_user_id' => $user->telegram_user_id,
                        'email' => $user->email,
                        'owner' => $user->owner,
                        'photo' => $user->photoUrl(['w' => 40, 'h' => 40, 'fit' => 'crop']),
                        'deleted_at' => $user->deleted_at,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        Request::validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'telegram_user_id' => ['nullable', 'max:11'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['nullable'],
            'owner' => ['required', 'integer'],
            'photo' => ['nullable', 'image'],
        ]);

        User::create([
            'first_name' => Request::get('first_name'),
            'last_name' => Request::get('last_name'),
            'telegram_user_id' => Request::get('telegram_user_id'),
            'email' => Request::get('email'),
            'password' => Request::get('password'),
            'owner' => Request::get('owner'),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
        ]);

        return Redirect::route('users')->with('success', 'Пользователь сохранен');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'telegram_user_id' => $user->telegram_user_id,
                'email' => $user->email,
                'owner' => $user->owner,
                'photo' => $user->photoUrl(['w' => 60, 'h' => 60, 'fit' => 'crop']),
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(User $user)
    {
/*         if (App::environment('demo') && $user->isDemoUser()) {
            return Redirect::back()->with('error', 'Updating the demo user is not allowed.');
        } */

        Request::validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'telegram_user_id' => ['nullable', 'max:11'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
            'owner' => ['required', 'integer'],
            'photo' => ['nullable', 'image'],
        ]);

        $user->update(Request::only('first_name', 'telegram_user_id', 'last_name', 'email', 'owner'));

        if (Request::file('photo')) {
            $user->update(['photo_path' => Request::file('photo')->store('users')]);
        }

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return Redirect::back()->with('success', 'Пользователь сохранен');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return Redirect::back()->with('error', 'Удалять админа ЗАПРЕЩЕНО!');
        }
        
        $user->trashed() ?  $user->forceDelete() : $user->delete();   

        return Redirect::back()->with('success', 'Пользователь удален');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'Пользователь восстановлен');
    }
}
