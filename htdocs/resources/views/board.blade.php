@extends('layout.index')
@include('layout.modal-login')
@section('grid-layout')
    <div class="container" style="width:100%;margin-top:30px;padding-left:0 !important; padding-right:0 !important;">
            <div class="container" style="width:100%;margin-top:30px;padding-left:0 !important; padding-right:0 !important;">
                <div class="left-side col-md-12">
                    <div class="cover-profile" style="background-image: url('{{URL::to('/api/photo/')."/".$board["cover_link"]}}')"></div>
                    <div class="dark-cover"></div>
                    <div class='cover-content'>
                        <h1 id="user-span" data-user="{{$board["board_id"]}}">{{$board["title"]}}</h1>
                        <div class="cover-caption"><h4>{{$board["description"]}}</h4></div>
                    </div>
                </div>
                <div class="right-side col-md-12">
                    <div class="row" style="padding-top:18px;">
                    <h3>
                        @if(Auth::user()!=null)
                            @if($board["user_id"]==Auth::user()->user_id)
                                <button id="btn-edit" class="btn follow_btn">
                                    <em></em>
                                    <span>Chỉnh sửa</span>
                                </button>
                            @else
                                @if(!isset($board["follow"]))
                                    <button id="btn-follow" class="btn follow_btn" data-id="1">
                                        <em></em>
                                        <span>Theo dõi</span>
                                    </button>
                                @else
                                    <button id="btn-follow" class="btn follow_btn" data-id="1">
                                        <em></em>
                                        <span>Đang theo dõi</span>
                                    </button>
                                @endif
                            @endif
                        @else
                            <button id="btn-follow" class="btn follow_btn" data-id="0">
                                <em></em>
                                <span>Theo dõi</span>
                            </button>
                        @endif

                    </h3>

                    </div>
                    <ul class="user-info nav nav-pills user-profile-list">
                        <li id="post-list" class="user-profile-info active">
                            <a href="#user-container" data-toggle="tab"><span>{{$profile["number_of_posts"]}}</span> Bài viết</a>
                        </li>
                        <li id="following-list" class="user-profile-info">
                            <a href="#tab4" data-toggle="tab"><span>{{$profile["number_of_following"]}}</span> Người đang theo dõi</a>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    <div class="tab-content">
        <div id="user-container" class="wf-container tab-pane active" style="margin: 40 auto;width: 90%;">
            @foreach($posts as $post)
                <div class="wf-box" data-id="{{$post["post_id"]}}">
                    <img src="{{URL::to('api/photo').'/'.$post["photo_link"]}}" class="box-img" data-id="{{$post["post_id"]}}"/>
                    <div class="content">
                        <h3 class="box-img-des">{{$post["description"]}}</h3>
                        <div class="box-img-card">
                            <img src="{{URL::asset("img/logo.png")}}" width="30" height="30" class="logo-profile">
                            <div>
                                <p class="card-owner">{{$post["owner"]}}</p>
                                <h4 class="card-title">{{$post['board_title']}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="tab3" class="wf-container tab-pane" style="margin: 40 auto;width: 90%;">
            <div class="wf-box col-sm-3" data-id="11">
                <ul class="grid-board-fl list-group">
                    <li class="list-group-item">
                        <img src="img/5.jpg" class="box-img" data-id="11"/>
                    </li>
                    <li class="list-group-item">
                        <img src="img/5.jpg" class="box-img" data-id="11"/>
                    </li>
                    <li class="list-group-item">
                        <img src="img/5.jpg" class="box-img" data-id="11"/>
                    </li>
                    <li class="list-group-item">
                        <img src="img/5.jpg" class="box-img" data-id="11"/>
                    </li>
                </ul>
            </div>
            <div class="wf-box col-sm-3" data-id="11">
                <ul class="grid-board-fl list-group">
                    <li class="list-group-item">
                        <img src="img/5.jpg" class="box-img" data-id="11"/>
                    </li>
                    <li class="list-group-item">
                        <img src="img/5.jpg" class="box-img" data-id="11"/>
                    </li>
                    <li class="list-group-item">
                        <img src="img/5.jpg" class="box-img" data-id="11"/>
                    </li>
                    <li class="list-group-item">
                        <img src="img/5.jpg" class="box-img" data-id="11"/>
                    </li>
                </ul>
            </div>
         </div>
    </div>
    </div>    
@stop



