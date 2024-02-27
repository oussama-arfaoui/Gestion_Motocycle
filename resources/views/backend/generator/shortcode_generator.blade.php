@extends('backend.layouts.admin-dashboard')

@section('content')

<div class="dashboard-main-container">
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="/shortcode_generator">Shortcode Generator</a>
    </div>

    <div class="dashboard-main-container-actions">
        
        <button id="clean_button" class="dashboard-secondary-button" >
            <x-trash-icon />
            <span>Clean Displays</span>
        </button>

        <button id="generate_button" class="dashboard-main-button">
            <x-add-icon />
            <span>Generate Shortcode</span>
        </button>
    </div>

    <div class="dashboard-main-container-modules">
        
        <div class="node-input">
            <label for="shortcode_name">Shortcode Name</label>
            <input type="text" name="shortcode_name" id="shortcode_name" />
        </div>
        
        <div class="node-input">
            <label for="shortcode_array">Shortcode Array Elements</label>
            <textarea type="text" name="shortcode_array" id="shortcode_array"></textarea>
        </div>
        
        <div class="node-display">
            <div class="node-display-head">
                <button id="shortcode_function_get_copy" class="dashboard-icon-button node-display-action"><x-copy-icon /></button>
                <label for="shortcode_function_get">Shortcode Function Get</label> 
            </div>
            <textarea type="text" name="shortcode_function_get" id="shortcode_function_get"></textarea>
        </div>

        <div class="node-display">
            <div class="node-display-head">
                <button id="shortcode_function_index_copy" class="dashboard-icon-button node-display-action">
                    <x-copy-icon />
                </button>
                <label for="shortcode_function_index">Shortcode Function Index</label>
            </div>
            <textarea type="text" name="shortcode_function_index" id="shortcode_function_index"></textarea>
        </div>
        
        <div class="node-display">
            <div class="node-display-head">
                <button id="shortcode_admin_config_code_copy" class="dashboard-icon-button node-display-action">
                    <x-copy-icon />
                </button>
                <label for="shortcode_admin_config_code">Shortcode Admin Config Code</label>
            </div>
            <textarea type="text" name="shortcode_admin_config_code" id="shortcode_admin_config_code"></textarea>
        </div>

        <div class="node-display">
            <div class="node-display-head">
                <button id="shortcode_index_copy" class="dashboard-icon-button node-display-action">
                    <x-copy-icon />
                </button>
                <label for="shortcode_index">Shortcode Index</label>
            </div>
            <textarea type="text" name="shortcode_index" id="shortcode_index"></textarea>
        </div>
        
        <div class="node-display">
            <div class="node-display-head">
                <button id="shortcode_style_template_copy" class="dashboard-icon-button node-display-action">
                    <x-copy-icon />
                </button>
                <label for="shortcode_style_template">Shortcode Style Template</label>
            </div>
            <textarea type="text" name="shortcode_style_template" id="shortcode_style_template"></textarea>
        </div>
    
    </div>


</div>

@endsection