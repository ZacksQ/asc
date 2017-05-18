<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	
	// public $appid='wxd838d68f09d59d02';
 //    public $AppSecret='953fa44c48be8f22575087cb0e7cbee4';

    public function signin(){
        $user = M("users");
        $checkuser = $user->where("username = '".I("post.username")."' and password = '".sha1(I("post.password"))."'")->find();
        if($checkuser){
            $result = array(
                "success" => true,
                "msg" => "登录成功，等待跳转..."
            );
            session("userid", $checkuser["id"]);
        }else{
            $result = array(
                "success" => false,
                "msg" => "用户名或密码不正确"
            );
        }
        echo json_encode($result);
    }

    public function fpwdcheckuser(){
        $user = M('users');
        $checkuser = $user->where("username = '".I("post.reusername")."' and email = '".I("post.remail")."'")->find();
        if($checkuser){
            $result = array(
                "success" => true,
                "msg" => "请求成功"
            );
        }else{
            $result = array(
                "success" => false,
                "msg" => "输入的用户名和邮箱不对应或不存在"
            );
        }
        echo json_encode($result);
    }

    public function resetpassword(){
        $user = M('users');
        $data["password"] = sha1(I("post.password"));
        $reset = $user->where("username = '".I("post.username")."' and email = '".I("post.email")."'")->save($data);
        // echo $user->getLastSql(); exit();
        if($reset){
            $result = array(
                "success" => true,
                "msg" => "重置成功，请等待跳转..."
            );
        }else{
            $result = array(
                "success" => false,
                "msg" => "重置失败，请稍后再试，或联系管理员"
            );
        }
        echo json_encode($result);
    }

    public function login(){  
        if(session("userid")){
            $this->redirect("Index/showdata");
        }  	
        $this->display();
    }

    public function logout(){  
        session("userid",null);           
    }

    public function showdata(){
        if(session("userid")){
            $user = M("users");
            if(IS_POST){  
                if(I("post.action")=="modify"){              
                    $isuccess = $user->where("id = ".session("userid"))->save(I("post."));
                    if($isuccess){
                        $result = array(
                            "success" => true,
                            "msg" => "修改成功！"
                        );
                    }else{
                        $result = array(
                            "success" => false,
                            "msg" => "修改失败"
                        );
                    }                   
                }else if(I("post.action")=="showdata"){
                    $isuccess = $user->where("id = ".session("userid"))->find();
                    if($isuccess){
                        $result = array(
                            "success" => true,
                            "data" => $isuccess,
                            "msg" => "操作成功"
                        );
                    }else{
                        $result = array(
                            "success" => false,
                            "msg" => "获取数据失败，请稍后再试"
                        );
                    }                    
                }
                 echo json_encode($result);
            }else{
                $this->display();
            }
        }else{
            $this->redirect("Index/login");
        }
        
    }

    public function register(){
        $username = I("post.username");        
    	if(IS_POST){
            $isrepeat = $this->checkuser($username);
            if(!$isrepeat){
                $result = array(
                    "success" => false,
                    "msg" => "用户名已重复"
                );
            }else{
                $user = M("users");
                $postdata = I("post.");
                $postdata["password"] = sha1($postdata["password"]);
                $insertuser = $user->add($postdata);
                if($insertuser){
                    $result = array(
                        "success"=> true,
                        "msg" => "注册成功，等待跳转..."
                    );
                }else{
                    $result = array(
                        "success"=> false,
                        "msg" => "注册失败"
                    );
                }
            }
            echo json_encode($result);
        }else{
            $this->display();
        }
    }

    public function checkuser($username=null){
        $user = M("users");
        $checkuser = $user->where("username = '".$username."'")->find();
        if($checkuser){
            $result =  false;
        }else{
            $result = true;
        }
        return $result;
    }
}