@extends('layouts.main')
@section('title', 'Post')
@section('content')
<section class="container">
    <h3 class="section-heading">Post</h3>
       <form  class="post-box" action="{{url('post')}}" method="post" enctype="multipart/form-data">
        @csrf
        <textarea name="post" id="post" cols="30" rows="10"></textarea>
        <div class="post-actions">
            <div class="characters"><span>0</span> / 500</div>
            <i class="fa fa-link select-file"></i>
            <input type="file" name="file[]" id="file" accept="image/*" class="hidden-select-file" multiple="multiple">
            <button id="make-post" class="btn-nohover ">Post</button>
        </div>
       </form>
    <div class="post-notes">
        <ul>
            <li>You post must not contain any abusive words.</li>
            <li>Post must not harm anyone sentiments.</li>
            <li>You can only select image file for the post.</li>
            <li>If you post is reported by 5 or more person the post will automatically blocked for public view.</li>
        </ul>
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
