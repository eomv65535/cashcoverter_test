<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;


class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input)
    {
        $response = Http::post('https://reqres.in/api/users', [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        
        if ($response->status() !== 201) {
            throw ValidationException::withMessages([
                'email' => [trans('fortify.failed')],
            ]);
        }
        
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
