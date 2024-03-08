{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.brands.style.$style";

@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [ 'Brands' => $Brands])