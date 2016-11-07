<?php

namespace App\Http\Middleware;
use Cache;
use Session;
use Closure;
use Request;
class CheckLogin
{
	public function handle($request, Closure $next)
    {
        /* echo "sss";
		$url = $request->path();
		var_dump($url); */
		//$user = Cache::get('user_info');
		//return $next($request);
		//检查是否跳转到登录页面，若跳转到其它页，检查是否登录，若没有登录则跳转到登录页
		$next_url = Request::path();
		if($next_url=='login' || $next_url=='login/kg' || $next_url=='mem/mem' || $next_url=='mem/flashmemchache' || $next_url=='mem/forgetmem')
		{
			return $next($request);
		}else{
			$is_login = Session::has('zizhu_login');

			if($is_login)
			{
				return $next($request);
			}else{
				$url = url('login');
				return redirect($url);
			}
		}
		
		/*$login = Session::get('tian_ji_login');
		if(!empty($login))
		{
			return $next($request);
		}else{
			return redirect()->guest('login');
		}*/
    }
}