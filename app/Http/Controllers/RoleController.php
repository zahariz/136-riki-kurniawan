<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $search === null ?
        $data = Role::paginate(10) :
        $data = Role::where('role_name', 'like', '%' . $search . '%')
        ->orWhere('desc', 'like', '%' . $search . '%')
        ->paginate(10);

        return view('Role.Index', [
            'data' => $data,
            'title' => 'Role'
        ]);
    }

    public function store(RoleCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $role = new Role($data);
        $role->save();

        Alert::success('Hore!', 'Role successfully created!');
        return redirect()->back();
    }

    public function update(int $id, RoleUpdateRequest $request): RedirectResponse
    {
        $role = Role::query()->where('id', $id)->first();
        if(!$role) {
            Alert::error('Oops!', 'Role Not Found!');
            return redirect()->back();
        }

        $data = $request->validated();

        $role->fill($data);
        $role->save();

        Alert::success('Hore!', 'Role successfully updated!');
        return redirect()->back();

    }

    public function destroy(int $id): RedirectResponse
    {
        $role = Role::query()->where('id', $id)->first();
        if(!$role) {
            Alert::error('Oops!', 'Role Not Found!');
            return redirect()->back();
        }

        $role->delete();
        Alert::success('Hore!', 'Role successfully deleted!');
        return redirect()->back();
    }
}
