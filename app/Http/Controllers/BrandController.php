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
            'brand_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ],
        [
            'brand_img.mimes' => 'Format non accepté ! Utilisez seulement : JPG, JPEG, PNG ou WEBP',
            'brand_img.max'   => 'Image trop grande ! Maximum 2MB autorisé',
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
        'brand_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ], [
        'brand_img.mimes' => 'Format non accepté ! Utilisez seulement : JPG, JPEG, PNG ou WEBP',
        'brand_img.max'   => 'Image trop grande ! Maximum 2MB autorisé',
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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ], [
                'image.mimes' => 'Format non accepté ! Utilisez seulement : JPG, JPEG, PNG ou WEBP',
                'image.max'   => 'Image trop grande ! Maximum 2MB autorisé',
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
            if ($request->has('price')) {
                $family->price = (float)$request->input('price', 0);
            }
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
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                    ], [
                        'image.mimes' => 'Format non accepté ! Utilisez seulement : JPG, JPEG, PNG ou WEBP',
                        'image.max'   => 'Image trop grande ! Maximum 2MB autorisé',
                    ]);

                    if ($validator->fails()) {
                        return response()->json(['success' => false, 'message' => $validator->getMessageBag()->first()], 422);
                    }

                    $variant = new \App\Models\ProductVariant();
                    $variant->name = $request->name;
                    $variant->price = (float)($request->input('price', 0));
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
            $total = $family->quantity ?? 0;
            $showroom = $family->chassisNumbers->where('location', 'SHOW-ROOM')->count();
            $depot = $family->chassisNumbers->where('location', 'DEPOT')->count();
            
            $family->qty_showroom = $showroom;
            // Dépôt = total - showroom (pour garantir total = showroom + depot)
            $family->qty_depot = $total - $showroom;
        });
        
        return response()->json(['families' => $families]);
    }

    // Get products (chassis numbers) for a family
    public function getProducts($familyId)
    {
        $variant = \App\Models\ProductVariant::with('chassisNumbers')->find($familyId);
        if (!$variant) {
            return response()->json(['products' => [], 'counters' => null]);
        }

        $products = $variant->chassisNumbers->map(function($chassis) use ($variant) {
            return [
                'id' => $chassis->id,
                'name' => $variant->name,
                'chassis_number' => $chassis->chassis_number,
                'date' => $chassis->date ? date('Y-m-d', strtotime($chassis->date)) : null,
                'location' => $chassis->location ?: 'DEPOT' // Valeur par défaut
            ];
        });

        // Utiliser quantity comme total et répartir selon les châssis réels
        $total = $variant->quantity ?? 0;
        $realShowroom = $variant->chassisNumbers->where('location', 'SHOW-ROOM')->count();
        $realDepot = $variant->chassisNumbers->where('location', 'DEPOT')->count();
        
        // Garantir la cohérence : total = showroom + depot
        if ($realShowroom + $realDepot > 0) {
            $showroom = $realShowroom;
            $depot = $realDepot;
            $total = $showroom + $depot;
        } else {
            // Pas de châssis réels, tout en dépôt
            $showroom = 0;
            $depot = $total;
        }

        $counters = [
            'total' => $total,
            'depot' => $depot,
            'showroom' => $showroom
        ];

        return response()->json(['products' => $products, 'counters' => $counters]);
    }
    
    // Analyser tout le stock par emplacement
    public function analyzeAllStock()
    {
        try {
            // Récupérer tous les numéros de châssis avec leurs variantes
            $allChassis = \App\Models\ChassisNumber::with('variant.category.brand')->get();
            
            // Utiliser les quantities des variantes comme total global
            $allVariants = \App\Models\ProductVariant::all();
            $totalGlobal = $allVariants->sum('quantity');
            $realShowroomGlobal = $allChassis->where('location', 'SHOW-ROOM')->count();
            $realDepotGlobal = $allChassis->where('location', 'DEPOT')->count();
            
            // Toujours garantir que total = showroom + depot
            // Si des chassis réels existent, les utiliser et ajuster le total
            if ($realShowroomGlobal + $realDepotGlobal > 0) {
                $showroomGlobal = $realShowroomGlobal;
                $depotGlobal = $realDepotGlobal;
                $totalGlobal = $showroomGlobal + $depotGlobal;
            } else {
                // Pas de chassis réels, tout en dépôt
                $showroomGlobal = 0;
                $depotGlobal = $totalGlobal;
            }
            
            $stockAnalysis = [
                'total_global' => $totalGlobal,
                'depot_global' => $depotGlobal,
                'showroom_global' => $showroomGlobal,
                'by_brand' => [],
                'by_family' => [],
                'details' => []
            ];
            
            // Analyser par marque — inclure toutes les marques (avec ou sans chassis)
            $allBrands = \App\Models\Brand::with(['productCategories.variants'])->get();
            foreach ($allBrands as $brand) {
                $brandVariants = \App\Models\ProductVariant::whereHas('category', function($q) use ($brand) {
                    $q->where('brand_id', $brand->id);
                })->get();
                $brandTotal = $brandVariants->sum('quantity');
                $brandVariantIds = $brandVariants->pluck('id');
                $brandChassis = $allChassis->filter(fn($c) => $brandVariantIds->contains($c->variant_id ?? null));
                $brandShowroom = $brandChassis->where('location', 'SHOW-ROOM')->count();
                $brandDepot    = $brandChassis->where('location', 'DEPOT')->count();
                // Garantir la cohérence : total = showroom + depot
                if ($brandShowroom + $brandDepot > 0) {
                    $brandTotal = $brandShowroom + $brandDepot;
                } else {
                    $brandDepot = $brandTotal;
                }
                $stockAnalysis['by_brand'][$brand->name] = [
                    'total'   => $brandTotal,
                    'depot'   => $brandDepot,
                    'showroom'=> $brandShowroom,
                ];
            }

            // Analyser par famille — inclure toutes les variantes (avec ou sans chassis)
            foreach ($allVariants as $variant) {
                $familyName    = $variant->name ?? 'Non assigné';
                $familyTotal   = $variant->quantity ?? 0;
                $familyChassis = $allChassis->where('variant_id', $variant->id);
                $familyShowroom= $familyChassis->where('location', 'SHOW-ROOM')->count();
                $familyDepot   = $familyChassis->where('location', 'DEPOT')->count();
                // Garantir la cohérence : total = showroom + depot
                if ($familyShowroom + $familyDepot > 0) {
                    $familyTotal = $familyShowroom + $familyDepot;
                } else {
                    $familyDepot = $familyTotal;
                }
                $stockAnalysis['by_family'][$familyName] = [
                    'total'   => $familyTotal,
                    'depot'   => $familyDepot,
                    'showroom'=> $familyShowroom,
                ];
            }
            
            // Détails pour debug
            $stockAnalysis['details'] = $allChassis->take(10)->map(function($chassis) {
                return [
                    'chassis_number' => $chassis->chassis_number,
                    'location' => $chassis->location,
                    'brand' => $chassis->variant->category->brand->name ?? 'N/A',
                    'family' => $chassis->variant->name ?? 'N/A',
                ];
            });
            
            return response()->json(['success' => true, 'analysis' => $stockAnalysis]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
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
