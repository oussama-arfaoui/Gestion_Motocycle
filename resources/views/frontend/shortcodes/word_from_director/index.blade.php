{{-- Index File --}}

{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.word_from_director.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'section_tag' => $section_tag,

'title' => $title,

'description' => $description,

'name_tag' => $name_tag,

])