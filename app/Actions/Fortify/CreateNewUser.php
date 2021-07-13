<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        if(User::where('id',2)->doesntExist()) {
            if(User::where('id', 1)->doesntExist()) {
                $role = Role::where('name', 'superadmin')->get();
            }else{
                $role = Role::where('name', 'admin')->get();
            }
        }else{
            $role = Role::where('name','guest')->get();
        }
        
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role_id' => $role[0]->id,
            'password' => Hash::make($input['password']),
        ]);
    }
}
