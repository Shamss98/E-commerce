<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Backend\UserService;

class UserController extends Controller
{
protected $userService;
public function __construct(UserService $userService)
{
    $this->userService = $userService;
}
public function index()
{
    $users = $this->userService->all();
    return view('dashboard.users.index', compact('users'));

}
public function create()
{
    return view('dashboard.users.create');
}
public function store(UserRequest $request)
{

    $data = $request->validated();
    $this->userService->createUser($data);
    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');

}
public function edit(User $user)
{
    return view('dashboard.users.edit', compact('user'));
}
public function update(UserRequest $request, User $user)
{

    $data = $request->validated();
    $this->userService->updateUser($user, $data);
    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
}
}
