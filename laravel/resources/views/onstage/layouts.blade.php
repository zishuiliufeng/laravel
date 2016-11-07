<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理 - @yield('title')</title>
	<link rel="stylesheet" href="/laravel/AmazeUI/assets/css/amazeui.min.css">
	<link rel="stylesheet" href="/laravel/resources/assets/js/jquery-ui/jquery-ui.min.css" />
	<link rel="stylesheet" href="/laravel/resources/assets/css/onstage.css" />
	<script src="/laravel/resources/assets/js/jquery.js" type="text/javascript"></script>
	<script src="/laravel/AmazeUI/assets/js/amazeui.min.js" type="text/javascript"></script>
	<script src="/laravel/AmazeUI/assets/js/handlebars.min.js" type="text/javascript"></script>
	<script src="/laravel/AmazeUI/assets/js/amazeui.widgets.helper.js" type="text/javascript"></script>
	<script src="/laravel/resources/assets/js/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<script src="/laravel/resources/assets/js/jquery.cookie.js" type="text/javascript"></script>
	<script src="/laravel/resources/assets/js/common.js" type="text/javascript"></script>
	<script src="/laravel/resources/assets/js/jquery.bgColorSelector.js" type="text/javascript"></script>
	<script src="/laravel/resources/assets/js/jQuery.md5.js" type="text/javascript"></script>
	<script src="/laravel/resources/assets/js/index.js" type="text/javascript"></script>

	<script>
		var COMMON_URL = '/laravel/resources/assets';
	</script>
</head>
<body>
	 		<div class="bgSelector"></div>
            <header class="am-topbar am-topbar-inverse">
			  <h1 class="am-topbar-brand zizhu_title">
			    <a href="#" class="zizhu">紫竹</a>
			  </h1>
				<h1 class="am-topbar-brand list_change">
			  <button class="am-topbar-btn  am-btn am-btn-sm am-btn-success list_toggle am-topbar-inverse" ><span class="am-sr-only">侧边切换</span> <span class="am-icon-bars"></span></button>
				</h1>
			  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
			    <ul class="am-nav am-nav-pills am-topbar-nav">
			      <li class="am-active"><a href="#">首页</a></li>
			      <li><a href="#">项目</a></li>
			      <li class="am-dropdown" data-am-dropdown>
			        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
			          下拉 <span class="am-icon-caret-down"></span>
			        </a>
			        <ul class="am-dropdown-content">
			          <li class="am-dropdown-header">标题</li>
			          <li><a href="#">1. 去月球</a></li>
			          <li class="am-active"><a href="#">2. 去火星</a></li>
			          <li><a href="#">3. 还是回地球</a></li>
			          <li class="am-disabled"><a href="#">4. 下地狱</a></li>
			          <li class="am-divider"></li>
			          <li><a href="#">5. 桥头一回首</a></li>
			        </ul>
			      </li>
			    </ul>

			    <form class="am-topbar-form am-topbar-left am-form-inline" role="search">
			      <div class="am-form-group">
			        <input type="text" class="am-form-field am-input-sm" placeholder="搜索">
			      </div>
			    </form>

			    <div class="am-topbar-right">
			      <div class="am-dropdown" data-am-dropdown="{boundary: '.am-topbar'}">
			        <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm am-dropdown-toggle" data-am-dropdown-toggle>其他 <span class="am-icon-caret-down"></span></button>
			        <ul class="am-dropdown-content">
			          <li><a href="#" id="bgSelector">换个颜色</a></li>
			          <li><a href="#" class="flash_memchache">更新缓存</a></li>
			          <li><a href="#" class="forget_memchache">清除缓存</a></li>
			        </ul>
			      </div>
			    </div>

			    <div class="am-topbar-right">
			      <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm login_out">
			      	<span class="am-icon-sign-out"></span>退出
			      </button>
			    </div>
			    <div class="am-topbar-right">
			      <div class="am-dropdown" data-am-dropdown="{boundary: '.am-topbar'}">
			        <button class="am-btn-secondary am-dropdown-toggle am-btn-info" data-am-dropdown-toggle>
			        	<img class="login_user_avatar" src="<?php echo $login_user->avatar; ?>" alt="用户头像">
			         	<span class="am-icon-caret-down"></span>
			        </button>
			        <ul class="am-dropdown-content">
			          <li><a href="#">最后登录:<?php echo $login_user->last_login_time; ?></a></li>
			          <li><a href="#">登录ip:<?php echo $login_user->ip; ?></a></li>
			          <li><a href="#" data-am-modal="{target: '#alter_userinfo'}">修改用户信息</a></li>
			          <li><a href="#" class="change_password">修改密码</a></li>
			        </ul>
			      </div>
			    </div>
			    <div class="am-topbar-right">
			        <dl class="user_info">
			    		<dt class="username"><?php echo $login_user->username; ?></dt>
			    		<dt class="role"><?php echo $login_user->role_name; ?></dt>
			    	</dl>
			    </div>
				
				
			  </div>
			</header>

			
			
		@section('sidebar')
		sidebar.
        @show

        <div class="container">
            @yield('content')
        </div>
