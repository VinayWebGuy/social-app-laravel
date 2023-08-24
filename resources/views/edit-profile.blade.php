@extends('layouts.main')
@section('title', 'Edit Profile')
@section('content')
<section class="container">
    <h3 class="section-heading">Edit Profile</h3>
    <div class="profile">
        <form action="{{url('edit-profile')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form_group">
                    <label for="username">Username</label>
                    <input type="text" value="{{$user->username}}" readonly>
                </div>
                <div class="form_group">
                    <label for="name">Name</label>
                    <input type="text" value="{{$user->name}}" name="name">
                </div>
            </div>
            <div class="row">
                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="email" value="{{$user->email}}" readonly>
                </div>
                <div class="form_group">
                    <label for="mobile">Mobile</label>
                    <input type="number" name="mobile" value="{{$user->mobile}}">
                </div>
            </div>
            <div class="row full">
                <div class="form_group">
                    <label for="bio">Bio</label>
                    <textarea name="bio" id="bio" cols="30" rows="10">{{$user->bio}}</textarea>
                </div>
            </div>
            <div class="row full">
                <div class="form_group">
                    <label for="bio">Profile Pic</label>
                    <input type="file" name="profile_pic" id="profile_pic">
                    @if($user->profile_pic!='')
                        <img src="{{asset('assets/images')}}/{{$user->profile_pic}}" width="60px" height="60px" alt="">
                    @endif
                </div>
            </div>
            <p class="mtb-8">More Details</p>
            <div class="row">
                <div class="form_group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" id="dob" value="{{$user->dob}}">
                </div>
                <div class="form_group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender">
                        <option value="">Choose</option>
                        <option @if($user->gender=="male") {{'selected'}} @endif value="male">Male</option>
                        <option @if($user->gender=="female") {{'selected'}} @endif value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form_group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" value="{{$user->city}}">
                </div>
                <div class="form_group">
                    <label for="pincode">Pin code</label>
                    <input type="number" name="pincode" id="pincode" value="{{$user->pincode}}">
                </div>
               
            </div>
            <div class="row">
                <div class="form_group">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" value="{{$user->state}}">
                </div>
                <div class="form_group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" value="{{$user->country}}">
                </div>
               
            </div>
            <button class="btn">Update</button>
            <span class="additional-link">For additonal profile details <a href="#" class="underline-link">Click here</a></span>
        </form>
    </div>


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
</section>
@endsection
