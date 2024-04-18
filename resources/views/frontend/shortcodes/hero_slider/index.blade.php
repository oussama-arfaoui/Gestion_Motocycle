{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.hero_slider.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'section_tag' => $section_tag = $section_tag ?? "",

'title' => $title = $title ?? "",

'subtitle' => $subtitle = $subtitle ?? "",

'description' => $description = $description ?? "",

'keyword' => $keyword = $keyword ?? "",

'primary_button_label' => $primary_button_label = $primary_button_label ?? "",

'primary_button_link' => $primary_button_link = $primary_button_link ?? "",

'secondary_button_label' => $secondary_button_label = $secondary_button_label ?? "",

'secondary_button_link' => $secondary_button_link = $secondary_button_link ?? "",

])