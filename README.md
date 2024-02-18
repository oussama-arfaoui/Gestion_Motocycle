<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# Carbon-x CMS documentation
# Documentation For Database

## **Pages Table**

- **Description:** Stores information about pages on the website.
- **Columns:**
    - **`id`**: Unique identifier for the page.
    - **`name`**: Name of the page.
    - **`content`**: Content of the page.
    - **`user_id`**: ID of the user who created the page.
    - **`image`**: Path to the image associated with the page.
    - **`template`**: Template used for the page.
    - **`description`**: Description of the page.
    - **`status`**: Status of the page (e.g., published).
    - **`created_at`**: Timestamp indicating when the page was created.
    - **`updated_at`**: Timestamp indicating when the page was last updated.

## **Slugs Table**

- **Description:** Stores information about pages on the website.
- **Columns:**
    - **`id`**: Unique identifier for the page.
    - `key` is the unique slug key for each page.
    - `reference_id` stores the ID of the referenced page from the Pages table.
    - `reference_type` specifies the type of the referenced model (e.g., 'App\Models\Page').
    - `prefix` is an optional field that you may use.
    - `created_at` and `updated_at` are timestamps for tracking creation and updates.

# Documentation For Backend

## **Model: Page**

- **Description:** Represents a page on the website.
- **File Path:** **`C:\MAMP\htdocs\Carbon-X\app\Models\Page.php`**

## **Controller: PageController**

- **Description:** Manages CRUD operations for pages.
- **File Path:** **`C:\MAMP\htdocs\Carbon-X\app\Http\Controllers\PageController.php`**
- **Methods:**
    - **`index`**: Displays a list of all pages.
    - **`create`**: Displays the form for creating a new page.
    - **`store`**: Stores a newly created page in the database.
    - **`show`**: Displays the details of a specific page.
    - **`edit`**: Displays the form for editing a specific page.
    - **`update`**: Updates the details of a specific page in the database.
    - **`destroy`**: Deletes a specific page from the database.

## **Route: web.php**

Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

## **Model: Slug**

- **Description:** Represents a page on the website.
- **File Path:** **`C:\\MAMP\\htdocs\\Carbon-X\\app\\Models\\Slug.php`Methods:**

## **Controller: I use PageController too and update store & edit and SlugController**

- **Description:** Handles requests related to slugs.
- **File Path:** **`app/Http/Controllers/SlugController.php`**

### **Routes**

1. **Web Routes**
    - **File Path:** **`routes/web.php`**
    - **Routes:**
        - **`GET /{slug}`**: Maps to **`SlugController@showBySlug`** for displaying page content by slug.

### 

### **Files Modified/Added**

### 1. **`resources\views\backend\pages\edit.blade.php`** and **`resources\views\backend\pages\create.blade.php`**

- **Description:** These files are responsible for rendering the page editing and creation forms in the backend.
- **Functionality Added:**
    - Integrated dropdown menu for selecting shortcodes.
    - Dynamically loading the view to display shortcode attributes based on the selected shortcode type.
    - Constructing and appending shortcodes to the content textarea.
    - Utilized JavaScript for dynamic behavior and AJAX requests for fetching shortcode configurations.

### 2. **`resources\functions\shortcodes.php`**

- **Description:** Contains functions related to shortcodes.
- **Functionality Added:**
    - Defined functions **`getShortcodeTypes()`** and **`getShortcodeindex()`** to retrieve shortcode types and attributes.

### 3. **`composer.json`**

- **Description:** Configuration file for Composer.
- **Changes Made:**
    - Added autoloading for the **`shortcodes.php`** file.

### 4. **`routes\web.php`**

- **Description:** Contains route definitions for the web application.
- **Changes Made:**
    - Added routes for handling shortcodes and retrieving shortcode configurations.

### 5. **`app\Http\Controllers\PageController.php`**

- **Description:** Controller responsible for managing pages.
- **Changes Made:**
    - Updated **`store`** and **`edit`** functions to handle shortcode integration into page content and updating the slug table.

### 6. **`app\Http\Controllers\SlugController.php`**

- **Description:** Controller for managing slugs.
- **Changes Made:**
    - Added a method to handle default page rendering.

### 7. **`app\helpers.php`**

- **Description:** Contains helper functions.
- **Changes Made:**
    - Added function **`processShortcodes()`** to handle shortcode processing.
    - Added function **`renderViewWithAttributes()`** to render views with attributes.

# Documentation For Frontend

## **Views: Pages**

- **Description:** Contains views related to managing pages in the dashboard.
- **File Paths:**
    - **`C:\MAMP\htdocs\Carbon-X\resources\views\backend\pages\index.blade.php`**: View for displaying a list of all pages.
    - **`C:\MAMP\htdocs\Carbon-X\resources\views\backend\pages\create.blade.php`**: View for creating a new page.
    - **`C:\MAMP\htdocs\Carbon-X\resources\views\backend\pages\edit.blade.php`**: View for editing an existing page.
    
    **Default Layout**
    
    - **Description:** Layout template for displaying page content.
    - **File Path:** **`resources/views/frontend/layouts/default.blade.php`**

### **Files Modified/Added**

### 1. **`resources\views\frontend\shortcodes\hero\index.blade.php`**

- **Description:** Renders the hero shortcode based on the provided style.
- **Changes Made:**
    - Determines the style to use based on the provided **`$style`** variable.
    - Renders the corresponding view based on the determined style, passing relevant attributes.

### 2. **`resources\views\frontend\shortcodes\hero\admin-config.blade.php`**

- **Description:** Provides a form for configuring the hero shortcode in the page management interface.
- **Functionality Added:**
    - Form fields for configuring attributes of the hero shortcode:
        - Title
        - Subtitle
        - Description
        - Button primary label
        - Style (dropdown menu for selecting a style)

### 3. **`resources\views\frontend\shortcodes\hero\style\style1.blade.php`** and **`resources\views\frontend\shortcodes\hero\style\style2.blade.php`**

- **Description:** Views for rendering different styles of the hero shortcode.
- **Functionality:**
    - Renders the hero shortcode with a specific style.
    - Receives attributes passed from the **`index.blade.php`** file and incorporates them into the rendered view.

### **Functionality Overview**

- **Integration of Hero Shortcode:**
    - Provided functionality for integrating the hero shortcode into frontend pages.
    - Allows customization of the hero section's appearance and content through attributes such as title, subtitle, description, button label, and style.