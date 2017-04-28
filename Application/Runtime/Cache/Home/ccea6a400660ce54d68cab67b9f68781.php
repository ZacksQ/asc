<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="/yy/Public/css/style.css">
</head>
<body class="login">
	<div id="loginbox">
		<div class="logo">
			<img src="/yy/Public/images/logo.jpg" alt="">
		</div>
		<div class="loginform">
			<div class="form-item">
				<input type="text" name="username" class="txt txt-block txt-login" placeholder="请输入账号">
			</div>
			<div class="form-item">
				<input type="password" name="password" class="txt txt-block txt-login" placeholder="请输入密码">
			</div>
			<div class="form-item">
				<button class="btn btn-block btn-login">登 录</button>
			</div>
			<!-- <a href="" class="fl botfun">忘记密码？</a> -->
			<a href="<?php echo U('register');?>" class="fr botfun">注册账号</a>
			<div class="clear"></div>
		</div>
	</div>
	<script src="/yy/Public/js/jquery-1.9.1.min.js"></script>
	<script src="/yy/Public/layui/layui.js"></script>
	<script>
		$(".btn-login").click(function(){
			layui.use(["layer"],function(){
				var username = $("input[name=username]").val(),
					password = $("input[name=password]").val()

				if($.trim(username) == ""){
					layer.msg("请输入用户名");
					return false;	
				}
				
				if($.trim(password) == ""){
					layer.msg("请输入密码");
					return false;	
				}

				$.ajax({
					url: "<?php echo U('signin');?>",
					dataType: "json",
					type: "post",
					data: {"username": username, "password": password},
					success: function(d){
						if(d.success==true){
							layer.msg(d.msg, function(){
								// window.location.href="<?php echo U('login');?>";
							});
						}else{
							layer.msg(d.msg);
						}						
					}
				});
			});
		});
	</script>
</body>
</html>