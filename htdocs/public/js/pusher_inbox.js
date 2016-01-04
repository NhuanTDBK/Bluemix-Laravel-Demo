/**
 * Created by Nhuan on 12/12/2015.
 */
// Enable pusher logging - don't include this in production
    // Enable pusher logging - don't include this in production
//Pusher.log = function(message) {
//    if (window.console && window.console.log) {
//        //window.console.log(message);
//    }
//};
var pusher = new Pusher('0698be6919e98a075011', {
    encrypted: true
});
var user_channel = getUserId().toString();
list_channel = [];
var channel = pusher.subscribe(user_channel);
list_channel.push(channel);
console.log("Notification channel initializing");
channel.bind('notification', function(data) {
    // init bunch of sounds
    ion.sound({
        sounds: [
            {alias: "s1",
             name: "door_bump"
            }
        ],

        // main config
        path: "/js/sounds/",
        preload: false,
        volume: 0.9
    });

    // play sound
    ion.sound.play("s1", {
        loop: 3
    });

    $("#box_noti").append("<div class='fr_item noti_item' data-noti='"+data.post_id+"'><img src='http://foodieweb.com/api/photo/"+data.avatar_link+"' height='30' width='30' class='logo-profile' style='cursor:pointer;float:left;width:30px !important;'><p style='padding-top: 5px;margin-left: 39px;'> gửi bạn một tin nhắn: "+data.text+"</p></div>");
    $(".noti_alert").show();
});
console.log("Like channel initializing");
channel.bind('like', function(data) {
    $("#box_noti").append("<div class='fr_item noti_item' data-noti='"+data.post_id+"'><img src='http://foodieweb.com/api/photo/"+data.avatar_link+"' height='30' width='30' class='logo-profile' style='cursor:pointer;float:left;width:30px !important;'><p style='padding-top: 5px;margin-left: 39px;'>"+data.name+" like your post</p></div>");
    $(".noti_alert").show();
});
console.log("Pin channel init")
channel.bind('pin', function(data) {
    $("#box_noti").append("<div class='fr_item noti_item' data-noti='"+data.post_id+"'><img src='http://foodieweb.com/api/photo/"+data.avatar_link+"' height='30' width='30' class='logo-profile' style='cursor:pointer;float:left;width:30px !important;'><p style='padding-top: 5px;margin-left: 39px;'>"+data.name+" has pinned new post</p></div>");
    $(".noti_alert").show();
});
channel.bind('onShowChatBox',function(data){
    console.log(data);
    //var modal = $('.box-mess');
    var friendid = data.user.user_id;
    var user_id = $("#user-id-info").data('id');
    //modal.data("chatid",friendid);
    //modal.find("#friend_profile").attr("href","http://foodieweb.com/"+data.user.username);
    //modal.find("#friend_profile").text(data.user.name);
    //modal.show();
    //console.log(friendid);
    //console.log(user_id);
    var channel_name = Math.min(user_id,friendid)+"-"+Math.max(user_id,friendid);
    var channel = createChannelChat(channel_name);
});
function createChannelChat(channel_name){

    for(var i = 0;i<list_channel.length;i++){
        if(list_channel[i].name==channel_name)
        {
            console.log("Duplicate channel");
            return;
        }
    }
    try {
        var channel = pusher.subscribe(channel_name);
        channel.bind("messages:onsend", appendToBox);
        channel.bind("messages:ontype", showTyping);
        channel.bind("messages:onseen", showSeenLabel);
        list_channel.push(channel);
        return channel;
    } catch(err){
        console.log(err);
    }

}
function appendToBox(data){
    console.log("Ping...");
    if(getUserId()!=data.sender_id) {
        // init bunch of sounds
        ion.sound({
            sounds: [
                {name: "button_tiny",
                 preload: false}
            ],

            // main config
            path: "/js/sounds/",
            preload: true,
            multiplay: true,
            volume: 0.9
        });

        // play sound
        ion.sound.play("button_tiny");

        if($('.box-mess').is(":hidden")==true){
            showBox(data.sender_id);
        }
        console.log(data.message);
        var chat = data.message;
        $(".bm-container").append("<div class='mess_item'>" + chat + "</div>");
    }
}
function showTyping(data){
    console.log("Typing...");
}
function showSeenLabel(data){
    console.log(data);
}
