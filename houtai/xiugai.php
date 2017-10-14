<?php
	include('classes/fileupload.class.php');
    include('classes/image.class.php');
    include('function.inc.php');
    include('conn.php');



	if(isset($_COOKIE['username'])){

		if($_GET['action'] == 'xiugai'){
			$sql = "SELECT * from zuopin where id = '{$_GET['id']}'";
			//echo $sql;
			$result = mysqli_query($conn,$sql) or die("连接失败");
			if(mysqli_num_rows($result)> 0 ) {

			list($id, $fenlei, $biaoti, $zuozhe, $tupian, $neirong, $time) = mysqli_fetch_row($result);
		}else{
			echo "没有对应的数据!<br>";
		}

		}

	}else{
		echo '<script>alert("请登录");history.go(-1)</script>';
	}
	if(isset($_POST['dosubmit'])) {

		//如果用户有添加图片的动作
		if($_FILES['pic']['error']==0) {
			$pic = upload('pic');

		
			//全部字段都要修改
			$sql = "UPDATE zuopin set fenlei='{$_POST['fenlei']}',biaoti='{$_POST['biaoti']}', zuozhe='{$_POST['zuozhe']}', tupian='{$pic}', neirong='{$_POST['neirong']}' where id='{$_GET['id']}'";
			echo $sql;
		} else {
			
			//全部字段都要修改
			$sql = "UPDATE zuopin set fenlei='{$_POST['fenlei']}', biaoti='{$_POST['biaoti']}', zuozhe='{$_POST['zuozhe']}', neirong='{$_POST['neirong']}' where id='{$_GET['id']}'";
			echo $sql;
		}

		$result = mysqli_query($conn,$sql) or die("失败");

		if( mysqli_affected_rows($conn) > 0) {
			echo "<script>alert('修改成功!');location.href='design.php';</script><br>";
		}else{
			echo "<script>alert('修改失败!');history.go(-1);</script>";
		}
	
	}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="#">管理员</a></li>
                <li><a href="#">修改密码</a></li>
                <li><a href="#">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="design.html"><i class="icon-font">&#xe008;</i>作品管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe005;</i>博文管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe006;</i>分类管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe012;</i>评论管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe052;</i>友情链接</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">作品管理</a><span class="crumb-step">&gt;</span><span>新增作品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
            <form action="xiugai.php?action=xiugai&id=<?php echo $_GET['id']; ?>" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>分类：</th>
                            <td>
                                <select name="fenlei" value="<?php echo $fenlei?>" id="catid" class="required">
                        
                                    <option  value="精品界面">精品界面</option>
                                    <option  value="推荐界面">推荐界面</option>
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>标题：</th>
                                <td>
                                    <input class="common-text required" id="title" name="biaoti" size="50" value="<?php echo $biaoti?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>作者：</th>
                                <td><input class="common-text" name="zuozhe" size="50" value="<?php echo $zuozhe?>" type="text"></td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>缩略图：</th>

                                <td><input name="pic" id="" type="file" value="<?php echo $tupian?>"><!--<input type="submit" onclick="submitForm('/jscss/admin/design/upload')" value="上传图片"/>--><?php echo $tupian?></td>
                                <img width="100" src="<?php echo "upload/th_".$tupian; ?>">
                                
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td><textarea  name="neirong" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10" >
                                <?php echo $neirong?></textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit" name="dosubmit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>