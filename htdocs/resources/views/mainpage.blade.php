@extends('layout.index')
<link href="{{URL::asset('img/logo.png')}}" rel="icon" type="image/png" sizes="96x96" >
@section('grid-layout')
<script type="text/javascript">
    $(document).ready(function(){
        var waterfall = new Waterfall({
            minBoxWidth: 250
        });
        $(".wf-container").fadeIn(1200);
    });
</script>
	<div class="wf-container" style="margin-top:50px;display:none">
        <div class="wf-box" style="border: none;">
            <div class="content" style="background-color:#fff;webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,0.22);box-shadow: 0 1px 2px 0 rgba(0,0,0,0.22);border-top-left-radius: 6px;border-top-right-radius: 6px;'">
                <div class='invitefr'>
                    <span>Những người theo dõi bạn</span>
                    <i class="fa fa-chevron-right" style='float:right;cursor:pointer;'></i>
                </div>
                @foreach(App\Models\FollowEvent::getFollower(Auth::user()->user_id) as $key => $value)
                <a href="{{url('/')."/".$value->username}}">
                    <div class="fr_item">
                        <img src="{{URL::to('/api/photo/')."/".$value->avatar_link}}" height="30" width="30" class="logo-profile" style='cursor:pointer;float:left;width:30px !important;'>
                        <p style="padding-top: 5px;margin-left: 39px;">{{$value->name}}</p>
                    </div>
                </a>       
                @endforeach 
            </div>

            <div class="content" style="margin-top:10px;background-color:#fff;webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,0.22);box-shadow: 0 1px 2px 0 rgba(0,0,0,0.22);border-top-left-radius: 6px;border-top-right-radius: 6px;'">
                <div class='findfr' style="cursor:pointer;background-color:#fff;">
                    <span>Những người bạn theo dõi</span>
                    <i class="fa fa-chevron-right" style='float:right;cursor:pointer;'></i>
                </div>
                @foreach(App\Models\FollowEvent::getFollowing(Auth::user()->user_id) as $key => $value)
                <a href="{{url('/')."/".$value->username}}">
                    <div class="fr_item">
                        <img src="{{URL::to('/api/photo/')."/".$value->avatar_link}}" height="30" width="30" class="logo-profile" style='cursor:pointer;float:left;width:30px !important;'>
                        <p style="padding-top: 5px;margin-left: 39px;">{{$value->name}}</p>
                    </div>
                </a>       
                @endforeach
            </div>
        </div>
        @foreach($posts as $key => $post)
            @if($key == 0 && count($posts) == 1)
            <div class="wf-box" data-id="{{$post["post_id"]}}">
                <img src="{{URL::to('api/photo').'/'.$post["photo_link"]}}" class="box-img" data-id="{{$post["post_id"]}}" data-idnext="{{$post['post_id']}}" data-idprev="{{$post['post_id']}}"/>
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
            @elseif($key == 0)
            <div class="wf-box" data-id="{{$post["post_id"]}}">
                <img src="{{URL::to('api/photo').'/'.$post["photo_link"]}}" class="box-img" data-id="{{$post["post_id"]}}" data-idnext="{{$posts[$key+1]['post_id']}}" data-idprev="{{$post['post_id']}}"/>
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
            @elseif($key == count($posts) - 1)
            <div class="wf-box" data-id="{{$post["post_id"]}}">
                <img src="{{URL::to('api/photo').'/'.$post["photo_link"]}}" class="box-img" data-id="{{$post["post_id"]}}" data-idnext="{{$post['post_id']}}" data-idprev="{{$posts[$key-1]['post_id']}}"/>
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
            @else
            <div class="wf-box" data-id="{{$post["post_id"]}}">
                <img src="{{URL::to('api/photo').'/'.$post["photo_link"]}}" class="box-img" data-id="{{$post["post_id"]}}" data-idnext="{{$posts[$key+1]['post_id']}}" data-idprev="{{$posts[$key-1]['post_id']}}"/>
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
            @endif
        @endforeach
    </div>

@stop