<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\ProductCategorie;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{
    public function index()
    {
        $variants = ProductVariant::with('category')->latest()->paginate(10);
        return view('productvariant.index', compact('variants'));
    }

    public function create()
    {
        $categories = ProductCategorie::pluck('name', 'id');
        return view('productvariant.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name'        => 'required|string|max:191',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Upload image if provided
        if ($request->hasFile('image')) {
            $image_size = $request->file('image')->getSize();
            $result = Utility::updateStorageLimit(Auth::user()->creatorId(), $image_size);

            if ($result == 1) {
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $dir = 'uploads/product_variant/';
                $path = Utility::upload_file($request, 'image', $fileNameToStore, $dir, []);

                if ($path['flag'] == 1) {
                    $data['image'] = $fileNameToStore;
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }
        }

        ProductVariant::create($data);

        return redirect()->route('variants.index')->with('success', __('Variant created successfully'));
    }

    public function edit(ProductVariant $variant)
    {
        $categories = ProductCategorie::pluck('name', 'id');
        return view('productvariant.edit', compact('variant', 'categories'));
    }

    public function update(Request $request, ProductVariant $variant)
    {
        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name'        => 'required|string|max:191',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
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

                $dir = 'uploads/product_variant/';
                $path = Utility::upload_file($request, 'image', $fileNameToStore, $dir, []);

                if ($path['flag'] == 1) {
                    $data['image'] = $fileNameToStore;
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }
            }
        }

        $variant->update($data);

        return redirect()->route('variants.index')->with('success', __('Variant updated successfully'));
    }

    public function destroy(ProductVariant $variant)
    {
        $variant->delete();
        return redirect()->route('variants.index')->with('success', __('Variant deleted successfully'));
    }
}
