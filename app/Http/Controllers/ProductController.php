<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['variant.category'])->latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $variants = ProductVariant::pluck('name', 'id'); // For dropdown selection
        return view('product.create', compact('variants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'name' => 'required|string|max:191',
            'SKU' => 'required|string|max:100',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image_size = $request->file('image')->getSize();
            $result = Utility::updateStorageLimit(Auth::user()->creatorId(), $image_size);

            if ($result == 1) {
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $dir = 'uploads/product/';
                $path = Utility::upload_file($request, 'image', $fileNameToStore, $dir, []);

                if ($path['flag'] == 1) {
                    $data['image'] = $fileNameToStore;
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }
        }

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $variants = ProductVariant::pluck('name', 'id');
        return view('product.edit', compact('product', 'variants'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'name' => 'required|string|max:191',
            'SKU' => 'required|string|max:100',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image_size = $request->file('image')->getSize();
            $result = Utility::updateStorageLimit(Auth::user()->creatorId(), $image_size);

            if ($result == 1) {
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $dir = 'uploads/product/';
                $path = Utility::upload_file($request, 'image', $fileNameToStore, $dir, []);

                if ($path['flag'] == 1) {
                    $data['image'] = $fileNameToStore;
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }
        }

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
