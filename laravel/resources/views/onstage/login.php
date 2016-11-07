<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
	<link rel="stylesheet" href="/laravel/AmazeUI/assets/css/amazeui.min.css">
	<link rel="stylesheet" href="/laravel/resources/assets/css/onstage.css" />

	<!-- <script src="/laravel/AmazeUI/assets/js/jquery.js" type="text/javascript"></script> -->
	<script src="/laravel/resources/assets/js/jquery-3.0.0.min.js" type="text/javascript"></script>
	<script src="/laravel/AmazeUI/assets/js/amazeui.min.js" type="text/javascript"></script>
	<script src="/laravel/resources/assets/js/supersized.3.0.js" type="text/javascript"></script>
	<script src="/laravel/resources/assets/js/login.js" type="text/javascript"></script>
</head>
<body id="supersized">
	<form class="login_form" method="post">
		<div class="avatar_div">
		    <img class="am-img-thumbnail am-circle avatar" src="/laravel/AmazeUI/assets/i/1.png" alt="头像"/>
		    <div class="progress" id="progress"></div>
		</div>
		<div class="am-input-group input_left">
		  <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
		  <input type="text" class="am-form-field" id="username" placeholder="Username" required="required">
		</div>

		<div class="am-input-group input_right">
		  <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
		  <input type="password" class="am-form-field" id="password" placeholder="Password" required="required">
		</div>
		<div class="login">
			<button type="button" class="am-btn am-btn-secondary am-btn-sm log">登录</button>
			<button type="button" class="am-btn am-btn-secondary am-btn-sm loging"><i class="am-icon-spinner am-icon-spin"></i>登录中</button>
			<button type="button" class="am-btn am-btn-warning am-btn-sm register">注册</button>
		</div>
	</form>
</body>
</html>

<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">提示</div>
    <div class="am-modal-bd alert_content">
      
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn alert_ok">确定</span>
    </div>
  </div>
</div>

<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">正在登录...</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>

<script>
	$(function() {
                $.fn.supersized.options = {
                    vertical_center: 1,//是否让图像垂直居中，如果为0，则图像为顶端对齐。
                    slideshow: 1,//是否显示展示工具条，包括标题、图片数字和导航按钮。
                    navigation: 1,//是否展示导航按钮。
                    thumbnail_navigation: 1,//为1时可以通过单击缩略图导航切换图片，为0时，缩略图不显示。
                    transition: 1, //0-None, 1-Fade, 2-slide top, 3-slide right, 4-slide bottom, 5-slide left
                    pause_hover: 0,//是否鼠标滑向图片时暂停图片切换。
                    slide_counter: 0,//是否显示切换图片的数字。
                    slide_captions: 0,//是否显示图片标题。
                    slide_interval: 4000,//图片切换间隔时间（毫秒）
                    autoplay:true,//是否自动播放。
                    transition_speed:1000, //切换速度
                    keyboard_nav:true,//是否支持键盘操作切换。
                    slides: [ //所切换的图片集合，包括图片地址image，图片标题title，图片链接url。
                    	//{image: 'slides/tower.jpg', title: 'City Clock Tower', url: 'http://www.sucaihuo.com'},
                        {image: '/laravel/resources/assets/img/1.jpg'},
                        {image: '/laravel/resources/assets/img/2.jpg'},
                        {image: '/laravel/resources/assets/img/3.jpg'},
                        {image: '/laravel/resources/assets/img/4.jpg'},
                        {image: '/laravel/resources/assets/img/5.jpg'},
                    ]
                };
                $('#supersized').supersized();
            });
	$('.log').bind('click',function(){
		login();
	})
	$('.alert_ok').bind('click',function(){
		//alert_close();   
        location.reload();
	})
</script>