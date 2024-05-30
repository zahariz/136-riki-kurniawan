<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->input('search');
        $search == null ?
        $data = User::query()->with(['role'])
        ->paginate(10) :
        $data = User::query()->with(['role'])
        ->where('name', 'like', '%' . $search . '%')
        ->orWhere('username', 'like', '%' . $search . '%')
        ->orWhereHas('role', function($query) use ($search) {
            $query->where('role_name', 'like', '%'.$search.'%');
        })
        ->paginate(10);

        $role = Role::query()->get();
        return view('Users.Index', [
            'title' => 'users',
            'data' => $data,
            'role' => $role
        ]);
    }

    public function edit(int $id): RedirectResponse | View
    {
        $users = User::query()->with(['role'])->where('id', $id)->first();
        if(!$users) {
            Alert::error('Oops!', 'User Not Found');
            return redirect()->back();
        }

        $role = Role::query()->get();

        return view('Users.Edit', [
            'title' => 'Edit User',
            'data' => $users,
            'role' => $role
        ]);
    }

    public function update(int $id, UserUpdateRequest $request)
    {
        $user = User::where('id', $id)->first();
        if(!$user) {
            Alert::error('Oops!', 'User Not Found!');
            return redirect()->back();
        }
        $data = $request->validated();
        $user->fill($data);
        $user->role_id = $request->input('role_id');
        $user->save();
        Alert::success('Hore!', 'User Updated Successfully');

        return redirect()->route('users');

    }

    public function store(UserCreateRequest $request): RedirectResponse
    {

        $data = $request->validated();

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->role_id = $request->input('role_id');
        $user->save();
        Alert::success('Hore!', 'User Created Successfully');
        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $user = User::where('id', $id)->first();

        if(!$user) {
            Alert::error('Oops!', 'User Not Found!');
            return redirect()->back();
        }
        $user->delete();

        Alert::success('Success', 'User Successfuly deleted!');
        return redirect()->back();

    }
}
