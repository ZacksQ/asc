<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$this->isLogin();
    	$infolist=M('users')->select();
    	$this->assign('infolist',$infolist);
        $this->display();
    }

    public function num(){
    	$this->isLogin();
    	$infolist=M('awardnum')->order('id asc')->select();
    	$this->assign('infolist',$infolist);
        $this->display();
    }
    public function login(){
		if(IS_POST){
			$Admin = M('admin');
			$pass = $Admin->where("username = '{$_POST['username']}'")->getField('password');
			if(sha1($_POST['password']) == $pass){
				session(array('name'=>'name','expire'=>3600));
				session('name',$_POST['username']);
				//session('userid',$userid);
				$this->success('登陆成功','index');
			}else{
				$this->error('你输入的信息有误，请重新输入！');
			}
		}else{
			$this->display();
		}
	}

	public function message(){
    	$this->isLogin();
    	$infolist=M('message')->order('id desc')->select();
    	$this->assign('infolist',$infolist);
        $this->display();
    }

    public function msg_delete(){
    	$this->isLogin();
		$Cms = M("message");
		$Cms->where("id='{$_GET['id']}'")->delete();
		$this->success('数据删除成功！',U('Index/message'));
    }

    public function customer(){
    	$this->isLogin();
    	$infolist=M('users')->order('id desc')->select();
    	$this->assign('infolist',$infolist);
        $this->display();
    }

    public function customer_delete(){
    	$this->isLogin();
		$Cms = M("users");
		$Cms->where("id='{$_GET['id']}'")->delete();
		$this->success('数据删除成功！',U('Index/customer'));
    }
    public function customer_edit(){
    	$this->isLogin();
		$Cms = M("users");
		$data['isblack']=1;
		$Cms->where("id='{$_GET['cid']}'")->save($data);
		$this->success('用户拉黑成功！',U('Index/customer'));
    }
    public function msg_pass(){
    	$this->isLogin();
		$Cms = M("message");
		$data['isshow']=1;
		$Cms->where("id='{$_GET['cid']}'")->save($data);
		$auditingid['msgid']=$_GET['cid'];
		$result=M('auditing')->add($auditingid);
		$this->success('数据审核通过！',U('Index/message'));
    }    
    
	public function cms_add(){
		$this->isLogin();
		if(IS_POST){
			$cms=M('customer');
			$data=$_POST;
			$info= $this->uploadImg();
			if($info['pic']['savename'])
			$data['pic'] =__ROOT__.'/public/'.$info['pic']['savepath'].$info['pic']['savename'];
			if($cms->add($data))
				$this->success('数据添加成功！',U('Index/index'));
		}else{
			$this->display();
		}
	}

	public function lot_add(){
		$this->isLogin();
		if(IS_POST){
			$cms=M('award');
			$data=$_POST;
			if($cms->add($data))
				$this->success('数据添加成功！',U('Index/lottery'));
		}else{
			$this->display();
		}
	}

	public function num_add(){
		$this->isLogin();
		if(IS_POST){
			$cms=M('awardnum');
			$data=$_POST;
			if($cms->add($data))
				$this->success('数据添加成功！',U('Index/num'));
		}else{
			$this->display();
		}
	}

	public function filter(){
		$this->isLogin();
		$infolist=M('filter')->order('id desc')->select();
    	$this->assign('infolist',$infolist);
        $this->display();
	}

	public function filter_add(){
		$this->isLogin();
		if(IS_POST){
			$cms=M('filter');
			$data=$_POST;			
			if($cms->add($data))
				$this->success('数据添加成功！',U('Index/filter'));
		}else{
			$this->display();
		}
	}

	public function filter_delete(){
    	$this->isLogin();
		$Cms = M("filter");
		$Cms->where("id='{$_GET['id']}'")->delete();
		$this->success('数据删除成功！',U('Index/filter'));
    }
	public function cms_edit(){
		$this->isLogin();
		$Cms = M("users");
		$data = $Cms->where("id='{$_GET['cid']}'")->find();
		$data['content'] = stripslashes($data['content']);
		$this->assign('title',"企业信息");
		$this->assign('vo',$data);
		$this->display("cms_add");
		
	}
	public function cms_search(){
		if(IS_POST){
			$Cms = M('users');
			foreach (I("post.") as $key => $value) {
				if($value){
					$condition[$key] = strval($value);
				}
			}		
			$condition["_logic"] = "OR";
			
			$infolist = $Cms->where($condition)->select();
			// echo $Cms->getLastSql();
			$this->assign('infolist',$infolist);
		}		

		$this->display("index");
	}
