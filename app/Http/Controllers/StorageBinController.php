<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageBinCreateRequest;
use App\Http\Requests\StorageBinUpdateRequest;
use App\Models\StorageBin;
use App\Models\StorageLocation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

        $sloc = StorageLocation::query()->with('sbin')->get();
        return view('StorageBin.index', [
            'title' => 'Storage Bin List',
            'data' => $data,
            'sloc' => $sloc
        ]);
    }

    public function getBySlocId(int $slocId): JsonResponse
    {
        $data = StorageBin::query()->where('sloc_id', $slocId)->get();

        return response()->json($data);
    }

    public function store(StorageBinCreateRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $sbin = new StorageBin($data);
        $sbin->sloc_id = $request->input('sloc_id');
        $sbin->save();
        Alert::success('Sukses', 'Berhasil Menambahkan data!');
        return redirect()->route('sbin');
    }

    public function update(int $id, StorageBinUpdateRequest $request): RedirectResponse
    {
        $sbin = StorageBin::where('id', $id)->first();
        if(!$sbin) {
            Alert::error('Oops!', 'Something went wrong');
            return redirect()->back();
        }

        $data = $request->validated();
        $sbin->fill($data);
        $sbin->sloc_id = $request->input('sloc_id');
        $sbin->save();

        Alert::success('Sukses', 'Berhasil Mengubah data!');
        return redirect()->route('sbin');
    }

    public function destroy(int $id)
    {
        $sbin = StorageBin::where('id', $id)->first();

        if(!$sbin) {
            Alert::error('Oops!', 'Something went wrong');
            return redirect()->back();
        }
        $sbin->delete();
        Alert::success('Sukses', 'Berhasil Menghapus data!');
        return redirect()->route('sbin');

    }
}
