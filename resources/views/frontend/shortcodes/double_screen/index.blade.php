{{-- Index File --}}

{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.double_screen.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'title_1' => $title_1,

'description_1' => $description_1,

'button_1' => $button_1,

'title_2' => $title_2,

'description_2' => $description_2,

'button_2' => $button_2,

])