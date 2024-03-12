{{-- Index File --}}

{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.hero_section.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'section_tag' => $section_tag,

'title' => $title,

'subtitle' => $subtitle,

'description' => $description,

'primary_button_label' => $primary_button_label,

'secondary_button_label' => $secondary_button_label,

])