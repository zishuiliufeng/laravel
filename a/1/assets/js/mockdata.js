$(function(){
	//本地存储
	var store = $.AMUI.store;

	if (!store.enabled) {
	  alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.');
	  return;
	}
	var LOGIN_URL = 'login.com';
	var SIGN_UP_URL = 'sign_up.com';
	Mock.setup({
	    timeout: '200-600'
	})
	Mock.mock(LOGIN_URL,function(obj){
		var data = obj.body.split("&");
		
		var user_arr = data[0].split("=");
		var password_arr = data[1].split("=");
		var user = user_arr[1];
		var password = password_arr[1];
		var userinfo = store.get('userinfo');
		console.log(userinfo)
		if(!userinfo){
			result = $.parseJSON('{"status":3,"msg" : "请先注册用户"}')
		}else{
			var user_password = '';
			var is_user = '';
			$.each(userinfo,function(o,i){
				var user_name = i.name;
				if(user_name==user)
				{
					user_password = i.password;
					is_user = user_name;
				}
			})
			if(user==is_user && password==user_password)
			{
				result = $.parseJSON('{"status":1,"msg" : "ok","data" : "index.html"}');
			}else{
				result = $.parseJSON('{"status":2,"msg" : "登录名或密码错误"}')
			}
		}
		return result;
	})
	
	//截断注册ajax
	Mock.mock(SIGN_UP_URL,function(obj){
		var data = obj.body.split("&");
		var email_arr = data[0].split("=");
		var email = email_arr[1];
		var name_arr = data[1].split("=");
		var name = name_arr[1];
		var password_arr = data[2].split("=");
		var password = password_arr[1];
		var repassword_arr = data[3].split("=");
		var repassword = repassword_arr[1];

		if(password != repassword)
		{
			return $.parseJSON('{"status":2,"msg" : "两次密码不一致"}');
		}
		
		var userinfo = store.get('userinfo');
		if(!userinfo){
			var users = new Array();
			var user = new Array();
			/*user.push({
				'name' : name,
				'email' : email,
				'password' : password
			})*/
			user = {"name":name,"email":email,"password":password};
			users.push(user);
			store.set('userinfo',users);
			return $.parseJSON('{"status":1,"msg" : "ok","data":"login.html"}');
		}else{
			$.each(userinfo,function(o,i){
				var user_name = i.name;
				var user_email = i.email;
				if(user_name==name){
					return $.parseJSON('{"status":3,"msg" : "此用户名已注册"}');
				}
				if(user_email==email){
					return $.parseJSON('{"status":4,"msg" : "此邮箱已注册"}');
				}
			})

			var users = userinfo;
			var user = new Array();

			user = {"name":name,"email":email,"password":password};
			users.push(user);
			store.set('userinfo',users);
			return $.parseJSON('{"status":1,"msg" : "ok","data":"login.html"}');
		}
		
	})
})