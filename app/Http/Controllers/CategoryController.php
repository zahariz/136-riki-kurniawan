<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $search === null ?
        $data = Category::paginate(10) :
        $data = Category::where('category_name', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->paginate(10);
        return view('Category.index', [
            'title' => 'Category List',
            'data' => $data
        ]);
    }

    public function store(CategoryCreateRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $category = new Category($data);
        $category->save();

        return redirect()->route('category')->with('status', 'Berhasil menambah data!');
    }

    public function update(int $id, CategoryUpdateRequest $request): RedirectResponse
    {
        $category = Category::where('id', $id)->first();
        if(!$category) {
            return redirect()->back()->withErrors('Something went wrong ..');
        }

        $data = $request->validated();
        $category->fill($data);
        $category->save();

        return redirect()->back()->with('status', 'Berhasil mengubah data!');
    }

    public function destroy(int $id)
    {
        $category = Category::where('id', $id)->first();

        if(!$category) {
            return redirect()->back()->withErrors('Something went wrong ..');
        }
        $category->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus data!');

    }
}
