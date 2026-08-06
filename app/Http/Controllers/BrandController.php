<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Utility;
use App\Models\ProductCategorie;
use App\Models\ProductVariant;
use App\Models\ChassisNumber;
use App\Exports\StockExport;
use App\Exports\StockTemplateExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class BrandController extends Controller
{
    // List all brands
    public function index()
    {
        if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Manage Brands') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Create Products') && !\Auth::user()->can('Edit Products') && !\Auth::user()->can('Show Products')) {
            return redirect()->route('profile')->with('error', __('Permission denied.'));
        }
        $brands = Brand::with(['categories.variants.chassisNumbers'])->get();
        return view('brand.index', compact('brands'));
    }

    // Show create form
    public function create()
    {
        if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Create Brand') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Create Products')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        return view('brand.create');
    }

// Store a new brand
public function store(Request $request)
{
    if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Create Brand') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Create Products')) {
        return redirect()->back()->with('error', __('Permission denied.'));
    }
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
    $brand->reference = $request->input('reference');
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
        if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Edit Brand') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Edit Products')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        $brand = Brand::findOrFail($id);
        return view('brand.edit', compact('brand'));
    }

  // Update brand
public function update(Request $request, $id)
{
    if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Edit Brand') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Edit Products')) {
        return redirect()->back()->with('error', __('Permission denied.'));
    }
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
    $brand->reference = $request->input('reference');
    $brand->save();

    return redirect()->route('brands.index')->with('success', __('Brand updated successfully.'));
}

    // Delete brand
    public function destroy($id)
    {
        if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Delete Brand') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Delete Products')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brands.index')->with('success', __('Brand deleted successfully.'));
    }

    // Get brand statistics for dashboard
    public function getBrandStats()
    {
        $brands = Brand::with(['categories.variants.chassisNumbers'])->get();
        
        $totalModels = 0;
        $totalFamilies = 0;
        $totalStock = 0;
        $brandStats = [];
        
        foreach ($brands as $brand) {
            $modelsCount = $brand->categories->count();
            $familiesCount = $brand->categories->sum(function($category) {
                return $category->variants->count();
            });
            $stockCount = $brand->categories->sum(function($category) {
                return $category->variants->sum(function($variant) {
                    return $variant->chassisNumbers->count();
                });
            });
            
            $totalModels += $modelsCount;
            $totalFamilies += $familiesCount;
            $totalStock += $stockCount;
            
            $brandStats[] = [
                'id' => $brand->id,
                'name' => $brand->name,
                'models_count' => $modelsCount,
                'families_count' => $familiesCount,
                'total_stock' => $stockCount
            ];
        }
        
        return response()->json([
            'total_models' => $totalModels,
            'total_families' => $totalFamilies,
            'total_stock' => $totalStock,
            'brands' => $brandStats
        ]);
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
            $model->reference = $request->input('reference');
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
            if (in_array($request->input('tracking_type'), ['chassis', 'ref'])) {
                $family->tracking_type = $request->input('tracking_type');
            }
            // Référence : utilisée uniquement pour les familles de type "ref"
            if (($family->tracking_type ?? 'chassis') === 'ref') {
                $family->reference = $request->input('reference');
            } else {
                $family->reference = null;
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
                    $category->reference = $request->input('reference');
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
                    $variant->tracking_type = in_array($request->input('tracking_type'), ['chassis', 'ref']) ? $request->input('tracking_type') : 'chassis';
                    $variant->reference = $variant->tracking_type === 'ref' ? $request->input('reference') : null;
                    
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

                    // Si la famille est suivie par numéro de châssis, chaque numéro doit être unique.
                    // Pour une famille de type "référence", les doublons sont autorisés.
                    $isUnique = ($variant->tracking_type ?? 'chassis') === 'chassis';

                    if ($isUnique) {
                        $submitted = array_map(function ($c) {
                            return trim($c['number']);
                        }, $request->chassis_numbers);

                        // Doublons dans la saisie elle-même
                        $duplicatesInBatch = array_diff_assoc($submitted, array_unique($submitted));
                        if (!empty($duplicatesInBatch)) {
                            return response()->json([
                                'success' => false,
                                'message' => __('Numéro de châssis en double dans la saisie : ') . implode(', ', array_unique($duplicatesInBatch)),
                            ], 422);
                        }

                        // Doublons déjà présents pour cette famille
                        $existing = \App\Models\ChassisNumber::where('variant_id', $variant->id)
                            ->whereIn('chassis_number', $submitted)
                            ->pluck('chassis_number')
                            ->all();
                        if (!empty($existing)) {
                            return response()->json([
                                'success' => false,
                                'message' => __('Ce numéro de châssis existe déjà : ') . implode(', ', $existing),
                            ], 422);
                        }
                    }

                    foreach ($request->chassis_numbers as $chassisData) {
                        $chassis = new \App\Models\ChassisNumber();
                        $chassis->chassis_number = trim($chassisData['number']);
                        $chassis->variant_id = $variant->id;
                        $chassis->date = isset($chassisData['date']) ? $chassisData['date'] : null;
                        $chassis->location = isset($chassisData['location']) ? $chassisData['location'] : 'DEPOT';
                        $chassis->save();
                    }

                    $label = $isUnique ? __('Numéros de châssis ajoutés avec succès.') : __('Références ajoutées avec succès.');
                    return response()->json(['success' => true, 'message' => $label]);

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

        return response()->json([
            'products' => $products,
            'counters' => $counters,
            'tracking_type' => $variant->tracking_type ?? 'chassis',
            'family_name' => $variant->name,
        ]);
    }

    // Page d'impression des étiquettes (QR / code-barres) pour une famille
    public function printLabels(Request $request, $id)
    {
        $family = \App\Models\ProductVariant::with(['category.brand', 'chassisNumbers'])->findOrFail($id);

        $template  = (int) $request->get('template', 1);
        if (!in_array($template, [1, 2, 3])) {
            $template = 1;
        }
        $withPrice = $request->boolean('price', true);
        $chassisId = $request->get('chassis');

        // Dimensions par défaut (mm) par modèle, surchargées par la requête
        $defaults = [
            1 => ['w' => 50, 'h' => 25],
            2 => ['w' => 50, 'h' => 25],
            3 => ['w' => 58, 'h' => 40],
        ];
        $w = (float) $request->get('w', $defaults[$template]['w']);
        $h = (float) $request->get('h', $defaults[$template]['h']);
        if ($w < 10 || $w > 300) { $w = $defaults[$template]['w']; }
        if ($h < 10 || $h > 300) { $h = $defaults[$template]['h']; }

        // Orientation : on garantit le sens demandé en réarrangeant largeur/hauteur
        $orientation = $request->get('orientation', 'portrait') === 'landscape' ? 'landscape' : 'portrait';
        if ($orientation === 'portrait' && $w > $h) {
            [$w, $h] = [$h, $w];
        } elseif ($orientation === 'landscape' && $h > $w) {
            [$w, $h] = [$h, $w];
        }
        $labelWidth  = $w . 'mm';
        $labelHeight = $h . 'mm';

        $brand = optional(optional($family->category)->brand)->name ?? '';
        $model = optional($family->category)->name ?? '';
        $trackingType = $family->tracking_type ?? 'chassis';
        $codeLabel = $trackingType === 'ref' ? __('Réf') : __('N° Châssis');

        // Construire la liste des valeurs à imprimer
        if ($trackingType === 'ref') {
            // Référence héritée : famille -> modèle -> marque
            $inheritedRef = $family->reference
                ?: (optional($family->category)->reference
                    ?: optional(optional($family->category)->brand)->reference);

            if (!empty($inheritedRef)) {
                $values = collect([$inheritedRef]);
            } else {
                $values = $family->chassisNumbers->pluck('chassis_number')->filter()->unique()->values();
                if ($values->isEmpty()) {
                    $values = collect([$family->name]);
                }
            }
        } else {
            $chassis = $family->chassisNumbers;
            if ($chassisId) {
                $chassis = $chassis->where('id', $chassisId);
            }
            $values = $chassis->pluck('chassis_number')->filter()->values();
            if ($values->isEmpty()) {
                $values = collect([$family->name]);
            }
        }

        return view('brand.print', [
            'family'       => $family,
            'brand'        => $brand,
            'model'        => $model,
            'template'     => $template,
            'withPrice'    => $withPrice,
            'values'       => $values,
            'codeLabel'    => $codeLabel,
            'trackingType' => $trackingType,
            'labelWidth'   => $labelWidth,
            'labelHeight'  => $labelHeight,
        ]);
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
            $allBrands = \App\Models\Brand::with(['categories.variants'])->get();
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

    // ==================== Import / Export ====================

    // Export the stock (Marque → Modèle → Famille → Numéro de châssis) with optional date range
    public function exportStock(Request $request)
    {
        if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Manage Brands') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Show Products')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $from = $request->input('from_date');
        $to   = $request->input('to_date');

        $name = 'Stock_Moto_' . date('Y-m-d_His') . '.xlsx';

        return Excel::download(new StockExport($from, $to), $name);
    }

    // Download an empty import template with example rows
    public function downloadTemplate()
    {
        if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Manage Brands') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Create Products')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return Excel::download(new StockTemplateExport(), 'Modele_Import_Stock.xlsx');
    }

    // Import the stock from an xlsx/csv file following the template
    public function importStock(Request $request)
    {
        if (\Auth::user()->type !== 'Owner' && !\Auth::user()->can('Manage Brands') && !\Auth::user()->can('Manage Products') && !\Auth::user()->can('Create Products')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $validator = \Validator::make($request->all(), [
            'import_file' => 'required|file|mimes:xlsx,xls,csv,txt',
        ], [
            'import_file.mimes' => __('Format non accepté ! Utilisez un fichier XLSX, XLS ou CSV.'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->getMessageBag()->first());
        }

        try {
            $sheets = Excel::toArray([], $request->file('import_file'));
            $rows   = $sheets[0] ?? [];

            if (empty($rows)) {
                return redirect()->back()->with('error', __('Le fichier est vide.'));
            }

            // Locate the header row and build a column index map
            $colMap     = null;
            $startIndex = 0;
            foreach ($rows as $index => $row) {
                $map = $this->mapHeaderColumns($row);
                if ($map !== null) {
                    $colMap     = $map;
                    $startIndex = $index + 1;
                    break;
                }
            }

            if ($colMap === null || !isset($colMap['chassis'])) {
                return redirect()->back()->with('error', __('En-têtes introuvables. Utilisez le modèle fourni (Marque, Modèle, Famille, Numéro de châssis).'));
            }

            $imported       = 0;
            $skipped        = 0;
            $touchedVariants = [];

            for ($i = $startIndex; $i < count($rows); $i++) {
                $row = $rows[$i];

                $brandName  = isset($colMap['marque']) ? trim((string) ($row[$colMap['marque']] ?? '')) : '';
                $modelName  = isset($colMap['modele']) ? trim((string) ($row[$colMap['modele']] ?? '')) : '';
                $familyName = isset($colMap['famille']) ? trim((string) ($row[$colMap['famille']] ?? '')) : '';
                $chassisNo  = trim((string) ($row[$colMap['chassis']] ?? ''));
                $rawDate    = isset($colMap['date']) ? ($row[$colMap['date']] ?? null) : null;
                $rawLieu    = isset($colMap['lieu']) ? trim((string) ($row[$colMap['lieu']] ?? '')) : '';

                // A row is only useful if it has at least a chassis number and a brand/model/family
                if ($chassisNo === '' || ($brandName === '' && $modelName === '' && $familyName === '')) {
                    $skipped++;
                    continue;
                }

                $brandName  = $brandName !== '' ? $brandName : 'Non assigné';
                $modelName  = $modelName !== '' ? $modelName : 'Non assigné';
                $familyName = $familyName !== '' ? $familyName : 'Non assigné';

                $brand = $this->firstOrCreateCaseInsensitive(
                    Brand::class,
                    ['name' => $brandName],
                    ['name' => $brandName, 'brand_img' => 'default.jpg']
                );

                $category = $this->firstOrCreateCaseInsensitive(
                    ProductCategorie::class,
                    ['name' => $modelName, 'brand_id' => $brand->id],
                    ['name' => $modelName, 'brand_id' => $brand->id]
                );

                $variant = $this->firstOrCreateCaseInsensitive(
                    ProductVariant::class,
                    ['name' => $familyName, 'category_id' => $category->id],
                    ['name' => $familyName, 'category_id' => $category->id, 'price' => 0, 'quantity' => 0]
                );

                $chassis = ChassisNumber::where('chassis_number', $chassisNo)
                    ->where('variant_id', $variant->id)
                    ->first();

                if (!$chassis) {
                    $chassis = new ChassisNumber();
                    $chassis->chassis_number = $chassisNo;
                    $chassis->variant_id     = $variant->id;
                }

                $chassis->date     = $this->parseImportDate($rawDate);
                $chassis->location = $this->normalizeLocation($rawLieu);
                $chassis->save();

                $touchedVariants[$variant->id] = true;
                $imported++;
            }

            // Keep variant quantities consistent with the number of chassis
            foreach (array_keys($touchedVariants) as $variantId) {
                $variant = ProductVariant::find($variantId);
                if ($variant) {
                    $count = $variant->chassisNumbers()->count();
                    if ($count > ($variant->quantity ?? 0)) {
                        $variant->quantity = $count;
                        $variant->save();
                    }
                }
            }

            $message = __(':imported numéro(s) de châssis importé(s).', ['imported' => $imported]);
            if ($skipped > 0) {
                $message .= ' ' . __(':skipped ligne(s) ignorée(s) (doublons ou incomplètes).', ['skipped' => $skipped]);
            }

            return redirect()->route('brands.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('Erreur lors de l\'import: ') . $e->getMessage());
        }
    }

    // Build a column-index map from a potential header row, or null if not a header
    private function mapHeaderColumns(array $row)
    {
        $map = [];
        foreach ($row as $index => $value) {
            $key = $this->normalizeHeader((string) $value);
            if ($key === '') {
                continue;
            }
            if (\Illuminate\Support\Str::contains($key, 'marque')) {
                $map['marque'] = $index;
            } elseif (\Illuminate\Support\Str::contains($key, 'modele')) {
                $map['modele'] = $index;
            } elseif (\Illuminate\Support\Str::contains($key, 'famille') || \Illuminate\Support\Str::contains($key, 'designation')) {
                $map['famille'] = $index;
            } elseif (\Illuminate\Support\Str::contains($key, 'chassis') || \Illuminate\Support\Str::contains($key, 'numero')) {
                $map['chassis'] = $index;
            } elseif (\Illuminate\Support\Str::contains($key, 'date')) {
                $map['date'] = $index;
            } elseif (\Illuminate\Support\Str::contains($key, 'lieu') || \Illuminate\Support\Str::contains($key, 'location') || \Illuminate\Support\Str::contains($key, 'emplacement')) {
                $map['lieu'] = $index;
            }
        }

        // Consider it a valid header only if it identifies the chassis column
        return isset($map['chassis']) ? $map : null;
    }

    // Normalize a header label: lowercase, strip accents and non-letters
    private function normalizeHeader(string $value): string
    {
        $value = mb_strtolower(trim($value));
        $value = strtr($value, [
            'à' => 'a', 'â' => 'a', 'ä' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'î' => 'i', 'ï' => 'i',
            'ô' => 'o', 'ö' => 'o',
            'û' => 'u', 'ù' => 'u', 'ü' => 'u',
            'ç' => 'c',
        ]);
        return preg_replace('/[^a-z]/', '', $value);
    }

    // Parse a date coming from Excel (serial number or string) into Y-m-d or null
    private function parseImportDate($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            try {
                return ExcelDate::excelToDateTimeObject((float) $value)->format('Y-m-d');
            } catch (\Exception $e) {
                // fall through to string parsing
            }
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    // Normalize the location to DEPOT or SHOW-ROOM (default DEPOT)
    private function normalizeLocation($value): string
    {
        $key = $this->normalizeHeader((string) $value);
        if (\Illuminate\Support\Str::contains($key, 'showroom') || \Illuminate\Support\Str::contains($key, 'show')) {
            return 'SHOW-ROOM';
        }
        return 'DEPOT';
    }

    // Case-insensitive first-or-create for import records (BECANE == BECAne)
    private function firstOrCreateCaseInsensitive($modelClass, array $match, array $create = [])
    {
        $query = $modelClass::query();
        foreach ($match as $key => $value) {
            if (is_string($value)) {
                $query->whereRaw('LOWER(' . $key . ') = ?', [mb_strtolower($value)]);
            } else {
                $query->where($key, $value);
            }
        }

        $instance = $query->first();
        if ($instance) {
            return $instance;
        }

        return $modelClass::create($create);
    }
}
