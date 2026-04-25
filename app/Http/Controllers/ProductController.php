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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'image.mimes' => 'Format non accepté ! Utilisez seulement : JPG, JPEG, PNG ou WEBP',
            'image.image' => 'Le fichier doit être une image valide.',
            'image.max' => 'Image trop grande ! Maximum 2MB autorisé',
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

    public function addToCart($id, $session)
    {
        $cart = session()->get($session, []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $cart[$id]['subtotal'] = $cart[$id]['price'] * $cart[$id]['quantity'];
            $cart[$id]['variant_subtotal'] = $cart[$id]['variant_price'] * $cart[$id]['quantity'];
        } else {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['error' => __('Product not found')], 404);
            }
            $cart[$id] = [
                'id' => $id,
                'product_name' => $product->name,
                'variant_id' => 0,
                'variant_name' => '',
                'price' => $product->price ?? 0,
                'variant_price' => $product->price ?? 0,
                'quantity' => 1,
                'subtotal' => $product->price ?? 0,
                'variant_subtotal' => $product->price ?? 0,
                'tax' => [],
                'originalquantity' => $product->quantity ?? 1,
                'originalvariantquantity' => 1,
                'store_id' => \Auth::user()->current_store,
            ];
        }

        session()->put($session, $cart);

        $total = 0;
        $carttotal = [];
        foreach ($cart as $key => $item) {
            $sub = ($item['variant_id'] ?? 0) > 0 ? ($item['variant_subtotal'] ?? 0) : ($item['subtotal'] ?? 0);
            $total += $sub;
            $carttotal[] = [
                'id' => $key,
                'subtotal' => $item['subtotal'] ?? 0,
                'variant_subtotal' => $item['variant_subtotal'] ?? 0,
                'variant_id' => $item['variant_id'] ?? 0,
            ];
        }

        return response()->json([
            'code' => '200',
            'product' => $cart[$id],
            'carttotal' => $carttotal,
            'carthtml' => '',
        ]);
    }

    public function addToCartVariant($id, $session, $variation_id = 0)
    {
        $variant = ProductVariant::find($variation_id ?: $id);
        if (!$variant) {
            return response()->json(['error' => __('Variant not found')], 404);
        }

        $cart = session()->get($session, []);
        $cartKey = 'variant_' . $variant->id;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
            $cart[$cartKey]['variant_subtotal'] = $cart[$cartKey]['variant_price'] * $cart[$cartKey]['quantity'];
            $cart[$cartKey]['subtotal'] = $cart[$cartKey]['variant_subtotal'];
        } else {
            $cart[$cartKey] = [
                'id' => $cartKey,
                'product_name' => $variant->name,
                'variant_id' => $variant->id,
                'variant_name' => $variant->name,
                'price' => $variant->price ?? 0,
                'variant_price' => $variant->price ?? 0,
                'quantity' => 1,
                'subtotal' => $variant->price ?? 0,
                'variant_subtotal' => $variant->price ?? 0,
                'tax' => [],
                'originalquantity' => $variant->quantity ?? 1,
                'originalvariantquantity' => $variant->quantity ?? 1,
                'store_id' => \Auth::user()->current_store,
            ];
        }

        session()->put($session, $cart);

        $total = 0;
        $carttotal = [];
        foreach ($cart as $key => $item) {
            $sub = ($item['variant_id'] ?? 0) > 0 ? ($item['variant_subtotal'] ?? 0) : ($item['subtotal'] ?? 0);
            $total += $sub;
            $carttotal[] = [
                'id' => $key,
                'subtotal' => $item['subtotal'] ?? 0,
                'variant_subtotal' => $item['variant_subtotal'] ?? 0,
                'variant_id' => $item['variant_id'] ?? 0,
            ];
        }

        return response()->json([
            'code' => '200',
            'product' => $cart[$cartKey],
            'carttotal' => $carttotal,
            'carthtml' => '',
        ]);
    }

    public function updateCart(Request $request)
    {
        $id = $request->id;
        $quantity = max(1, (int) $request->quantity);
        $session_key = $request->get('session_key', 'pos');
        $discount = (float) $request->get('discount', 0);

        $cart = session()->get($session_key, []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['subtotal'] = ($cart[$id]['price'] ?? 0) * $quantity;
            $cart[$id]['variant_subtotal'] = ($cart[$id]['variant_price'] ?? 0) * $quantity;
            session()->put($session_key, $cart);
        }

        $total = 0;
        $products = [];
        foreach ($cart as $key => $item) {
            $sub = ($item['variant_id'] ?? 0) > 0 ? ($item['variant_subtotal'] ?? 0) : ($item['subtotal'] ?? 0);
            $total += $sub;
            $products[] = [
                'id' => $key,
                'subtotal' => $item['subtotal'] ?? 0,
                'variant_subtotal' => $item['variant_subtotal'] ?? 0,
                'variant_id' => $item['variant_id'] ?? 0,
            ];
        }

        $afterDiscount = max(0, $total - $discount);

        return response()->json(['code' => '200', 'product' => $products, 'discount' => $afterDiscount]);
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->id;
        $session_key = $request->get('session_key', 'pos');

        $cart = session()->get($session_key, []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put($session_key, $cart);
        }

        if ($request->wantsJson() || $request->ajax()) {
            $total = 0;
            $products = [];
            foreach ($cart as $key => $item) {
                $sub = ($item['variant_id'] ?? 0) > 0 ? ($item['variant_subtotal'] ?? 0) : ($item['subtotal'] ?? 0);
                $total += $sub;
                $products[] = [
                    'id' => $key,
                    'subtotal' => $item['subtotal'] ?? 0,
                    'variant_id' => $item['variant_id'] ?? 0,
                ];
            }
            return response()->json(['code' => '200', 'product' => $products, 'success' => __('Item removed')]);
        }

        return redirect()->back()->with('success', __('Item removed from cart'));
    }

    public function emptyCart(Request $request)
    {
        $session_key = $request->get('session_key', 'pos');
        session()->forget($session_key);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['code' => '200', 'success' => __('Cart cleared')]);
        }

        return redirect()->back();
    }

    public function productVariant($id, $session)
    {
        $variant = ProductVariant::find($id);
        if (!$variant) {
            return response()->json(['error' => __('Variant not found')], 404);
        }

        return response()->json([
            'variant_id' => $variant->id,
            'price' => $variant->price ?? 0,
            'quantity' => $variant->quantity ?? 0,
        ]);
    }

    public function getVariantQuantity(Request $request)
    {
        $variants = $request->get('variants', '');
        $productId = $request->get('product_id');

        if (empty($variants)) {
            return response()->json(['variant_id' => 0, 'price' => 0, 'quantity' => 0]);
        }

        $variantName = trim($variants);
        $variant = ProductVariant::where('name', $variantName)->first();

        if (!$variant) {
            return response()->json(['variant_id' => 0, 'price' => 0, 'quantity' => 0]);
        }

        return response()->json([
            'variant_id' => $variant->id,
            'price' => $variant->price ?? 0,
            'quantity' => $variant->quantity ?? 0,
        ]);
    }

    public function searchProducts(Request $request)
    {
        $search = $request->get('search', '');
        $html = '';

        if (empty(trim($search))) {
            return response('');
        }

        // Rechercher par marques
        $brands = \App\Models\Brand::where('name', 'LIKE', "%{$search}%")->get();

        // Rechercher par familles (ProductVariant)
        $families = ProductVariant::with('category.brand')
            ->where('name', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get();

        // Rechercher par numéros de châssis
        $chassis = \App\Models\ChassisNumber::with('variant.category.brand')
            ->where('chassis_number', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get();

        if ($brands->isEmpty() && $families->isEmpty() && $chassis->isEmpty()) {
            return response('
                <div class="text-center py-4">
                    <div class="alert alert-warning">
                        <i class="ti ti-search-off me-2" style="font-size:1.5rem;"></i>
                        <strong>' . __('Aucun résultat pour') . ' "' . e($search) . '"</strong><br>
                        <small class="text-muted">' . __('Essayez un autre terme de recherche') . '</small>
                    </div>
                </div>
            ');
        }

        // Marques
        if ($brands->isNotEmpty()) {
            $html .= '<div class="mb-3"><h6 class="text-muted fw-bold"><i class="ti ti-building me-1"></i>' . __('Marques') . '</h6><div class="row row-gap-2">';
            foreach ($brands as $brand) {
                $img = $brand->brand_img
                    ? '<img src="' . \App\Models\Utility::get_file('uploads/brand_image/' . $brand->brand_img) . '" style="width:36px;height:36px;object-fit:cover;border-radius:6px;" class="me-2" onerror="this.style.display=\'none\'">'
                    : '<div class="me-2 bg-primary rounded d-flex align-items-center justify-content-center" style="width:36px;height:36px;min-width:36px;"><i class="ti ti-building text-white"></i></div>';
                $html .= '<div class="col-md-4 col-6">
                    <div class="card search-result-card" onclick="loadPosModels(' . $brand->id . ', \'' . addslashes($brand->name) . '\')" style="cursor:pointer;">
                        <div class="card-body py-2 px-3 d-flex align-items-center">
                            ' . $img . '
                            <div><strong>' . e($brand->name) . '</strong><br><small class="text-muted">' . __('Marque') . '</small></div>
                            <i class="ti ti-chevron-right ms-auto text-muted"></i>
                        </div>
                    </div>
                </div>';
            }
            $html .= '</div></div>';
        }

        // Familles
        if ($families->isNotEmpty()) {
            $html .= '<div class="mb-3"><h6 class="text-muted fw-bold"><i class="ti ti-folders me-1"></i>' . __('Familles') . '</h6><div class="row row-gap-2">';
            foreach ($families as $family) {
                $brandName = $family->category->brand->name ?? '';
                $html .= '<div class="col-md-4 col-6">
                    <div class="card search-result-card" onclick="loadPosChassis(' . $family->id . ', \'' . addslashes($family->name) . '\')" style="cursor:pointer;">
                        <div class="card-body py-2 px-3 d-flex align-items-center">
                            <i class="ti ti-folders me-2 text-success" style="font-size:1.5rem;"></i>
                            <div>
                                <strong>' . e($family->name) . '</strong><br>
                                <small class="text-muted">' . e($brandName) . ' • ' . __('Qté') . ': ' . ($family->quantity ?? 0) . '</small>
                            </div>
                            <i class="ti ti-chevron-right ms-auto text-muted"></i>
                        </div>
                    </div>
                </div>';
            }
            $html .= '</div></div>';
        }

        // Châssis
        if ($chassis->isNotEmpty()) {
            $html .= '<div class="mb-3"><h6 class="text-muted fw-bold"><i class="ti ti-barcode me-1"></i>' . __('Numéros de châssis') . '</h6><div class="row row-gap-2">';
            foreach ($chassis as $item) {
                $familyName = $item->variant->name ?? '';
                $brandName  = $item->variant->category->brand->name ?? '';
                $loc = $item->location ?? 'DEPOT';
                $locBadge = $loc === 'SHOW-ROOM'
                    ? '<span class="badge bg-success">' . $loc . '</span>'
                    : '<span class="badge bg-secondary">' . $loc . '</span>';
                $html .= '<div class="col-md-6 col-12">
                    <div class="card search-result-card" style="cursor:pointer;">
                        <div class="card-body py-2 px-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="badge bg-info me-1">' . e($item->chassis_number) . '</span>
                                <small class="text-muted">' . e($familyName) . ' — ' . e($brandName) . '</small><br>
                                ' . $locBadge . '
                            </div>
                            <button class="btn btn-sm btn-primary add-scan-to-cart ms-2"
                                    data-chassis-id="' . $item->id . '"
                                    data-variant-id="' . ($item->variant_id ?? 0) . '">
                                <i class="ti ti-plus"></i> ' . __('Ajouter') . '
                            </button>
                        </div>
                    </div>
                </div>';
            }
            $html .= '</div></div>';
        }

        return response($html);
    }
}
