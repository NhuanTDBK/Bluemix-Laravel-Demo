@section('modal')
<div class="box-mess">
  <div class="bm-header">
    <a id="friend_profile" href="">Tùng</a>
    <div class="bm-close"></div>
  </div>
  <div class="bm-container">

  </div>
  <div class="bm-footer">
    <textarea placeholder="Thêm tin nhắn" id='mess_chat'></textarea>
  </div>  
</div>

<script type="text/javascript">
  $('.box-mess').hide();

  $('.bm-close').on('click', function(){
    $('.box-mess').hide();
  });
  $("#mess_chat").on('keyup', function(e){
    if (e.which == 13 || e.keyCode == 13) {
      chat = $(this).val();
      userid = "{{Auth::user()->user_id}}";
      friendid = $(".box-mess").data('chatid');

      if(userid < friendid){
        channel = userid +""+friendid;
      }else{
        channel = friendid +""+userid;
      }
      $.ajax({
        url: "{{url('/create-chat')}}",
        type:"POST",
        data:{channel:channel, chat:chat, userid:userid, friendid:friendid},
          success:function(data){
            channel_chat = pusher.subscribe(channel); 
            channel_chat.bind('chat', function(data) {  
                $(".bm-container").append("<div class='mess_item'>"+data.chat+"</div>");
            }); 
            $(this).val("");
            $(".bm-container").append("<div class='mess_item_owner'>"+chat+"</div>");
        }});
    }
  });  
</script>
{{-- @stop  --}}
