<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{
	//前置方法
	public function _before_index(){
		
	}
	public function index()
	{
		$this->render('Login');
	}
}