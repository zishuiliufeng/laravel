$(function(){
	Mock.setup({
	    timeout: '200-600'
	})
	Mock.mock(LOGIN_URL,function(obj){
		var data = obj.body.split("&");
		
		var user_arr = data[0].split("=");
		var password_arr = data[1].split("=");
		var user = user_arr[1];
		var password = password_arr[1];
		//var result = new Array();
		if(user=='admin' && password=='111111')
		{
			/*result.push({
			    'status' : 1,
			    'msg' : 'ok',
			    'data' : 'index.html'
			})*/
			result = $.parseJSON('{"status":1,"msg" : "ok","data" : "index.html"}');
		}else{
			/*result.push({
			    'status' : 2,
			    'msg' : '登录名或密码错误',
			})*/
			result = $.parseJSON('{"status":2,"msg" : "登录名或密码错误"}')
		}
		return result;
	})
})