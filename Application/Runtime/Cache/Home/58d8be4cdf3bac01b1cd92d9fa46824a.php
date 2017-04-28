<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户中心</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	<link rel="stylesheet" href="/yy/Public/layui/css/layui.css">
	<link rel="stylesheet" href="/yy/Public/css/style.css">
</head>
<body class="register">
	<form class="registerform" action="" method="post">
		<fieldset>
			<!-- <div class="form-item">
				<label for="">每季度更新数据</label>
			</div> -->
			<div class="form-item">
				<label for="">截止目前今年总收入</label>
				<input type="text" name="nowtotalrevenue" class="txt">
			</div>
			<div class="form-item">
				<label for="">截止目前今年纳税额</label>
				<input type="text" name="nowratal" class="txt">
			</div>
			<div class="form-item">
				<label for="">新增专利数(注明类型)</label>
				<input type="text" name="typatent" class="txt">
			</div>
			<div class="form-item">
				<label for="">员工人数</label>
				<input type="text" name="tyemployee" class="txt">
			</div>
			<div class="form-item">
				<label for="">缴纳社保人数</label>
				<input type="text" name="tysocial" class="txt">
			</div>
			<div class="form-item">
				<label for="">新增奖项</label>
				<input type="text" name="tyaward" class="txt">
			</div>
		</fieldset>
		<button class="btn btn-block btn-register">修 改</button>
	</form>
	<script src="/yy/Public/js/jquery-1.9.1.min.js"></script>
	<script src="/yy/Public/layui/layui.js"></script>
	<script>
		$.ajax({
				url: "<?php echo U('showdata');?>",
				dataType: "json",
				type: "post",
				data:{"action":"showdata"},
				success: function(d){
					if(d.success==true){
						var data = d.data;
						$("input[name=nowtotalrevenue]").val(data["nowtotalrevenue"]);
						$("input[name=nowratal]").val(data["nowratal"]);
						$("input[name=typatent]").val(data["typatent"]);
						$("input[name=tyemployee]").val(data["tyemployee"]);
						$("input[name=tysocial]").val(data["tysocial"]);
						$("input[name=tyaward]").val(data["tyaward"]);
					}					
				}
			});

		$(".btn-register").click(function(){
			var formdatarr = $(".registerform").serializeArray();
			var postdata = {"action":"modify"};
			$.each(formdatarr, function(i,f){
				postdata[f.name] = f.value;
			});

			layui.use(["layer"],function(){
				if($.trim(postdata.nowtotalrevenue) == ""){
					layer.msg("截止目前今年总收入不能为空");
					return false;	
				}
				if($.trim(postdata.nowratal) == ""){
					layer.msg("截止目前今年纳税额不能为空");
					return false;	
				}
				if($.trim(postdata.typatent) == ""){
					layer.msg("新增专利数不能为空");
					return false;	
				}
				if($.trim(postdata.tyemployee) == ""){
					layer.msg("员工人数不能为空");
					return false;	
				}
				if($.trim(postdata.tysocial) == ""){
					layer.msg("缴纳社保人数不能为空");
					return false;	
				}
				if($.trim(postdata.tyaward) == ""){
					layer.msg("新增奖项不能为空");
					return false;	
				}
				$.ajax({
					url: "<?php echo U('showdata');?>",
					dataType: "json",
					type: "post",
					data: postdata,
					success: function(d){
					
							layer.msg(d.msg);
		
					}
				});
			});
			return false;
		});
	</script>
</body>
</html>