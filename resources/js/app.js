const hero_slider_counter = 8000;


// Code for functioning Dropdowns

const dropdowns = ["nav-products", "nav-ecommerce", "nav-generator", "username"];

for (let element of dropdowns) {
    const dropdownButton = document.getElementById(`dropdown-${element}`);
    const dropdownContent = document.getElementById(`dropdown-menu-${element}`);

    if (dropdownButton && dropdownContent) {
        dropdownButton.addEventListener('click', () => {
            dropdownContent.classList.toggle('show');
            dropdownContent.classList.toggle('hide');
            // Toggle the arrow direction as well
            const arrow = document.getElementById(`dropdown-${element}-arrow`);
            arrow.classList.toggle('spin-arrow');
        });
    }
};


//// CODE for Shortcode Generator

const generate_button = document.getElementById("generate_button")
const clean_button = document.getElementById("clean_button")

const shortcode_name = document.getElementById('shortcode_name');
const shortcode_array = document.getElementById('shortcode_array');

const shortcode_function_get = document.getElementById('shortcode_function_get');
const shortcode_function_index = document.getElementById('shortcode_function_index');
const shortcode_admin_config_code = document.getElementById('shortcode_admin_config_code');
const shortcode_index = document.getElementById('shortcode_index');
const shortcode_style_template = document.getElementById('shortcode_style_template');

const shortcode_function_get_copy = document.getElementById('shortcode_function_get_copy');
const shortcode_function_index_copy = document.getElementById('shortcode_function_index_copy');
const shortcode_admin_config_code_copy = document.getElementById('shortcode_admin_config_code_copy');
const shortcode_index_copy = document.getElementById('shortcode_index_copy');
const shortcode_style_template_copy = document.getElementById('shortcode_style_template_copy');


let attributes_array;
let formatted_shortcode_name;

if (shortcode_array && shortcode_name) {
    shortcode_array.addEventListener('change', () => {
        attributes_array = shortcode_array.value.trim().split(" ");
        console.log(attributes_array);
    })


    shortcode_name.addEventListener('change', () => {
        formatted_shortcode_name = shortcode_name.value.trim().replace(/[^a-zA-Z ]/g, '').replace(/\s+/g, '_').toLowerCase();
    })
}

/// LOCAL STORAGE RAAAH

// Function to save data to local storage
function saveDataToLocalStorage() {
    localStorage.setItem('shortcode_function_get', shortcode_function_get.value);
    localStorage.setItem('shortcode_function_index', shortcode_function_index.value);
    localStorage.setItem('shortcode_admin_config_code', shortcode_admin_config_code.value);
    localStorage.setItem('shortcode_index', shortcode_index.value);
    localStorage.setItem('shortcode_style_template', shortcode_style_template.value);
}

// Function to load data from local storage



function loadDataFromLocalStorage() {
    shortcode_function_get.value = localStorage.getItem('shortcode_function_get') || '';
    shortcode_function_index.value = localStorage.getItem('shortcode_function_index') || '';
    shortcode_admin_config_code.value = localStorage.getItem('shortcode_admin_config_code') || '';
    shortcode_index.value = localStorage.getItem('shortcode_index') || '';
    shortcode_style_template.value = localStorage.getItem('shortcode_style_template') || '';
}

// Call load function when the page loads

if (shortcode_function_get && shortcode_admin_config_code && shortcode_function_index && shortcode_style_template && shortcode_function_index) {

    window.addEventListener('load', loadDataFromLocalStorage);

}
/// Create the Get function

function create_the_get_function() {
    return shortcode_function_get.value = `
    '${formatted_shortcode_name}' => [
        'name' => '${formatted_shortcode_name}',
        'view' => 'frontend.shortcodes.${formatted_shortcode_name}.admin-config',
    ],
    `
}

