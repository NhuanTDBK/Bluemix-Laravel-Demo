<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/normalize.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
        <!-- Optional theme -->

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{URL::asset('js/jquery-1.9.1.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        <style type="text/css">
            .back-link a {
                color: #4ca340;
                text-decoration: none; 
                border-bottom: 1px #4ca340 solid;
            }
            .back-link a:hover,
            .back-link a:focus {
                color: #408536; 
                text-decoration: none;
                border-bottom: 1px #408536 solid;
            }
            h1 {
                height: 100%;
                /* The html and body elements cannot have any padding or margin. */
                margin: 0;
                font-size: 14px;
                font-family: 'Open Sans', sans-serif;
                color: #1c1d1e;
                font-size: 32px;
                margin-bottom: 3px;
            }
            h2 {
                color: #1c1d1e;
                font-family: 'Open Sans', sans-serif;
                font-weight: normal;
            }
            .entry-header .inner {
                text-align: left;
                margin: 0 auto 20px auto;
                width: 800px;
            }
            .entry-header { padding-top: 20px; background-color: #fff; width:100%; position: fixed; top: 0; left: 0; z-index: 999999}
        </style>
    </head>
    <body class="loading">  
        <main>     
            <section id="slide-1" class="homeSlide">
                <div class="bcg" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -100px;" data-anchor-target="#slide-1">
                    <div class="hsContainer">
                        <div class="hsContent" data-center="opacity: 1" data-106-top="opacity: 0" data-anchor-target="#slide-1 h2">
                            <h2>Find Out<br />Whatever You Like!</h2>
                            <p> Thật thoải mái tìm các món ăn mà bạn bè đã đăng.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="slide-2">
                <div class="bcg" data-0="background-color:rgb(1,27,59);" data-top="background-color:(0,0,0);"  data-anchor-target="#slide-2">
                    <div class="hsContainer">
                        <div class="hsContent">
                            <h2 data-center="opacity: 1" data--200-bottom="opacity: 0" data-206-top="opacity: 1" data-106-top="opacity: 0" data-anchor-target="#slide-2 h2">Easy To Get Meal Anywhere!</h2>
                            <p data-center="opacity: 1" data--200-bottom="opacity: 0" data-206-top="opacity: 1" data-106-top="opacity: 0" data-anchor-target="#slide-2 h2">Thật dễ dàng thưởng thức các món ăn vì đã có sẵn địa chỉ trong mỗi bức ảnh.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="slide-3" class="homeSlide">
                <div class="bcg" data-center="background-position: 0px 50%;" data-bottom-top="background-position: 0px 40%;" data-top-bottom="background-position: -40px 50%;" data-anchor-target="#slide-3">
                    <div class="hsContainer">
                        <div class="hsContent">
                            <div class="plaxEl" data-106-top="opacity: 0" data--30p-top="opacity: 1;" data--60p-top="opacity: 0;" data-bottom="opacity: 1; position: fixed; top: 206px; width: 100%; left: 0;"  data-anchor-target="#slide-3">
                                <h2></h2>             
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="slide-4" class="homeSlide homeSlideTall">
                <div class="bcg" data-center="background-position: 50% 0px;" data-bottom-top="background-position: 50% 100px;" data-top-bottom="background-position: 50% -100px;" data-anchor-target="#slide-4">
                    <div class="curtainContainer">
                        <div class="curtain" data-bottom-top="opacity: 0" data-106-top="height: 1%; opacity: 0; top: -10%;" data-center="height: 100%; opacity: 0.5; top: 0%;" data-anchor-target="#slide-4"></div>
                        <div class="copy" data-bottom-top="opacity: 0" data--100-bottom="opacity: 0" data--280-bottom="opacity: 1;" data-280-top="opacity: 1;" data-106-top="opacity: 0;" data-anchor-target="#slide-4 .copy">
                            <h2>Check In & Get A Selfie!</h2>
                            <p style="color:White;">Chụp những bức ảnh mà bạn thích và chia sẻ cùng bạn bè. </p>
                        </div> 
                    </div>
                </div>
            </section>
            
            <section id="slide-5" class="homeSlide homeSlideTall2">
                <div class="bcg">
                    &nbsp;
                </div>
                <div class="bcg bcg2" data-bottom-top="opacity: 0;" data--33p-top="opacity: 0;" data--66p-top="opacity: 1;" data-anchor-target="#slide-5">
                    <div class="hsContainer">
                        <div class="hsContent" data-bottom-top="opacity: 0;" data-center="opacity: 1" data-anchor-target="#slide-5">
                            <h2>Just Eat!<br> Everything We Leave Behind!</h2>
                            
                        </div>
                    </div>
                </div>
                <div class="bcg bcg3" data-300-bottom="opacity: 0;" data-100-bottom="opacity: 1;" data-anchor-target="#slide-5">
                    <div class="hsContainer">
                        <div class="hsContent" data-100-bottom="opacity: 0;" data-bottom="opacity: 1;" data-anchor-target="#slide-5">
                            <button  id='showup' type="button" class="btn btn-large btn-warning" style="font-size:40px;">Tham gia với chúng tôi</button>
                            <p>Click và cùng chúng tôi trải nghiệm sự phong phú của ẩm thực thế giới.</p>
                        </div>
                    </div>
                </div>
            </section>            
        </main>
        @include('layout.modal-login')
        <script src="{{URL::asset('js/modernizr-2.7.1.min.js')}}"></script>
        <script src="{{URL::asset('js/imagesloaded.js')}}"></script>
        <script src="{{URL::asset('js/skrollr.js')}}"></script>
        <script src="{{URL::asset('js/_main.js')}}"></script>
		<script src="{{URL::asset('js/facebook_connect.js')}}"></script>
        <script type="text/javascript">
            $('#showup').on('click', function(){
                $(".modal-login").modal('show');
            });
        </script>
    </body>
</html>