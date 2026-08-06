<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Utility;
use App\Models\Store;
use App\Models\Order;
use App\Models\UserDetail;
use App\Models\Product;
use App\Models\ProductVariantOption;
use App\Models\PurchasedProducts;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Pos')){
            $customers      = Customer::where('store_id', \Auth::user()->current_store)->orderBy('name', 'ASC')->get()->pluck('name', 'name');
            $customers->prepend('Walk-in-customer', '');
            $user = \Auth::user();
            $store = Store::where('id','=',$user->current_store)->where('created_by',$user->creatorId())->first();
            $brands = Brand::with(['categories.variants.chassisNumbers'])->get();
            return view('pos.index',compact('customers','store','brands'));
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(\Auth::user()->can('Create Pos')){
            $sess = session()->get('pos');
            if (isset($sess) && !empty($sess) && count($sess) > 0) {
                $user = \Auth::user();
    
                $settings = Utility::settings();
                if(!empty( $request->vc_name)){
                    $customer_detail = Customer::where('name',$request->vc_name)->where('store_id', $request->store_id)->first();
                    $customer = UserDetail::where('customer_id', '=', $customer_detail->id)->where('store_id', $request->store_id)->first();
                }
                else{
                    $customer = [];
                }
                $store = Store::where('id','=',$user->current_store)->where('created_by',$user->creatorId())->first();
                $details = [
                    'pos_id' => time(),
                    'customer' => $customer != null ? $customer->toArray() : [],
                    'store' => $store != null ? $store->toArray() : [],
                    'user' => $user != null ? $user->toArray() : [],
                    'date' => date('Y-m-d'),
                    'pay' => 'show',
                ];
                if (!empty($details['customer']) || isset($customer_detail))
                {
                    $storedetails = '<h7 class="text-dark">' . ucfirst($details['store']['name'])  . '</p></h7>';
                   
                   if(!empty($details['customer'])){
                        $details['customer']['billing_city'] = !empty($details['customer']['billing_city']) ? ", " . $details['customer']['billing_city'] : '';
                        $details['customer']['shipping_city'] = !empty($details['customer']['shipping_city']) ? ", " . $details['customer']['shipping_city'] : '';
                        $customerdetails = '<h6 class="text-dark">' . ucfirst($customer_detail->name) . '</h6> <p class="m-0 h6 font-weight-normal">' . $customer_detail->phone . '</p>' . '<p class="m-0 h6 font-weight-normal">' .  $details['customer']['billing_address'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_city'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_country'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_postalcode'] ?? '' . '</p>';
        
                        $shippdetails = '<h6 class="text-dark"><b>' . ucfirst($customer_detail->name) . '</h6> </b>' . '<p class="m-0 h6 font-weight-normal">' . $customer_detail->phone . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_address'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_city']  . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_country'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_postalcode'] . '</p>';
                   }
                   else{
                        $customerdetails = '<h2 class="h6"><b>' . ucfirst($customer_detail->name) . '</b><h2>';
                        $shippdetails = '-';
                   }
                  
                 
                    
                }
                else {
                    $customerdetails = '<h2 class="h6"><b>' . __('Walk-in Customer') . '</b><h2>';
                    $storedetails = '<h7 class="text-dark">' . ucfirst($details['store']['name'])  . '</p></h7>';
                    $shippdetails = '-';
    
                }
               
                $store['city'] = !empty($store->city) ? ", " . $store->city . "," : '';
                $store['country'] = !empty($store->country) ? ", " . $store->country . "," : '';

                $userdetails = '<h6 class="text-dark"><b>' . ucfirst($details['user']['name']) . ' </b><p class="m-0 font-weight-normal">' . $store->address . $store['city'] .'</p>' . '<p class="m-0 font-weight-normal">'.  $store->state . $store['country']  . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $store->zipcode . '</p>';
                $details['customer']['details'] = $customerdetails;
                $details['store']['details'] = $storedetails;
                $details['customer']['shippdetails'] = $shippdetails;
    
                $details['user']['details'] = $userdetails;
    
                $mainsubtotal = 0;
                $sales        = [];
                
               
                foreach ($sess as $key => $value) {
                    if($value['variant_id'] == 0){
                        $subtotal = $value['price'] * $value['quantity'];
        
                        if(!empty($value['tax'])){
                            $tax = 0;
                            foreach($value['tax'] as $taxes){
                                $beforeTax = Utility::taxRate($taxes['tax'], $value['price'],  $value['quantity']);
                                $tax += $beforeTax;
                            }
                        }
                        else{
                            $tax = 0;
                        }
                        
                        $sales['data'][$key]['product_name']       = $value['product_name'];
                        $sales['data'][$key]['quantity']   = $value['quantity'];
                        $sales['data'][$key]['price']      = Utility::priceFormat($value['price']);
                        $sales['data'][$key]['tax']        = $value['tax'];
                    
                    
                        $sales['data'][$key]['tax_amount'] = Utility::priceFormat($tax);
                        $sales['data'][$key]['subtotal']   = Utility::priceFormat($value['subtotal']);
                        $mainsubtotal                      += $value['subtotal'];
                    }else{
                        $subtotal = $value['variant_price'] * $value['quantity'];
        
                        if(!empty($value['tax'])){
                            $tax = 0;
                            foreach($value['tax'] as $taxes){
                                $beforeTax = Utility::taxRate($taxes['tax'], $value['variant_price'],  $value['quantity']);
                                $tax += $beforeTax;
                            }
                        }
                        else{
                            $tax = 0;
                        }
                        
                        $sales['data'][$key]['product_name']       = $value['product_name'].'-'.$value['variant_name'];
                        $sales['data'][$key]['quantity']   = $value['quantity'];
                        $sales['data'][$key]['price']      = Utility::priceFormat($value['variant_price']);
                        $sales['data'][$key]['tax']        = $value['tax'];
                    
                    
                        $sales['data'][$key]['tax_amount'] = Utility::priceFormat($tax);
                        $sales['data'][$key]['subtotal']   = Utility::priceFormat($value['variant_subtotal']);
                        $mainsubtotal                      += $value['variant_subtotal'];
                        
                    }
                }
              
                if($request->discount <= $mainsubtotal){
                    $discount=!empty($request->discount)?$request->discount:0;
                }
                else{
                    $discount=$mainsubtotal;
                }
                $sales['discount'] = Utility::priceFormat($discount);
                $total= $mainsubtotal-$discount;
                $sales['sub_total'] = Utility::priceFormat($mainsubtotal);
                $sales['total'] = Utility::priceFormat($total);
    
                return view('pos.create', compact('sales', 'details'));
            } else {
                return response()->json(
                    [
                        'error' => __('Add some products to cart!'),
                    ],
                    '404'
                );
            }
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Pos')){
            $discount=$request->discount;
            $price = floatval(str_replace(',', '', str_replace('$', '', $request->price)));
            $user_id = \Auth::user()->creatorId();
            if(!empty( $request->vc_name)){
                $customer = Customer::where('name',$request->vc_name)->where('store_id', $request->store_id)->first();
                $cust_details = UserDetail::where('customer_id', '=', $customer->id)->where('store_id', $request->store_id)->first();
            }
            else{
                $cust_details = [];
            }
            $store = Store::where('id','=',\Auth::user()->current_store)->where('created_by',$user_id)->first();
            $sales            = session()->get('pos');
            if (isset($sales) && !empty($sales) && count($sales) > 0) {
                    foreach ($sales as $key => $value) {
                        if($value['variant_id'] == 0){
                            $product_id = $value['id'];
                            $original_quantity = ($value == null) ? 0 : (int)$value['originalquantity'];

                            $product_quantity = $original_quantity - $value['quantity'];
                            if ($value != null && !empty($value)) {
                                Product::where('id', $product_id)->update(['quantity' => $product_quantity]);
                            }
                        }else{
                            $product_id = $value['id'];
                            $variant_id = $value['variant_id'];
                            $variant_original_quantity = ($value == null) ? 0 : (int)$value['originalvariantquantity'];

                            $variant_quantity = $variant_original_quantity - $value['quantity'];
                            if ($value != null && !empty($value)) {
                                ProductVariantOption::where('id', $variant_id)->update(['quantity' => $variant_quantity]);
                            }
                        }
                    }
                
                    $pos                  = new Order();
                    $pos->order_id = time();
                    $pos->name            = isset($customer->name) ? $customer->name : 'walk-in-customer' ;
                    $pos->email           = isset($customer->name) ? $customer->email : '' ;
                    $pos->card_number = '';
                    $pos->card_exp_month = '';
                    $pos->card_exp_year = '';
                    $pos->status = 'pending';
                    $pos->user_address_id =  !empty($cust_details['id']) ? $cust_details['id'] : '';
                    $pos->shipping_data = !empty($shipping_data) ? $shipping_data : '';
                    $pos->coupon = '';
                    $pos->coupon_json = "";
                    $pos->discount_price = (float)$discount;
                    $pos->product_id = $product_id;
                    $pos->price = $price;
                    $pos->product = json_encode($sales);
                    $pos->price_currency = $store->currency_code;
                    $pos->txn_id = '';
                    $pos->payment_type = __('POS');
                    $pos->payment_status = 'approved';
                    $pos->receipt = '';
                    $pos->user_id = $store['id'];
                    $pos->customer_id = isset($cust_details->id) ? $cust_details->id : '';
                    
                    $pos->save();
                    
                    //webhook
                    $module = 'New Order';
                    $webhook =  Utility::webhook($module, $store->id);
                    if ($webhook) {
                        $parameter = json_encode($pos);
                        //
                        // 1 parameter is  URL , 2 parameter is data , 3 parameter is method
                        $status = Utility::WebhookCall($webhook['url'], $parameter, $webhook['method']);
                        if ($status != true) {
                            $msg  = 'Webhook call failed.';
                        }
                    }

                    foreach ($sales as $product_id) {
                        $purchased_products = new PurchasedProducts();
                        $purchased_products->product_id = $product_id['id'];
                        $purchased_products->customer_id = isset($cust_details->id) ? $cust_details->id : '';
                        $purchased_products->order_id = $pos->id;
                        $purchased_products->save();
                    }
                
                
                    session()->forget('pos');

                    $msg = response()->json(
                        [
                            'status' => 'success',
                            'code' => 200,
                            'success' => __('Payment completed successfully!'),
                            'order_id' => \Crypt::encrypt($pos->id),
                            'order' => $pos,
                        ]
                    );
                    $order_email = $pos->email;
                    $owner = User::find($store->created_by);
        
                    $owner_email = $owner->email;
                    $order_id = \Crypt::encrypt($pos->id);
        
                    // if (isset($store->mail_driver) && !empty($store->mail_driver)) {
                        $dArr = [
                            'order_name' => $pos->name,
                        ];
        
                        $resp = Utility::sendEmailTemplate('Order Created', $order_email, $dArr, $store, $order_id);
        
                        $resp1 = Utility::sendEmailTemplate('Order Created For Owner', $owner_email, $dArr, $store, $order_id);
        
                    // }
                    if (isset($store->is_twilio_enabled) && $store->is_twilio_enabled == "on") {
                        Utility::order_create_owner($pos, $owner, $store);
                        Utility::order_create_customer($pos, $customer, $store);
                    }
        
                    return $msg;
            
            } else {
                return response()->json(
                    [
                        'code' => 404,
                        'success' => __('Items not found!'),
                    ]
                );
            }
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function cartdiscount(Request $request)
    {

        if($request->discount){
            $sess = session()->get('pos');
            if(!empty($sess)){
                $subtotal1 = 0;
                foreach($sess as $id => $value){
                    if($value['variant_id'] == 0){
                        $subtotal1 += $value['subtotal'];
                    }else{
                        $subtotal1 += $value['variant_subtotal'];
                    }
                }
                $subtotal = $subtotal1;
            }else{
                $subtotal = !empty($sess)?array_sum(array_column($sess, 'subtotal')):0;
            }
            $discount = $request->discount;
            $total = $subtotal - $discount;
            $total = Utility::priceFormat($total);

        }else{
            $sess = session()->get('pos');
            $subtotal = !empty($sess)?array_sum(array_column($sess, 'subtotal')):0;
            $discount = 0;
            $total = $subtotal - $discount;
            $total = Utility::priceFormat($total);
        }

        return response()->json(['total' => $total], '200');

    }
    public function printView(Request $request)
    {
        $sess = session()->get('pos');

        if (isset($sess) && !empty($sess) && count($sess) > 0) {
            $user = \Auth::user();
            $settings = Utility::settings();

            if(!empty( $request->vc_name)){
                $customer_detail = Customer::where('name',$request->vc_name)->where('store_id', $request->store_id)->first();
                $customer = UserDetail::where('customer_id', '=', $customer_detail->id)->where('store_id', $request->store_id)->first();
            }
            else{
                $customer_detail = '';
                $customer = [];
            }
            $store = Store::where('id','=',$user->current_store)->where('created_by',$user->creatorId())->first();

            $details = [
                'pos_id' => time(),
                'customer' => $customer != null ? $customer->toArray() : [],
                'store' => $store != null ? $store->toArray() : [],
                'user' => $user != null ? $user->toArray() : [],
                'date' => date('Y-m-d'),
                'pay' => 'show',
            ];
            if (!empty($details['customer']) || !empty($customer_detail))
            {
                $storedetails = '<h7 class="text-dark">' . ucfirst($details['store']['name'])  . '</p></h7>';
                
                if(!empty($details['customer'])){
                    $details['customer']['billing_city'] = !empty($details['customer']['billing_city']) ? ", " . $details['customer']['billing_city'] : '';
                    $details['customer']['shipping_city'] = !empty($details['customer']['shipping_city']) ? ", " . $details['customer']['shipping_city'] : '';
                    $customerdetails = '<h6 class="text-dark">' . ucfirst($customer_detail->name) . '</h6> <p class="m-0 h6 font-weight-normal">' . $customer_detail->phone . '</p>' . '<p class="m-0 h6 font-weight-normal">' .  $details['customer']['billing_address'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_city'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_country'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_postalcode'] ?? '' . '</p>';

                    $shippdetails = '<h6 class="text-dark"><b>' . ucfirst($customer_detail->name) . '</h6> </b>' . '<p class="m-0 h6 font-weight-normal">' . $customer_detail->phone . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_address'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_city']  . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_country'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_postalcode'] . '</p>';
                }
                else{
                    $customerdetails = '<h2 class="h6"><b>' . ucfirst($customer_detail->name) . '</b><h2>';
                    $shippdetails = '-';
                }
                
                
                
            }
            else {
                $customerdetails = '<h2 class="h6"><b>' . __('Walk-in Customer') . '</b><h2>';
                $storedetails = '<h7 class="text-dark">' . ucfirst($details['store']['name'])  . '</p></h7>';
                $shippdetails = '-';

            }
            

            $store['city'] = !empty($store->city) ? ", " . $store->city . "," : '';
            $store['country'] = !empty($store->country) ? ", " . $store->country . "," : '';

            $userdetails = '<h6 class="text-dark"><p class="m-0 font-weight-normal">' . $store->address . $store['city'] .'</p>' . '<p class="m-0 font-weight-normal">'.  $store->state . $store['country']  . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $store->zipcode . '</p>';

            $details['customer']['details'] = $customerdetails;
            $details['store']['details'] = $storedetails;

            $details['customer']['shippdetails'] = $shippdetails;

            $details['user']['details'] = $userdetails;
            $mainsubtotal = 0;
            $sales        = [];

            foreach ($sess as $key => $value) {
                if($value['variant_id'] == 0){
                    $subtotal = $value['price'] * $value['quantity'];

                    if(!empty($value['tax'])){
                        $tax = 0;
                        foreach($value['tax'] as $taxes){
                            $beforeTax = Utility::taxRate($taxes['tax'], $value['price'],  $value['quantity']);
                            $tax += $beforeTax;
                        }
                    }
                    else{
                        $tax = 0;
                    }
                    
                    $sales['data'][$key]['product_name']       = $value['product_name'];
                    $sales['data'][$key]['quantity']   = $value['quantity'];
                    $sales['data'][$key]['price']      = Utility::priceFormat($value['price']);
                    $sales['data'][$key]['tax']        = $value['tax'];
                
                    $sales['data'][$key]['tax_amount'] = Utility::priceFormat($tax);
                    $sales['data'][$key]['subtotal']   = Utility::priceFormat($value['subtotal']);
                    $mainsubtotal                      += $value['subtotal'];
                }else{
                    $subtotal = $value['variant_price'] * $value['quantity'];

                    if(!empty($value['tax'])){
                        $tax = 0;
                        foreach($value['tax'] as $taxes){
                            $beforeTax = Utility::taxRate($taxes['tax'], $value['variant_price'],  $value['quantity']);
                            $tax += $beforeTax;
                        }
                    }
                    else{
                        $tax = 0;
                    }
                    
                    $sales['data'][$key]['product_name']       = $value['product_name'].'-'.$value['variant_name'];
                    $sales['data'][$key]['quantity']   = $value['quantity'];
                    $sales['data'][$key]['price']      = Utility::priceFormat($value['variant_price']);
                    $sales['data'][$key]['tax']        = $value['tax'];
                
                
                    $sales['data'][$key]['tax_amount'] = Utility::priceFormat($tax);
                    $sales['data'][$key]['subtotal']   = Utility::priceFormat($value['variant_subtotal']);
                    $mainsubtotal                      += $value['variant_subtotal'];
                    
                }
            }
        
            if($request->discount <= $mainsubtotal){
                $discount=!empty($request->discount)?$request->discount:0;
            }
            else{
                $discount=$mainsubtotal;
            }
            $sales['discount'] = Utility::priceFormat($discount);
            $total= $mainsubtotal-$discount;
            $sales['sub_total'] = Utility::priceFormat($mainsubtotal);
            $sales['total'] = Utility::priceFormat($total);
            return view('pos.printview', compact('details', 'sales', 'customer','customer_detail'));
        }else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    // AJAX methods for POS hierarchy navigation
    public function getPosModels($brandId)
    {
        $models = \App\Models\ProductCategorie::where('brand_id', $brandId)->get();
        return response()->json(['models' => $models]);
    }

    public function getPosFamilies($modelId)
    {
        $families = \App\Models\ProductVariant::where('category_id', $modelId)->with('chassisNumbers')->get();
        return response()->json(['families' => $families]);
    }

    public function getPosChassis($familyId)
    {
        $variant = \App\Models\ProductVariant::with('chassisNumbers')->find($familyId);
        if (!$variant) {
            return response()->json(['products' => [], 'variant' => null]);
        }

        $products = $variant->chassisNumbers->map(function($chassis) use ($variant) {
            return [
                'id' => $chassis->id,
                'name' => $variant->name,
                'chassis_number' => $chassis->chassis_number,
                'variant_id' => $variant->id,
                'location' => $chassis->location ?? 'DEPOT',
                'price' => (float)($variant->price ?? 0),
                'price_formatted' => \App\Models\Utility::priceFormat($variant->price ?? 0),
            ];
        });

        return response()->json([
            'products' => $products,
            'variant' => [
                'id' => $variant->id,
                'name' => $variant->name,
                'quantity' => $variant->quantity ?? 0,
                'price' => (float)($variant->price ?? 0),
                'price_formatted' => \App\Models\Utility::priceFormat($variant->price ?? 0),
            ]
        ]);
    }

    public function addToPosCart(Request $request)
    {
        $selectedChassis = $request->input('selected_chassis', []);
        $familyId = $request->input('family_id');
        $inputPrice = (float)($request->input('price', 0));
        
        $user  = \Auth::user();
        $store = Store::where('id', $user->current_store)->where('created_by', $user->creatorId())->first();

        $variant = \App\Models\ProductVariant::with(['chassisNumbers', 'category'])
            ->find($familyId);
        if (!$variant) {
            return response()->json(['success' => false, 'message' => __('Famille non trouvée')]);
        }
        
        // Get or create session
        $session_key = 'pos';
        $cart = session()->get($session_key, []);

        if (!empty($selectedChassis)) {
            // Ajouter les chassis sélectionnés individuellement
            foreach ($selectedChassis as $chassisId) {
                $chassis = \App\Models\ChassisNumber::find($chassisId);
                if ($chassis && $chassis->variant_id == $familyId) {
                    $productId = 'chassis_' . $chassis->id;
                    if (!isset($cart[$productId])) {
                        $price = $inputPrice > 0 ? $inputPrice : ($variant->price ?? 0);
                        $cart[$productId] = [
                            'id' => $productId,
                            'product_name' => $variant->name . ' - ' . $chassis->chassis_number,
                            'variant_id' => $variant->id,
                            'variant_name' => $variant->name,
                            'chassis_number' => $chassis->chassis_number,
                            'price' => $price,
                            'variant_price' => $price,
                            'quantity' => 1,
                            'subtotal' => $price,
                            'variant_subtotal' => $price,
                            'tax' => [],
                            'originalquantity' => 1,
                            'originalvariantquantity' => 1,
                            'store_id' => $store ? $store->id : null
                        ];
                    }
                }
            }
        } else {
            // Pas de chassis individuel : ajouter la famille entière
            $productId = 'family_' . $variant->id;
            if (!isset($cart[$productId])) {
                $price = $inputPrice > 0 ? $inputPrice : ($variant->price ?? 0);
                $cart[$productId] = [
                    'id' => $productId,
                    'product_name' => $variant->name,
                    'variant_id' => $variant->id,
                    'variant_name' => $variant->name,
                    'chassis_number' => __('N/A'),
                    'price' => $price,
                    'variant_price' => $price,
                    'quantity' => 1,
                    'subtotal' => $price,
                    'variant_subtotal' => $price,
                    'tax' => [],
                    'originalquantity' => $variant->quantity ?? 1,
                    'originalvariantquantity' => $variant->quantity ?? 1,
                    'store_id' => $store ? $store->id : null
                ];
            }
        }

        session()->put($session_key, $cart);

        // Calculate totals
        $total = 0;
        foreach ($cart as $item) {
            if ($item['variant_id'] > 0) {
                $total += $item['variant_subtotal'];
            } else {
                $total += $item['subtotal'];
            }
        }

        // Update family quantity
        $variant->quantity = $variant->quantity - count($selectedChassis);
        $variant->save();

        return response()->json([
            'success' => true, 
            'message' => __('Produits ajoutés au panier'),
            'total' => \App\Models\Utility::priceFormat($total),
            'cart_count' => count($cart)
        ]);
    }

    public function searchChassis(Request $request)
    {
        try {
            $query = trim($request->get('q', ''));

            if (strlen($query) < 1) {
                return response()->json(['results' => []]);
            }

            $rows = \App\Models\ChassisNumber::where('chassis_number', 'LIKE', "%{$query}%")
                ->limit(20)
                ->get();

            $results = $rows->map(function ($chassis) {
                // Load relations manually to avoid eager-loading chain errors
                $variant  = $chassis->variant_id
                            ? \App\Models\ProductVariant::find($chassis->variant_id)
                            : null;
                $category = $variant && $variant->category_id
                            ? \App\Models\ProductCategorie::find($variant->category_id)
                            : null;
                $brand    = $category && $category->brand_id
                            ? \App\Models\Brand::find($category->brand_id)
                            : null;

                return [
                    'id'             => $chassis->id,
                    'chassis_number' => $chassis->chassis_number,
                    'variant_id'     => $chassis->variant_id,
                    'family_name'    => $variant  ? $variant->name  : '',
                    'model_name'     => $category ? $category->name : '',
                    'brand_name'     => $brand    ? $brand->name    : '',
                    'location'       => $chassis->location ?? 'DEPOT',
                    'price'          => $variant  ? (float)($variant->price ?? 0) : 0,
                ];
            });

            return response()->json(['results' => $results]);

        } catch (\Exception $e) {
            \Log::error('searchChassis error: ' . $e->getMessage());
            return response()->json(['results' => [], 'error' => $e->getMessage()], 200);
        }
    }
}
