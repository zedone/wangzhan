<?php
    include('classes/fileupload.class.php');
    include('classes/image.class.php');
    include('function.inc.php');
    include('conn.php');
       if(isset($_COOKIE['username'])){
       
        $sql = "SELECT * from admin where username = '{$_COOKIE['username']}'";
        
        $result = mysqli_query($conn,$sql) or die("false");
        
        if($html = mysqli_fetch_array($result)){         
        }
        
        }else{
        echo "<script>alert('用户不存在');history.go(-1);</script>";
    }

       

        if(isset($_POST['dosubmit'])) {

        $pic = upload("pic");

        if(!$pic) {
            echo "文件上传失败";
        }


        $sql = "insert into zuopin(fenlei,biaoti,zuozhe,tupian,neirong,time) values('{$_POST['fenlei']}', '{$_POST['biaoti']}', '{$_POST['zuozhe']}', '{$pic}', '{$_POST['neirong']}', now())";

    //  echo $sql."<br>";  //debug output sql

        $result = mysqli_query($conn,$sql) or die("失败");


        if(mysqli_affected_rows() > 0) {
            echo "<script>alert('添加成功');location.href='design.php';</script>";
         }else {
            echo "<script>alert('添加成功');history.go(-1);</script>";
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
    <script type="text/javascript">
            function checkinput(){
                if(myform.biaoti.value==""){
                    alert("请选择标题");
                    // myform(表单名).username(表单里的东西).focus()（接受焦点） 
                    myform.biaoti.focus();
                    return false;
                }
                if(myform.fenlei.value==""){
                    alert("请选择分类");
                    myform.pwd.focus();
                    return false;
                }
                if(myform.pic.value==""){
                    alert("请上传图片");
                    myform.pic.focus();
                    return false;
                }
                
            }
    </script>
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
                        <li><a href="design.php"><i class="icon-font">&#xe008;</i>作品管理</a></li>
                        <li><a href="design.php"><i class="icon-font">&#xe005;</i>博文管理</a></li>
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
                <form action="insert.php" method="post" id="myform" name="myform" enctype="multipart/form-data" onsubmit="return checkinput()">
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>分类：</th>
                            <td>
                                <select name="fenlei" id="catid" class="required">
                                    <option name="fenlei" value="">请选择</option>
                                    <option name="fenlei" value="精品界面">精品界面</option>
                                    <option name="fenlei" value="推荐界面">推荐界面</option>
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>标题：</th>
                                <td>
                                    <input class="common-text required" id="title" name="biaoti" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>作者：</th>
                                <td><input class="common-text" name="zuozhe" size="50" value="" type="text"></td>
                            </tr>
                            <tr>

                                <th><i class="require-red">*</i>缩略图：</th>

                                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                                <img width="100" src="">
                                <td><input name="pic" id="" type="file"> --><!--<input type="submit" onclick="submitForm('/jscss/admin/design/upload')" value="上传图片"/>-->

                                 <td><input name="pic" id="" type="file" value="<?php echo $tupian?>"><!--<input type="submit" onclick="submitForm('/jscss/admin/design/upload')" value="上传图片"/>--><?php echo $tupian?></td>
                                
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td><textarea name="neirong" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"></textarea></td>
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