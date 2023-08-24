<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Social App</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    <div class="app">
        <div class="auth">
            <div class="logo">Social App</div>
            <h3>Login to Social App</h3>
            <form action="{{url('login')}}" method="post">
                @csrf
                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="form_group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <button class="btn">Login</button>
                <div class="links">
                    <a href="{{url('register')}}">Create</a>
                    <a href="{{url('forget-password')}}">Forgot?</a>
                </div>
            </form>
            <div class="note">Welcome to Social App.</div>
            <div class="notifications">
                @if(Session::has('success'))
                <div class="notification">
                    {{Session::get('success')}}
                  </div>
                  @endif
                  @if(Session::has('invalid'))
                <div class="notification incorrect">
                    {{Session::get('invalid')}}
                  </div>
                  @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>