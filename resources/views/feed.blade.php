@extends('layouts.main')
@section('title', 'Chat')
@section('content')
    <section class="container">
        <h3 class="section-heading">Feed</h3>
        <div class="all-feeds">
            @foreach ($posts as $post)
                <?php
                $imgs = explode(',', $post->files);
                $posted_by = DB::table('users')
                    ->where('id', $post->created_by)
                    ->first();
                $liked = DB::table('likes')
                    ->where('post_id', $post->id)
                    ->where('user_id', Session::get('id'))
                    ->first();
                ?>
                <div class="single-feed">
                    <div class="posted-by">
                    @if($posted_by->username==Session::get('username'))
                    <a href="javascript:void(0)">Me</a>
                    {{$post->created_at->diffForHumans()}}
                    @else
                        <a target="_blank" href="{{url('profile')}}/{{$posted_by->username}}"> {{ '@' . $posted_by->username }}</a>
                        {{$post->created_at->diffForHumans()}}
                    @endif
                    </div>
                    @if ($post->files != '')
                        <div class="feed-img">
                            @foreach ($imgs as $img)
                                <img src="{{ asset('assets/posts') }}/{{ $img }}" alt="" class="post-image">
                            @endforeach
                        </div>
                    @endif
                    <div class="feed-post">
                        {!! $post->post !!}
                    </div>

                    <div class="feed-actions">
                        <div class="like-comment">
                            @if ($liked)
                                <i class="fa-solid fa-heart like-post" like-id="{{ $post->id }}"></i>
                            @else
                                <i class="fa-regular fa-heart like-post" like-id="{{ $post->id }}"></i>
                            @endif
                            <i class="fa-regular fa-comment open-comments" comment-id="{{ $post->id }}"></i>
                            <i class="fa-regular fa-flag"></i>
                        </div>
                        <div class="like-comment-no">
                            <span id="like-{{ $post->id }}" class="no_likes">{{ $post->likes }} like(s)</span> <span
                                id="comment-{{ $post->id }}" cmnt-id="{{ $post->id }}" class="no_comments">{{ $post->comments }} comment(s)</span>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>


        <div class="view-img">
            <i class="fa fa-times close-img"></i>
            <img class="image-modal" src="" alt="Some Error">
        </div>

        <div class="post-comments">
            <i class="fa fa-times close-comments"></i>
            <div class="write-comment">
                <input type="hidden" name="comment_id" id="comment_id" value="">
                <textarea class="comment_area" name="" id="" cols="30" rows="10"></textarea>
                <button class="btn-nohover" id="add-comment">Add</button>
            </div>
            <div class="recent-comments">
                <h4>Recent Comments</h4>
                <div class="all-recent-comments">
                    <div class="recent-single-comment">
                        {{-- <div class="recent-comment-username"><a href="">@vinay_munjal</a> <span class="time">5 mins
                                ago</span></div>
                        <div class="recent-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores
                            reprehenderit et, veritatis ipsa odit iusto?</div> --}}
                    </div>
                </div>


            </div>
        </div>


    </section>
@endsection
