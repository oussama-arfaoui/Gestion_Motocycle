@include('backend.layouts.menu')
@include('backend.layouts.topbar')




    <div>
        <h2>Pages</h2>
        <a href="{{ route('pages.create') }}" class="btn btn-primary">Create New Page</a>
        <table class="table">
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
                        <td>
                            <a href="{{ route('pages.show', $page->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

