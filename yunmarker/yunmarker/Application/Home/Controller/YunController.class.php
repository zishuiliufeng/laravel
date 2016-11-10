<?php
namespace Home\Controller;
use Think\Controller;
require_once 'simple_html_dom.php';

class YunController extends Controller{
	/**
	 * 默认控制器
	 */
    public function index(){
        $default_img = c('default_img');
        $this->assign('default_img',$default_img);
        $this->display();
    }
	
    /**
     * 消息模板
     * @var string
     * @author lishengcn.cn
     */
    private $msgTpl = '{"code": %s, "content": %s}';
    
    /**
     * 生成消息模板
     * @param integer $code
     * @param string $content
     * @return string 
     * @author lishengcn.cn
     */
    private function CreateMsg($code, $content) {
    	$result = sprintf($this->msgTpl, $code, $content);
    	return $result;
    }
    
    /**
     * 格式化icon的url
     * @param string $href
     * @param string $iconUrl
     * @return string
     * @author lishengcn.cn
     */
    private function FormatIcon($href, $iconUrl){
    	if(!strstr($iconUrl, "http") && $iconUrl != null) {
    		return $href . $iconUrl;
    	} elseif ($iconUrl == null) {
    		$iconUrl = "/yunmarker/client/assets/img/icon.jpg";
    		return $iconUrl;
    	} else {
    		return $iconUrl;
    	}
    }
    
    /**
     * 获取网址的title和icon
     * @param string $url
     * @return array 
     * @author lishengcn.cn
     */
    private function GetMarker($title, $url) {
    	if (!$html = file_get_html($url)) {
    		return false;
    	} else {
    		if ($title == ''){
    			$data['title'] = $html->find('title', 0)->plaintext;
    		} else {
    			$data['title'] = $title;
    		}
    		$data['href'] = $url;
    		if ($icon = $html->find('link[rel=shortcut icon]', 0)->href) {
    			$data['icon'] = $icon;
    		} elseif ($icon = $html->find('link[rel=shortcut icon]', 0)->href) {
    			$data['icon'] = $icon;
    		}
    		return $data;
    	}
    }
    
    /**
     * 添加书签
     * @param string $url
     * @author lishengcn.cn
     */
    public function Add($title, $url,$classification_id) {
    	if ($data = $this->GetMarker($title, $url)) {
    		$data['icon'] = $this->FormatIcon($data['href'], $data['icon']);
    		$marker = D('yunmarker');
    		$data['marker_id'] = null;
    		$data['classification_id'] = $classification_id;
    		$data['create_time'] = date('Y-m-d H:i:s',time());
    		$marker->create($data);
    		$marker_id = $marker->add($data);
    		$data['marker_id'] = $marker_id;
    		$data = json_encode($data);
    		echo $this->CreateMsg(1, $data);
    	} else {
    		echo $this->CreateMsg(0, '"获取url失败"');
    	}
    }
    
    /**
     * 删除书签
     * @param integer $marker_id
     */
    public function Del($marker_id) {
    	$marker = D('yunmarker');
    	$condition['marker_id'] = $marker_id;
    	if ($marker->where($condition)->delete() != 0) {
    		echo $this->CreateMsg(1, '"删除书签成功"');
    	} else {
    		echo $this->CreateMsg(0, '"删除书签失败"');
    	}
    }
    
    /**
     * 模糊查询书签
     * @param string $keyworld
     */
    public function Search($keyworld) {
    	$marker = D('yunmarker');
    	$condition['title'] = array('like', "%{$keyworld}%");
    	if ($data = $marker->where($condition)->select()) {
    		$data = json_encode($data);
    		echo $this->CreateMsg(1, $data);
    	} else {
    		echo $this->CreateMsg(0, '"没有找到相关信息"');
    	}
    }
    
    /**
     * 修改书签
     * @param integer $marker_id
     * @param string $title
     * @param string $href
     */
    public function Alter($marker_id, $title, $href) {
    	$marker = D('yunmarker');
    	$data['marker_id'] = $marker_id;
    	$data['title'] = $title;
    	$data['href'] = $href;
   		$data['update_time'] = date('Y-m-d H:i:s',time());
    	$marker->create($data);
    	var_dump($marker->save($data));  	
    }
    
    public function ShowAll($classification_id,$keyworld='') {
    	$marker = D('yunmarker');
    	if(!empty($keyworld))
    	{
    		$key = ' AND title=%'.$keyworld.'%';
    	}else{
    		$key = '';
    	}
    	$data = $marker->where('classification_id='.$classification_id.$key)->order('update_time desc,create_time desc')->select();
    	$this->assign('classification_id',$classification_id);
    	$this->assign('marker',$data);
    	$this->display('yun');
    }

