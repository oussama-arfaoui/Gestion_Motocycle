<table id="style-3" class="table style-3 dt-table-hover non-hover">
    <thead>
    <tr>
        <th class="checkbox-column dt-no-sorting"> Record no. </th>
        <th>product_name</th>
        <th>product_description</th>
        <th>Status</th>
        <th>template</th>
        <th>seo_title</th>
        <th>...tools</th>
    </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->product_description }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->template }}</td>
                <td>{{ $product->seo_title }}</td>
                <td><i class="fa fa-edit"><a href="{{ route('product.edit', ['id' => $product->id]) }}"></a></i></td>
            </tr>
        @endforeach
    </tbody>
</table>