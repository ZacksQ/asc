<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>网站管理系统</title>
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="stylesheet" href="/yy/Public/css/amazeui.min.css"/>
  <link rel="stylesheet" href="/yy/Public/css/admin.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，本网站 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>网站管理系统</strong> <small></small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas" style="height:100%;">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="<?php echo U('Index/index');?>"><span class="am-icon-home"></span> 首页</a></li>       
        
        <li><a href="<?php echo U('Index/index');?>"><span class="am-icon-file"></span> 企业信息管理</a></li>
        
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav4'}"><span class="am-icon-user"></span> 管理员管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav4">
            <li><a href="<?php echo U('Index/user_add');?>"><span class="am-icon-puzzle-piece"></span> 新增用户</a></li>
            <li><a href="<?php echo U('Index/user_edit');?>"><span class="am-icon-puzzle-piece"></span> 修改密码</a></li>
          </ul>
        </li>

        <li><a href="<?php echo U('Index/loginOut');?>"><span class="am-icon-sign-out"></span> 注销</a></li>
        <div style="height:200px;"></div>
      </ul>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">
    
  <style>
  [class*=am-u-]{
    font-size: 13px;
  }
</style>
  <div class="am-cf am-padding">
    <div class="am-fl am-cf"> <strong class="am-text-primary am-text-lg">企业管理</strong>
      /
      <small><?php echo ($title); ?></small>
    </div>
    <a href="<?php echo U('download',array('cid'=>$_GET['cid']));?>" target="_new" class="am-fr am-btn am-btn-primary am-btn-xs search-btn" id="downexcel">导出数据</a>

    <a href="javascript:;" target="_new" class="am-fr am-btn am-btn-primary am-btn-xs" onclick="window.print()">打印</a>
  </div>

  <div class="am-g">
    <div class="am-u-sm-12">      
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">企业名称：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["companyname"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">负责人：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["principal"]); ?></div>                  
          <div class="am-u-sm-4 am-u-md-2 am-text-right">Email：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["email"]); ?></div>          
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">上一年度总收入：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["lytotalrevenue"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">上一年度纳税额：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["lyratal"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">截止目前今年总收入：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["tytotalrevenue"]); ?></div>          
        </div>
     <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">截止目前今年纳税额：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["tyratal"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">累计拥有专利数：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["patent"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">发明授权：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["invent"]); ?></div>          
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">实用新型授权：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["utilitymodel"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">外观授权：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["appearance"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">软著授权：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["soft"]); ?></div>          
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">员工人数：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["employee"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">缴纳社保人数：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["paysocial"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">科技研发人员数：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["science"]); ?></div>          
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">累计获得奖项(获得时间-奖项或称号名称)：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["awardget"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">截止目前今年总收入：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["nowtotalrevenue"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">截止目前今年纳税额：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["nowratal"]); ?></div>          
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">新增专利数(注明类型)：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["typatent"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">员工人数：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["tyemployee"]); ?></div>          
        
          <div class="am-u-sm-4 am-u-md-2 am-text-right">缴纳社保人数：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["tysocial"]); ?></div>          
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-4 am-u-md-2 am-text-right">新增奖项：</div>
          <div class="am-u-sm-8 am-u-md-2">
            <?php echo ($vo["tyaward"]); ?></div> 
            <div class="am-u-sm-4 am-u-md-2 am-text-right"></div>
          <div class="am-u-sm-8 am-u-md-2">
            </div>          
        </div>
    </div>
  </div>


  </div>
  <!-- content end -->

</div>

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<!-- <footer>
  <hr>
  <p class="am-padding-left">© 2014</p>
</footer> -->

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/yy/Public/js/polyfill/rem.min.js"></script>
<script src="/yy/Public/js/polyfill/respond.min.js"></script>
<script src="/yy/Public/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/yy/Public/js/jquery.min.js"></script>
<script src="/yy/Public/js/amazeui.min.js"></script>
<!--<![endif]-->
<script src="/yy/Public/js/app.js"></script>
<script>
    // $(function(){
    //   $(".search-btn").click(function(){
    //     var formdatarr = $(".search").serializeArray();
    //     var postdata = {};
    //     $.each(formdatarr, function(i,f){
    //       postdata[f.name] = f.value;
    //     });
    //     $.ajax({
          
    //     });
    //   });
    // });
  </script>
</body>
</html>