public function lot_edit(){
		$this->isLogin();
		if (IS_POST){
			$data = $_POST;
			
	    	$Cms = M("award");
	    	// $data['cate_id'] = $_GET['cid'];
	    	if($Cms->where("id = '{$_GET['cid']}'")->save($data)){
	    		$this->success('数据更新成功！',U('Index/lottery'));
	    	}else{
	    		$this->error('数据更新失败！',U('Index/lottery'));
	    	}
		}else{
			$Cms = M("award");
			$data = $Cms->where("id='{$_GET['cid']}'")->find();
			
	
			$this->assign('vo',$data);
			$this->display("lot_add");
		}
	}

	public function num_edit(){
		$this->isLogin();
		if (IS_POST){
			$data = $_POST;
			
	    	$Cms = M("awardnum");
	    	// $data['cate_id'] = $_GET['cid'];
	    	if($Cms->where("id = '{$_GET['cid']}'")->save($data)){
	    		$this->success('数据更新成功！',U('Index/num'));
	    	}else{
	    		$this->error('数据更新失败！',U('Index/num'));
	    	}
		}else{
			$Cms = M("awardnum");
			$data = $Cms->where("id='{$_GET['cid']}'")->find();
			
	
			$this->assign('vo',$data);
			$this->display("num_add");
		}
	}

	public function setting(){
		$this->isLogin();
		$setting=M('setting');
		if(IS_POST){
			$data = $_POST;
			if(!isset($data['auditing']))
				$data['auditing']=0;
			else
				$data['auditing']=1;
			$info= $this->uploadImg();
			if($info['codepic']['savename'])
				$data['codepic'] =__ROOT__.'/public/'.$info['codepic']['savepath'].$info['codepic']['savename'];
			if($info['logo']['savename'])
				$data['logo'] =__ROOT__.'/public/'.$info['logo']['savepath'].$info['logo']['savename'];
		
			if($setting->where('id=1')->save($data)){
				$this->success('数据更新成功！',U('Index/setting'));
			}else{
				$this->error('数据更新失败！',U('Index/setting'));
			}
		}else{			
			$data=$setting->where('id=1')->find();
			$this->assign("data",$data);
			$this->display();
		}
		
	}


	public function cms_delete(){
		$this->isLogin();
		$Cms = M("users");
		$Cms->where("id='{$_GET['id']}'")->delete();
		$this->success('数据删除成功！',U('Index/index'));
	}

	public function lot_delete(){
		$this->isLogin();
		$Cms = M("award");
		$Cms->where("id='{$_GET['id']}'")->delete();
		$this->success('数据删除成功！',U('Index/lottery'));
	}
	public function num_delete(){
		$this->isLogin();
		$Cms = M("awardnum");
		$Cms->where("id='{$_GET['id']}'")->delete();
		$this->success('数据删除成功！',U('Index/num'));
	}
	private function isLogin(){
		if(!$_SESSION['name']){
			$this->redirect('Index/login');
		}
		
	}

	public function loginOut(){
		session('name',null);
		$this->success('退出登陆成功','login');
	}

	public function user_add(){
		$this->isLogin();
		if(IS_POST){
			$Admin = M('admin');
			if($Admin->where("username = '{$_POST['title']}'")->find()){
				$this->error('该用户名已存在，请重新输入！');
			}
			if($_POST['password'] == $_POST['repass']){
				
				$data = array("username"=>$_POST['title'],'password'=>sha1($_POST['password']));
				$Admin->add($data);
				$this->success('新增用户成功！');
			}else{
				$this->error('两次输入密码不符，请重新输入！');
			}
		}else{
			$this->display();
		}
	}
	public function user_edit(){
		$this->isLogin();
		if(IS_POST){
			$Admin = M('admin');
			$username = $_SESSION['name'];
			if($_POST['password'] == $_POST['repass']){
				$data = array('password'=>sha1($_POST['password']));
				$Admin->where("username = '{$username}'")->save($data);
				$this->success('密码修改成功！');
			}else{
				$this->error('两次输入密码不符，请重新输入！');
			}
		}else{
			$this->display();
		}
	}

	public function uploadImg(){
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Public/'; // 设置附件上传根目录
	    $upload->savePath  =     'Uploads/'; // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->upload();
	
		    return $info;
	
	}

	public function test(){
		if(IS_POST){
		$info=$this->uploadImg();
			print_r($info['pic']);
			//echo $this->uploadImg();
		}

		$this->display();
	}

	public function navsetting(){
		$this->isLogin();
		if(IS_POST){
			$data = $_POST;
			if(!isset($data['nav1']))
				$nav1['isshow']=0;
			else
				$nav1['isshow']=1;
			if(!isset($data['nav2']))
				$nav2['isshow']=0;
			else
				$nav2['isshow']=1;
			if(!isset($data['nav3']))
				$nav3['isshow']=0;
			else
				$nav3['isshow']=1;
			if(!isset($data['nav4']))
				$nav4['isshow']=0;
			else
				$nav4['isshow']=1;
			if(!isset($data['nav5']))
				$nav5['isshow']=0;
			else
				$nav5['isshow']=1;
			if(!isset($data['nav6']))
				$nav6['isshow']=0;
			else
				$nav6['isshow']=1;
			if(!isset($data['nav7']))
				$nav7['isshow']=0;
			else
				$nav7['isshow']=1;
			if(!isset($data['nav8']))
				$nav8['isshow']=0;
			else
				$nav8['isshow']=1;
			$upn1=M('nav')->where('id=1')->save($nav1);
			$upn1=M('nav')->where('id=2')->save($nav2);
			$upn1=M('nav')->where('id=3')->save($nav3);
			$upn1=M('nav')->where('id=4')->save($nav4);
			$upn1=M('nav')->where('id=5')->save($nav5);
			$upn1=M('nav')->where('id=6')->save($nav6);
			$upn1=M('nav')->where('id=7')->save($nav7);
			$upn1=M('nav')->where('id=8')->save($nav8);
		}
		$result=M('nav')->select();
		$this->assign('navlist',$result);
		$this->display();
	}

	public function init(){
		$this->isLogin();
		if(IS_POST){
			$result1=M('message')->where('id>0')->delete();
			$result2=M('shakeact')->where('id>0')->delete();
			$result3=M('shakecount')->where('id>0')->delete();
			$result4=M('users')->where('id>0')->delete();
			if($result1&&$result2&&$result3&&$result4){
				$this->success('数据清空成功！',U('Index/init'));
			}else{
				$this->error('数据清空失败！',U('Index/init'));
			}
		}else{
			$this->display();
		}
	}
}