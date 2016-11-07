<?php
namespace App\Http\Controllers\Onstage;
use DB;
use Cache;
use Session;
use App\User;
use App\Http\Controllers\Controller;

class MemController extends Controller
{
	/**
	 * [postFlashmemchache 更新缓存]
	 * @return [type] [success or fail]
	 */
	public function postFlashmemchache()
    {
    	//删除缓存
    	if (Cache::has('zizhu_users')) {
		    $is_forget = Cache::forget('zizhu_users');
		}
		//添加缓存
        $mem = Cache::rememberForever('zizhu_users', function() {
            return DB::table('user')->leftjoin('role','user.role','=','role.role_id')->select('user.*','role.role_name')->get();
        });
        if($mem)
        {
        	$result = array('status'=>1,'msg'=>'缓存更新成功!');
        }else{
        	$result = array('status'=>2,'msg'=>'缓存更新失败!');
        }
        echo json_encode($result);
    }
    public function postForgetmem()
    {
    	if (Cache::has('zizhu_users')) {
		    $is_forget = Cache::forget('zizhu_users');
		    if($is_forget)
		    {
		    	$result = array('status'=>1,'msg'=>'清除缓存成功!');
		    }else{
		    	$result = array('status'=>2,'msg'=>'清除缓存失败!');
		    }
		}else{
		    $result = array('status'=>3,'msg'=>'缓存不存在!');
		}
		echo json_encode($result);
    }


    static function mem_user($username)
    {
    	//$username = $_GET['username'];
    	$mem = self::mem_info();
    	$result = array();
    	if(!empty($mem))
    	{
    		foreach ($mem as $key => $row) {
    			if($row->username==$username)
    			{
    				$result = $row;
    			}
    		}
    	}
    	return $result;
    }
    static function mem_id($id)
    {
    	//$username = $_GET['username'];
    	$mem = self::mem_info();
    	$result = array();
    	if(!empty($mem))
    	{
    		foreach ($mem as $key => $row) {
    			if($row->id==$id)
    			{
    				$result = $row;
    			}
    		}
    	}
    	return $result;
    }
    /**
     * [getMem 获取缓存信息]
     * @return [type] [用户信息]
     */
    static function mem_info()
    {
    	$mem = Cache::get('zizhu_users');
    	return $mem;
    }

    public function getMem()
    {
    	$mem = Cache::get('zizhu_users');
    	return $mem;
    }

    /**
	 * [postFlashmemchache 更新缓存]
	 * @return [type] [success or fail]
	 */
	public function getFlashmemchache()
    {
    	//删除缓存
    	if (Cache::has('zizhu_users')) {
		    $is_forget = Cache::forget('zizhu_users');
		}
		//添加缓存
        $mem = Cache::rememberForever('zizhu_users', function() {
            return DB::table('user')->leftjoin('role','user.role','=','role.role_id')->select('user.*','role.role_name')->get();
        });
        if($mem)
        {
        	$result = array('status'=>1,'msg'=>'缓存更新成功!');
        }else{
        	$result = array('status'=>2,'msg'=>'缓存更新失败!');
        }
        return $result;
    }
    public function getForgetmem()
    {
    	if (Cache::has('zizhu_users')) {
		    $is_forget = Cache::forget('zizhu_users');
		    if($is_forget)
		    {
		    	$result = array('status'=>1,'msg'=>'清除缓存成功!');
		    }else{
		    	$result = array('status'=>2,'msg'=>'清除缓存失败!');
		    }
		}else{
		    $result = array('status'=>3,'msg'=>'缓存不存在!');
		}
		return $result;
    }
}