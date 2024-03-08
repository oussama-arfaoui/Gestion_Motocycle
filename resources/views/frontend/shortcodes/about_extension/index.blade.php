{{-- Index File --}}

{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.about_extension.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'title' => $title,

'description' => $description,

'node_title_1' => $node_title_1,

'node_description_1' => $node_description_1,

'node_title_2' => $node_title_2,

'node_description_2' => $node_description_2,

'node_title_3' => $node_title_3,

'node_description_3' => $node_description_3,

'node_title_4' => $node_title_4,

'node_description_4' => $node_description_4,

])