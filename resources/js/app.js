

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

    if (attributes_string) {
        return shortcode_function_index.value = `
        '${formatted_shortcode_name}' => [
            'name' => '${formatted_shortcode_name}',
            'view' => 'frontend.shortcodes.${formatted_shortcode_name}.index',
            'attributes' => ['${attributes_string}','style']
        ],
        `
    } else {
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
            <select name="style">
                <option value="style1">Style 1</option>
                <option value="style2">Style 2</option>
                <option value="style3">Style 3</option>
                <option value="style4">Style 4</option>
                <option value="style5">Style 5</option>
                <option value="style6">Style 6</option>
                <option value="style7">Style 7</option>
                <option value="style8">Style 8</option>
                <option value="style9">Style 9</option>
                <option value="style10">Style 10</option>
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


// function logImageSrc() {
//     var imageSrc = document.getElementById('image-fucked').getAttribute('src');
//     console.log("Image source:", imageSrc);
// }

// setInterval(logImageSrc, 2000)


// Function to play sound
const click_1 = new Audio('https://assets.mixkit.co/active_storage/sfx/1120/1120-preview.mp3');
const click_2 = new Audio("https://assets.mixkit.co/active_storage/sfx/1118/1118-preview.mp3");
const sound_success = new Audio("https://assets.mixkit.co/active_storage/sfx/1107/1107-preview.mp3");

function playSound(element) {
    element.play();
}

// Add click event listener to elements with class "dashboard-icon-button"
document.addEventListener('DOMContentLoaded', function () {

    var buttons = document.querySelectorAll('.dashboard-icon-button');
    var sidebarLinks = document.querySelector('.dashboard_sidebar__links');
    var dashboardMainButton = document.querySelectorAll('.dashboard-main-button');

    
    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            playSound(click_1);
        });
    });
    
    sidebarLinks.addEventListener('click', function (event) {
        // Check if the event target is a child element
        var isChild = event.target.closest('.dashboard_sidebar__links') !== null;
        if (isChild) {
            playSound(click_2);
        }
    });

    dashboardMainButton.forEach(function (button) {
        button.addEventListener('click', function () {
            playSound(sound_success);
        });
    });
});


/// DARK THEME
const root = document.documentElement;
let isToggled = localStorage.getItem('isToggled') === 'true';

const toggleColors = () => {
    if (isToggled) {
        root.style.setProperty('--db-light', '#111827');
        root.style.setProperty('--db-dark', '#F9FAFB');
        root.style.setProperty('--db-gray', '#D2D5DA');
        root.style.setProperty('--db-dark-gray', '#1f29371c');

        root.style.setProperty('--db-blue', '#93c5fd');
        root.style.setProperty('--db-purple', '#d8b4fe');
        root.style.setProperty('--db-red', '#FCA5A5');
        root.style.removeProperty('--db-green');
    } else {
        root.style.setProperty('--db-light', '#d1cfcc');
        root.style.setProperty('--db-dark', '#000100');
        root.style.setProperty('--db-gray', '#d1cfcc81');
        root.style.setProperty('--db-dark-gray', '#54545481');

        root.style.setProperty('--db-blue', '#5268a589');
        root.style.setProperty('--db-purple', '#cfced18c');
        root.style.setProperty('--db-red', '#ffac7c8a');
        root.style.setProperty('--db-green', '#cbd62e80');
    }

    isToggled = !isToggled;
    localStorage.setItem('isToggled', isToggled);
};


document.querySelector('.dashboard-theme-toggler').addEventListener('click', toggleColors);
