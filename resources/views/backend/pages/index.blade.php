@extends('backend.layouts.admin-dashboard')


@section('content')
<div class="dashboard-main-container">


    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('pages.index') }}">Pages</a>
    </div>

    {{-- Actions for the pages table --}}

    <div class="dashboard-main-container-actions">

        {{-- Bulk Actions and Such --}}



        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('pages.create') }}">
            <x-add-icon />
            <span>Create New Page</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td>{{ $page->name }}</td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ config('app.url') }}{{ $page->slug->key }}" target="_blank">
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button></a>

                    <a href="{{ route('pages.edit', $page->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>

                    <form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="confirmDelete({{ $page->id }})" class="dashboard-icon-button action-delete">
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
    function confirmDelete(pageId) {
        if (confirm('Are you sure you want to delete this page?')) {
            document.getElementById('deleteForm' + pageId).submit();
        }
    }
</script>

@endsection