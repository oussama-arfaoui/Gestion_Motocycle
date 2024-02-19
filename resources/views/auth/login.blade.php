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

  </form>