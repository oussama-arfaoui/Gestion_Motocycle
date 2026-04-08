<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Utility;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // List all brands
    public function index()
    {
        $brands = Brand::with(['categories.variants.chassisNumbers'])->get();
        return view('brand.index', compact('brands'));
    }

    // Show create form
    public function create()
    {
        return view('brand.create');
    }

// Store a new brand
public function store(Request $request)
{
    $validator = \Validator::make(
        $request->all(),
        [
            'name' => 'required|max:190',
            'brand_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]
    );

    if ($validator->fails()) {
        return redirect()->back()->with('error', $validator->getMessageBag()->first());
    }

    $fileNameToStores = null;

    if ($request->hasFile('brand_img')) {
        $image_size = $request->file('brand_img')->getSize();
        $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);

        if ($result == 1) {
            $filenameWithExt = $request->file('brand_img')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('brand_img')->getClientOriginalExtension();
            $fileNameToStores = $filename . '_' . time() . '.' . $extension;

            $dir = 'uploads/brand_image/';
            $path = Utility::upload_file($request, 'brand_img', $fileNameToStores, $dir, []);

            if ($path['flag'] != 1) {
                return redirect()->back()->with('error', __($path['msg']));
            }
        }
    }

    $brand = new Brand();
    $brand->name = $request->name;
    if (!empty($fileNameToStores)) {
        // Store only the filename
        $brand->brand_img = $fileNameToStores;
    }
    $brand->save();

    return redirect()->route('brands.index')->with('success', __('Brand added!') . ((isset($result) && $result != 1) ? '<br> <span class="text-danger">' . $result . '</span>' : ''));
}

    // Show edit form
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brand.edit', compact('brand'));
    }

  // Update brand
