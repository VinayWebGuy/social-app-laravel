<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title') - Social App</title>
</head>

<body>
    <main>
        <header class="container">
            <div class="logo">Social App</div>
            <div class="menu">
                <ul>
                    @if(Session::has('authenticated'))
                    <li><a href="javascript:void()">Welcome {{Session::get('name')}}</a></li>
                    <li><a href="{{url('post')}}">Post</a></li>
                    <li><a href="{{url('feed')}}">Feed</a></li>
                    <li><a href="{{url('logout')}}" class="btn">Logout</a></li>
                    @else
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Stars <i class="fa fa-star"></i></a></li>
                    <li><a href="{{url('register')}}" class="btn">Sign up</a></li>
                    @endif
                </ul>
                <span class="close-sidebar">x</span>
            </div>
            <div class="hamburger">
                <i class="fa-solid fa-bars"></i>
            </div>
        </header>