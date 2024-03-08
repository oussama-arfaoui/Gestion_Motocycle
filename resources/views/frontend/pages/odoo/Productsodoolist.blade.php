<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odoo Products List</title>
</head>
<body>
    <h1>Odoo Products List</h1>
    <ul>
        @foreach($odooproducts as $product)
            <li>
                <h2>{{ $product['name'] }}</h2>
                <p>List Price: ${{ $product['list_price'] }}</p>
                @if(isset($product['image']))
                    <img src="data:image/jpeg;base64,{{ $product['image'] }}" alt="{{ $product['name'] }}">
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
