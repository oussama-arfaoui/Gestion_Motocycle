{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.category_overview.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'section_tag' => $section_tag = $section_tag ?? "",

'title' => $title = $title ?? "",

'subtitle' => $subtitle = $subtitle ?? "",

'description' => $description = $description ?? "",

'primary_button_label' => $primary_button_label = $primary_button_label ?? "",

'primary_button_link' => $primary_button_link = $primary_button_link ?? "",

'secondary_button_label' => $secondary_button_label = $secondary_button_label ?? "",

'secondary_button_link' => $secondary_button_link = $secondary_button_link ?? "",

'keyword' => $keyword = $keyword ?? "",

'node_icon_1' => $node_icon_1 = $node_icon_1 ?? "",

'node_title_1' => $node_title_1 = $node_title_1 ?? "",

'node_description_1' => $node_description_1 = $node_description_1 ?? "",

'node_icon_2' => $node_icon_2 = $node_icon_2 ?? "",

'node_title_2' => $node_title_2 = $node_title_2 ?? "",

'node_description_2' => $node_description_2 = $node_description_2 ?? "",

'node_icon_3' => $node_icon_3 = $node_icon_3 ?? "",

'node_title_3' => $node_title_3 = $node_title_3 ?? "",

'node_description_3' => $node_description_3 = $node_description_3 ?? "",

'node_icon_4' => $node_icon_4 = $node_icon_4 ?? "",

'node_title_4' => $node_title_4 = $node_title_4 ?? "",

'node_description_4' => $node_description_4 = $node_description_4 ?? "",

'category_title_1' => $category_title_1 = $category_title_1 ?? "",

'category_description_1' => $category_description_1 = $category_description_1 ?? "",

'category_button_1' => $category_button_1 = $category_button_1 ?? "",

'category_link_1' => $category_link_1 = $category_link_1 ?? "",

'category_title_2' => $category_title_2 = $category_title_2 ?? "",

'category_description_2' => $category_description_2 = $category_description_2 ?? "",

'category_button_2' => $category_button_2 = $category_button_2 ?? "",

'category_link_2' => $category_link_2 = $category_link_2 ?? "",

'category_title_3' => $category_title_3 = $category_title_3 ?? "",

'category_description_3' => $category_description_3 = $category_description_3 ?? "",

'category_button_3' => $category_button_3 = $category_button_3 ?? "",

'category_link_3' => $category_link_3 = $category_link_3 ?? "",

'category_title_4' => $category_title_4 = $category_title_4 ?? "",

'category_description_4' => $category_description_4 = $category_description_4 ?? "",

'category_button_4' => $category_button_4 = $category_button_4 ?? "",

'category_link_4' => $category_link_4 = $category_link_4 ?? "",

])