function create_the_index_function() {
    var attributes_string = attributes_array.join("', '");
    
    if(attributes_string){
        return shortcode_function_index.value = `
        '${formatted_shortcode_name}' => [
            'name' => '${formatted_shortcode_name}',
            'view' => 'frontend.shortcodes.${formatted_shortcode_name}.index',
            'attributes' => ['${attributes_string}','style']
        ],
        `
    }else{
        return shortcode_function_index.value = `
        '${formatted_shortcode_name}' => [
            'name' => '${formatted_shortcode_name}',
            'view' => 'frontend.shortcodes.${formatted_shortcode_name}.index',
            'attributes' => ['style']
        ],
        `
    }
}

function create_the_admin_config_code() {
    let admin_config = ` <section class="shortcode-editor"> `

    for (let element of attributes_array) {

        if (element.toLowerCase().includes('description')) {

            admin_config += `
                    
                    <div class="node-input">
                        <label>${element}</label>
                        <textarea name="${element}" value=""></textarea>
                    </div>
                    
                    `
        } else {
            admin_config += `
                    
                    <div class="node-input">
                        <label>${element}</label>
                        <input name="${element}" value="" />
                    </div>
                    
                    `
        }

    }

    admin_config += `

        <div class="node-selector">
            <label>Style</label>
            <select name="style1">
                <option value="style1">Style 1</option>
                <option value="style1">Style 2</option>
            </select>
        </div>

    </section>`


    return shortcode_admin_config_code.value = admin_config;
}


function create_the_index_code() {
    let index_code = `

    {{-- Determine which style to use --}}
    @php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.${formatted_shortcode_name}.style.$style";
    @endphp

    {{-- Render the corresponding view --}}
    @includeIf($viewName, [
    `

    for (let element of attributes_array) {
        index_code += `
            '${element}' => $${element},
            `
    }

    index_code += `
    ])
    `

    return shortcode_index.value = index_code;
}

function create_the_style_template() {
    let style_template = `<section class="${formatted_shortcode_name}_style1 global_container">`
    for (let element of attributes_array) {
        style_template += `
        <p>{{ $${element} }}</p>
        `
    }
    style_template += `</section>`

    return shortcode_style_template.value = style_template
}

/// Generator ACTIVATE !!!!!

if (generate_button && clean_button) {

    generate_button.addEventListener('click', () => {
        create_the_get_function();
        create_the_index_function();
        create_the_admin_config_code();
        create_the_index_code();
        create_the_style_template();

        saveDataToLocalStorage();
    })

    clean_button.addEventListener('click', () => {

        shortcode_function_get.value = ''
        shortcode_function_index.value = ''
        shortcode_admin_config_code.value = ''
        shortcode_index.value = ''
        shortcode_style_template.value = ''
    })
}


if (shortcode_function_get_copy && shortcode_admin_config_code_copy && shortcode_function_index_copy && shortcode_style_template_copy && shortcode_index_copy) {


    shortcode_function_get_copy.addEventListener("click", () => {
        var text = shortcode_function_get.value;
        navigator.clipboard.writeText(text);

        shortcode_function_get.style.border = '1px solid red !important'
    })

    shortcode_function_index_copy.addEventListener("click", () => {
        var text = shortcode_function_index.value;
        navigator.clipboard.writeText(text);
    })

    shortcode_admin_config_code_copy.addEventListener("click", () => {
        var text = shortcode_admin_config_code.value;
        navigator.clipboard.writeText(text);
    })

    shortcode_index_copy.addEventListener("click", () => {
        var text = shortcode_index.value;
        navigator.clipboard.writeText(text);
    })

    shortcode_style_template_copy.addEventListener("click", () => {
        var text = shortcode_style_template.value;
        navigator.clipboard.writeText(text);
    })


}

function logImageSrc() {
    var imageSrc = document.getElementById('image-fucked').getAttribute('src');
    console.log("Image source:", imageSrc);
}

setInterval(logImageSrc, 2000)