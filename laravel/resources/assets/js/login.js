var Asc;
function login()
{
	var method = $('.login_form').attr('method');
	var username = $('#username').val();
	var password = $('#password').val();
	var url = 'login/kg';
	if(username.length<=0 || password.length<=0)
	{
		$('.alert_content').text('请填写必选项登录');
		$('#my-alert').modal('open');
		return;
	}
	$('.log').addClass('am-animation-scale-up am-animation-reverse');
	$('.register').addClass('am-animation-scale-down am-animation-reverse');
	$('.input_left').addClass('am-animation-slide-left am-animation-reverse');
	$('.input_right').addClass('am-animation-slide-right am-animation-reverse');
	setTimeout(function () {
		$('.avatar').addClass('avatar-top');
	},300)
	
	setTimeout(function () {
		$.ajax({
			type : method,
			url : url,
			dataType : 'json',
			cache : false,
			data : {
				username : username,
				password : password,
			},
			beforeSend : function(){				
				$('.progress').html('<div class="am-progress am-progress-striped am-active"><div class="am-progress-bar am-progress-bar-warning"></div></div>');
				
				Asc = setInterval("timeAsc()",10);
				//$('#my-modal-loading').modal('open');
				//$.AMUI.progress.configure({ ease: 'ease', speed: 500 });
			},
			success : function(o){
				if(o)
				{
					res = o;
					pw = setInterval("progress_width()",10);

				}
			}
		})
	},500);

}
//定时自增进度条
var i = 0;

function timeAsc()
{
  w = i++;
  wi = w+'%';
  $('.am-progress-bar').css('width',wi);
  if(w==100)
  {
  	clearTimeAsc();
  }
}
function clearTimeAsc()
{
	clearInterval(Asc);
}
//定时检查进度条长度
var pw;
var res;
function progress_width()
{
	var w = $('.am-progress-bar').css('width');
	var url = 'index';
	if(w=='100px')
	{
		clearInterval(pw);
		if(res.status==1){
			location.href = url;
			//$('#my-modal-loading').modal('close');
		}else{
			//$('#my-modal-loading').modal('close');
			
			$('.alert_content').text(res.msg);
			$('#my-alert').modal('open');
		}
	}
}

function alert_close(){
	setTimeout(function () {
		$('.log').removeClass('am-animation-reverse');
		$('.register').removeClass('am-animation-reverse');
		$('.input_left').removeClass('am-animation-reverse');
		$('.input_right').removeClass('am-animation-reverse');
	},300)
}
