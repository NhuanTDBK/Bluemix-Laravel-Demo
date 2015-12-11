/**
 * Created by Nhuan on 12/5/2015.
 */
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