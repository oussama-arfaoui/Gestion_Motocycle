{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.homepage_cta.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [
'title' => $title,
'description' => $description,
'primary_button_label' => $primary_button_label,
])