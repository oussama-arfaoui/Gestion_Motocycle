<h2>Register</h2>

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
  

      <div>
        <label for="remember">
            <input type="checkbox" name="remember" id="remember">
            <span class="">Remember Me</span>
        </label>
      </div>

      <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
      <button>Register</button>
    </div>
  
    <div class="container signin">
      <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
  </form>