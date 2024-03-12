@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('products.index') }}">Products</a>
    </div>

    {{-- Form for editing a product --}}
    <div class="dashboard-main-container-modules">


            <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="node-input">
                <label for="product_name" class="form-label">Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control"
                    value="{{ $product->product_name }}">
            </div>
            <div class="node-input">
                <label for="product_description" class="form-label">Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control"
                    value="{{ $product->product_description }}">
            </div>


            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $product->status }}">
            </div>
            <div class="node-input">
                <label for="template" class="form-label">Template</label>
                <input type="text" name="template" id="template" class="form-control"
                    value="{{ $product->template }}">
            </div>


            <div class="node-input">
                <label for="seo_title" class="form-label">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control"
                    value="{{ $product->seo_title }}">
            </div>


            <!-- Images -->
            <div class="node-input">
                <label for="images" class="form-label">Images</label>
                @foreach(json_decode($product->images) as $image)
                <img src="{{ asset('storage/Images/general/' . $image) }}" alt="Project Image">
                @endforeach
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>

            <div class="node-input">
                <label for="points" class="form-label">List of Points</label>
                <textarea name="points" id="points" class="form-control"
                    rows="4">{{ $product->points }}</textarea>
            </div>

            <div class="node-input">
                <label for="characteristics" class="form-label">Characteristics</label>
                <textarea name="characteristics" id="characteristics" class="form-control">{{ $product->characteristics }}</textarea>
            </div>

            <!-- Attributes -->
            <div class="node-input" id="attributeFields">
                <label for="attributes" class="form-label">Attributes</label>
                @foreach(json_decode($product->attributes) as $attribute => $value)
                <div class="attribute">
                    <input type="text" name="attributes[name][]" placeholder="Attribute Name" value="{{ $attribute }}"
                        class="form-control">
                    <input type="text" name="attributes[value][]" placeholder="Attribute Value" value="{{ $value }}"
                        class="form-control">
                </div>
                @endforeach
            </div>
            <button type="button" id="addAttribute" class="btn btn-primary mt-3">Add Attribute</button>


            <div class="node-selector">
                <label for="categories" class="form-label">Categories</label>
                <select name="categories[]" id="categories" class="form-select">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>Save</span>
            </button>

        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('addAttribute').addEventListener('click', function() {
            var attributeField = document.createElement('div');
            attributeField.classList.add('attribute');
            attributeField.innerHTML = `
                <input type="text" name="attributes[name][]" placeholder="Attribute Name" class="form-control">
                <input type="text" name="attributes[value][]" placeholder="Attribute Value" class="form-control">
                <button type="button" class="btn btn-danger removeAttribute">Remove</button>
            `;
            document.getElementById('attributeFields').appendChild(attributeField);
        });

        document.getElementById('attributeFields').addEventListener('click', function(e) {
            if (e.target.classList.contains('removeAttribute')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection
