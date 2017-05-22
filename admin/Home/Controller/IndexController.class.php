<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public $infolist;
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

	public function cms_edit(){
		$this->isLogin();
		$Cms = M("users");
		$data = $Cms->where("id='{$_GET['cid']}'")->find();
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
			// if($action == 'export'){
	        	// if(!$infolist){
	        	//     $this->error('没有搜索结果，无法导出数据');
	        	// }
	        	// $this->goods_export($infolist);
	        // }
		}		
		$this->assign('infolist',$infolist);
		$this->display("index");
	}

	public function download(){
		$Cms = M("users");
		$data = $Cms->where("id='{$_GET['cid']}'")->select();
    	if(!$data){
    	    $this->error('没有搜索结果，无法导出数据');
    	}
    	$this->goods_export($data);
	}


	public function cms_delete(){
		$this->isLogin();
		$Cms = M("users");
		$Cms->where("id='{$_GET['id']}'")->delete();
		$this->success('数据删除成功！',U('Index/index'));
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

	protected function goods_export($infolist=array())
    {
        // print_r($infolist);exit;
        $infolist = $infolist;
        $data = array();
        foreach ($infolist as $k=>$info_info){
        	// echo $info_info['id'];exit;
            $data[$k][id] = $info_info['id'];
            $data[$k][companyname] = $info_info['companyname'];
            $data[$k][tel] = $info_info['tel'];
            $data[$k][principal] = $info_info['principal'];
            $data[$k][email] = $info_info['email'];
            $data[$k][lytotalrevenue]  = $info_info['lytotalrevenue'];
            $data[$k][lyratal]  = $info_info['lyratal'];
            $data[$k][tytotalrevenue]  = $info_info['tytotalrevenue'];
            $data[$k][tyratal] = $info_info['tyratal'];
            $data[$k][patent] = $info_info['patent'];
            $data[$k][invent] = $info_info['invent'];
            $data[$k][utilitymodel] = $info_info['utilitymodel'];
            $data[$k][appearance] = $info_info['appearance'];
            $data[$k][soft] = $info_info['soft'];
            $data[$k][employee] = $info_info['employee'];
            $data[$k][paysocial] = $info_info['paysocial'];
            $data[$k][science] = $info_info['science'];
            $data[$k][awardget] = $info_info['awardget'];
            $data[$k][nowtotalrevenue] = $info_info['nowtotalrevenue'];
            $data[$k][nowratal] = $info_info['nowratal'];
            $data[$k][typatent] = $info_info['typatent'];
            $data[$k][tyemployee] = $info_info['tyemployee'];
            $data[$k][tysocial] = $info_info['tysocial'];
            $data[$k][tyaward] = $info_info['tyaward'];
        }

        // print_r($infolist);
        // print_r($data);exit;

        foreach ($data as $field=>$v){
            if($field == 'id'){
                $headArr[]='产品id';
            }

            if($field == 'companyname'){
                $headArr[]='公司名称';
            }

            if($field == 'tel'){
                $headArr[]='联系电话';
            }

            if($field == 'principal'){
                $headArr[]='负责人';
            }

            if($field == 'email'){
                $headArr[]='零件号';
            }

            if($field == 'lytotalrevenue'){
                $headArr[]='上一年度总收入面价';
            }

            if($field == 'lyratal'){
                $headArr[]='上一年度纳税额';
            }

            if($field == 'tytotalrevenue'){
                $headArr[]='截止目前今年总收入';
            }
            if($field == 'tyratal'){
                $headArr[]='截止目前今年纳税额';
            }

            if($field == 'patent'){
                $headArr[]='累计拥有专利数';
            }

            if($field == 'invent'){
                $headArr[]='发明授权';
            }

            if($field == 'utilitymodel'){
                $headArr[]='实用新型授权';
            }

            if($field == 'appearance'){
                $headArr[]='外观授权';
            }

            if($field == 'soft'){
                $headArr[]='软著授权';
            }

            if($field == 'employee'){
                $headArr[]='员工人数';
            }

            if($field == 'paysocial'){
                $headArr[]='缴纳社保人数';
            }

            if($field == 'science'){
                $headArr[]='科技研发人员数';
            }

            if($field == 'awardget'){
                $headArr[]='累计获得奖项';
            }

            if($field == 'nowtotalrevenue'){
                $headArr[]='截止目前今年总收入';
            }

            if($field == 'nowratal'){
                $headArr[]='截止目前今年纳税额';
            }

            if($field == 'typatent'){
                $headArr[]='新增专利数';
            }

            if($field == 'tyemployee'){
                $headArr[]='员工人数';
            }

            if($field == 'tysocial'){
                $headArr[]='缴纳社保人数';
            }
            
            if($field == 'tyaward'){
                $headArr[]='新增奖项';
            }
        }

        $filename="goods_list";

        $this->getExcel($filename,$headArr,$data);
    }

	private  function getExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");

        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);

        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
}