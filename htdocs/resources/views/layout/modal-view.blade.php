@section('modal')
  <div class="modal fade modal-view" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="col-xs-8 center-right-side" id="main-post-id" style="border-radius:6px;margin-right:15px;">
          <div class="mv-title keep-open">
            <div class="mv-title-pinit" id="post_pin_btn">
              <span>Bookmark</span>
            </div>
            <div id="post_like_btn" class="mv-title-like">
                <em></em>
                <span>Like</span>
            </div>
            <div id="post_share_btn" class="mv-title-share">
              <em></em>
              <span id="fb_share">Share</span>
            </div> 
            <div id="post_send_btn" class="mv-title-send" id="dropdownMenu3" data-toggle="dropdown">
              <em></em>
              <span>Send</span>
            </div> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3" style="margin-top:26px;">
                <li class="mv-square"></li>
                <li role="presentation">
                  <textarea class="mv-mess" placeholder="Thêm tin nhắn..."></textarea>
                </li>
                <li role="presentation">
                  <ul class="mv-listfr">
                    @if(Auth::user()!=null)
                      @foreach(App\Models\FollowEvent::getFollower(Auth::user()->user_id) as $key => $value)
                      <li data-userid="{{$value->user_id}}" data-userlink="{{Auth::user()->avatar_link}}">
                        <img src="{{URL::to('/api/photo/')."/".$value->avatar_link}}" width="35" height="35" class="logo-profile">
                        <p>{{$value->name}}</p>
                      </li>
                      @endforeach
                    @endif  
                  </ul>
                </li>
            </ul>
            </div>
            <div class="fluid-container mv-img">
              <div class="wf-box" style="margin-top:15px;">
                <img id="main-photo-post" src="{{URL::asset('img/5.jpg')}}" class="box-img"/>
                <div class="content">
                  <p>
                    Upload bởi <span id="owner-post"></span>
                  </p>
                </div>
              </div>
            </div>
            </div>  
          <div class="col-xs-3 center-left-side">

            <div class="fluid-container cls-title">
              <img src="{{URL::asset('img/5.jpg')}}" height="38" width="38" class="logo-profile" id="cls-title">
              <div class="cls-user">
                <p class="cls-board" id="cls-board">hh</p>
                <p class="cls-name" id="cls-name">HoTung</p>
              </div>
            </div>
            <div class="row fluid-container cls-album" id="cls-album">
             
            </div>
          </div>
          <div class="col-xs-3 mv-map">
            <iframe id="embed_map" src = "" style="width: 100%;height: 100%;"></iframe>
          </div>
          <div class="col-xs-8 mv-cmt">
            <div class="mv-cmt-owner">
              <img id="main-owner-avatarlink" src="img/5.jpg" class="logo-profile cmt-avatar">
              <div class="cmt-chat cmt-name">
                <a id="main-owner-name">Tung</a>
              </div>
              <div class="cmt-chat" id="main-post-description"></div>
            </div>
            <div class="mv-cmt-itembox">
              <img src="img/5.jpg" class="logo-profile cmt-avatar-owner">
              <div class="cmt-chat-owner">
                <a>Tung</a>
                <textarea id="main-comment-btn" class="cmt-boxchat" placeholder="Thêm bình luận"></textarea>
              </div>
            </div>
          </div>
          <div class="col-xs-12 mv-related-post">
          <p>Related Posts</p>
          <div id="recommend_lists">
             <div class="wf-box" data-id="">
             {{--Link ảnh--}}
                 <img src="" class="box-img" data-id="" data-idnext="" data-idprev=""/>
                 <div class="content">
                 {{--Description--}}
                     <h3 class="box-img-des"></h3>
                     <div class="box-img-card">
                         <img src="{{URL::asset("img/logo.png")}}" width="30" height="30" class="logo-profile">
                         <div>
                         {{--Ten owner--}}
                             <p class="card-owner">
                             {{--{{$post["owner"]}}--}}
                             </p>
                             {{--Ten board--}}
                             <h4 class="card-title"></h4>
                         </div>
                     </div>
                 </div>
             </div>
          </div>
          </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <script>
    $(document).ready(function(){
      var waterfall = new Waterfall({
          minBoxWidth: 250
      });
    });
    $('.dropdown-menu li, .dropdown-menu textarea').click(function(e) {
      e.stopPropagation();
    });
    /*
        Ham share bai post len fb
     */
    $("#fb_share").click(function(){
        var id = $("#main-post-id").data('id')
      FB.ui(
        {
          method: 'share',
          href: 'http://foodiee.mybluemix.net/post/'+id
        },
        // callback
        function(response) {
          if (response && !response.error_message) {
            // alert('Posting completed.');
          } else {
            // alert('Error while posting.');
          }
        }
      );
    });
    //Editor: Tunght
    //Code gui tin nhan
    $(".mv-listfr li").click(function(){
      user_id = $(this).data('userid');
      avatar_link = $(this).data('userlink');
      post_id = $("#main-post-id").data("id");
      text = $(".mv-mess").val();
      $.ajax({
        url: "{{url('/create_noti')}}",
        type:"POST",
        data:{user_id:user_id, text:text, avatar_link:avatar_link, post_id:post_id},
          success:function(data){
            if(data){

            }
        }});
    });
    $("#post_like_btn").click(function(){
        likePost($("#main-post-id").data("id"));
    });
    $("#main-comment-btn").on('keyup', function(e){
        if (e.which == 13 || e.keyCode == 13) {
          var post_id = $("#main-post-id").data("id");
          var comment = $(".mv-cmt-itembox textarea").val();
          commentPost(post_id,comment);
        }
    });
    function likePost(post_id){
        var url ="{{URL::to('/api/post')}}"+'/'+post_id+'/'+"like";
        $.ajax({
            url: url,
            type:"GET",
            success:function(data){
                span_text = $("#post_like_btn").find('span:first');
                if(span_text.text()=="Like"){
                    span_text.text("Liked");
                }
                else {
                    span_text.text("Like")
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
    function createCommentBox(commentor,avatar_link,comment){
        var result = $("<div>",{class:"mv-cmt-item",style:"display:none"}).append(
            $("<img>",{class:"logo-profile cmt-avatar"}),
            $("<div>",{class:"cmt-chat cmt-name"}).append(
                $("<a>")
            ),
            $("<div>",{class:"cmt-chat"})
        );
        result.find("img").attr("src",avatar_link);
        result.find(".cmt-chat a:first").text(commentor);
        result.find(".cmt-chat:eq(1)").text(comment);
        return result;
    }
    function getPostById(modal,id){
        var url ="{{URL::to('/api/post')}}"+'/'+id;
        $.ajax({
            url: url,
            type:"GET",
            success:function(data){
                console.log(data);
                modal.find("#owner-post").text(data.owner);
                modal.find("#main-owner-name").text(data.owner);
                modal.find("#main-owner-avatarlink").attr("src","{{URL::to('api/photo')}}"+"/"+data.avatar_link);
                $("#main-owner-name").text(data.owner);
                modal.find("#main-post-id").data("id",data.post_id);
                modal.find("#main-photo-post").attr("src","{{URL::to('api/photo')}}"+"/"+data.photo_link);
                modal.find("#cls-board").text(data.board_title);
                modal.find("#cls-name").text(data.owner);
                modal.find("#cls-title").attr("src","{{URL::to('api/photo')}}"+"/"+data.photo_link);
                modal.find("#main-post-description").text(data.description);
                modal.find("#left-arrow").attr("data-id",$(".box-img-actived").data('idprev'));
                modal.find("#right-arrow").attr("data-id",$(".box-img-actived").data('idnext'));
                modal.find("#embed_map").attr('src', "https://maps.google.com/maps?q="+data.places.lat+","+data.places.lng+"&hl=es;z=14&amp&output=embed");
                //modal.find("#embed_map").attr('src', function () { return $(this).contents().get(0).location.href });
                for (i = 0; i < data.boards.length; i++) {
                  modal.find("#cls-album").append("<div class='wf-box'><img data-id='"+data.boards[i]['post_id']+"' src='{{URL::to('api/photo')}}"+"/"+data.boards[i]['photo_link']+"' class='box-img'/></div>");
                };

                $(".mv-cmt-itembox img").attr("src",$("#user-avatar-link-profile").attr("src"));
                $(".mv-cmt-itembox .cmt-chat-owner a").text($("#user-id-info").text().trim());
                if(data.liked==true)
                     modal.find("#post_like_btn").find('span:first').text("Liked");
                else
                    modal.find("#post_like_btn").find('span:first').text("Like");
                if(data.comments.length>0)
                {
                    console.log("into");
                     for(var i = 0;i<data.comments.length;i++){
                        var comment_box = createCommentBox(data.comments[i].name,"{{URL::to('api/photo')}}"+"/"+data.comments[i].avatar_link,data.comments[i].text);
                        comment_box.insertBefore($(".mv-cmt-itembox")).fadeIn(1000);
                     }
                }
                modal.modal('show');
            }
        });
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
  </script>
{{-- @stop  --}}
