{{-- Determine which style to use --}}
@php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.Category_Overview.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [
    'title' => isset($title) ? $title : '',
    'subtitle' => isset($subtitle) ? $subtitle : '',
    'category_ids' => isset($category_ids) ? $category_ids : ''
])
