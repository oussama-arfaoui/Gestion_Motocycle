<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Utility;

class ProductCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Product category')){
            $user = \Auth::user()->current_store;

            $product_categorys = ProductCategorie::where('store_id', $user)->where('created_by', \Auth::user()->creatorId())->get();

            return view('product_category.index', compact('product_categorys'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
            public function create()
        {
            $brands = \App\Models\Brand::all(); // For dropdown
            $parentCategories = ProductCategorie::where('parent_id', null)
                                                ->where('store_id', \Auth::user()->current_store)
                                                ->get();
            return view('product_category.create', compact('brands', 'parentCategories'));
        }
        
public function store(Request $request)
{
    if(\Auth::user()->can('Create Product category')){

        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:190',
            'brand_id' => 'nullable|exists:brands,id',
            'parent_id' => 'nullable|exists:product_categories,id',
            'categorie_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', $validator->getMessageBag()->first());
        }

        $fileNameToStore = null;

        if($request->hasFile('categorie_img')){
            $file = $request->file('categorie_img');
            $image_size = $file->getSize();
            $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);

            if($result == 1){
                $originalName = $file->getClientOriginalName();
                $filename = pathinfo($originalName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $settings = Utility::getStorageSetting();
                $dir = ($settings['storage_setting'] == 'local') ? 'uploads/product_image/' : 'uploads/product_image/';

                $path = Utility::upload_file($request, 'categorie_img', $fileNameToStore, $dir, []);

                if($path['flag'] != 1){
                    return redirect()->back()->with('error', __($path['msg']));
                }
                // NOTE: We store only the filename in DB
            }
        }

        $productCategorie = new ProductCategorie();
        $productCategorie->store_id = \Auth::user()->current_store;
        $productCategorie->name = $request->name;
        $productCategorie->brand_id = $request->brand_id ?? null;
        $productCategorie->parent_id = $request->parent_id ?? null;
        if($fileNameToStore){
            $productCategorie->categorie_img = $fileNameToStore; // only filename
        }
        $productCategorie->created_by = \Auth::user()->creatorId();
        $productCategorie->save();

        return redirect()->back()->with('success', __('Product Category added!'));
    }

    return redirect()->back()->with('error', 'Permission denied.');
}


    /**
     * Display the specified resource.
     *
     * @param \App\ProductCategorie $productCategorie
     *
     * @return \Illuminate\Http\Response
     */

    public function show(ProductCategorie $productCategorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ProductCategorie $productCategorie
     *
     * @return \Illuminate\Http\Response
     */
  public function edit(ProductCategorie $productCategorie)
{
    $brands = \App\Models\Brand::all();
    $parentCategories = ProductCategorie::where('parent_id', null)
                                        ->where('store_id', \Auth::user()->current_store)
                                        ->get();
    return view('product_category.edit', compact('productCategorie', 'brands', 'parentCategories'));
}

public function update(Request $request, ProductCategorie $productCategorie)
{
    if(\Auth::user()->can('Edit Product category')){

        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:190',
            'brand_id' => 'nullable|exists:brands,id',
            'parent_id' => 'nullable|exists:product_categories,id',
            'categorie_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', $validator->getMessageBag()->first());
        }

        if($request->hasFile('categorie_img')){
            $file = $request->file('categorie_img');
            $image_size = $file->getSize();
            $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);

            if($result == 1){
                // Delete old file from storage
                if($productCategorie->categorie_img){
                    $oldFilePath = 'uploads/product_image/' . $productCategorie->categorie_img;
                    Utility::changeStorageLimit(\Auth::user()->creatorId(), $oldFilePath);
                }

                $originalName = $file->getClientOriginalName();
                $filename = pathinfo($originalName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $settings = Utility::getStorageSetting();
                $dir = ($settings['storage_setting'] == 'local') ? 'uploads/product_image/' : 'uploads/product_image/';

                $path = Utility::upload_file($request, 'categorie_img', $fileNameToStore, $dir, []);

                if($path['flag'] != 1){
                    return redirect()->back()->with('error', __($path['msg']));
                }

                $productCategorie->categorie_img = $fileNameToStore; // store only filename
            }
        }

        $productCategorie->name = $request->name;
        $productCategorie->brand_id = $request->brand_id ?? null;
        $productCategorie->parent_id = $request->parent_id ?? null;
        $productCategorie->update();

        return redirect()->back()->with('success', __('Product Category updated!'));
    }

    return redirect()->back()->with('error', 'Permission denied.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProductCategorie $productCategorie
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategorie $productCategorie)
    {
        if(\Auth::user()->can('Delete Product category')){
            $product = Product::where('product_categorie', $productCategorie->id)->get();

            if($product->count() != 0)
            {
                return redirect()->back()->with(
                    'error', __('Category is used in products!')
                );
            }
            else
            {
                $fileName = $productCategorie->categorie_img !== 'default.jpg' ? $productCategorie->categorie_img : '' ;
                $filePath ='uploads/product_image/'. $fileName;

                Utility::changeStorageLimit(\Auth::user()->creatorId(),$filePath);
                $productCategorie->delete();

                return redirect()->back()->with(
                    'success', __('Product Category Deleted!')
                );
            }
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
    public function getProductCategories(){
        // Récupérer toutes les marques pour les utiliser comme filtres
        $brands = \App\Models\Brand::orderBy('name')->get();
        
        $html = '<div class="mr-2 zoom-in cat-tab-item cat-active">
                    <div class="card rounded-10 card-stats mb-0 overflow-hidden" data-id="0" data-cat-id="0">
                    <div class="brand-filter-btn" data-brand-id="0">
                        <button type="button" class="btn tab-btns btn-primary">'.__("Toutes les catégories").'</button>
                    </div>
                    </div>
                </div>';
        foreach($brands as $brand){
            $html .= '<div class="mr-2 zoom-in cat-tab-item cat-list-btn">
            <div class="card rounded-10 card-stats mb-0 overflow-hidden" data-id="'.$brand->id.'" data-cat-id="'.$brand->id.'">
               <div class="brand-filter-btn" data-brand-id="'.$brand->id.'">
                  <button type="button" class="btn tab-btns">'.$brand->name.'</button>
               </div>
            </div>
         </div>';
        }
        return Response($html);
    }
}
