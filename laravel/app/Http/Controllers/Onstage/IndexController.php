<?php
namespace App\Http\Controllers\Onstage;
use DB;
use Cache;
use Session;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Onstage\MemController;

class IndexController extends MemController
{
	public function getIndex()
	{
		$login = Session::get('zizhu_login');
		//若没有头像，赋给默认头像
		if(empty($login->avatar))
		{
			$login->avatar = '/laravel/resources/assets/img/zizu.png';
		}
		

		return view('onstage.index',['login_user'=>$login]);
	}

	public function postSidebar()
	{
		$login = Session::get('zizhu_login');
		//登录用户的权限
		$login_role = $login->role;
		$permissions = DB::table('role')->where('role_id','=',$login_role)->select('permissions')->first();
		$permissions_Str = $permissions->permissions;
		$permissions_Arr = explode(',',$permissions_Str);
		$admin_permissions =  DB::table('admin_permissions')
                     ->where('module','=','index')
                     ->whereIn('permissions_id', $permissions_Arr)
                     ->get();
        $data = array();
        if(!empty($admin_permissions))
        {
        	foreach ($admin_permissions as $key => $row) {
        		$data[$row->sidebar][] = $row;
        	}
        }
        $result = array('status'=>1,'msg'=>'ok','data'=>$data);
        echo json_encode($result);             
	}
}