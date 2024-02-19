<table id="style-3" class="table style-3 dt-table-hover non-hover">
    <thead>
    <tr>
        <th class="checkbox-column dt-no-sorting"> Record no. </th>
        <th>name</th>
        <th>description</th>
        <th>content</th>
        <th>is_featured</th>
        <th>image</th>
        <th>views</th>
        <th>status</th>
        <th>...tools</th>
    </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->service_name }}</td>
                <td>{{ $service->service_description }}</td>
                <td>{{ $service->content }}</td>
                <td>{{ $service->is_featured }}</td>
                <td>{{ $service->image }}</td>
                <td>{{ $service->views }}</td>
                <td>{{ $service->status }}</td>
                <td><i class="fa fa-edit"><a href="{{ route('service.edit', ['id' => $service->id]) }}"></a></i></td>    
            </tr>
            @endforeach
    </tbody>
</table>