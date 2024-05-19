
/**
 * 
 * CONSTANTS
 * 
 */


const hero_slider_counter = 8000;



/**
 * 
 * HTML ELEMENTS
 * 
 */
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


const Notification_DB = document.getElementById("dashboard_notification");
const Notification_DB_text = document.getElementById("dashboard_notification_text");
const closeDbNotification = document.getElementById("closeDbNotification");

const page_shortcodes_input = document.getElementById("page_shortcodes_input");
const page_shortcodes_input_edit = document.getElementById("page_shortcodes_input_edit");

const page_shortcodes_output = document.getElementById("page_shortcodes_output");
const page_shortcodes_output_copy = document.getElementById("page_shortcodes_output_copy");

const page_delete_button = document.getElementById("page_delete_button")

const dashboard_menu_toggle = document.getElementById("dashboard_menu_toggle");
const dashboard_sidebar = document.getElementById("dashboard_sidebar");


/**
 * 
 *  Notification System
 * 
 *  Add the function after any event that doesn't reload the page.
 */

function Notify(text, importance) {
    Notification_DB.classList.remove('remove_notif');

    if (importance) {
        Notification_DB.classList.add(importance);
    }
    Notification_DB_text.innerText = text;

    Notification_DB.classList.add("notify");

    setTimeout(() => {
        Notification_DB.classList.remove("notify");
        Notification_DB.classList.add('remove_notif');
    }, 5100);
}

if (closeDbNotification) {
    closeDbNotification.addEventListener('click', () => {
        Notification_DB.classList.remove("notify");
        Notification_DB.classList.add('remove_notif');
    })
}




/**
 * 
 * DROPDOWNS CODE
 *  Add the name of the dropdow in the array to make it function, especially the sidebar ones.
 */


const dropdowns = ["nav-products", "nav-ecommerce", "nav-generator", "nav-projects", "nav-Settings", "nav-Services", "nav-Blogs", "nav-Job", "nav-Carrier", "username"];

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

        Notify("Codes Generated Successfully!");
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

        Notify("Copied Successfully!");
    })

    shortcode_function_index_copy.addEventListener("click", () => {
        var text = shortcode_function_index.value;
        navigator.clipboard.writeText(text);

        Notify("Copied Successfully!");
    })

    shortcode_admin_config_code_copy.addEventListener("click", () => {
        var text = shortcode_admin_config_code.value;
        navigator.clipboard.writeText(text);

        Notify("Copied Successfully!");
    })

    shortcode_index_copy.addEventListener("click", () => {
        var text = shortcode_index.value;
        navigator.clipboard.writeText(text);

        Notify("Copied Successfully!");
    })

    shortcode_style_template_copy.addEventListener("click", () => {
        var text = shortcode_style_template.value;
        navigator.clipboard.writeText(text);

        Notify("Copied Successfully!");
    })


}


/**
 * 
 * Shortcode Editor (semi-automatic)
 * 
 * 
 *     HOW TO USE???
 * 
 *  -> Paste your Collection of shortcodes into the input field
 *  -> Press the yellow edit button
 *  -> Edit to your heart's content
 *  -> Click the Main Green button to generate the new collection of shortcodes
 *  -> Paste into the pages.
 */

if (page_shortcodes_input && page_shortcodes_output) {

    let shortcode_editor = document.getElementById("shortcode-editor");

    const shortcode = page_shortcodes_input.value;


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
        shortcode_editor.innerHTML = '';

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



    const registerChangesButton = document.getElementById('registerChangesButton');


    // Update editor when shortcode is pasted & the edit button is clicked. 
    page_shortcodes_input_edit.addEventListener('click', () => {
        const shortcode = page_shortcodes_input.value;
        const parsedShortcode = parseShortcode(shortcode);
        createInputsForShortcode(parsedShortcode);


    });


    page_shortcodes_output_copy.addEventListener('click', () => {
        var text = page_shortcodes_output.value;
        navigator.clipboard.writeText(text);

        Notify("Collection Copied Successfully!");
    });

    registerChangesButton.addEventListener('click', () => {
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
        page_shortcodes_output.value = modifiedShortcode; // Display modified shortcode on the second output screen
    });


}



/**
 * 
 * Page Deletion System
 */


if (page_delete_button) {
    page_delete_button.addEventListener("click", (e) => {

        e.preventDefault();
        if (confirm('Are you sure you want to delete this brand?')) {
            Notify("Page deleted Successfully.")
            e.target.closest('form').submit();
        } else {
            Notify("Cencelled Deletion...")
        }
    })
}




/**
 * 
 * Toggling Viewing the Dashboard Sidebar
 */


dashboard_menu_toggle.addEventListener("click", () => {
    dashboard_sidebar.classList.toggle('show-block')
})