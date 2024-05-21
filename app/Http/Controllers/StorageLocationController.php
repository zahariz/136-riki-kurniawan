<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageLocationCreateRequest;
use App\Http\Requests\StorageLocationUpdateRequest;
use App\Models\StorageLocation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StorageLocationController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $search === null ?
        $data = StorageLocation::paginate(10) :
        $data = StorageLocation::where('nama_sloc', 'like', '%' . $search . '%')
        ->orWhere('kode_sloc', 'like', '%' . $search . '%')
        ->paginate(10);
        return view('StorageLocation.index', [
            'title' => 'Storage Location List',
            'data' => $data
        ]);
    }

    public function store(StorageLocationCreateRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $sloc = new StorageLocation($data);
        $sloc->save();

        return redirect()->route('sloc')->with('status', 'Berhasil menambah data!');
    }

    public function update(int $id, StorageLocationUpdateRequest $request): RedirectResponse
    {
        $sloc = StorageLocation::where('id', $id)->first();
        if(!$sloc) {
            return redirect()->back()->withErrors('Something went wrong ..');
        }

        $data = $request->validated();
        $sloc->fill($data);
        $sloc->save();

        return redirect()->back()->with('status', 'Berhasil mengubah data!');
    }

    public function destroy(int $id)
    {
        $sloc = StorageLocation::where('id', $id)->first();

        if(!$sloc) {
            return redirect()->back()->withErrors('Something went wrong ..');
        }
        $sloc->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus data!');

    }
}
