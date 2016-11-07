<?php

namespace App\Http\Controllers\Onstage;
use DB;
use Cache;
use Session;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Onstage\MemController;

class LoginController extends MemController
{
    /**
     * [index 登录页面] 
     * @return [type] [description]
     */
    public function getIndex()
    {
        $is_login = Session::has('zizhu_login');
        
        if($is_login)
        {
            return redirect('index');
        }else{
            return view('onstage.login');
        }   
    }
    /**
     * [postKg 验证登录]
     * @return [json] [success or fail]
     */
    public function postKg()
    {
    	$username = $_POST['username'];
    	$password = $_POST['password'];
        //若缓存存在则取缓存，否则查表
        $mem = $this->mem_user($username);
        if(!empty($mem))
        {
            $user = $mem;
        }else{
            //$user = DB::select('select * from user where username = ?',[$username]);
            $user = DB::table('user')->leftjoin('role','user.role','=','role.role_id')->where('username','=',$username)->select('user.*','role.role_name')->get();
            $user = $user[0]; 
        }
    	
    	if(!empty($user))
    	{
    		$user_password = $user->password;
	    	if(md5($password)==$user_password)
	    	{
	    		//Cache::put('user', $user[0], 60);
                //最后登录时间
                $time = date('Y-m-d H:i:s',time());
                $ip = $this->ip();
                if($ip=='::1')
                {
                    $ip = '本地登录';
                }
                //$affected = DB::update('update user set last_login_time = ? where id = ?', [$time,$user->id]);
                $affected = DB::table('user')
                            ->where('id', $user->id)
                            ->update(['last_login_time' => $time,'ip' => $ip]);

                $user->last_login_time = $time;
                $user->ip = $ip;
                Session::put('zizhu_login', $user);
                //Session::save();
	    		$result = array('status'=>1,'msg'=>'登陆成功');
	    	}else{
	    		$result = array('status'=>2,'msg'=>'用户名或密码错误');
	    	}
    	}else{
    		$result = array('status'=>3,'msg'=>'用户不存在');
    	}
    	echo json_encode($result);
    }
    public function postCheckoldpassword()
    {
        $login = Session::get('zizhu_login');
        if($login)
        {
            $userid = $login->id;
            if (Cache::has('zizhu_users')) {
                $userinfo = self::mem_id($userid);
                $password = $userinfo->password;
                $result = array('status'=>1,'msg'=>'ok','old'=>$password);
            }else{
                $result = array('status'=>3,'msg'=>'no this data !');
            }
            
        }else{
            $result = array('status'=>2,'msg'=>'get session fail !');
        }
        echo json_encode($result);
    }

    public function postChangepassword()
    {
        $new_password = trim($_POST['new_password']);
        $cnew_password = trim($_POST['cnew_password']);
        $old_password = trim($_POST['old_password']);
        $login = Session::get('zizhu_login');
        if($login)
        {
            $userid = $login->id;
            if (Cache::has('zizhu_users')) {
                $userinfo = self::mem_id($userid);
                $password = $userinfo->password;
                if($password == md5($old_password))
                {
                    if($new_password == $cnew_password)
                    {
                        $affected = DB::table('user')
                            ->where('id', $userid)
                            ->update(['password' => md5($new_password),'updated_at' => date('Y-m-d H:i:s')]);
                         if($affected)
                         {
                            //删除缓存
                            if (Cache::has('zizhu_users')) {
                                $is_forget = Cache::forget('zizhu_users');
                            }
                            //添加缓存
                            $mem = Cache::rememberForever('zizhu_users', function() {
                                return DB::table('user')->leftjoin('role','user.role','=','role.role_id')->select('user.*','role.role_name')->get();
                            });
                            //删除session
                            Session::forget('zizhu_login');
                            $result = array('status'=>1,'msg'=>'修改成功');
                        }else{
                            $result = array('status'=>6,'msg'=>'save fail !');
                        }   
                        
                    }else{
                        $result = array('status'=>5,'msg'=>'两次输入密码不一致!');
                    }
                }else{
                    $result = array('status'=>4,'msg'=>'旧密码错误!');
                }

                
            }else{
                $result = array('status'=>3,'msg'=>'no this data !');
            }
            
        }else{
            $result = array('status'=>2,'msg'=>'get session fail !');
        }
        echo json_encode($result);
    }

    /**
     * [getip 获取登录用户的ip]
     * @return [string] [ip]
     */
    function ip() {  
    $unknown = 'unknown';  
    if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
    && $_SERVER['HTTP_X_FORWARDED_FOR'] 
    && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], 
    $unknown) ) {  
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    } elseif ( isset($_SERVER['REMOTE_ADDR']) 
    && $_SERVER['REMOTE_ADDR'] && 
    strcasecmp($_SERVER['REMOTE_ADDR'], $unknown) ) {  
    $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    /*  
    处理多层代理的情况  
    或者使用正则方式：$ip = preg_match("/[d.]
    {7,15}/", $ip, $matches) ? $matches[0] : $unknown;  
    */  
    if (false !== strpos($ip, ','))  
    $ip = reset(explode(',', $ip));  
     return $ip;  
    } 

    public function getCeshi()
    {
    	$login = Session::get('zizhu_login');
        return $login;
    	/*var_dump($login);
    	 print_r( Session::all() ); //取出来看看是否put成功  
        exit;   //习惯性的调试都exit，不执行后续代码 */
    }
    /**
     * [getLoginout 注销登录session]
     * @return [type] [返回登录页面]
     */
    public function getLoginout()
    {
        $login_out = Session::forget('zizhu_login');
        return view('onstage.login');
    }
}
