{{-- Determine which style to use --}}
@php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.hero.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [
    'title' => $title,
    'subtitle' => $subtitle,
    'description' => $description,
    'button_primary_label' => $button_primary_label
])
