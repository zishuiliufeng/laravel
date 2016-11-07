$(function() {
	/**
	 * [注销登录session]
	 * @param  {String} ){		location.href [跳转到登录页面]
	 * @return {[type]}                    [description]
	 */
	$('.login_out').bind('click',function(){
		location.href = 'login/loginout';
	})
	/**
	 * [更新缓存]
	 * @param  {String} ){                                  	var url [更新缓存的方法]
	 * @param  {[type]} success :             function(res)           		{             			if(res)    			{    				$('.alert_content').html('');    				$('.alert_content').html(res.msg);    				$('#my-alert').modal('show');    			}    		}    	})    } [description]
	 * @return {[type]}         [description]
	 */
    $('.flash_memchache').bind('click',function(){
    	var url = 'mem/flashmemchache';
    	ajaxPost(url);
    })
    /**
     * [清空缓存]
     * @param  {String} ){                 	var url [清空缓存的方法]
     * @return {[type]}     [description]
     */
    $('.forget_memchache').bind('click',function(){
    	var url = 'mem/forgetmem';
    	ajaxPost(url);
    })

    function ajaxPost(url)
    {
    	$.ajax({
    		url : url,
    		type : 'POST',
    		dataType : 'json',
    		cache : false,
    		data : {},
    		success : function(res)
    		{
    			if(res)
    			{
    				$('.alert_content').html('');
    				$('.alert_content').html(res.msg);
    				$('#my-alert').modal('open');
    			}
    		}
    	})
    }

    $('.change_password').bind('click',function()
    {
    	$('.show_old_password').attr('checked',false);
    	$('.show_new_password').attr('checked',false);
    	$('.show_cnew_password').attr('checked',false);
    	$('.old_password').val('');
    	$('.new_password').val('');
    	$('.cnew_password').val('');
    	//$('#change_password').modal('open');
    	$('#change_password').modal({
        relatedTarget: this,
        onConfirm: function(options) {
 			var url = "login/changepassword";
			var new_password = $('.new_password').val();
			var cnew_password = $('.cnew_password').val();
			var old_password = $('.old_password').val();
			var old_psw = $('.old_password').attr('psw');
			if($.md5(old_password) != old_psw)
			{
				$('.alert_content').html('');
    			$('.alert_content').html('旧密码错误!');
    			$('#my-alert').modal('open');
    			return false;
			}
			if(new_password != cnew_password)
			{
				$('.alert_content').html('');
    			$('.alert_content').html('两次输入的密码不一致!');
    			$('#my-alert').modal('open');
    			return false;
			}
			$.ajax({
				type : "POST",
				url : url,
				dataType : 'json',
				cache : false,
				data : {
					new_password : new_password,
					cnew_password : cnew_password,
					old_password : old_password,
				},
				beforeSend : function(){				
					$('#my-modal-loading').modal('open');
				},
				success : function(res){
					if(res.status==1)
					{
						$('#my-modal-loading').modal('close');
						$('.alert_content').html('');
		    			$('.alert_content').html('密码修改成功,请重新登录!');
		    			$('#my-alert').modal('open');
		    			$('.alert_ok').bind('click',function(){
		    				location.reload();
		    			})
					}else{
						$('.alert_content').html('');
		    			$('.alert_content').html(res.msg);
		    			$('#my-alert').modal('open');
					}
				}
			})
        },
        // closeOnConfirm: false,
        onCancel: function() {
          alert('算求，不弄了');
        }
      });
    })
    //密码显示和隐藏
    $('.show_old_password').bind('change',function(){
    	var is_check = $(".show_old_password").prop("checked");
    	var obj = document.getElementById("old_password");
    	change_password_type(is_check,obj);
    })
    $('.show_new_password').bind('change',function(){
    	var is_check = $(".show_new_password").prop("checked");
    	var obj = document.getElementById("new_password");
    	change_password_type(is_check,obj);
    })
    $('.show_cnew_password').bind('change',function(){
    	var is_check = $(".show_cnew_password").prop("checked");
    	var obj = document.getElementById("cnew_password");
    	change_password_type(is_check,obj);
    })

    function change_password_type(is_check,obj)
    {
    	//修改Input的type属性只能用js方法
    	if(is_check)
    	{
    		obj.type = "text";
    	}else{
    		obj.type="password";
    	}
    }


	$('#doc-vld-ajax').validator({
	    validate: function(validity) {
	      var v = $(validity.field).val();

	      var comparer = function(v1, v2) {
	        if (v1 != v2) {
	          validity.valid = false;
	        }

	        // 这些属性目前 v2.3 以前没什么用，如果不想写可以忽略
	        // 从 v2.3 开始，这些属性被 getValidationMessage() 用于生成错误提示信息
	        if (v2 < 10) {
	          validity.rangeUnderflow = true;
	        } else if(v2 > 10) {
	          validity.rangeOverflow = true;
	        }
	      };

	      // Ajax 验证
	      if ($(validity.field).is('.old_password')) {
	        // 异步操作必须返回 Deferred 对象
	        return $.ajax({
	          url : 'login/checkoldpassword',
	          type : 'POST',
	          // cache: false, 实际使用中请禁用缓存
	          dataType: 'json'
	        }).then(function(res) {
	        	if(res.status==1)
	        	{
	        		var old_password = $('.old_password').val();
	        		$('.old_password').attr('psw',res.old);
	        		comparer(res.old, $.md5(old_password));
	        		if(res.old==$.md5(old_password))
	        		{
	        			$('.old_psw_check').addClass('am-icon-check');
	        			$('.old_psw_check').removeClass('am-icon-times');
	        		}else{
	        			$('.old_psw_check').removeClass('am-icon-check');
	        			$('.old_psw_check').addClass('am-icon-times');
	        		}
	          		return validity;
	        	}else{
	        		$('.alert_content').html('');
    				$('.alert_content').html(res.msg);
    				$('#my-alert').modal('open');
	        	}
	          
	        }, function() {
	          return validity;
	        });
	      }

	      // 本地验证，同步操作，无需返回值
	      if ($(validity.field).is('.new_password')) {
	      	var cnew_password = $('.cnew_password').val();
	      	var new_password = $('.new_password').val();
	      	if(cnew_password.length>0)
	      	{
	      		comparer(cnew_password, new_password);
	      		if(cnew_password != new_password)
	      		{
	      			$('.cnew_password').removeClass('am-field-valid');
	      			$('.cnew_password').addClass('am-active');
	      			$('.cnew_password').addClass('am-field-error');
	      			$('.cnew_psw').addClass('am-form-error');
	      			$('.cnew_psw').removeClass('am-form-success');
	      			//对错图标
	      			$('.new_psw_check').removeClass('am-icon-check');
	        		$('.new_psw_check').addClass('am-icon-times');
	        		$('.cnew_psw_check').removeClass('am-icon-check');
	        		$('.cnew_psw_check').addClass('am-icon-times');
	      		}else if(cnew_password == new_password)
	      		{
	      			$('.cnew_password').removeClass('am-active');
	      			$('.cnew_password').removeClass('am-field-error');
	      			$('.cnew_password').addClass('am-field-valid');
	      			$('.cnew_psw').removeClass('am-form-error');
	      			$('.cnew_psw').addClass('am-form-success');
	      			//对错图标
	      			$('.new_psw_check').addClass('am-icon-check');
	        		$('.new_psw_check').removeClass('am-icon-times');
	        		$('.cnew_psw_check').addClass('am-icon-check');
	        		$('.cnew_psw_check').removeClass('am-icon-times');
	      		}
	      	}
	        
	        // return validity;
	      }
	      if ($(validity.field).is('.cnew_password')) {
	      	var new_password = $('.new_password').val();
	      	var cnew_password = $('.cnew_password').val();
	      	if(cnew_password.length>0)
	      	{
	      		comparer(new_password, cnew_password);
	      		if(new_password != cnew_password)
	      		{
	      			$('.new_password').removeClass('am-field-valid');
	      			$('.new_password').addClass('am-active');
	      			$('.new_password').addClass('am-field-error');
	      			$('.new_psw').addClass('am-form-error');
	      			$('.new_psw').removeClass('am-form-success');
	      			//对错图标
	      			$('.new_psw_check').removeClass('am-icon-check');
	        		$('.new_psw_check').addClass('am-icon-times');
	        		$('.cnew_psw_check').removeClass('am-icon-check');
	        		$('.cnew_psw_check').addClass('am-icon-times');
	      		}else if(new_password == cnew_password)
	      		{
	      			$('.new_password').removeClass('am-active');
	      			$('.new_password').removeClass('am-field-error');
	      			$('.new_password').addClass('am-field-valid');
	      			$('.new_psw').removeClass('am-form-error');
	      			$('.new_psw').addClass('am-form-success');
	      			//对错图标
	      			$('.new_psw_check').addClass('am-icon-check');
	        		$('.new_psw_check').removeClass('am-icon-times');
	        		$('.cnew_psw_check').addClass('am-icon-check');
	        		$('.cnew_psw_check').removeClass('am-icon-times');
	      		}
	      	}	
	        //comparer(new_password, v);
	        // return validity;
	      }
	    }
	});
	// 侧边菜单开关
	$('.list_toggle').bind('click',function(){
        if($('.left-sidebar').is('.active')){
            if($(window).width() > 1024){
                $('.right-content-wrapper').removeClass('active');
            }
            $('.left-sidebar').removeClass('active');
        }else{

            $('.left-sidebar').addClass('active');
            if($(window).width() > 1024){
                $('.right-content-wrapper').addClass('active');
            }
        }
    })

    if($(window).width() < 1024){
        $('.left-sidebar').addClass('active');
    }else{
        $('.left-sidebar').removeClass('active');
    }

	/*$('.cnew_password').bind('input propertychange',function()
	{
		var new_password = $('.new_password').val();
	    var cnew_password = $('.cnew_password').val();
	})*/

	//模拟登录
	$('.school_A1_login').bind('click',function(){
		var username = $('.school_A1_username').val();
		var password = $('.school_A1_password').val();
		var type = $("input[name='school_A1']:checked").val(); 
		var url = "http://e.dev.anoah.com/ebag/index.php?r=school/default/login";
		$.ajax({
			url : url,
			type : 'POST',
			dataType : 'json',
			cache : false,
			data : {
				username : username,
				password : password,
				type : type
			},
			success : function(res){
				$('.alert_content').html('');
    			$('.alert_content').html(res.type);
    			$('#my-alert').modal('open');
			},
			error : function(o){
				alert(o);
			}
		})
	})

	$('.backstage-permissions').bind('click',function(){
		
	})
})




