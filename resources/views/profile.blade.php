@extends('layouts.main')
@section('title', 'Profile')
@section('content')
<section class="container">
    <h3 class="section-heading">Profile</h3>

    <div class="profile">
        <div class="profile-info">
            <div class="username">
                @if(Session::get('id')==$user->id)
                <a href="{{url('edit-profile')}}">{{'@'.$user->username}} <i class="fa fa-edit"></i></a>
                @else
                    <a href="javascript:void(0)">{{'@'.$user->username}}</a>
                @endif
            </div>
            <div class="name">{{$user->name}}</div>
            <div class="email">{{$user->email}}</div>
            <div class="mobile">{{$user->mobile}}</div>
            <div class="about">{{$user->bio}}</div>
            <div class="badges">
                <div class="badge red"></div>
                <div class="badge yellow"></div>
                <div class="badge green"></div>
                <div class="badge pink"></div>
                <div class="badge blue"></div>
            </div>
            <div class="friend-actions">
                <button class="btn">Add Friend <i class="fa fa-user-plus"></i></button>
                <a href="{{url('chat')}}/{{$user->username}}" id="msg" class="btn btn2">Message <i class="fa fa-message"></i></a>
            </div>
        </div>
        <div class="profile-pic">
            <div class="profile-pic-shield">
                @if($user->profile_pic!='')
                <img src="{{asset('assets/images')}}/{{$user->profile_pic}}" draggable="false" alt="">
                @else
                    <img src="{{asset('assets/images/user.jpeg')}}" draggable="false" alt="">
                @endif
            </div>
        </div>
    </div>
   </section>
@endsection
