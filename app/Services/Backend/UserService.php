<?php

namespace App\Services\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function all()
    {
        return User::latest()->paginate(12);
    }
    public function createUser(array $data)
    {

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return User::create($data);
    }
    public function updateUser(User $user, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
            }
        $user->update($data);

}
}
