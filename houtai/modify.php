<?php
	include('conn.php');
	if($_GET['action']=='modify'){
		 $sql = "SELECT * from admin where username = '{$_COOKIE['username']}'";
         $result = mysqli_query($conn,$sql) or die("失败");
         $num = mysqli_num_rows($result);
         	if($num){
         		$_clean = array();
         		$_clean['username'] = trim($_POST["username"]);
         		$_clean['userpwd'] = md5($_POST['userpwd']);
         	}
         		if(empty($_POST['userpwd'])){
				$sql = "UPDATE `admin` SET username='{$_clean['username']}' WHERE username='{$_COOKIE['username']}'";
				
			}else{
				$sql = "UPDATE `admin` SET userpwd='{$_clean['userpwd']}' WHERE username='{$_COOKIE['username']}'";
			}
			$result = mysqli_query($conn, $sql) or die("失败"); 
			if(mysqli_affected_rows($conn)){
				echo "<script>alert('修改成功');location.href='index.php';</script>";
			}else{
				echo "<script>alert('修改失败');history.go(-1);</script>";
			exit();
			}

	}


	  if(isset($_COOKIE['username'])){
        
        $sql = "SELECT * from admin where username = '{$_COOKIE['username']}'";
        // echo $sql;
        $result = mysqli_query($conn,$sql) or die("失败");
	 if($html = mysqli_fetch_array($result)){

		 }else{
		 	echo "<script>alert('用户不存在');history.go(-1);</script>";
		 }
	}else{
		echo "<script>alert('用户不存在');history.go(-1);</script>";
	}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台登录</title>
    <link href="css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>后台管理</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="?action=modify" method="post">
                <ul class="admin_items">
                 <li>
                        <label for="user">用户：</label>
                        <input type="text" name="username" value="<?php echo $html['username']?>" id="user" size="35" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="newpwd">新密码：</label>
                        <input type="password" name="userpwd" value="" id="newpwd" size="35" class="admin_input_style" />
                    </li>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                        <span><input type="hidden" name="hidden" value="hidden"></span>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
</html>