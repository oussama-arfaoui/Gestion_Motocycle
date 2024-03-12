@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('product-categories.index') }}">Product Categories</a>
    </div>

    {{-- Actions for the product categories table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('product-categories.create') }}">
            <x-add-icon />
            <span>Create New Category</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Category Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->category_name }}</td>
                <td>
                    @if($category->image)
                        <img src="{{ asset('storage/Images/general/' . $category->image) }}" alt="Category Image">
                    @else
                        No image available
                    @endif
                </td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ route('product-categories.show', $category->id) }}" target="_blank">
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>
                    <a href="{{ route('product-categories.edit', $category->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>

                    <form action="{{ route('product-categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="confirmDelete({{ $category->id }})" class="dashboard-icon-button action-delete">
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
    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            document.getElementById('deleteForm' + categoryId).submit();
        }
    }
</script>

@endsection
