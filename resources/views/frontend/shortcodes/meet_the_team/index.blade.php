{{-- Index File --}}

{{-- Determine which style to use --}}
@php
$style = $style ?? ''; // Default to empty string if style is not provided
$viewName = "frontend.shortcodes.meet_the_team.style.$style";
@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [

'section_tag' => $section_tag,

'title' => $title,

'description' => $description,

'member_1' => $member_1,

'job_title_1' => $job_title_1,

'member_2' => $member_2,

'job_title_2' => $job_title_2,

'member_3' => $member_3,

'job_title_3' => $job_title_3,

])