    /**
     * 添加分类
     * @param string name
     */
    public function NewClassification(){
        $name = $_POST['name'];
        $image_data = !empty($_POST['image_data'])?$_POST['image_data']:'';
    	if(!empty($name))
    	{
            $marker = D('Classification');
            $img_path = c('default_img');
            if(!empty($image_data))
            {
                $savePath = $this->SaveImg($image_data);
                if($savePath)
                {
                   $data['img'] = $savePath; 
                   $img_path = $savePath;
                }   
            }
			$data['name'] = $name;
			$data['create_time'] = date('Y-m-d H:i:s',time());
			$marker->create($data);
			$classification_id = $marker->add($data);
			if($classification_id){
				$result = array('status'=>1,'msg'=>'新增分类成功!','res'=>array('classification_id'=>$classification_id,'name'=>$name,'img'=>$img_path));
			}else{
				$result = array('status'=>2,'msg'=>'新增分类失败!');
			}	
   	 	}else{
   	 		$result = array('status'=>2,'msg'=>'分类名称为空!');
   	 	}
    	echo json_encode($result);
    }

    /**
     * 修改分类
     *
     */
    public function EditClassification(){
        date_default_timezone_set('PRC'); 
        $classification_id = $_POST['classification_id'];
        $name = $_POST['name'];
        $image_data = $_POST['image_data'];
        $marker = M('Classification');
        $list = $marker->where('classification_id='.$classification_id)->find();
        $img_path = '';
        if(!empty($image_data))
        {
            $savePath = $this->SaveImg($image_data);
            if($savePath)
            {
               $data['img'] = $savePath; 
               $img_path = $savePath;
            }   
        }
        $data['name'] = $name;
        $data['update_time'] = date('Y-m-d H:i:s',time());
        $m = $marker->where('classification_id='.$classification_id)->save($data);
        if($m)
        {   
            if(!empty($img_path) && !empty($list['img']))
            {
                //删除原图片
                $realPath = $_SERVER['DOCUMENT_ROOT'].$list['img'];
                unlink($realPath);
            }
            $result = array('status'=>1,'msg'=>'修改分类成功!','res'=>array('classification_id'=>$classification_id,'name'=>$name,'img'=>$img_path));
        }else{
            $result = array('status'=>2,'msg'=>'修改分类失败!');
        }
        echo json_encode($result);
    }

    /**
     * 删除分类
     *
     */
    public function DeleteClassification(){
        $classification_id = (int)$_POST['classification_id'];
        $marker = M('Classification');
        $marker->startTrans();//开启事务
        $is_here = $marker->where('classification_id='.$classification_id)->find();
        if(!empty($is_here)){
            //删除分类下的书签
            $yunmarker = D('yunmarker');
            $condition['classification_id'] = $classification_id;
            if($yunmarker->where($condition)->delete())
            {
                //删除分类
                if($marker->where($condition)->delete()){
                    $marker->commit();//成功则提交
                    $result = array('status'=>1,'msg'=>'删除成功','classification_id'=>$classification_id);
                }
            }else{
                $marker->rollback();//不成功，则回滚
                $result = array('status'=>2,'msg'=>'删除失败','classification_id'=>$classification_id);
            }
        }else{
            $result = array('status'=>2,'msg'=>'此分类不存在','classification_id'=>$classification_id);
        }
        echo json_encode($result);
    }

    /**
     * 分类列表
     * 
     */
    public function ShowClassification(){
    	$marker = M('Classification');
    	$data = $marker->order('update_time desc,create_time desc')->select();
    	echo json_encode($data);
    }

    /**
     * 保存图片
     */
    public function SaveImg($base64_img)
    {
        //删除字符串前的提示信息 "data:image/png;base64," 
        $is_base64 = strpos($base64_img,"data:image/png;base64,");
        if($is_base64 !== false)
        {
            $base64_img = str_replace("data:image/png;base64,",'',$base64_img);
        }
        $realPath = c('img_path');
        //解码
        $tmp  = base64_decode($base64_img);
        $name = time().'.png';
        //写文件
        if(file_put_contents($realPath.$name, $tmp))
        {
            $savePath = '/yunmarker/client/uploads/img/'.$name;
            return $savePath;
        }else{
            return false;
        }
        
    }
}