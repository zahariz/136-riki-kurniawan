<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request):View
    {
        $search = $request->input('search');
        $search === null ?
        $data = Product::paginate(10) :
        $data = Product::with(['category'])->where('product_name', 'like', '%' . $search . '%')
        ->orWhere('sku', 'like', '%' . $search . '%')
        ->orWhereHas('category', function($query) use ($search) {
            $query->where('category_name', 'like', '%'.$search.'%');
        })
        ->paginate(10);
        $category = Category::all();
        return view('Product.index', [
            'title' => 'Product List',
            'data' => $data,
            'category' => $category
        ]);
    }

    public function store(ProductCreateRequest $request)
    {
        $data = $request->validated();
        $product = new Product($data);
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect()->back()->with('status', 'Data berhasil ditambahkan!');
    }

    public function update(int $id, ProductUpdateRequest $request)
    {
        $product = Product::where('id', $id)->first();
        if(!$product) {
            return redirect()->back()->withErrors('Something went wrong ..');
        }

        $data = $request->validated();
        $product->fill($data);
        $product->save();

        return redirect()->back()->with('status', 'Berhasil mengubah data!');
    }

    public function destroy(int $id)
    {
        $product = Product::where('id', $id)->first();

        if(!$product) {
            return redirect()->back()->withErrors('Something went wrong ..');
        }
        $product->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus data!');

    }
}
