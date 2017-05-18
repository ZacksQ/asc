<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>爱双创-忘记密码</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	<link rel="stylesheet" href="/yy/Public/layui/css/layui.css">
	<link rel="stylesheet" href="/yy/Public/css/style.css">
</head>
<body class="register">
	<form class="registerform" action="" method="post">
		
	</form>
	<script src="/yy/Public/js/jquery-1.9.1.min.js"></script>
	<script src="/yy/Public/layui/layui.js"></script>
	<script type="text/html" id="step1">
		<fieldset>
			<div class="form-item">
				<label for="">注册时填写的用户名</label>
				<input type="text" name="reusername" class="txt">
			</div>
			<div class="form-item">
				<label for="">注册时填写的邮箱</label>
				<input type="text" name="remail" class="txt">
			</div>
		</fieldset>
		<button class="btn btn-block btn-register">下一步</button>
	</script>
	<script type="text/html" id="step2">
		<fieldset>
			<div class="form-item">
				<label for="">新密码</label>
				<input type="password" name="password" class="txt">
			</div>
			<div class="form-item">
				<label for="">确认密码</label>
				<input type="password" name="confirmpwd" class="txt">
			</div>
		</fieldset>
		<button class="btn btn-block btn-reset">密码重置</button>
	</script>
	<script>
		$(".registerform").html($("#step1").html());
		// $("#step1").
		var user = {};
		$(".btn-register").click(function(){
			var formdatarr = $(".registerform").serializeArray();
			var postdata = {};
			$.each(formdatarr, function(i,f){
				postdata[f.name] = f.value;
			});

			layui.use(["layer"],function(){
				if($.trim(postdata.reusername) == ""){
					layer.msg("注册时填写的用户名不能为空");
					return false;	
				}
				if($.trim(postdata.remail) == ""){
					layer.msg("注册时填写的邮箱不能为空");
					return false;	
				}
				
				$.ajax({
					url: "<?php echo U('fpwdcheckuser');?>",
					dataType: "json",
					type: "post",
					data: postdata,
					success: function(d){
						if(d["success"]){
							$(".registerform").html($("#step2").html());
							$(".btn-reset").click(resetpwd);
							user.username = postdata.reusername;
							user.email = postdata.remail;
						}
						else{
							layer.msg(d.msg);
						}
					}
				});
			});
			return false;
		});

		function resetpwd(){
			var formdatarr = $(".registerform").serializeArray();
			var postdata = {};
			$.each(formdatarr, function(i,f){
				postdata[f.name] = f.value;
			});

			layui.use(["layer"],function(){
				if($.trim(postdata.password) == ""){
					layer.msg("密码不能为空");
					return false;	
				}
				if($.trim(postdata.confirmpwd) == ""){
					layer.msg("确认密码不能为空");
					return false;	
				}
				if($.trim(postdata.password) != $.trim(postdata.confirmpwd)){
					layer.msg("密码填写不一致");
					return false;	
				}
				postdata.username = user.username;
				postdata.email = user.email;
				$.ajax({
					url: "<?php echo U('resetpassword');?>",
					dataType: "json",
					type: "post",
					data: postdata,
					success: function(d){
						if(d["success"]){
							layer.msg(d.msg,function(){
								window.location.href="login.html";
							});
						}
						else{
							layer.msg(d.msg);
						}
					}
				});
			});
			return false;
		}
	</script>
</body>
</html>