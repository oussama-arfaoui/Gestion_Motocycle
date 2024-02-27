{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.gallery_overview.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [
'section_tag' => $section_tag,

'title' => $title,
'description' => $description,
'primary_button_label' => $primary_button_label,

'project_title_1' => $project_title_1,
'project_description_1' => $project_description_1,
'project_period_1' => $project_period_1,
'project_number_of_doors_1' => $project_number_of_doors_1,
'project_location_1' => $project_location_1,
'project_date_1' => $project_date_1,

'project_title_2' => $project_title_2,
'project_description_2' => $project_description_2,
'project_period_2' => $project_period_2,
'project_number_of_doors_2' => $project_number_of_doors_2,
'project_location_2' => $project_location_2,
'project_date_2' => $project_date_2,

'project_title_3' => $project_title_3,
'project_description_3' => $project_description_3,
'project_period_3' => $project_period_3,
'project_number_of_doors_3' => $project_number_of_doors_3,
'project_location_3' => $project_location_3,
'project_date_3' => $project_date_3,

'project_title_4' => $project_title_4,
'project_description_4' => $project_description_4,
'project_period_4' => $project_period_4,
'project_number_of_doors_4' => $project_number_of_doors_4,
'project_location_4' => $project_location_4,
'project_date_4' => $project_date_4,

'project_title_5' => $project_title_5,
'project_description_5' => $project_description_5,
'project_period_5' => $project_period_5,
'project_number_of_doors_5' => $project_number_of_doors_5,
'project_location_5' => $project_location_5,
'project_date_5' => $project_date_5,
])