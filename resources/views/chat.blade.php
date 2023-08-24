@extends('layouts.main')
@section('title', 'Chat')
@section('content')
    <section class="container">
        <h3 class="section-heading">Chat</h3>

        <div class="chat-section">

            <div class="chat-box">
                <div class="chat-header">
                    <div class="chat-img">
                        @if ($user->profile_pic != '')
                            <img src="{{ asset('assets/images') }}/{{ $user->profile_pic }}" alt="">
                        @else
                            <img src="{{ asset('assets/images/user.jpeg') }}" alt="">
                        @endif
                    </div>
                    <div class="chat-user-details">
                        <p>{{ $user->name }}</p>
                        <p>Offline <span class="offline"></span></p>
                    </div>
                    <i class="fa fa-ellipsis-v three-dots"></i>
                    <div class="chat-action">
                        <ul>
                            <li>Report</li>
                            <li>Block</li>
                            <li>Clear</li>
                        </ul>
                    </div>
                </div>
                <div class="chat-body">
                    @foreach ($messages as $msg)
                        <?php
                        $rname = DB::table('users')
                            ->where('username', $msg->other_id)
                            ->first();
                        $sname = DB::table('users')
                            ->where('username', $msg->my_id)
                            ->first();
                        ?>
                        @if ($msg->other_id == $user->username)
                            <div class="msgg outgoing-msg">
                                @if($msg->files!='')
                                @php
                                    $br_files = explode(',',$msg->files);
                                @endphp
                                <div class="chat-images">
                                    @foreach($br_files as $file)
                                        <img src="{{asset('assets/chat')}}/{{$file}}" alt="">
                                    @endforeach
                                </div>
                                @endif
                                {{ $msg->msg }}
                            </div>
                        @else
                            <div class="msgg incoming-msg">
                                @if($msg->files!='')
                                @php
                                    $br_files = explode(',',$msg->files);
                                @endphp
                                <div class="chat-images">
                                    @foreach($br_files as $file)
                                        <img src="{{asset('assets/chat')}}/{{$file}}" alt="">
                                    @endforeach
                                </div>
                                @endif
                                {{ $msg->msg }}
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="chat-footer">
                    <textarea name="msg" id="msg" cols="30" rows="10"></textarea>
                    <input type="hidden" id="other_id" value="{{$user->username}}">
                    <div class="msg-action">
                        <i class="fa fa-file select-file"></i>
                        <input type="file" name="files[]" id="files" accept="image/*" class="hidden-select-file" multiple>
                        <button id="send-msg"><i class="fa fa-paper-plane"></i></button>
                    </div>
                </div>
                
            </div>
            <div class="my-friends">
                <h3>My friends</h3>
                <a class="my-friend" href="">
                    <img src="{{ asset('assets/images/user.jpeg') }}" alt="">
                    <p>John doe</p>
                </a>
                <a class="my-friend" href="">
                    <img src="{{ asset('assets/images/user.jpeg') }}" alt="">
                    <p>Chris Addam</p>
                </a>
                <a class="my-friend" href="">
                    <img src="{{ asset('assets/images/user.jpeg') }}" alt="">
                    <p>William Jack</p>
                </a>
            </div>
        </div>
    </section>
@endsection
