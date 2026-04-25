@extends('layouts.admin')
@php
    $logo=\App\Models\Utility::get_file('uploads/logo');
    $product_item=\App\Models\Utility::get_file('uploads/is_cover_image/');
    $company_favicon=Utility::getValByName('company_favicon');
    $SITE_RTL = Utility::getValByName('SITE_RTL');
    $setting = \App\Models\Utility::colorset();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if(isset($setting['color_flag']) && $setting['color_flag'] == 'true')
    {
        $themeColor = 'custom-color';
    }
    else {
        $themeColor = $color;
    }
    $storesetting = Utility::StorageSettings();
@endphp
@section('page-title', __('Pos'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ __('Pos') }}</li>
@endsection

@push('styles')
<style>
.chassis-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.chassis-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}
.chassis-card .btn-primary {
    min-width: 100px;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}
.chassis-card .btn-primary:hover {
    background-color: #0056b3 !important;
    border-color: #0056b3 !important;
}
.chassis-card .badge {
    font-size: 0.75rem;
}
.alert-info .btn-success {
    white-space: nowrap;
    padding: 0.5rem 1.25rem;
    font-size: 0.9rem;
}
.alert-info .btn-success:hover {
    background-color: #218838 !important;
    border-color: #1e7e34 !important;
}
</style>
@endpush
@section('content')
    <div class="mt-4 product-tab-wrp">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-4 pdp-section-title">
                    <h3 class="mb-3">{{ __('Section Produits') }}</h3>
                </div>
                <div class="col-md-4 text-end">
                    <!-- Language Switcher -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="ti ti-world me-2"></i>
                            @switch(app()->getLocale())
                                @case('en')
                                    <span>English</span>
                                    @break
                                @case('fr')
                                    <span>Français</span>
                                    @break
                                @case('ar')
                                    <span>العربية</span>
                                    @break
                                @default
                                    <span>{{ __('Language') }}</span>
                            @endswitch
                            <i class="ti ti-chevron-down ms-2"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('change.language', 'en') }}">
                                    <i class="ti ti-flag me-2"></i>English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('change.language', 'fr') }}">
                                    <i class="ti ti-flag me-2"></i>Français
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('change.language', 'ar') }}">
                                    <i class="ti ti-flag me-2"></i>العربية
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <div class="category-wrp mb-4">
            <div class="ms-0 row">
                <div class="button-list b-bottom catgory-pad category-tab-wrapper ps-0 col-lg-8 col-12" >
                    <div class="form-row m-0 gap-3" id="categories-listing">
                    </div>
                </div>
                <div class="col-lg-4 col-12 ps-0 search-main-form">
                    <div class="search-bar-left search-form-wrp d-flex">
                        <form class="search-input-wrp">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti ti-search"></i></span>
                                </div>
                                <input id="searchproduct" type="text" data-url="{{ route('search.products') }}" placeholder="{{ __('Search Product') }}" class="form-control pr-4 rounded-right">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Scan / Barcode Search Section -->
        <div class="card mb-4">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white"><i class="ti ti-barcode"></i></span>
                            <input type="text" id="scanChassisInput" class="form-control" 
                                   placeholder="{{ __('Scanner ou saisir un numéro de châssis...') }}" autofocus>
                            <button class="btn btn-primary" type="button" id="scanSearchBtn">
                                <i class="ti ti-search me-1"></i>{{ __('Rechercher') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <small class="text-muted"><i class="ti ti-info-circle me-1"></i>{{ __('Scannez ou tapez le numéro de châssis') }}</small>
                    </div>
                </div>
                <!-- Search Results -->
                <div id="scanResults" class="mt-3" style="display:none;">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('Marque') }}</th>
                                    <th>{{ __('Modèle') }}</th>
                                    <th>{{ __('Famille') }}</th>
                                    <th>{{ __('N° Châssis') }}</th>
                                    <th>{{ __('Emplacement') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="scanResultsBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php $lastsegment = 'pos'; ?>

        <div class="mt-2 row row-gap pdp-sop-card">
            <div class="col-lg-7">
                <div class="sop-card card h-100">

                    <div class="card-body pdp-card-inner py-3 px-2">
                        <div class="right-content">

                            <div class="product-body-nop pdp-body-nop">
                                <!-- Breadcrumb Navigation -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0" id="pos-breadcrumb-nav">
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <a href="#" data-level="brands" class="breadcrumb-link">{{ __('Marques') }}</a>
                                            </li>
                                        </ol>
                                    </nav>
                                    <button id="pos-back-btn" class="btn btn-outline-secondary btn-sm" onclick="posGoBack()" style="display: none;">
                                        <i class="ti ti-arrow-left me-1"></i>{{ __('Retour') }}
                                    </button>
                                </div>

                                <!-- Search Results Container -->
                                <div id="product-listing" class="mb-3" style="display:none;"></div>

                                <!-- Content Container -->
                                <div id="pos-hierarchy-content">
                                    <!-- Brands Level -->
                                    <div id="pos-brands-level" class="hierarchy-level">
                                        @if ($brands->isEmpty())
                                            <div class="text-center py-5">
                                                <i class="ti ti-brand text-muted" style="font-size: 4rem;"></i>
                                                <h5 class="mt-3 text-muted">{{ __('Aucune marque trouvée') }}</h5>
                                                <p class="text-muted">{{ __('Commencez par ajouter votre première marque') }}</p>
                                            </div>
                                        @else
                                            <div class="row row-gap-3">
                                                @foreach ($brands as $brand)
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="card h-100 brand-card" onclick="loadPosModels({{ $brand->id }}, '{{ $brand->name }}')">
                                                            <div class="card-body d-flex align-items-center">
                                                                @if ($brand->brand_img)
                                                                    <img src="{{ \App\Models\Utility::get_file('uploads/brand_image/' . $brand->brand_img) }}" alt="{{ $brand->name }}" class="me-3" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                                                    <div class="me-3 bg-primary rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; display:none !important;">
                                                                        <i class="ti ti-brand text-white"></i>
                                                                    </div>
                                                                @else
                                                                    <div class="me-3 bg-primary rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                                        <i class="ti ti-brand text-white"></i>
                                                                    </div>
                                                                @endif
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-1 fw-bold">{{ $brand->name }}</h6>
                                                                    <small class="text-muted">{{ __('Marque') }}</small>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <i class="ti ti-chevron-right text-muted"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Models Level (Hidden by default) -->
                                    <div id="pos-models-level" class="hierarchy-level" style="display: none;">
                                        <div class="text-center py-3">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">{{ __('Chargement...') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Families Level (Hidden by default) -->
                                    <div id="pos-families-level" class="hierarchy-level" style="display: none;">
                                        <div class="text-center py-3">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">{{ __('Chargement...') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Chassis Selection Level (Hidden by default) -->
                                    <div id="pos-chassis-level" class="hierarchy-level" style="display: none;">
                                        <div class="text-center py-3">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">{{ __('Chargement...') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 ps-lg-0 pe-lg-0">
                <div class="card m-0 h-100">
                    <div class="card-header p-3">
                        <div class="row align-items-center row-gap">
                            <div class="col-md-6">
                                <h3 class="mb-0">{{ __('Section Facturation') }}</h3>
                            </div>
                            <div class="col-md-6">
                                {{ Form::select('customer_id',$customers,'', array('class' => 'form-control select customer_select','id'=>'customer','required'=>'required')) }}
                                {{ Form::hidden('vc_name_hidden', '',['id' => 'vc_name_hidden']) }}
                                <input type="hidden" id="store_id" value="{{ \Auth::user()->current_store }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-body carttable cart-product-list carttable-scroll pdp-cart-body d-flex" id="carthtml">
                        @php $total = 0 @endphp
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-left">{{ __('Nom') }}</th>
                                    <th class="text-center">{{ __('Qté') }}</th>
                                    <th>{{ __('Taxe') }}</th>
                                    <th class="text-center">{{ __('Prix') }}</th>
                                    <th class="text-center">{{ __('Sous-total') }}</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody id="tbody">
                                @if(session($lastsegment) && !empty(session($lastsegment)) && count(session($lastsegment)) > 0)
                                    @foreach(session($lastsegment) as $id => $details)
                                        @php
                                            $isChassis = str_starts_with($id, 'chassis_') || str_starts_with($id, 'family_');
                                            $product = null;
                                            $image_url = 'default.jpg';
                                            
                                            if ($isChassis) {
                                                $variant = \App\Models\ProductVariant::with('category.brand')->find($details['variant_id']);
                                                $brand_img_url = null;
                                                if ($variant && $variant->category && $variant->category->brand && $variant->category->brand->brand_img) {
                                                    $brand_img_url = \App\Models\Utility::get_file('uploads/brand_image/' . $variant->category->brand->brand_img);
                                                }
                                                $total = $total + (float) ($details['variant_subtotal'] ?? $details['subtotal'] ?? 0);
                                            } elseif (isset($details['variant_id']) && $details['variant_id'] > 0) {
                                                // Regular variant item
                                                $variant = \App\Models\ProductVariant::find($details['variant_id']);
                                                $product = $variant ? \App\Models\Product::find($variant->product_id) : null;
                                                $image_url = ($product && !empty($product->is_cover)) ? $product->is_cover : 'default.jpg';
                                                $total = $total + (float) $details['variant_subtotal'];
                                            } else {
                                                // Regular product
                                                $product = \App\Models\Product::find($details['id']);
                                                $image_url = !empty($product->is_cover) ? $product->is_cover : 'default.jpg';
                                                $total = $total + (float) $details['subtotal'];
                                            }
                                            
                                            $canShow = $isChassis || ($product && \Auth::user()->current_store == $product->store_id);
                                        @endphp
                                        @if($canShow)
                                            @if($isChassis)
                                                <tr data-product-id="{{$id}}" 
                                                    data-chassis-id="{{ str_replace('chassis_', '', $id) }}" 
                                                    data-chassis-number="{{ $details['chassis_number'] ?? '' }}"
                                                    data-variant-id="{{ $details['variant_id'] }}">
                                            @elseif($details['variant_id'] <= 0)
                                                <tr data-product-id="{{$id}}" id="product-id-{{$details['id']}}">
                                            @else
                                                <tr data-product-id="{{$id}}" id="product-variant-id-{{$details['variant_id']}}">
                                            @endif
                                                    <td class="cart-images">
                                                        @if($isChassis && !empty($brand_img_url))
                                                            <img alt="brand" src="{{ $brand_img_url }}" class="card-image avatar rounded-circle-sale border border-2 border-primary rounded" style="width:40px;height:40px;object-fit:cover;">
                                                        @elseif($isChassis)
                                                            <div class="avatar rounded-circle-sale border border-2 border-primary rounded d-flex align-items-center justify-content-center bg-light" style="width:40px;height:40px;">
                                                                <i class="ti ti-motorbike text-primary"></i>
                                                            </div>
                                                        @else
                                                            <img alt="Image placeholder" src="{{ \App\Models\Utility::get_file('uploads/is_cover_image/') . $image_url }}" class="card-image avatar rounded-circle-sale border border-2 border-primary rounded" onerror="this.style.display='none';this.parentElement.innerHTML='<div class=\'d-flex align-items-center justify-content-center bg-light rounded\' style=\'width:40px;height:40px;\'><i class=\'ti ti-photo text-muted\'></i></div>';">
                                                        @endif
                                                    </td>
                                                @if($isChassis)
                                                    <td class="name">
                                                        {{ $details['variant_name'] ?? '' }}
                                                        <br><small class="badge bg-info">{{ $details['chassis_number'] ?? '' }}</small>
                                                    </td>
                                                    <td>1</td>
                                                @elseif($details['variant_id'] <= 0)
                                                    <td class="name">{{ $details['product_name'] }}</td>
                                                    <td>
                                                        <span class="quantity buttons_added">
                                                            <input type="button" value="-" class="minus">
                                                            <input type="number" step="1" min="1" max="" name="quantity"
                                                                title="{{ __('Quantity') }}" class="input-number"
                                                                data-url="{{ url('update-cart/') }}" data-id="{{ $id }}"
                                                                size="4" value="{{ $details['quantity'] }}">
                                                            <input type="button" value="+" class="plus">
                                                        </span>
                                                    </td>
                                                @else
                                                    <td class="name">{{ $details['product_name'] . '-' . $details['variant_name'] }}</td>
                                                    <td>
                                                        <span class="quantity buttons_added">
                                                            <input type="button" value="-" class="minus">
                                                            <input type="number" step="1" min="1" max="" name="quantity"
                                                                title="{{ __('Quantity') }}" class="input-number"
                                                                data-url="{{ url('update-cart/') }}" data-id="{{ $id }}"
                                                                size="4" value="{{ $details['quantity'] }}">
                                                            <input type="button" value="+" class="plus">
                                                        </span>
                                                    </td>
                                                @endif

                                                <td>
                                                    @if(!$isChassis && !empty($product->product_tax))
                                                        @php
                                                            $taxes=\Utility::tax($product->product_tax);
                                                        @endphp
                                                        @foreach($taxes as $tax)
                                                            <span class="badge bg-primary">{{$tax->name .' ('.$tax->rate .'%)'}}</span> <br>
                                                        @endforeach
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                                @if($isChassis)
                                                    @php $chassisPrice = (float)($details['variant_price'] ?? $details['price'] ?? 0); @endphp
                                                    <td class="price text-right">
                                                        @if($chassisPrice > 0)
                                                            {{ \App\Models\Utility::priceFormat($chassisPrice) }}
                                                        @else
                                                            <span class="badge bg-warning text-dark">{{ __('À définir') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="col-sm-3 mt-2">
                                                        <span class="subtotal">{{ $chassisPrice > 0 ? \App\Models\Utility::priceFormat($chassisPrice) : '-' }}</span>
                                                    </td>
                                                @elseif($details['variant_id'] <= 0)
                                                    <td class="price text-right">{{ \App\Models\Utility::priceFormat($details['price']) }}</td>
                                                    <td class="col-sm-3 mt-2">
                                                        <span class="subtotal">{{ \App\Models\Utility::priceFormat($details['subtotal']) }}</span>
                                                    </td>
                                                @else
                                                    <td class="price text-right">{{ \App\Models\Utility::priceFormat($details['variant_price']) }}</td>
                                                    <td class="col-sm-3 mt-2">
                                                        <span class="subtotal">{{ \App\Models\Utility::priceFormat($details['variant_subtotal']) }}</span>
                                                    </td>
                                                @endif
                                                <td class="col-sm-2 mt-2 action-btn-wrapper">
                                                    <a href="#" class="bs-pass-para btn btn-sm btn-icon bg-danger text-white" data-confirm="{{ __('Are You Sure?') }}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"
                                                    data-confirm-yes="delete-form-{{ $id }}" title="{{ __('Delete') }}" data-id="{{ $id }}" data-bs-placement="top"  data-bs-toggle="tooltip" title="{{ __('Delete') }}">
                                                        <i class="ti ti-trash" title="{{ __('Delete') }}"></i>
                                                    </a>
                                                    {!! Form::open(['method' => 'delete', 'url' => ['remove-from-cart'],'id' => 'delete-form-'.$id]) !!}
                                                    <input type="hidden" name="session_key" value="{{ $lastsegment }}">
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr class="text-center no-found">
                                        <td colspan="7">{{ __('Aucun produit dans le panier') }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>


                        {{-- <div class="total-section mt-3">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <div class="left-inner ">
                                    <div class="d-flex text-end justify-content-end align-items-center">
                                        {{ Form::number('discount',null, array('class' => ' form-control discount','required'=>'required','placeholder'=>__('Discount'))) }}
                                        {{ Form::hidden('discount_hidden', '',['id' => 'discount_hidden']) }}
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="right-inner mt-3">
                                        <div class="d-flex text-end justify-content-md-end  justify-content-flex-start">
                                            <h6 class="mb-0 text-dark" style=" color: black !important; ">{{__('Sub Total')}} :</h6>
                                            <h6 class="mb-0 text-dark subtotal_price" id="displaytotal" style=" color: black !important; ">{{  \App\Models\Utility::priceFormat($total) }}</h6>
                                        </div>

                                    <div class="d-flex align-items-center justify-content-md-end  justify-content-flex-start">
                                        <h6 class="" style=" color: black !important; ">{{__('Total')}} :</h6>
                                        <h6 class="totalamount"  style=" color: black !important; ">{{ \App\Models\Utility::priceFormat($total) }}</h6>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-3" id="btn-pur">
                                @can('Create Pos')
                                    <button type="button" class="btn btn-primary rounded"  data-ajax-popup="true" data-size="xl"
                                            data-align="centered" data-url="{{route('pos.create')}}" data-title="{{__('POS Invoice')}}"
                                            @if(session($lastsegment) && !empty(session($lastsegment)) && count(session($lastsegment)) > 0) @else disabled="disabled" @endif>
                                        {{ __('PAY') }}
                                    </button>
                                @endcan
                                <div class="tab-content btn-empty text-end">
                                    <a href="#" class="btn btn-danger bs-pass-para rounded m-0"  data-toggle="tooltip" data-original-title="{{ __('Empty Cart') }}"
                                        data-confirm="{{ __('Are You Sure?') }}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="delete-form-emptycart">{{ __('Empty Cart') }}
                                    </a>
                                    {!! Form::open(['method' => 'post', 'url' => ['empty-cart'],'id' => 'delete-form-emptycart']) !!}
                                    <input type="hidden" name="session_key" value="{{ $lastsegment }}" id="empty_cart">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div> --}}


                        <div class="total-section pdp-discount mt-3">
                            <div class="row align-items-center">
                                <div class="col-xxl-6 col-xl-12 col-sm-12 col-12">
                                    <div class="left-inner d-flex">
                                            <span>{{__('Discount in our product')}}</span>
                                            <div class="d-flex text-end justify-content-end align-items-center">
                                                {{ Form::number('discount',null, array('class' => ' form-control discount','required'=>'required','placeholder'=>__('Discount'))) }}
                                                {{ Form::hidden('discount_hidden', '',['id' => 'discount_hidden']) }}
                                            </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-sm-12 col-12">
                                        <div class="right-inner d-flex justify-content-between ">
                                            <div class="billing-price d-flex justify-content-between">
                                                <h6 class="mb-0 text-dark">{{ __('Sub Total') }} :</h6>
                                                <h6 class="mb-0 text-dark subtotal_price" id="displaytotal">
                                                    {{  \App\Models\Utility::priceFormat($total) }}
                                                </h6>
                                            </div>

                                            <div
                                                class="d-flex justify-content-between">
                                                <h6 class="mb-0">{{ __('Total') }} :</h6>
                                                <h6 class="totalamount mb-0">
                                                    {{ \App\Models\Utility::priceFormat($total) }}
                                                </h6>
                                            </div>
                                        </div>
                                        {{-- <div class="billing-price d-flex justify-content-between">
                                            <span class="mb-0 text-dark">{{ __('You are saving') }} :</span>
                                            <p class="mb-0 text-dark discount_price" id="discounttotal">
                                                {{ \App\Models\Utility::priceFormat($total) }}
                                            </p>
                                        </div> --}}

                                        <div class="d-flex align-items-center justify-content-between pt-3" id="btn-pur">
                                            <div class="tab-content btn-empty text-end">
                                                <a href="#" class="btn btn-danger bs-pass-para rounded m-0"  data-toggle="tooltip" data-original-title="{{ __('Empty Cart') }}"
                                                    data-confirm="{{ __('Are You Sure?') }}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"
                                                    data-confirm-yes="delete-form-emptycart">{{ __('Empty Cart') }}
                                                </a>
                                                {!! Form::open(['method' => 'post', 'url' => ['empty-cart'],'id' => 'delete-form-emptycart']) !!}
                                                <input type="hidden" name="session_key" value="{{ $lastsegment }}" id="empty_cart">
                                                {!! Form::close() !!}
                                            </div>
                                            @can('Create Pos')
                                                <button type="button" class="btn btn-primary rounded" id="openPayModal"
                                                        @if(session($lastsegment) && !empty(session($lastsegment)) && count(session($lastsegment)) > 0) @else disabled="disabled" @endif>
                                                    {{ __('PAY') }}
                                                </button>
                                            @endcan

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pay / Create Order Modal -->
    <div class="modal fade" id="payOrderModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="ti ti-cash me-2"></i>{{ __('Créer la commande - Définir les prix') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">{{ __('Nom du client') }}</label>
                            <input type="text" class="form-control" id="pay_customer_name" placeholder="{{ __('Nom du client') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ __('Téléphone') }}</label>
                            <input type="text" class="form-control" id="pay_customer_phone" placeholder="{{ __('Téléphone') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ __('Notes') }}</label>
                            <input type="text" class="form-control" id="pay_notes" placeholder="{{ __('Notes optionnelles') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">{{ __('TVA') }} (%)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="pay_tva" value="0" min="0" max="100" step="0.01" placeholder="0">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label fw-semibold">{{ __('Commentaire') }}</label>
                            <textarea class="form-control" id="pay_comment" rows="2" placeholder="{{ __('Commentaire sur la commande...') }}"></textarea>
                        </div>
                    </div>
                    <h6 class="mb-3">{{ __('Récapitulatif de la commande') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="payItemsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('Produit') }}</th>
                                    <th>{{ __('N° Châssis') }}</th>
                                    <th>{{ __('Prix unitaire') }}</th>
                                    <th>{{ __('Quantité') }}</th>
                                    <th>{{ __('Sous-total') }}</th>
                                </tr>
                            </thead>
                            <tbody id="payItemsBody"></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end">{{ __('Sous-total HT') }}</td>
                                    <td id="paySubtotalDisplay">0</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">{{ __('TVA') }} (<span id="payTvaPercent">0</span>%)</td>
                                    <td id="payTvaAmountDisplay">0</td>
                                </tr>
                                <tr class="table-warning">
                                    <td colspan="4" class="text-end fw-bold">{{ __('Total TTC') }}</td>
                                    <td class="fw-bold" id="payTotalDisplay">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                    <button type="button" class="btn btn-success" id="confirmPayOrder">
                        <i class="ti ti-check me-1"></i>{{ __('Confirmer et créer la commande') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chassis Selection Modal -->
    <div class="modal fade" id="chassisSelectionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-truncate" id="chassisModalTitle" style="max-width:80%;" title="{{ __('Sélectionner les numéros de châssis') }}">{{ __('Sélectionner les numéros de châssis') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selectedFamilyId" name="family_id">
                    <div id="chassisListContainer">
                        <div class="text-center py-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">{{ __('Chargement...') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                    <button type="button" class="btn btn-primary" onclick="validateChassisSelection()">{{ __('Valider et ajouter au panier') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Price Input Modal -->
    <div class="modal fade" id="priceInputModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceModalTitle">{{ __('Ajouter au panier - Définir le prix') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ __('Produit') }}</label>
                        <input type="text" class="form-control bg-light" id="priceProductName" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            {{ __('Prix de vente') }} <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-primary text-white">
                                <i class="ti ti-currency-dirham me-1"></i>
                                {{ \App\Models\Store::where('id',\Auth::user()->current_store)->first()->currency ?? 'MAD' }}
                            </span>
                            <input type="number" class="form-control form-control-lg" id="priceInput"
                                   min="1" step="1" placeholder="{{ __('Ex: 35000') }}" required
                                   style="font-size:1.3rem; font-weight:600;">
                        </div>
                        <div id="priceHint" class="mt-2"></div>
                    </div>
                    <input type="hidden" id="priceVariantId">
                    <input type="hidden" id="priceChassisId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                    <button type="button" class="btn btn-success" id="confirmAddToCart">
                        <i class="ti ti-shopping-cart me-1"></i>{{ __('Ajouter au panier') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script-page')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $( document ).ready(function() {

            $( "#vc_name_hidden" ).val($('.customer_select').val());
            $( "#discount_hidden").val($('.discount').val());

            $(function () {
                getProductCategories();

            });

            if ($('#searchproduct').length > 0) {
                var url = $('#searchproduct').data('url');
                var store_id = $( "#store_id" ).val();
                searchProducts(url,'','0',store_id);
            }


            {{--  $( '#warehouse' ).change(function() {
            var ware_id = $( "#warehouse" ).val();
                searchProducts(url,'','0',ware_id);
            });  --}}
            $( '.customer_select' ).change(function() {
                $( "#vc_name_hidden" ).val($(this).val());
            });



            $(document).on('click', '#clearinput', function (e) {
                var IDs = [];
                $(this).closest('div').find("input").each(function () {
                    IDs.push('#' + this.id);
                });
                $(IDs.toString()).val('');
            });


            $(document).on('keyup', 'input#searchproduct', function () {
                var url = $(this).data('url');
                var value = this.value;
                var cat = $('.cat-active').children().data('cat-id');
                var store_id = $( "#store_id" ).val();
                searchProducts(url, value,cat,store_id);
            });


            function searchProducts(url, value, cat_id, store_id = '0') {
                if (!value || value.trim() === '') {
                    // Vider la recherche : afficher la hiérarchie normale
                    $('#product-listing').hide().html('');
                    $('#pos-hierarchy-content').show();
                    return;
                }

                var session_key = $('#empty_cart').val();
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        'search': value,
                        'cat_id': cat_id,
                        'store_id': store_id,
                        'session_key': session_key
                    },
                    success: function (data) {
                        // Cacher la hiérarchie, afficher les résultats
                        $('#pos-hierarchy-content').hide();
                        $('#product-listing').html(data).show();
                    },
                    error: function () {
                        $('#pos-hierarchy-content').hide();
                        $('#product-listing').html(`
                            <div class="alert alert-danger">
                                <i class="ti ti-alert-triangle me-2"></i>
                                {{ __('Erreur lors de la recherche') }}
                            </div>
                        `).show();
                    }
                });
            }

            function getProductCategories() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('product.categories') }}',
                    success: function (data) {

                        $('#categories-listing').html(data);
                    }
                });
            }

            $(document).on('click', '.toacart', function () {

                var sum = 0
                $.ajax({
                    url: $(this).data('url'),

                    success: function (data) {

                        if (data.code == '200') {

                            $('#displaytotal').text(addCommas(data.product.subtotal));
                            $('.totalamount').text(addCommas(data.product.subtotal));

                            if ('carttotal' in data) {
                                $.each(data.carttotal, function (key, value) {
                                    // $('#product-id-' + value.id + ' .subtotal').text(addCommas(value.subtotal));
                                    // sum += value.subtotal;
                                    if(value.variant_id == 0){
                                        $('#product-id-' + value.id + ' .subtotal').text(addCommas(value.subtotal));
                                        sum += value.subtotal;
                                    }else{
                                        $('#product-variant-id-' + value.variant_id + ' .subtotal').text(addCommas(value.variant_subtotal));
                                        sum += value.variant_subtotal;
                                    }
                                });
                                $('#displaytotal').text(addCommas(sum));

                                $('.totalamount').text(addCommas(sum));

                        $('.discount').val('');
                            }

                            $('#tbody').append(data.carthtml);
                            $('.no-found').addClass('d-none');
                            $('.carttable #product-id-' + data.product.id + ' input[name="quantity"]').val(data.product.quantity);
                            $('#btn-pur button').removeAttr('disabled');
                            $('.btn-empty button').addClass('btn-clear-cart');

                            }
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        show_toastr('{{ __("Error") }}', data.error, 'error');
                    }
                });
            });

            $(document).on('change keyup', '#carthtml input[name="quantity"]', function (e) {

                e.preventDefault();
                var ele = $(this);
                var sum = 0;
                var quantity = ele.closest('span').find('input[name="quantity"]').val();
                var discount = $('.discount').val();
                var session_key = $('#empty_cart').val();
                if(quantity != null && quantity != 0){
                    $.ajax({
                        url: ele.data('url'),
                        method: "patch",
                        data: {
                            id: ele.attr("data-id"),
                            quantity: quantity,
                            discount:discount,
                            session_key: session_key
                        },
                        success: function (data) {

                            if (data.code == '200') {

                                if (quantity == 0) {
                                    ele.closest(".row").hide(250, function () {
                                        ele.closest(".row").remove();
                                    });
                                    if (ele.closest(".row").is(":last-child")) {
                                        $('#btn-pur button').attr('disabled', 'disabled');
                                        $('.btn-empty button').removeClass('btn-clear-cart');
                                    }
                                }

                                $.each(data.product, function (key, value) {
                                    // sum += value.subtotal;
                                    // $('#product-id-' + value.id + ' .subtotal').text(addCommas(value.subtotal));
                                    if(value.variant_id == 0){
                                        $('#product-id-' + value.id + ' .subtotal').text(addCommas(value.subtotal));
                                        sum += value.subtotal;
                                    }else{
                                        $('#product-variant-id-' + value.variant_id + ' .subtotal').text(addCommas(value.variant_subtotal));
                                        sum += value.variant_subtotal;
                                    }
                                });

                                $('#displaytotal').text(addCommas(sum));
                                if(discount <= sum){
                                    $('.totalamount').text(data.discount);
                                }
                                else{
                                    $('.totalamount').text(addCommas(0));
                                }
                            }
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('{{ __("Error") }}', data.error, 'error');
                        }
                    });
                }
            });

            $(document).on('click', '.remove-from-cart', function (e) {
                e.preventDefault();

                var ele = $(this);
                var sum = 0;

                if (confirm('{{ __("Are you sure?") }}')) {
                    ele.closest(".row").hide(250, function () {
                        ele.closest(".row").parent().parent().remove();
                    });
                    if (ele.closest(".row").is(":last-child")) {
                        $('#btn-pur button').attr('disabled', 'disabled');
                        $('.btn-empty button').removeClass('btn-clear-cart');
                    }
                    $.ajax({
                        url: ele.data('url'),
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: ele.attr("data-id"),
                            session_key: '{{ $lastsegment }}'
                        },
                        success: function (data) {
                            if (data.code == '200') {

                                $.each(data.product, function (key, value) {
                                    sum += value.subtotal;
                                    $('#product-id-' + value.id + ' .subtotal').text(addCommas(value.subtotal));
                                });

                                $('#displaytotal').text(addCommas(sum));

                                show_toastr('success', data.success, 'success')
                            }
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('{{ __("Error") }}', data.error, 'error');
                        }
                    });
                }
            });

            $(document).on('click', '.btn-clear-cart', function (e) {
                e.preventDefault();

                if (confirm('{{ __("Remove all items from cart?") }}')) {

                    $.ajax({
                        url: $(this).data('url'),
                        data: {
                            session_key: session_key
                        },
                        success: function (data) {
                            location.reload();
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('{{ __("Error") }}', data.error, 'error');
                        }
                    });
                }
            });

            $(document).on('click', '.btn-done-payment', function (e) {
                e.preventDefault();
                var ele = $(this);

                $.ajax({
                    url: ele.data('url'),

                    method: 'GET',
                    data: {
                        vc_name: $('#vc_name_hidden').val(),
                        warehouse_name: $('#warehouse_name_hidden').val(),
                        discount : $('#discount_hidden').val(),
                    },
                    beforeSend: function () {
                        ele.remove();
                    },
                    success: function (data) {

                        if (data.code == 200) {
                            show_toastr('success', data.success, 'success')
                        }

                    },
                    error: function (data) {
                        data = data.responseJSON;
                        show_toastr('{{ __("Error") }}', data.error, 'error');
                    }

                });

            });

            // Filtre par marque
            $(document).on('click', '.brand-filter-btn', function (e) {
                var brandId = $(this).data('brand-id');
                // Mettre à jour les styles des boutons
                $('.brand-filter-btn').find('.tab-btns').removeClass('btn-primary');
                $(this).find('.tab-btns').addClass('btn-primary');
                $('.brand-filter-btn').closest('.cat-tab-item').removeClass('cat-active');
                $(this).closest('.cat-tab-item').addClass('cat-active');

                if (brandId == 0) {
                    // Afficher toutes les marques
                    posCurrentLevel = 'brands';
                    posCurrentBrandId = null;
                    posShowLevel('pos-brands-level');
                    posUpdateBreadcrumb([{name: '{{ __("Marques") }}', level: 'brands'}]);
                } else {
                    // Naviguer directement vers les modèles de cette marque
                    var brandName = $(this).find('.tab-btns').text();
                    loadPosModels(brandId, brandName);
                }
            });

            $(document).on('change keyup', '.discount', function () {

                var discount = $('.discount').val();
                var total = $('#displaytotal').text();
                var maintotal = parseFloat(total.replace("$","").replace(",",""))
                if(discount <= maintotal){
                    $( "#discount_hidden" ).val(discount);
                }else{
                    $( "#discount_hidden" ).val(maintotal);
                }
                $.ajax({
                    url: "{{route('cartdiscount')}}",
                    method: 'POST',
                    data: {discount: discount,},
                    success: function (data)
                    {
                        if(discount <= maintotal){
                            $('.totalamount').text(data.total);
                        }else{
                            $('.totalamount').text(addCommas(0));
                        }
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        show_toastr('{{ __("Error") }}', data.error, 'error');
                    }
                });


                var price = {{$total}}
                var total_amount = price-discount;
                $('.totalamount').text(total_amount);


            });

        });


        // Product Variant script

        $(document).on('change', '.variant-selection', function() {
                var variants = [];
                $(".variant-selection").each(function(index, element) {
                    if (element.value != '' && element.value != undefined) {
                        var el_val = element.value;
                        variants.push(el_val);
                    }
                });
                if (variants.length > 0) {

                    $.ajax({
                        url: '{{ route('get.products.variant.quantity') }}',
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            variants: variants.join(' : '),
                            product_id: $('#product_id').val()
                        },

                        success: function(data) {
                            if (data.variant_id == 0) {
                                $('.variant_stock1').addClass('d-none');
                                $('.variation_price1').html("@lang('Please Select Variants')");
                                // $('#variant_qty').val('0');
                            } else {
                                var qty = "@lang('Price') : "  + data.price;
                                var amount = "@lang('QTY') : " + data.quantity;
                                $('.variation_price1').html(qty);
                                $('#variant_id').val(data.variant_id);
                                // $('#variant_qty').val(data.quantity);
                                $('.variant_qty').html(amount);
                                $('.variant_stock1').removeClass('d-none');
                                if (data.quantity != 0) {
                                    $('.variant_stock1').html("@lang('In Stock')");
                                    $(".variant_stock1").css({
                                        "backgroundColor": "#C2FFA5",
                                        "color": "#58A336"
                                    });
                                } else {
                                    $(".variant_qty").css({
                                        // "backgroundColor": "#FFA5A5",
                                        "color": "rgb(253 58 110)"
                                    });
                                    $('.variant_qty').html("@lang('Out Of Stock')");
                                }
                            }
                        }
                    });
                }
            });


            $(document).on('click', '.toacartvariant', function () {

            var sum = 0;
            var id = $(this).attr('data-id');
            var session_key = "{{ $lastsegment }}";
            var variants = [];
                $(".variant-selection").each(function(index, element) {
                    variants.push(element.value);
                });

                if (jQuery.inArray('0', variants) != -1) {
                    show_toastr('Error', "{{ __('Please select all option.') }}", 'error');
                    return false;
                }

                var variation_ids = $('#variant_id').val();

            $.ajax({
                    url: '{{ route('addToCartVariant', ['__product_id', 'session_key', 'variation_id']) }}'
                        .replace('__product_id', id).replace('session_key', session_key).replace('variation_id', variation_ids ?? 0),//$(this).data('url'),
                    data: {
                        "_token": "{{ csrf_token() }}",
                        variants: variants.join(' : '),
                    },
                success: function (data) {
                    if (data.code == '200') {

                        $('#displaytotal').text(addCommas(data.product.variant_subtotal));
                        $('.totalamount').text(addCommas(data.product.variant_subtotal));

                        if ('carttotal' in data) {
                            $.each(data.carttotal, function (key, value) {
                                    if(value.variant_id == 0){
                                        $('#product-id-' + value.id + ' .subtotal').text(addCommas(value.subtotal));
                                        sum += value.subtotal;
                                    }else{
                                        $('#product-variant-id-' + value.variant_id + ' .subtotal').text(addCommas(value.variant_subtotal));
                                        sum += value.variant_subtotal;
                                    }
                            });
                            $('#displaytotal').text(addCommas(sum));

                            $('.totalamount').text(addCommas(sum));

                        $('.discount').val('');
                        }
                        $('#tbody').append(data.carthtml);
                        $('.no-found').addClass('d-none');
                        $('.carttable #product-variant-id-' + data.product.variant_id + ' input[name="quantity"]').val(data.product.quantity);
                        $('#btn-pur button').removeAttr('disabled');
                        $('.btn-empty button').addClass('btn-clear-cart');

                        }
                },
                error: function (data) {
                    data = data.responseJSON;
                    show_toastr('{{ __("Error") }}', data.error, 'error');
                }
            });
        });

            $(document).on('click', '.add_to_cart_variant', function () {
                $('#commonModal').modal('hide');
            });

        // POS Hierarchy Navigation Functions
        let posCurrentLevel = 'brands';
        let posCurrentBrandId = null;
        let posCurrentModelId = null;
        let posCurrentFamilyId = null;

        function posShowLevel(levelId) {
            document.querySelectorAll('.hierarchy-level').forEach(el => {
                el.style.display = 'none';
            });
            document.getElementById(levelId).style.display = 'block';
        }

        function posUpdateBreadcrumb(levels) {
            const breadcrumb = document.getElementById('pos-breadcrumb-nav');
            const backBtn = document.getElementById('pos-back-btn');
            breadcrumb.innerHTML = '';
            
            if (levels.length > 1) {
                backBtn.style.display = 'inline-flex';
            } else {
                backBtn.style.display = 'none';
            }
            
            levels.forEach((level, index) => {
                const li = document.createElement('li');
                li.className = 'breadcrumb-item';
                
                if (index === levels.length - 1) {
                    li.className += ' active';
                    li.setAttribute('aria-current', 'page');
                    li.textContent = level.name;
                } else {
                    const a = document.createElement('a');
                    a.href = '#';
                    a.className = 'breadcrumb-link';
                    a.setAttribute('data-level', level.level);
                    a.textContent = level.name;
                    a.onclick = (e) => {
                        e.preventDefault();
                        posNavigateToLevel(level.level, level.data);
                    };
                    li.appendChild(a);
                }
                
                breadcrumb.appendChild(li);
            });
        }

        function posGoBack() {
            $('#product-listing').hide().html('');
            $('#pos-hierarchy-content').show();
            document.getElementById('searchproduct').value = '';
            if (posCurrentLevel === 'models') {
                posCurrentLevel = 'brands';
                posCurrentBrandId = null;
                posShowLevel('pos-brands-level');
                posUpdateBreadcrumb([
                    {name: '{{ __("Marques") }}', level: 'brands'}
                ]);
            } else if (posCurrentLevel === 'families') {
                posCurrentLevel = 'models';
                posCurrentModelId = null;
                posShowLevel('pos-models-level');
                posUpdateBreadcrumb([
                    {name: '{{ __("Marques") }}', level: 'brands'},
                    {name: '{{ __("Modèles") }}', level: 'models', data: {brandId: posCurrentBrandId}}
                ]);
            } else if (posCurrentLevel === 'chassis') {
                posCurrentLevel = 'families';
                posCurrentFamilyId = null;
                posShowLevel('pos-families-level');
                posUpdateBreadcrumb([
                    {name: '{{ __("Marques") }}', level: 'brands'},
                    {name: '{{ __("Modèles") }}', level: 'models', data: {brandId: posCurrentBrandId}},
                    {name: '{{ __("Familles") }}', level: 'families', data: {modelId: posCurrentModelId}}
                ]);
            }
        }

        function posNavigateToLevel(level, data) {
            $('#product-listing').hide().html('');
            $('#pos-hierarchy-content').show();
            document.getElementById('searchproduct').value = '';
            if (level === 'brands') {
                posCurrentLevel = 'brands';
                posCurrentBrandId = null;
                posCurrentModelId = null;
                posCurrentFamilyId = null;
                posShowLevel('pos-brands-level');
                posUpdateBreadcrumb([
                    {name: '{{ __("Marques") }}', level: 'brands'}
                ]);
            } else if (level === 'models') {
                loadPosModels(data.brandId);
            } else if (level === 'families') {
                loadPosFamilies(data.modelId);
            }
        }

        function loadPosModels(brandId, brandName) {
            posCurrentLevel = 'models';
            posCurrentBrandId = brandId;
            
            fetch(`/pos/brands/${brandId}/models`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('pos-models-level');
                if (data.models && data.models.length > 0) {
                    let html = '<div class="row row-gap-3">';
                    data.models.forEach(model => {
                        html += `
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 model-card" onclick="loadPosFamilies(${model.id}, '${model.name}')">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="ti ti-package me-3 text-primary" style="font-size: 2rem;"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold">${model.name}</h6>
                                            <small class="text-muted">{{ __('Modèle') }}</small>
                                        </div>
                                        <div class="ms-2">
                                            <i class="ti ti-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    html += '</div>';
                    container.innerHTML = html;
                } else {
                    container.innerHTML = `
                        <div class="text-center py-5">
                            <i class="ti ti-package text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">{{ __('Aucun modèle trouvé') }}</h5>
                        </div>
                    `;
                }
                posShowLevel('pos-models-level');
                posUpdateBreadcrumb([
                    {name: '{{ __("Marques") }}', level: 'brands'},
                    {name: brandName || '{{ __("Modèles") }}', level: 'models', data: {brandId: brandId}}
                ]);
            })
            .catch(error => {
                console.error('Error loading models:', error);
                const container = document.getElementById('pos-models-level');
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="ti ti-alert-triangle text-danger" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-danger">{{ __('Erreur de chargement') }}</h5>
                    </div>
                `;
                posShowLevel('pos-models-level');
            });
        }

        function loadPosFamilies(modelId, modelName) {
            posCurrentLevel = 'families';
            posCurrentModelId = modelId;
            
            fetch(`/pos/models/${modelId}/families`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('pos-families-level');
                if (data.families && data.families.length > 0) {
                    let html = '<div class="row row-gap-3">';
                    data.families.forEach(family => {
                        html += `
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 family-card" onclick="loadPosChassis(${family.id}, '${family.name}')">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="ti ti-folders me-3 text-success" style="font-size: 2rem;"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold">${family.name}</h6>
                                            <small class="text-muted">{{ __('Famille') }} • {{ __('Quantité') }}: ${family.quantity || 0}</small>
                                        </div>
                                        <div class="ms-2">
                                            <i class="ti ti-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    html += '</div>';
                    container.innerHTML = html;
                } else {
                    container.innerHTML = `
                        <div class="text-center py-5">
                            <i class="ti ti-folders text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">{{ __('Aucune famille trouvée') }}</h5>
                        </div>
                    `;
                }
                posShowLevel('pos-families-level');
                posUpdateBreadcrumb([
                    {name: '{{ __("Marques") }}', level: 'brands'},
                    {name: '{{ __("Modèles") }}', level: 'models', data: {brandId: posCurrentBrandId}},
                    {name: modelName || '{{ __("Familles") }}', level: 'families', data: {modelId: modelId}}
                ]);
            });
        }

        function loadPosChassis(familyId, familyName) {
            posCurrentLevel = 'chassis';
            posCurrentFamilyId = familyId;

            // Afficher le spinner pendant le chargement
            const container = document.getElementById('pos-chassis-level');
            container.innerHTML = `<div class="text-center py-4"><div class="spinner-border text-primary"></div></div>`;
            posShowLevel('pos-chassis-level');
            posUpdateBreadcrumb([
                {name: '{{ __("Marques") }}', level: 'brands'},
                {name: '{{ __("Modèles") }}', level: 'models', data: {brandId: posCurrentBrandId}},
                {name: '{{ __("Familles") }}', level: 'families', data: {modelId: posCurrentModelId}},
                {name: familyName || '{{ __("Numéros de châssis") }}', level: 'chassis', data: {familyId: familyId}}
            ]);

            fetch(`/pos/families/${familyId}/chassis`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const variant = data.variant;
                const products = data.products || [];
                const totalQty = variant ? variant.quantity : 0;

                let html = '';

                // En-tête avec infos de la famille
                if (variant) {
                    html += `
                        <div class="alert alert-info d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <i class="ti ti-motorbike me-2" style="font-size:1.4rem;"></i>
                                <strong>${variant.name}</strong>
                                &nbsp;—&nbsp;
                                <span class="badge bg-primary fs-6">${totalQty} {{ __('moto(s) disponible(s)') }}</span>
                            </div>
                            <button class="btn btn-success btn-sm" onclick="showPriceModal(${familyId}, '${variant.name}', null, ${variant.price || 0})">
                                <i class="ti ti-shopping-cart me-1"></i>{{ __('Ajouter au panier') }}
                            </button>
                        </div>
                    `;
                }

                if (products.length > 0) {
                    // Afficher les numéros de châssis individuels
                    html += `<div class="row row-gap-3">`;
                    products.forEach(product => {
                        const locColor = product.location === 'SHOW-ROOM' ? 'success' : 'secondary';
                        html += `
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 chassis-card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="ti ti-motorbike text-info me-2" style="font-size: 1.5rem;"></i>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-bold">${product.name}</h6>
                                                <small class="text-muted">
                                                    <i class="ti ti-barcode me-1"></i>${product.chassis_number}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-${locColor}">${product.location || 'DEPOT'}</span>
                                            <button class="btn btn-sm btn-primary"
                                                    onclick="showPriceModal(${product.variant_id}, '${product.name}', ${product.id}, ${product.price || 0})">
                                                <i class="ti ti-plus me-1"></i>{{ __('Ajouter') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    html += `</div>`;
                } else if (totalQty > 0) {
                    // Pas de châssis individuels mais stock disponible
                    html += `
                        <div class="alert alert-warning">
                            <i class="ti ti-info-circle me-2"></i>
                            {{ __('Aucun numéro de châssis individuel enregistré. Le stock disponible est de') }}
                            <strong>${totalQty} {{ __('unité(s)') }}</strong>.
                            {{ __('Utilisez le bouton "Ajouter au panier" ci-dessus.') }}
                        </div>
                    `;
                } else {
                    html += `
                        <div class="text-center py-5">
                            <i class="ti ti-package-off text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">{{ __('Rupture de stock') }}</h5>
                        </div>
                    `;
                }

                container.innerHTML = html;
            })
            .catch(err => {
                console.error('Error loading chassis:', err);
                container.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="ti ti-alert-triangle me-2"></i>{{ __('Erreur de chargement') }}
                    </div>
                `;
            });
        }

        function showChassisSelectionModal(familyId, familyName) {
            document.getElementById('selectedFamilyId').value = familyId;
            document.getElementById('chassisModalTitle').textContent = `{{ __('Sélectionner les numéros de châssis pour') }}: ${familyName}`;
            
            const modal = new bootstrap.Modal(document.getElementById('chassisSelectionModal'));
            modal.show();
            
            // Load chassis numbers
            fetch(`/pos/families/${familyId}/chassis`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('chassisListContainer');
                if (data.products && data.products.length > 0) {
                    let html = '<div class="list-group">';
                    data.products.forEach(product => {
                        html += `
                            <div class="list-group-item">
                                <div class="form-check">
                                    <input class="form-check-input chassis-checkbox" type="checkbox" value="${product.id}" id="chassis_${product.id}">
                                    <label class="form-check-label d-flex justify-content-between align-items-center" for="chassis_${product.id}">
                                        <div>
                                            <strong>${product.name}</strong><br>
                                            <small class="text-muted">{{ __('Numéro de châssis') }}: ${product.chassis_number}</small>
                                        </div>
                                        <span class="badge bg-primary">{{ __('Prix') }}: ${product.price}</span>
                                    </label>
                                </div>
                            </div>
                        `;
                    });
                    html += '</div>';
                    container.innerHTML = html;
                } else {
                    container.innerHTML = `
                        <div class="text-center py-5">
                            <i class="ti ti-box text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">{{ __('Aucun numéro de châssis disponible') }}</h5>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading chassis:', error);
                const container = document.getElementById('chassisListContainer');
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="ti ti-alert-triangle text-danger" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-danger">{{ __('Erreur de chargement') }}</h5>
                    </div>
                `;
            });
        }

        function validateChassisSelection() {
            const selectedChassis = [];
            document.querySelectorAll('.chassis-checkbox:checked').forEach(checkbox => {
                selectedChassis.push(checkbox.value);
            });
            
            const familyId = document.getElementById('selectedFamilyId').value;
            
            fetch('/pos/add-to-cart', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    family_id: familyId,
                    selected_chassis: selectedChassis
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    bootstrap.Modal.getInstance(document.getElementById('chassisSelectionModal')).hide();
                    
                    // Show success message
                    show_toastr('Success', data.message, 'success');
                    
                    // Update cart totals
                    $('#displaytotal').text(addCommas(data.total));
                    $('.totalamount').text(addCommas(data.total));
                    
                    // Enable pay button if cart has items
                    $('#btn-pur button').removeAttr('disabled');
                    $('.btn-empty button').addClass('btn-clear-cart');
                    
                    // Reload page to show updated cart
                    setTimeout(() => location.reload(), 600);
                } else {
                    show_toastr('{{ __("Error") }}', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                show_toastr('{{ __("Error") }}', '{{ __("Une erreur est survenue") }}', 'error');
            });
        }

        // ==================== SCAN / BARCODE SEARCH ====================
        let scanSearchTimeout = null;
        const scanInput = document.getElementById('scanChassisInput');
        const scanResultsDiv = document.getElementById('scanResults');
        const scanResultsBody = document.getElementById('scanResultsBody');

        function performScanSearch(query) {
            if (!query || query.length < 1) {
                scanResultsDiv.style.display = 'none';
                return;
            }

            scanResultsBody.innerHTML = `<tr><td colspan="6" class="text-center py-2"><div class="spinner-border spinner-border-sm text-primary me-2"></div>{{ __('Recherche en cours...') }}</td></tr>`;
            scanResultsDiv.style.display = 'block';

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            
            fetch(`/pos/search-chassis?q=${encodeURIComponent(query)}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : ''
                }
            })
            .then(async r => {
                const text = await r.text();
                try {
                    return JSON.parse(text);
                } catch (e) {
                    const preview = text.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim().substring(0, 300);
                    throw new Error('HTTP ' + r.status + ' — ' + preview);
                }
            })
            .then(data => {
                if (data.error) {
                    scanResultsBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger py-3"><i class="ti ti-alert-triangle me-2"></i>{{ __('Erreur') }}: ${data.error}</td></tr>`;
                    scanResultsDiv.style.display = 'block';
                    return;
                }
                if (data.results && data.results.length > 0) {
                    let html = '';
                    data.results.forEach(item => {
                        html += `<tr>
                            <td>${item.brand_name || '-'}</td>
                            <td>${item.model_name || '-'}</td>
                            <td>${item.family_name || '-'}</td>
                            <td><span class="badge bg-info">${item.chassis_number}</span></td>
                            <td><span class="badge bg-${item.location === 'SHOW-ROOM' ? 'success' : 'secondary'}">${item.location}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary add-scan-to-cart" 
                                        data-chassis-id="${item.id}" 
                                        data-variant-id="${item.variant_id}">
                                    <i class="ti ti-plus me-1"></i>{{ __('Ajouter') }}
                                </button>
                            </td>
                        </tr>`;
                    });
                    scanResultsBody.innerHTML = html;
                    scanResultsDiv.style.display = 'block';
                } else {
                    scanResultsBody.innerHTML = `<tr><td colspan="6" class="text-center py-3">
                        <div class="alert alert-warning mb-0">
                            <i class="ti ti-search-off me-2"></i>
                            <strong>{{ __('Aucun résultat trouvé') }}</strong>
                            <br><small class="text-muted">{{ __('Vérifiez le numéro de châssis et réessayez') }}</small>
                        </div>
                    </td></tr>`;
                    scanResultsDiv.style.display = 'block';
                }
            })
            .catch(err => {
                console.error('Scan search error:', err);
                scanResultsBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger py-3"><i class="ti ti-alert-triangle me-2"></i>${err.message || '{{ __("Erreur lors de la recherche") }}'}</td></tr>`;
                scanResultsDiv.style.display = 'block';
            });
        }

        if (scanInput) {
            scanInput.addEventListener('input', function() {
                clearTimeout(scanSearchTimeout);
                scanSearchTimeout = setTimeout(() => performScanSearch(this.value.trim()), 300);
            });

            scanInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(scanSearchTimeout);
                    performScanSearch(this.value.trim());
                }
            });
        }

        document.getElementById('scanSearchBtn').addEventListener('click', function() {
            const query = scanInput.value.trim();
            if (!query) {
                scanResultsBody.innerHTML = `<tr><td colspan="6" class="text-center text-warning py-3"><i class="ti ti-alert-circle me-2"></i>{{ __('Veuillez saisir un numéro de châssis') }}</td></tr>`;
                scanResultsDiv.style.display = 'block';
                return;
            }
            performScanSearch(query);
        });

        // Add scanned chassis to cart
        $(document).on('click', '.add-scan-to-cart', function() {
            const btn = $(this);
            const chassisId = btn.data('chassis-id');
            const variantId = btn.data('variant-id');
            
            btn.prop('disabled', true).html('<i class="ti ti-loader me-1"></i>{{ __("Ajout...") }}');
            
            fetch('/pos/add-to-cart', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    family_id: variantId,
                    selected_chassis: [chassisId]
                })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    show_toastr('Success', data.message, 'success');
                    // Change button to success state
                    btn.removeClass('btn-primary').addClass('btn-success').html('<i class="ti ti-check me-1"></i>{{ __("Ajouté") }}');
                    // Update displayed totals
                    if (data.total) {
                        $('#displaytotal').text(data.total);
                        $('.totalamount').text(data.total);
                    }
                    $('#btn-pur button').removeAttr('disabled');
                    $('.btn-empty button').addClass('btn-clear-cart');
                    // Reload after short delay to update cart table
                    setTimeout(() => location.reload(), 1200);
                } else {
                    show_toastr('{{ __("Error") }}', data.message, 'error');
                    btn.prop('disabled', false).html('<i class="ti ti-plus me-1"></i>{{ __("Ajouter") }}');
                }
            })
            .catch(err => {
                console.error('Add to cart error:', err);
                btn.prop('disabled', false).html('<i class="ti ti-plus me-1"></i>{{ __("Ajouter") }}');
            });
        });

        // ==================== PRICE INPUT MODAL ====================
        function showPriceModal(variantId, productName, chassisId = null, price = 0) {
            // Si le prix catalogue existe déjà, ajouter directement sans modal
            if (price > 0) {
                addToCartDirect(variantId, productName, chassisId, price);
                return;
            }

            // Sinon ouvrir le modal pour saisir le prix manuellement
            document.getElementById('priceProductName').value = productName;
            document.getElementById('priceVariantId').value = variantId;
            document.getElementById('priceChassisId').value = chassisId || '';
            document.getElementById('priceInput').value = '';
            document.getElementById('priceHint').innerHTML = `<small class="text-warning"><i class="ti ti-alert-triangle me-1"></i>{{ __('Aucun prix catalogue. Saisissez le prix de vente.') }}</small>`;

            const modal = new bootstrap.Modal(document.getElementById('priceInputModal'));
            modal.show();
            document.getElementById('priceInputModal').addEventListener('shown.bs.modal', function handler() {
                document.getElementById('priceInput').focus();
                this.removeEventListener('shown.bs.modal', handler);
            });
        }

        function addToCartDirect(variantId, productName, chassisId, price) {
            const payload = { family_id: variantId, price: price };
            if (chassisId) payload.selected_chassis = [chassisId];

            show_toastr('', '{{ __("Ajout en cours...") }}', 'info');

            fetch('/pos/add-to-cart', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    show_toastr('{{ __("Succès") }}', productName + ' {{ __("ajouté au panier") }}', 'success');
                    // Rafraîchir le panier
                    if (typeof refreshCart === 'function') refreshCart();
                    else location.reload();
                } else {
                    show_toastr('{{ __("Erreur") }}', data.message || '{{ __("Erreur lors de l\'ajout") }}', 'error');
                }
            })
            .catch(err => {
                console.error('Add to cart error:', err);
                show_toastr('{{ __("Erreur") }}', '{{ __("Erreur réseau") }}', 'error');
            });
        }

        // Confirmer l'ajout au panier avec prix
        document.getElementById('confirmAddToCart').addEventListener('click', function() {
            const price = parseFloat(document.getElementById('priceInput').value);
            const variantId = document.getElementById('priceVariantId').value;
            const chassisId = document.getElementById('priceChassisId').value;
            
            if (isNaN(price) || price <= 0) {
                show_toastr('{{ __("Error") }}', '{{ __("Veuillez saisir un prix valide") }}', 'error');
                document.getElementById('priceInput').focus();
                return;
            }
            
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="ti ti-loader me-1"></i>{{ __("Ajout...") }}';
            
            const payload = {
                family_id: variantId,
                price: price
            };
            
            if (chassisId) {
                payload.selected_chassis = [chassisId];
            }
            
            fetch('/pos/add-to-cart', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('priceInputModal')).hide();
                    show_toastr('Success', data.message, 'success');
                    
                    // Update displayed totals
                    if (data.total) {
                        $('#displaytotal').text(data.total);
                        $('.totalamount').text(data.total);
                    }
                    $('#btn-pur button').removeAttr('disabled');
                    $('.btn-empty button').addClass('btn-clear-cart');
                    
                    // Reload to update cart table
                    setTimeout(() => location.reload(), 800);
                } else {
                    show_toastr('{{ __("Error") }}', data.message, 'error');
                }
                btn.disabled = false;
                btn.innerHTML = '<i class="ti ti-shopping-cart me-1"></i>{{ __("Ajouter au panier") }}';
            })
            .catch(err => {
                console.error('Add to cart error:', err);
                show_toastr('{{ __("Error") }}', '{{ __("Une erreur est survenue") }}', 'error');
                btn.disabled = false;
                btn.innerHTML = '<i class="ti ti-shopping-cart me-1"></i>{{ __("Ajouter au panier") }}';
            });
        });

        // ==================== PAY / CREATE ORDER MODAL ====================
        const payModal = document.getElementById('payOrderModal');
        
        const cur = '{{ \App\Models\Store::where("id",\Auth::user()->current_store)->first()->currency ?? "MAD" }}';

        function recalcPayTotals(subtotal) {
            const tva = parseFloat(document.getElementById('pay_tva').value) || 0;
            const tvaAmount = subtotal * tva / 100;
            const total = subtotal + tvaAmount;
            document.getElementById('paySubtotalDisplay').textContent    = cur + ' ' + subtotal.toFixed(2);
            document.getElementById('payTvaPercent').textContent         = tva;
            document.getElementById('payTvaAmountDisplay').textContent   = cur + ' ' + tvaAmount.toFixed(2);
            document.getElementById('payTotalDisplay').textContent       = cur + ' ' + total.toFixed(2);
        }

        document.getElementById('pay_tva')?.addEventListener('input', function() {
            const subtotal = parseFloat(this.closest('.modal-body')?.dataset.subtotal || 0);
            recalcPayTotals(subtotal);
        });

        document.getElementById('openPayModal')?.addEventListener('click', function() {
            const cartRows = document.querySelectorAll('#tbody tr[data-chassis-id], #tbody tr[data-product-id]');
            const payBody = document.getElementById('payItemsBody');
            let html = '';
            let subtotal = 0;

            if (cartRows.length > 0) {
                cartRows.forEach(row => {
                    const chassisNumber = row.getAttribute('data-chassis-number') || 'N/A';
                    const nameCell = row.querySelector('.name');
                    const productName = nameCell ? nameCell.textContent.trim().split('\n')[0].trim() : '';
                    const priceCell = row.querySelector('.price');
                    const priceText = priceCell ? priceCell.textContent.trim() : '0';
                    const price = parseFloat(priceText.replace(/[^0-9.]/g, '')) || 0;
                    const qtyCell = row.querySelector('.quantity');
                    const quantity = qtyCell ? parseInt(qtyCell.textContent.trim()) : 1;
                    const rowSubtotal = price * quantity;
                    subtotal += rowSubtotal;

                    html += `<tr>
                        <td>${productName}</td>
                        <td><span class="badge bg-info">${chassisNumber}</span></td>
                        <td class="text-end">${cur} ${price.toFixed(2)}</td>
                        <td class="text-center">${quantity}</td>
                        <td class="text-end fw-bold">${cur} ${rowSubtotal.toFixed(2)}</td>
                    </tr>`;
                });
            } else {
                html = `<tr><td colspan="5" class="text-center text-muted py-3">{{ __('Aucun article dans le panier') }}</td></tr>`;
            }

            payBody.innerHTML = html;
            // Reset form fields
            document.getElementById('pay_tva').value = '0';
            document.getElementById('pay_comment').value = '';
            // Store subtotal on modal-body for TVA recalc
            document.querySelector('#payOrderModal .modal-body').dataset.subtotal = subtotal;
            recalcPayTotals(subtotal);

            const modal = new bootstrap.Modal(payModal);
            modal.show();
        });

        // Confirm and create order
        document.getElementById('confirmPayOrder')?.addEventListener('click', function() {
            const btn = this;
            const cartRows = document.querySelectorAll('#tbody tr[data-chassis-id], #tbody tr[data-product-id]');
            const items = [];
            
            cartRows.forEach(row => {
                const chassisId = row.getAttribute('data-chassis-id');
                const productId = row.getAttribute('data-product-id');
                const priceCell = row.querySelector('.price');
                const priceText = priceCell ? priceCell.textContent.trim() : '0';
                const price = parseFloat(priceText.replace(/[^0-9.]/g, '')) || 0;
                
                if (chassisId) {
                    items.push({
                        chassis_number_id: parseInt(chassisId),
                        price: price
                    });
                } else if (productId) {
                    // For family items, we need to handle differently
                    const variantId = row.getAttribute('data-variant-id');
                    if (variantId) {
                        items.push({
                            variant_id: parseInt(variantId),
                            price: price
                        });
                    }
                }
            });
            
            if (items.length === 0) {
                show_toastr('{{ __("Error") }}', '{{ __("Aucun article dans le panier") }}', 'error');
                return;
            }
            
            btn.disabled = true;
            btn.innerHTML = '<i class="ti ti-loader me-1"></i>{{ __("Création en cours...") }}';
            
            fetch('/pos/create-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    customer_name: document.getElementById('pay_customer_name').value,
                    customer_phone: document.getElementById('pay_customer_phone').value,
                    notes: document.getElementById('pay_notes').value,
                    comment: document.getElementById('pay_comment').value,
                    tva: parseFloat(document.getElementById('pay_tva').value) || 0,
                    discount: parseFloat($('.discount').val()) || 0,
                    items: items,
                    session_key: '{{ $lastsegment }}'
                })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(payModal).hide();
                    show_toastr('Success', data.message, 'success');
                    setTimeout(() => location.reload(), 1200);
                } else {
                    show_toastr('{{ __("Error") }}', data.message, 'error');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="ti ti-check me-1"></i>{{ __("Confirmer et créer la commande") }}';
                }
            })
            .catch(err => {
                console.error('Create order error:', err);
                show_toastr('{{ __("Error") }}', '{{ __("Une erreur est survenue") }}', 'error');
                btn.disabled = false;
                btn.innerHTML = '<i class="ti ti-check me-1"></i>{{ __("Confirmer et créer la commande") }}';
            });
        });

    </script>
    <script>
        var site_currency_symbol_position = '{{ \App\Models\Utility::getValByName('currency_symbol_position') }}';
        var site_currency_symbol = '{{ \App\Models\Store::where('id',\Auth::user()->current_store)->first()->currency }}';
    </script>
@endpush
