<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageBinCreateRequest;
use App\Http\Requests\StorageBinUpdateRequest;
use App\Models\StorageBin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StorageBinController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $search === null ?
        $data = StorageBin::paginate(10) :
        $data = StorageBin::where('nama_bin', 'like', '%' . $search . '%')
        ->orWhere('kode_bin', 'like', '%' . $search . '%')
        ->paginate(10);
        return view('StorageBin.index', [
            'title' => 'Storage Bin List',
            'data' => $data
        ]);
    }

    public function store(StorageBinCreateRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $sbin = new StorageBin($data);
        $sbin->save();

        return redirect()->route('sbin')->with('status', 'Berhasil menambah data!');
    }

    public function update(int $id, StorageBinUpdateRequest $request): RedirectResponse
    {
        $sbin = StorageBin::where('id', $id)->first();
        if(!$sbin) {
            return redirect()->back()->withErrors('Something went wrong ..');
        }

        $data = $request->validated();
        $sbin->fill($data);
        $sbin->save();

        return redirect()->back()->with('status', 'Berhasil mengubah data!');
    }

    public function destroy(int $id)
    {
        $sbin = StorageBin::where('id', $id)->first();

        if(!$sbin) {
            return redirect()->back()->withErrors('Something went wrong ..');
        }
        $sbin->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus data!');

    }
}
