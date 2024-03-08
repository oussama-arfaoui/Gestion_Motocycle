{{-- Index File --}}

{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.mission_value_vision.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'section_tag' => $section_tag,

'title' => $title,

'description' => $description,

'node_title_1' => $node_title_1,

'node_description_1' => $node_description_1,

'node_title_2' => $node_title_2,

'node_description_2' => $node_description_2,

'node_title_3' => $node_title_3,

'node_description_3' => $node_description_3,

])