{{-- Index File --}}

{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.category_with_examples.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'primary_button_link' => $primary_button_link,

'product_name_1' => $product_name_1,

'product_name_2' => $product_name_2,

'product_name_3' => $product_name_3,

'sell_button' => $sell_button,

'tag_1' => $tag_1,

'tag_2' => $tag_2,

'category_link' => $category_link,

])