</body>
  <footer data-am-widget="footer"
          class="am-footer am-footer-default"
           data-am-footer="{  }">
    <div class="am-footer-switch">
    <span class="am-footer-ysp" data-rel="mobile"
          data-am-modal="{target: '#am-switch-mode'}">
          云适配版
    </span>
      <span class="am-footer-divider"> | </span>
      <a id="godesktop" data-rel="desktop" class="am-footer-desktop" href="javascript:">
          电脑版
      </a>
    </div>
    <div class="am-footer-miscs ">

          <p>由 <a href="http://www.yunshipei.com/" title="紫竹"
                                                target="_blank" class="">紫竹</a>
            提供技术支持</p>
        <p>CopyRight©2014  AllMobilize Inc.</p>
        <p>京ICP备13033158</p>
    </div>
  </footer>

  <div id="am-footer-modal"
       class="am-modal am-modal-no-btn am-switch-mode-m am-switch-mode-m-default">
    <div class="am-modal-dialog">
      <div class="am-modal-hd am-modal-footer-hd">
        <a href="javascript:void(0)" data-dismiss="modal" class="am-close am-close-spin " data-am-modal-close>&times;</a>
      </div>
      <div class="am-modal-bd">
          您正在浏览的是

        <span class="am-switch-mode-owner ">
            云适配
        </span>

        <span class="am-switch-mode-slogan">
              为您当前手机订制的移动网站。
        </span>
      </div>
    </div>
  </div>

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

<div class="am-popup" id="alter_userinfo">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title">模拟登录</h4>
      <span data-am-modal-close
            class="am-close">&times;</span>
    </div>
    <div class="am-popup-bd">
      	<form class="am-form am-form-horizontal">
		  <div class="am-form-group">
		    <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">账号</label>
		    <div class="am-u-sm-10">
		      <input type="text" id="doc-ipt-3" class="school_A1_username" placeholder="账号">
		    </div>
		  </div>

		  <div class="am-form-group">
		    <label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">密码</label>
		    <div class="am-u-sm-10">
		      <input type="text" id="doc-ipt-pwd-2" class="school_A1_password" placeholder="密码">
		    </div>
		  </div>
			
			<div class="am-form-group">
				<div class="am-u-sm-10">
			      <label>类型: </label>
			      <label class="am-radio-inline">
			        <input type="radio"  value="1" name="school_A1" required> 校管
			      </label>
			      <label class="am-radio-inline">
			        <input type="radio" value="2" name="school_A1"> A1
			      </label>
		      	</div>
		    </div>
		  <div class="am-form-group">
		    <div class="am-u-sm-10 am-u-sm-offset-2">
		      <button  class="am-btn am-btn-secondary am-topbar-btn school_A1_login">登录</button>
		    </div>
		  </div>
		</form>
    </div>
  </div>
</div>

<div class="am-modal am-modal-confirm" tabindex="-1" id="change_password">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">修改密码</div>
    <div class="am-modal-bd">
        <form action="" class="am-form" id="doc-vld-ajax">
			<fieldset>
			    <div class="am-form-group am-form-icon am-form-feedback">
			        <label for="old_password" style="float: left">旧密码：</label>
			        <label style="float: right">
			          <input type="checkbox" class="show_old_password">显示密码
			        </label>
			        <input type="password" id="old_password" class="old_password am-form-field" id="doc-vld-ajax-count"
			             placeholder="请填写旧密码" data-validate-async/>
			      <span class="old_psw_check"></span>
			    </div>

			    <div class="am-form-group new_psw am-form-icon am-form-feedback">
			        <label for="new_password" style="float: left">新密码:</label>
			        <label style="float: right">
			          <input type="checkbox" class="show_new_password">显示密码
			        </label>
			        <input type="password" id="new_password" class="new_password" id="doc-vld-sync"
			             placeholder="请填写新密码"/>
			        <span class="new_psw_check"></span>    
			    </div>
			    <div class="am-form-group cnew_psw am-form-icon am-form-feedback">
			        <label for="cnew_password" style="float: left">重复新密码:</label>
			        <label style="float: right">
			          <input type="checkbox" class="show_cnew_password">显示密码
			        </label>
			        <input type="password" id="cnew_password" class="cnew_password" id="doc-vld-sync"
			             placeholder="请重新填写新密码"/>
			        <span class="cnew_psw_check"></span>
			    </div>
			</fieldset>
		</form>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn change_psw" data-am-modal-confirm>提交</span>
    </div>
  </div>
</div>

<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">正在修改...</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>