public function update(Request $request, $id)
{
    $brand = Brand::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:191',
        'brand_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('brand_img')) {
        $filenameWithExt = $request->file('brand_img')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('brand_img')->getClientOriginalExtension();
        $fileNameToStores = $filename . '_' . time() . '.' . $extension;

        $dir = 'uploads/brand_image/';
        $path = Utility::upload_file($request, 'brand_img', $fileNameToStores, $dir, []);

        if ($path['flag'] != 1) {
            return redirect()->back()->with('error', __($path['msg']));
        }

        // Store only the filename
        $brand->brand_img = $fileNameToStores;
    }

    $brand->name = $request->name;
    $brand->save();

    return redirect()->route('brands.index')->with('success', __('Brand updated successfully.'));
}

    // Delete brand
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brands.index')->with('success', __('Brand deleted successfully.'));
    }

    // Edit Model (Category)
    public function editModel($id)
    {
        try {
            $model = \App\Models\ProductCategorie::findOrFail($id);
            return response()->json(['model' => $model]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Model not found: ') . $e->getMessage()], 404);
        }
    }

    // Update Model (Category)
    public function updateModel(Request $request, $id)
    {
        try {
            $model = \App\Models\ProductCategorie::findOrFail($id);
            
            $validator = \Validator::make($request->all(), [
                'name' => 'required|max:190',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->getMessageBag()->first()], 422);
            }

            $model->name = $request->name;
            $model->save();

            return response()->json(['success' => true, 'message' => __('Model updated successfully.')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Error updating model: ') . $e->getMessage()], 500);
        }
    }

    // Delete Model (Category)
    public function deleteModel($id)
    {
        $model = \App\Models\ProductCategorie::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true, 'message' => __('Model deleted successfully.')]);
    }

    // Edit Family (Variant)
    public function editFamily($id)
    {
        try {
            $family = \App\Models\ProductVariant::findOrFail($id);
            return response()->json(['family' => $family]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Family not found: ') . $e->getMessage()], 404);
        }
    }

    // Update Family (Variant)
    public function updateFamily(Request $request, $id)
    {
        try {
            $family = \App\Models\ProductVariant::findOrFail($id);
            
            $validator = \Validator::make($request->all(), [
                'name' => 'required|max:190',
                'quantity' => 'nullable|integer|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->getMessageBag()->first()], 422);
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                $image_size = $request->file('image')->getSize();
                $result = \App\Models\Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);

                if ($result == 1) {
                    $filenameWithExt = $request->file('image')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                    $dir = 'uploads/family_image/';
                    $path = \App\Models\Utility::upload_file($request, 'image', $fileNameToStore, $dir, []);

                    if ($path['flag'] != 1) {
                        return response()->json(['success' => false, 'message' => __($path['msg'])]);
                    }
                    
                    // Store only the filename
                    $family->image = $fileNameToStore;
                }
            }

            $family->name = $request->name;
            $family->quantity = $request->quantity ?? $family->quantity ?? 0;
            $family->save();

            return response()->json(['success' => true, 'message' => __('Family updated successfully.')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Error updating family: ') . $e->getMessage()], 500);
        }
    }

    // Delete Family (Variant)
    public function deleteFamily($id)
    {
        $family = \App\Models\ProductVariant::findOrFail($id);
        $family->delete();

        return response()->json(['success' => true, 'message' => __('Family deleted successfully.')]);
    }

    // Handle hierarchy AJAX requests
    public function hierarchyStore(Request $request)
    {
        $actionType = $request->input('action_type');
        $parentId = $request->input('parent_id');
        
        try {
            switch ($actionType) {
                case 'model':
                    // Add model (category) to brand
                    $validator = \Validator::make($request->all(), [
                        'name' => 'required|max:190',
                    ]);

                    if ($validator->fails()) {
                        return response()->json(['success' => false, 'message' => $validator->getMessageBag()->first()], 422);
                    }

                    $category = new \App\Models\ProductCategorie();
                    $category->name = $request->name;
                    $category->brand_id = $parentId;
                    $category->save();

                    return response()->json(['success' => true, 'message' => __('Model added successfully.')]);

                case 'family':
                    // Add family (variant) to model
                    $validator = \Validator::make($request->all(), [
                        'name' => 'required|max:190',
                        'quantity' => 'required|integer|min:1',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    if ($validator->fails()) {
                        return response()->json(['success' => false, 'message' => $validator->getMessageBag()->first()], 422);
                    }

                    $variant = new \App\Models\ProductVariant();
                    $variant->name = $request->name;
                    $variant->quantity = $request->quantity;
                    $variant->category_id = $parentId;
                    
                    // Handle image upload
                    if ($request->hasFile('image')) {
                        $image_size = $request->file('image')->getSize();
                        $result = \App\Models\Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);

                        if ($result == 1) {
                            $filenameWithExt = $request->file('image')->getClientOriginalName();
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            $extension = $request->file('image')->getClientOriginalExtension();
                            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                            $dir = 'uploads/family_image/';
                            $path = \App\Models\Utility::upload_file($request, 'image', $fileNameToStore, $dir, []);

                            if ($path['flag'] != 1) {
                                return response()->json(['success' => false, 'message' => __($path['msg'])]);
                            }
                            
                            // Store only the filename
                            $variant->image = $fileNameToStore;
                        }
                    }
                    
                    $variant->save();

                    return response()->json(['success' => true, 'message' => __('Family added successfully.')]);

                case 'chassis':
                    // Add chassis numbers to family
                    $validator = \Validator::make($request->all(), [
                        'chassis_numbers' => 'required|array|min:1',
                        'chassis_numbers.*.number' => 'required|string|max:190',
                        'chassis_numbers.*.date' => 'nullable|date',
                        'chassis_numbers.*.location' => 'nullable|string|in:DEPOT,SHOW-ROOM',
                    ]);

                    if ($validator->fails()) {
                        return response()->json(['success' => false, 'message' => $validator->getMessageBag()->first()], 422);
                    }

                    $variant = \App\Models\ProductVariant::findOrFail($parentId);

                    foreach ($request->chassis_numbers as $chassisData) {
                        $chassis = new \App\Models\ChassisNumber();
                        $chassis->chassis_number = $chassisData['number'];
                        $chassis->variant_id = $variant->id;
                        $chassis->date = isset($chassisData['date']) ? $chassisData['date'] : null;
                        $chassis->location = isset($chassisData['location']) ? $chassisData['location'] : 'DEPOT';
                        $chassis->save();
                    }

                    return response()->json(['success' => true, 'message' => __('Chassis numbers added successfully.')]);

                default:
                    return response()->json(['success' => false, 'message' => __('Action non valide')], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Une erreur est survenue: ') . $e->getMessage()], 500);
        }
    }

    // Get models for a brand
    public function getModels($brandId)
    {
        $models = \App\Models\ProductCategorie::where('brand_id', $brandId)->get();
        return response()->json(['models' => $models]);
    }

    // Get families for a model
    public function getFamilies($modelId)
    {
        $families = \App\Models\ProductVariant::where('category_id', $modelId)->with('chassisNumbers')->get();
        
        // Add SHOW-ROOM and DEPOT counts
        $families->each(function ($family) {
            $family->qty_showroom = $family->chassisNumbers->where('location', 'SHOW-ROOM')->count();
            $family->qty_depot = $family->chassisNumbers->where('location', 'DEPOT')->count();
        });
        
        return response()->json(['families' => $families]);
    }

    // Get products (chassis numbers) for a family
    public function getProducts($familyId)
    {
        $variant = \App\Models\ProductVariant::with('chassisNumbers')->find($familyId);
        if (!$variant) {
            return response()->json(['products' => []]);
        }

        $products = $variant->chassisNumbers->map(function($chassis) use ($variant) {
            return [
                'id' => $chassis->id,
                'name' => $variant->name,
                'chassis_number' => $chassis->chassis_number,
                'date' => $chassis->date ? date('Y-m-d', strtotime($chassis->date)) : null,
                'location' => $chassis->location
            ];
        });

        return response()->json(['products' => $products]);
    }
    
    // Edit Chassis Number
    public function editChassis($id)
    {
        try {
            $chassis = \App\Models\ChassisNumber::with('variant')->findOrFail($id);
            return response()->json(['chassis' => $chassis]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Chassis not found: ') . $e->getMessage()], 404);
        }
    }
    
    // Update Chassis Number
    public function updateChassis(Request $request, $id)
    {
        try {
            $chassis = \App\Models\ChassisNumber::findOrFail($id);
            
            $validator = \Validator::make($request->all(), [
                'chassis_number' => 'required|string|max:190',
                'date' => 'nullable|date',
                'location' => 'nullable|string|in:DEPOT,SHOW-ROOM',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->getMessageBag()->first()], 422);
            }

            $chassis->chassis_number = $request->chassis_number;
            $chassis->date = $request->date;
            $chassis->location = $request->location ?? 'DEPOT';
            $chassis->save();

            return response()->json(['success' => true, 'message' => __('Chassis updated successfully.')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Error updating chassis: ') . $e->getMessage()], 500);
        }
    }
    
    // Delete Chassis Number
    public function deleteChassis($id)
    {
        try {
            $chassis = \App\Models\ChassisNumber::findOrFail($id);
            $chassis->delete();
            return response()->json(['success' => true, 'message' => __('Chassis deleted successfully.')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Error deleting chassis: ') . $e->getMessage()], 500);
        }
    }
}
