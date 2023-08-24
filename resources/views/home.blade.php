@extends('layouts.main')
@section('title', 'Home')
@section('content')
<section class="hero container">
    <div class="left">
        <div class="headings">
            <h4>Tired of doing boring activities</h4>
            <h3>Social App is here</h3>
        </div>
        <p class="text">Introducing the revolutionary Social App, the ultimate escape from boredom and a gateway to endless excitement! Say goodbye to mundane activities and embrace a world of limitless possibilities. With the Social App, you can effortlessly connect with friends from all corners of the globe, engaging in vibrant conversations and sharing unforgettable moments. Explore a diverse range of interest-based groups, where you can meet like-minded individuals and delve into fascinating discussions. Unleash your creativity by sharing captivating photos, videos, and media with your friends, all in one convenient platform. The only limit is your imagination!</p>
        <div class="cta">
            @if(Session::has('authenticated'))
            <a href="{{url('post')}}" class="btn">Post Something</a>
            @else
            <a href="{{url('login')}}" class="btn">Get Started</a>
            @endif
        </div>
    </div>
    <div class="right">
        <div class="form">
            <h3>Want to contact?</h3>
            <form action="">
                <div class="form_group">
                    <label for="name">Name</label>
                    <input type="text" name="name">
                </div>
                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="text" name="email">
                </div>
                <div class="form_group">
                    <label for="mobile">Mobile</label>
                    <input type="number" name="mobile">
                </div>
                <div class="form_group">
                    <label for="msg">Message</label>
                    <textarea name="msg" id="msg"></textarea>
                </div>
                <button class="btn">Submit</button>
            </form>
        </div>
    </div>
</section>
@endsection
