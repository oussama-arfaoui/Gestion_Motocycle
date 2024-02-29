{{-- Index File --}}

{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.testimonials.style.$style";

@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'title'=> $title,
'description'=> $title,
'testimonials' => $testimonials,

])