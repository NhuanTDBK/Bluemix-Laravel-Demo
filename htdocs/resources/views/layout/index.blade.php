<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{URL::asset('img/logo.png')}}" rel="icon" type="image/png" sizes="96x96" >
    
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.hashtags.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/autocomplete.css')}}">
    <!-- Latest compiled and minified CSS -->

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{URL::asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{URL::asset('js/handlebars.js')}}"></script>
    <script src="{{URL::asset('js/autosize.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.hashtags.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/responsive_waterfall.js')}}"></script>
    <script src="{{URL::asset('js/typeahead.bundle.js')}}"></script>
    <script src="{{URL::asset('js/pusher.min.js')}}"></script>
    <script src="{{URL::asset('js/ion.sound.min.js')}}"></script>
     <script src="{{URL::asset('js/facebook_connect.js')}}"></script>
    <title>Fresh Food</title>
</head>
<body>
    {{-- Thanh menu --}}
    <nav class="navbar navbar-inverse navbar-fixed-top" style='background-color:#fff;webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,0.22);box-shadow: 0 1px 2px 0 rgba(0,0,0,0.22);'>
        <div class="container-fluid">
            <div class="navbar-header col-xs-5">
                <div class="col-xs-3">
                    <a class="navbar-brand logo" href="/home">
                        <img src="{{URL::asset("img/logo.png")}}" height="50" width="50">
                    </a>
                </div>    
                <div class="nav navbar-left nav-search col-xs-9">
                    <form>
                        <input id="search-textbox" class="typeahead" type="search" placeholder="Search" style="margin-top:15px;">
                    </form>
                </div>
            </div>
                
            <div class="nav navbar-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="margin-top:22px;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse navbar-right col-xs-7" id="myNavbar">
                <ul class="nav navbar-nav navbar-right nav-collapse">
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
                        <a id="user-id-info" data-id="{{Auth::user()->user_id}}" href="{{URL::to('user/'.Auth::user()->username)}}">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            {{Auth::user()->name}}
                        </a>

                    </li>
                    @endif
                    <li class="dropdown" style="margin-top:5px;">
                        @if(Auth::user()!=null)
                        <img src="{{URL::to('/api/photo/')."/".Auth::user()["avatar_link"]}}" height="30" width="30" class="logo-profile dropdown-toggle" id="user-avatar-link-profile dropdownMenu2" data-toggle="dropdown" style='cursor:pointer;' aria-haspopup="true" aria-expanded="true">
                        <div class="glyphicon glyphicon-exclamation-sign noti_alert"></div>
                        @endif
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" style="margin-top:26px;min-width: 250px;">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Thông báo</a></li>
                            <li role="separator" class="divider"></li>
                            <li role="presentation" id="box_noti">
                                
                            </li>
                            <li role="separator" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sửa thông tin</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::to('logout')}}">Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="layout-mainpage">
        @yield('grid-layout')
    </section>
    @include('layout.modal')
    @include('layout.modal-view')
    @include('layout.modal-message')
    @include('layout.modal-boxfriend')
    <div class="modal fade modal-prgbar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    00%
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</body>
<script>
    $(document).ready(function(){

        var active1 = false;
        var active2 = false;
        var active3 = false;
        var active4 = false;

        $("textarea#board_description").hashtags();

        $(".cmt-boxchat").hashtags();

        //sự kiện upload ảnh
        $('#upload').on('click', function(){

            document.getElementById("imgInp").click();
            //Ham nay o trang modal.blade.php

        });

        $("#imgInp").change(function(){
            readURL(this);
        });


        $('.locate-map').on('click',function(){
            $('.locate-map').hide();
            $('.locate-text').hide();
            $('#pac-input').show();
//            $('#map').show();
            initAutocomplete();
        });
        $(document).on('click', '.box-img', function(){
            $(".box-img-actived").removeClass("box-img-actived");
            $(this).addClass("box-img-actived");
            getPostById($('.modal-view'),$(this).data('id'));
        });
        $('#box_noti').delegate('.noti_item','click',function() {
            $(".box-img-actived").removeClass("box-img-actived");
            $(this).addClass("box-img-actived");
            getPostById($('.modal-view'),$(this).data('noti'));
        });
        $(document).on('click', '#pinit', function(){
            board_id = $(this).data('option');
            description = $('.description').val();
            place_id = 1;
            hashtag = $(".ajbh-list-hastag2 li").map(function(){
                return $(this).text();
            }).get();
            $.ajax({
                url :"{{url('/upload-post')}}",
                data: {board_id:board_id, description:description, place_id:place_id, hashtag:hashtag},
                type :'POST',
                cache :false
            }).done(function(data) {

            }).fail(function(data) {

            }).always(function(data) {

            });
        });
    });
    //--
    function readURL(input) {
        if (input.files && input.files[0]) {
            if(input.files[0].size > 5*1024*1024)
            {
                alert("Qua dung luong");
                return;
            }
            console.log(input.files[0]);
            var formData = new FormData();
            $('.modal-prgbar').modal('show');
            formData.append("src",input.files[0]);
            $.ajax({
                    url :"{{url('/api/photo')}}",
                    data: formData,
                    type :'POST',
                    dataType: 'json',
                    processData: false, // Don't process the files
                    contentType: false,
                    xhr: function()
                    {
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                            var percentComplete = (evt.loaded / evt.total)*100;
                            //Do something with upload progress
                            console.log(percentComplete);
                            $('.modal-prgbar .progress-bar').css('width', percentComplete+'%');
                            $('.modal-prgbar .progress-bar').text(percentComplete+'%');
                        }, false);
                        return xhr;
                   }
                }).success(function(evt){
                    // console.log(evt);
                    $('.modal-prgbar').modal('hide');
                    image_url = "{{url('api/photo/')}}"+"/"+evt;
                    $('#blah').attr('src', image_url);
                    $('#blah').attr('data-id',evt);
                    $('.modal-upload').modal('show');
                });
            var reader = new FileReader();
            reader.onload = function (theFile) {
                var image = new Image();
                image.src = theFile.target.result;
                $('.modal-prgbar .progress-bar').css('width', '0%');
                $('.modal-prgbar .progress-bar').text('00%');
                $('.modal-prgbar').modal('show');
            }
        }
    }
    function getUserId(){
        return $("#user-id-info").data("id");
    }
</script>
{{--
    Post loading: autocomplete search and pusher inbox
--}}
<script type="text/javascript"src="{{URL::asset('js/autocomplete_search.js')}}"></script>
<script src="{{URL::asset('js/pusher_inbox.js')}}"></script>
</html>