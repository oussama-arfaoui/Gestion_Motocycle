{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.category_overview.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [
'section_tag' => $section_tag,

'title' => $title,
'description' => $description,
'primary_button_label' => $primary_button_label,

'category_title_1' => $category_title_1,
'category_description_1' => $category_description_1,
'category_button_1' => $category_button_1,

'category_title_2' => $category_title_2,
'category_description_2' => $category_description_2,
'category_button_2' => $category_button_2
])