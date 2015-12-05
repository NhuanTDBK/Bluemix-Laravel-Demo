<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{URL::asset('img/logo.png')}}" rel="icon" type="image/png" sizes="96x96" >
    <link rel="stylesheet" href="{{URL::asset('css/kc.fab.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.js"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.hashtags.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/autocomplete.css')}}">
    <!-- Latest compiled and minified CSS -->

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{URL::asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{URL::asset('js/autosize.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.hashtags.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/responsive_waterfall.js')}}"></script>
    <script src="{{URL::asset('js/typeahead.bundle.js')}}"></script>
     {{--<script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0-alpha.4/handlebars.min.js"></script>--}}
    <title>Fresh Food</title>
</head>
<body>
    {{-- Thanh menu --}}
    <nav class="navbar navbar-inverse navbar-fixed-top" style='background-color:#fff;webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,0.22);box-shadow: 0 1px 2px 0 rgba(0,0,0,0.22);'>
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand logo" href="/home" style="margin-left:80px;">
                    <img src="{{URL::asset("img/logo.png")}}" height="50" width="50">
                </a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="margin-top:25px;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse container" id="myNavbar">
                <form class="nav navbar-nav navbar-left" >
                    <input id="search-textbox" class="typeahead" type="search" placeholder="Search" style="margin-top:22px;">
                </form>

                <ul class="nav navbar-nav navbar-right" style="margin-top:15px; margin-left:65px;">
                    <li>
                        <input type="file" name="image" id="imgInp" data-id = "" class="file" accept="image/*" style="display:none;">
                        <a href="#" id="upload">
                            <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                            Upload
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('an-gi-bay-gio')}}">
                            <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                            Ăn gì đây
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('home')}}">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            Home
                        </a>
                    </li>
                    @if(Auth::user()!=null)
                    <li>
                        <a id="user-id-info" data-id="{{Auth::user()->user_id}}" href="{{URL::to(Auth::user()->username)}}">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            {{Auth::user()->name}}
                        </a>
                    </li>
                    @endif
                    <li class="dropdown" style="margin-top:10px;">
                         @if(Auth::user()!=null)
                        <img src="{{URL::to('/api/photo/')."/".Auth::user()["avatar_link"]}}" height="30" width="30" class="logo-profile" id="user-avatar-link-profile" data-toggle="dropdown" style='cursor:pointer;'>
                        @endif
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2" style="margin-top:26px;">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sửa thông tin</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Đăng xuất</a></li>
                        </ul>
                        <span class="caret dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" style='cursor:pointer;'></span>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" style="margin-top:26px;">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sửa thông tin</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::to('user/logout')}}">Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
        @include('layout.modal')
        <div>
             <div class="modal fade modal-view">
                <div class="modal-dialog" style="width:75%;">
                  <div class="modal-content">
                      <div class="col-md-1">
                        <div class="left-arrow">
                          <i class="fa fa-chevron-left fa-2x"></i>
                        </div>
                      </div>
                      <div class="col-md-7 center-right-side" id="main-post-id" data-id="{{$post["post_id"]}}" style="border-radius:6px;margin-right:15px;">
                        <div class="mv-title keep-open">
                          <div class="mv-title-pinit" id="post_pin_btn">
                            <span>Đánh dấu</span>
                          </div>
                          <div id="post_like_btn" class="mv-title-like">
                            <em></em>
                            <span>Thích {{$post_stat["likes"]}}</span>
                          </div>
                          <div id="post_share_btn" class="mv-title-share">
                            <em></em>
                            <span>Chia sẻ</span>
                          </div>
                          <div id="post_send_btn" class="mv-title-send" id="dropdownMenu3" data-toggle="dropdown">
                            <em></em>
                            <span>Gửi</span>
                          </div>
                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3" style="margin-top:26px;">
                            <li class="mv-square"></li>
                            <li role="presentation">
                              <textarea class="mv-mess" placeholder="Thêm tin nhắn..."></textarea>
                            </li>
                            <li role="presentation">
                              <ul class="mv-listfr">
                                <li>
                                  <img src="{{URL::asset("img/logo.png")}}" width="35" height="35" class="logo-profile">
                                  <p>đsadá</p>
                                </li>
                                <li>
                                  <img src="{{URL::asset("img/logo.png")}}" width="35" height="35" class="logo-profile">
                                  <p>đsadá</p>
                                </li>
                                <li>
                                  <img src="{{URL::asset("img/logo.png")}}" width="35" height="35" class="logo-profile">
                                  <p>đsadá</p>
                                </li>
                                <li>
                                  <img src="{{URL::asset("img/logo.png")}}" width="35" height="35" class="logo-profile">
                                  <p>đsadá</p>
                                </li>
                                <li>
                                  <img src="{{URL::asset("img/logo.png")}}" width="35" height="35" class="logo-profile">
                                  <p>đsadá</p>
                                </li>
                                <li>
                                  <img src="{{URL::asset("img/logo.png")}}" width="35" height="35" class="logo-profile">
                                  <p>đsadá</p>
                                </li>
                                <li>
                                  <img src="{{URL::asset("img/logo.png")}}" width="35" height="35" class="logo-profile">
                                  <p>đsadá</p>
                                </li>
                              </ul>
                            </li>
                        </ul>
                        </div>
                        <div class="fluid-container mv-img">
                          <div class="wf-box">
                            <img id="main-photo-post" src="{{URL::to('api/photo').'/'.$post["photo_link"]}}" class="box-img"/>
                          </div>
                        </div>
                        <div class="fluid-container mv-img-footer">
                          <p></p>
                            <p>
                              Upload bởi <span id="owner-post">{{$post['owner']}}</span>
                            </p>
                            </div>
                          </div>
                      <div class="col-md-3 center-left-side">

                        <div class="fluid-container cls-title">
                          <img src="{{URL::asset('img/5.jpg')}}" height="38" width="38" class="logo-profile">
                          <div class="cls-user">
                            <p class="cls-board">hh</p>
                            <p class="cls-name">HoTung</p>
                          </div>
                        </div>
                        <div class="row fluid-container cls-album">
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}" class="box-img"/>
                          </div>
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}" class="box-img"/>
                          </div>
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}" class="box-img"/>
                          </div>
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}" class="box-img"/>
                          </div>
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}" class="box-img"/>
                          </div>
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}" class="box-img"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 mv-map">
                        <div id="map-detail"></div>
                      </div>
                      <div class="col-md-1 col-right-arrow">
                        <div class="right-arrow">
                          <i class="fa fa-chevron-right fa-2x"></i>
                        </div>
                      </div>
                      <div class="col-md-7 col-md-offset-1 mv-cmt">
                        <div class="mv-cmt-owner">
                          <img id="main-owner-avatarlink" src="{{URL::to('api/photo').'/'.$post["avatar_link"]}}" class="logo-profile cmt-avatar">
                          <div class="cmt-chat cmt-name">
                            <a id="main-owner-name">{{$post['owner']}}</a>
                          </div>
                          <div class="cmt-chat" id="main-post-description"></div>
                        </div>
                        @if(Auth::user()!=null)
                              <div class="mv-cmt-itembox">
                                  <img src="{{URL::to('api/photo').'/'.Auth::user()["avatar_link"]}}" class="logo-profile cmt-avatar-owner">
                                  <div class="cmt-chat-owner">
                                    <a>{{Auth::user()->name}}</a>
                                    <textarea class="cmt-boxchat" placeholder="Thêm bình luận"></textarea>
                                    <button id="main-comment-btn" class="btn-info"><span>Comment</span></button>
                                  </div>
                               </div>
                        @endif
                      </div>
                      <div class="col-md-10 col-md-offset-1 mv-related-post">
                      <p>Related Posts</p>
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}">
                            <div class="content">
                              <h3>Title</h3>
                              <p>Content Here</p>
                              <p>Content Here</p>
                              <p>Content Here</p>
                            </div>
                          </div>
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}">
                            <div class="content">
                                <h3>Title</h3>
                                <p>Content aa asdfasdfjal</p>
                            </div>
                          </div>
                          <div class="wf-box">
                            <img src="{{URL::asset('img/5.jpg')}}">
                            <div class="content">
                                <h3>Heading</h3>
                                <p>Content aa asdfasdfjal</p>
                            </div>
                          </div>
                      </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
        </div>
        </body>
        <script>
             window.fbAsyncInit = function() {
                        FB.init({
                          appId      : '1473244306316838',
                          xfbml      : true,
                          version    : 'v2.5'
                        });
                      };
            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            $(".modal-view").modal('show');
            $('.dropdown-menu li, .dropdown-menu textarea').click(function(e) {
                  e.stopPropagation();
                });
                function initMap(lat, lng) {
                  var myLatLng = new google.maps.LatLng(lat, lng);
                  var options = {
                      zoom: 18,
                      center: myLatLng,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                  var mapdetail = new google.maps.Map(document.getElementById('map-detail'), options);


                  var name = "Place.name";
                  var marker = new google.maps.Marker({
                      position: {lat: lat, lng: lng},
                      map: mapdetail,
                      title: name,
                      draggable: true
                  });
                }
                $("#post_like_btn").click(function(){
                    likePost($("#main-post-id").data("id"));
                });
                $("#main-comment-btn").click(function(){
                    var post_id = $("#main-post-id").data("id");
                    var comment = $(".mv-cmt-itembox textarea").val();
                    commentPost(post_id,comment);
                });
                function likePost(post_id){
                    var url ="{{URL::to('/api/post')}}"+'/'+post_id+'/'+"like";
                    $.ajax({
                        url: url,
                        type:"GET",
                        success:function(data){
                            span_text = $("#post_like_btn").find('span:first');
                            if(span_text.text()=="Thích"){
                                span_text.text("Đã thích");
                            }
                            else {
                                span_text.text("Thích")
                            }
                     }});
                }
                function commentPost(post_id,comment){
                    var url ="{{URL::to('/api/post')}}"+'/'+post_id+'/'+"comment";
                    $.ajax({
                        url: url,
                        type:"POST",
                        data:{comment:comment},
                        success:function(data){
                            if(data.result){
                                var post_id = $("#main-post-id").data("id");
                                var comment = $(".mv-cmt-itembox textarea").val();
                                var commentor = $(".mv-cmt-itembox a").text();
                                var avatar_link = $(".mv-cmt-itembox img").attr("src");
                                var commentBox = createCommentBox(commentor,avatar_link,comment);
                                commentBox.insertBefore($(".mv-cmt-itembox")).fadeIn(1000);
                                $(".mv-cmt-itembox textarea").val("");
                            }
                     }});
                }
                $("#post_pin_btn").click(function(){
                        $('.modal-upload').css("position","fixed").css("z-index",1050);
                            var image_url = $("#main-photo-post").attr("src");

                        $('.modal-upload').find('#blah').attr('src', image_url);
                //        $('.modal-upload').find('#blah').attr('data-id',evt);
                        $('.modal-upload').modal('show');
                    });
                      $(".modal-view").on('show.bs.modal',function(e){
                            console.log("modal view before view");
                        });
                        $(".modal-view").on('shown.bs.modal',function(e){
                                console.log("modal view viewed");
                });
                $("#post_share_btn").click(function(){
                    FB.ui(
                     {
                      method: 'share',
                      href: window.location.href
                    }, function(response){});
                });
        </script>
    </html>