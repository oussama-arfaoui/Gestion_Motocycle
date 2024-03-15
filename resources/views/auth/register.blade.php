<x-page-head />


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
                <h2>Carbon X - User Registration</h2>
                <p>Create Your Account</p>
            </div>

            <form class="dashboard_login-content-form" action="/register" method="POST">
                @csrf
                <input input type="text" placeholder="name" name="name" id="name" required>

                <input type="text" placeholder="Email" name="email" id="email" required>
                
                <input type="password" placeholder="Password" name="password" id="password" required>

                <button class="dashboard_login-content-form-submit" id="login_submit">
                    <span>Create Account</span>
                </button>
            </form>

            <a class="dashboard_login-content-remember" href="#">By creating an account you agree to our Terms of Service.</a>
            <a class="dashboard_login-content-remember" href="/login">Already Have An Account?</a>
        </div>

    </main>
</body>

</html>

{{-- <h2>Register</h2>

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
<form action="/register" method="POST">
    @csrf
    <div class="container">
      <p>Please fill in this form to create an account.</p>
      <hr>

      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="name" name="name" id="name" required>
      <hr>
  
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" id="email" required>
  
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" id="password" required>

      <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
      <button>Register</button>
    </div>
  
    <div class="container signin">
      <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
  </form> --}}