@extends('backend.layouts.admin-dashboard')

@section('content')

<div class="dashboard-main-container">
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="/admin/shortcode_editor">Shortcode Editor</a>
    </div>

    <div class="dashboard-main-container-actions">

        <button class="dashboard-secondary-button">
            <x-trash-icon />
            <span>Reset Changes</span>
        </button>

        <button id="registerChangesButton" class="dashboard-main-button">
            <x-add-icon />
            <span>Get Edited Shortcode</span>
        </button>
    </div>

    
    
    <div class="dashboard-main-container-modules">
        {{-- INPUT --}}
        <div class="dashboard-row">
            <div class="node-display">
                <div class="node-display-head">
                    <button id="page_shortcodes_input_edit" class="dashboard-icon-button node-display-action">
                        <x-edit-icon />
                    </button>
                    <label for="page_shortcodes_input">Input: Place The Page's Shortcodes Here For Modifcation:</label>
                </div>
                <textarea type="text" name="page_shortcodes_input" id="page_shortcodes_input"></textarea>
            </div>

            {{-- OUTPUT --}}
                    <div class="node-display">
                        <div class="node-display-head">
                            <button id="page_shortcodes_output_copy" class="dashboard-icon-button node-display-action">
                                <x-copy-icon />
                            </button>
                            <label for="page_shortcodes_output">Output: Copy the Modifications From Here</label>
                        </div>
                        <textarea type="text" name="page_shortcodes_output" id="page_shortcodes_output"></textarea>
                    </div>
        </div>

        {{-- EDITOR --}}
        <div id="shortcode-editor" class="shortcode-editor"></div>

    </div>


</div>

@endsection