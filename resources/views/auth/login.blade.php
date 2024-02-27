<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carbon - Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/scss/style.scss', 'resources/js/app.js'])
</head>



<body class="auth antialiased">
    <main class="dashboard_login">

{{-- 
        <div class="dashboard_login-bg">
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
        </div> --}}

        <div class="dashboard_login-content">

            <div class="dashboard_login-content-text">
                <h2>Carbon X - Admin Login</h2>
                <p>Enter Your Credential Below</p>
            </div>

            <form class="dashboard_login-content-form" action="/login" method="POST">
                @csrf
                <input type="text" placeholder="Email" name="email" id="email" required>
                <input type="password" placeholder="Password" name="password" id="password" required>

                <button class="dashboard_login-content-form-submit" id="login_submit">
                    <span>Unlock</span>

                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.25 8.25H3.75C2.92157 8.25 2.25 8.92157 2.25 9.75V15C2.25 15.8284 2.92157 16.5 3.75 16.5H14.25C15.0784 16.5 15.75 15.8284 15.75 15V9.75C15.75 8.92157 15.0784 8.25 14.25 8.25Z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M5.25 8.25V5.25C5.25 4.25544 5.64509 3.30161 6.34835 2.59835C7.05161 1.89509 8.00544 1.5 9 1.5C9.99456 1.5 10.9484 1.89509 11.6517 2.59835C12.3549 3.30161 12.75 4.25544 12.75 5.25V8.25"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="18" height="18" />
                        <path
                            d="M14.25 8.25H3.75C2.92157 8.25 2.25 8.92157 2.25 9.75V15C2.25 15.8284 2.92157 16.5 3.75 16.5H14.25C15.0784 16.5 15.75 15.8284 15.75 15V9.75C15.75 8.92157 15.0784 8.25 14.25 8.25Z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M5.25 8.24999V5.24999C5.24907 4.32003 5.59371 3.42289 6.21703 2.73274C6.84035 2.04259 7.69787 1.60867 8.62313 1.51521C9.54839 1.42175 10.4754 1.67542 11.2241 2.22698C11.9729 2.77854 12.4899 3.58863 12.675 4.49999"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </form>

            <a class="dashboard_login-content-remember" href="">Forgot Your Password?</a>
            <a class="dashboard_login-content-remember" href="/register">Create a New Account?</a>
        </div>

    </main>
</body>

</html>

{{-- 

<h2>Login</h2>

@if($errors->any())
<div>
    <div style="color:red;">
        Something went wrong!
    </div>
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{ $error }}
        </li>
        @endforeach
    </ul>
</div>
@endif
<form action="/login" method="POST">
    @csrf
    <div class="container">
        <p>Please fill in this form to create an login.</p>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>


        <button>Login</button>
    </div>

</form>  --}}