<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Social App</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    <div class="app">
        <div class="auth">
            <div class="logo">Social App</div>
            <h3>Register to Social App</h3>
            <form action="{{url('register')}}" method="post">
                @csrf
                <div class="form_group">
                    <label for="name">Name</label>
                    <input type="name" name="name" id="name">
                    @error('name')<span class="field-error">{{$message}}</span>@enderror
                </div>
                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    @error('email')<span class="field-error">{{$message}}</span>@enderror
                </div>
                <div class="form_group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    @error('password')<span class="field-error">{{$message}}</span>@enderror
                </div>
                <div class="form_group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password">
                    @error('confirm_password')<span class="field-error">{{$message}}</span>@enderror
                </div>
                <button class="btn">Register</button>
                <div class="links">
                    <a href="{{url('login')}}">Login</a>
                    <a href="{{url('/')}}">Contact us</a>
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