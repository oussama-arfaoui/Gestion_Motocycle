@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <span>Blogs</span>
    </div>

    {{-- Actions for the blogs table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('blogs.create') }}">
            <x-add-icon />
            <span>Create New Blog</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Category</th>
                <th>Title</th>
                <th>Content</th>
                <th>Views</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                  <!--hadi dyales image-->
                  @php
                  $imageArray = json_decode($blog->image, true);
                  $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                  @endphp
  
                  @if($firstImage)
                  <td><img id="image-fucked" src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="First Image"></td>
                  @else
                  <td>No image available</td>
                  @endif
                  <!--hadi dyales image-->
                  
                <!-- Displaying category name -->
                <td>
                    @php
                    $category = \App\Models\BlogsCategories::find($blog->category_id);
                    if($category) {
                        echo $category->name;
                    } else {
                        echo 'N/A';
                    }
                    @endphp
                </td>

                <td>{{ $blog->title }}</td>
                <td>{{ $blog->content }}</td>
                <td>{{ $blog->views }}</td>
                <td>{{ $blog->status }}</td>
                <td class="dashboard_main-table-actions">
                    <!-- Add button for viewing blog details -->
                    <a href="{{ route('blogs.show', $blog->id) }}" target="_blank">
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>
                    <a href="{{ route('blogs.edit', $blog->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete({{ $blog->id }})"
                            class="dashboard-icon-button action-delete">
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
    function confirmDelete(blogId) {
        if (confirm('Are you sure you want to delete this blog?')) {
            document.getElementById('deleteForm' + blogId).submit();
        }
    }
</script>

@endsection
