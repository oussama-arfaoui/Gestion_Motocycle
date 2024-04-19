
/**
 * 
 * CONSTANTS
 */


const hero_slider_counter = 8000;


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





/**
 * 
 * DROPDOWNS CODE
 *  Add the name of the dropdow in the array to make it function
 */


const dropdowns = ["nav-products", "nav-ecommerce", "nav-generator", "nav-projects", "nav-Settings", "nav-Services", "username"];

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








/**
 * 
 * SHORTCODE GENERATOR:
 *  Dashboard tab that allows you to easily create a shortcode
 */



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
            '${element}' => $${element} = $${element} ?? "",
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


/// EDITING SHORTCODES

// Sample shortcode
const shortcode = '[hero_slider section_tag="nothing" title="This is the Title For the Hero Section" subtitle="This is the Subtitle For the Hero Section" description="Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritati" keyword="Wonderway" primary_button_label="Primary Button" primary_button_link="Primary Link" secondary_button_label="Secondary button" secondary_button_link="Secondary Link" style="style4" ][/hero_slider][brands Brands="19,19,19,19,19,19,19,19,19,19" style="style2" ][/brands][category_overview section_tag="Category Overview" title="This is the title for the category overview" subtitle="this is the subtitle for the category overview" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur." primary_button_label="Primary Button" primary_button_link="/catalogue" secondary_button_label="Secondary Button" secondary_button_link="/contact" keyword="Category Overview" node_icon_1="quality" node_title_1="Node Title" node_description_1="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." node_icon_2="service" node_title_2="Node Title" node_description_2="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." node_icon_3="customize" node_title_3="Node Title" node_description_3="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." node_icon_4="efficiency" node_title_4="Node Title" node_description_4="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." category_title_1="Category Title" category_description_1="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." category_button_1="Discover More" category_link_1="/category" category_title_2="Category Title" category_description_2="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." category_button_2="Discover More" category_link_2="/category" category_title_3="Category Title" category_description_3="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." category_button_3="Discover More" category_link_3="/catalogue" category_title_4="Category Title" category_description_4="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." category_button_4="Discover More" category_link_4="Category Title" style="style7" ][/category_overview][about_overview section_tag="About Overview" title="This is the title for the about overview" subtitle="This is the subtitle for the about overview" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur." primary_button_label="Primary Button" primary_button_link="Primary Link" secondary_button_label="Secondary Button" secondary_button_link="Secondary Link" keyword="Wonderway" node_icon_1="quality" node_title_1="Node Title" node_description_1="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." node_icon_2="efficiency" node_title_2="Node Title" node_description_2="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." node_icon_3="custom" node_title_3="Node Title" node_description_3="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." node_icon_4="service" node_title_4="Node Title" node_description_4="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." style="style5" ][/about_overview]';


let shortcode_editor = document.getElementById("shortcode-editor");

function parseAttributes(attributes) {
    const regex = /(\w+)="([^"]*)"/g;
    let matches = [];
    let match;
    while ((match = regex.exec(attributes)) !== null) {
        matches.push({ key: match[1], value: match[2] });
    }
    return matches;
}

// Function to parse shortcode
function parseShortcode(shortcode) {
    const regex = /\[(\w+)(.*?)\]/g;
    let matches = [];
    let match;
    while ((match = regex.exec(shortcode)) !== null) {
        matches.push({ tag: match[1], attributes: parseAttributes(match[2]) });
    }
    return matches;
}

const parsedShortcode = parseShortcode(shortcode);


function createInputsForAttributes(attributes) {
    const container = document.createElement('div');
    container.classList.add('node-input');

    attributes.forEach((attribute, index) => {
        const label = document.createElement('label');
        label.textContent = `${attribute.key}:`;

        let input;
        if (attribute.key.toLowerCase().includes('description')) {
            input = document.createElement('textarea');
            input.textContent = attribute.value;
        } else {
            input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('value', attribute.value);
        }

        container.appendChild(label);
        container.appendChild(input);
    });
    return container;
}

// Function to create HTML input elements for each shortcode
function createInputsForShortcode(parsedShortcode) {
    
    parsedShortcode.forEach((shortcode, index) => {
        const shortcode_module = document.createElement('div');
        shortcode_module.classList.add('shortcode_module')
        

        const label = document.createElement('h3');
        label.textContent = `${shortcode.tag}`;
        shortcode_module.appendChild(label);
        label.classList.add('shortcode_module-title')
    
        shortcode.attributes.forEach((attribute, index) => {
            shortcode_module.appendChild(createInputsForAttributes([attribute]));
        });

        shortcode_editor.appendChild(shortcode_module);
    });


    return shortcode_editor;
}


shortcode_editor = createInputsForShortcode(parsedShortcode);


const registerChangesButton = document.getElementById('registerChangesButton');

function registerChangesAndGenerateShortcode() {
    let modifiedShortcode = '';
    const shortcodeModules = document.querySelectorAll('.shortcode_module');
    shortcodeModules.forEach((module, index) => {
        const tag = module.querySelector('.shortcode_module-title').textContent;
        modifiedShortcode += `[${tag}`;
        const inputs = module.querySelectorAll('input, textarea');
        inputs.forEach((input, inputIndex) => {
            const key = input.previousElementSibling.textContent.replace(':', '').trim();
            const value = input.value.replace(/'/g, '’');
            modifiedShortcode += ` ${key}="${value}"`;
        });
        modifiedShortcode += ']';
    });
    console.log(modifiedShortcode);
    // You can further process the modified shortcode as needed (e.g., send it to a server, update a preview, etc.)
}

registerChangesButton.addEventListener('click', ()=>{
    console.log("hello")
    registerChangesAndGenerateShortcode()
} );