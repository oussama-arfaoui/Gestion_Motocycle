@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('products.index') }}">Products</a>
    </div>

    {{-- Actions for the products table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('products.create') }}">
            <x-add-icon />
            <span>Create New Product</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Status</th>
                <th>Template</th>
                <th>SEO Title</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
            @if($product->images)

                 <!--hadi dyales image-->
                    @php
                        $imageArray = json_decode($product->images, true);
                        $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                    @endphp

                    @if($firstImage)
                        <td><img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="First Image"></td>
                    @else
                        <td>No image available</td>
                    @endif
                @else
                    <td>No image available</td>
                @endif
                <!--hadi dyales image-->

                <td>{{ $product->product_name }}</td>              
                <td>{{ $product->product_description }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->template }}</td>
                <td>{{ $product->seo_title }}</td>
                <td>{{ $product->category->category_name }}</td>
                </td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ route('product.edit', $product->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDelete({{ $product->id }})" class="dashboard-icon-button action-delete">
                                <x-trash-icon />
                            </button>
                        </form>


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            document.getElementById('deleteForm' + productId).submit();
        }
    }
</script>

@endsection
