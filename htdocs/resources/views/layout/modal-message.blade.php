@section('modal')
{{--
    Modal message
    Editor by TungHT
--}}
<div class="box-mess">
  <div class="bm-header">
    <a id="friend_profile" href="">Tùng</a>
    <div class="bm-close"></div>
  </div>
  <div class="bm-container">

  </div>
  <div class="bm-footer">
    <textarea placeholder="Thêm tin nhắn" id="mess_chat"></textarea>
    <span class="glyphicon glyphicon-share-alt" style="cursor:pointer;margin-top: -45px;float: right;color: blue;" id='text-box'></span>
  </div>  
</div>

<script type="text/javascript">
  $('.box-mess').hide();

  $('.bm-close').on('click', function(){
    $('.box-mess').hide();
  });
  $("#text-box").on('click', function(e){
      var chat = $("#mess_chat").val();
      {{--var userid = "{{Auth::user()->user_id}}";--}}
      var friendid = $(".box-mess").data('chatid');
      console.log("Send message");
      var data = {
        "text":chat,
        "receiver_id":friendid
      };
      var url = "{{URL::to('api/messages')}}";
      $("#mess_chat").val("");
      $(".bm-container").append("<div class='mess_item_owner'>"+chat+"</div>");
      $.post(url,data,function(data) {
            if(data.result=="failed"){
                console.log("Error on sending");
            }
      });
  });  
</script>
{{-- @stop  --}}
