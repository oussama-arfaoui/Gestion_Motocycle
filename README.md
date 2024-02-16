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
- `id` is defined as an auto-increment primary key.
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

    ## **Model: Slug**

- **Description:** Represents a page on the website.
- **File Path:** **`C:\MAMP\htdocs\Carbon-X\app\Models\Slug.php`**
    **Methods:**
## **Controller: I use PageController too and update store & edit**


# Documentation For Frontend
## **Views: Pages**

- **Description:** Contains views related to managing pages in the dashboard.
- **File Paths:**
    - **`C:\MAMP\htdocs\Carbon-X\resources\views\backend\pages\index.blade.php`**: View for displaying a list of all pages.
    - **`C:\MAMP\htdocs\Carbon-X\resources\views\backend\pages\create.blade.php`**: View for creating a new page.
    - **`C:\MAMP\htdocs\Carbon-X\resources\views\backend\pages\edit.blade.php`**: View for editing an existing page.