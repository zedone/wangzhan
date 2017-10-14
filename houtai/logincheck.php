<?php 
	header("Content-Type:text/html;charset=utf-8");
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include('c.php');
	if(isset($_POST["hidden"]) && $_POST["hidden"] == "hidden"){

		$user = trim($_POST["username"]); 

		$pws = md5(trim($_POST["userpwd"]));
		
		if($user==""||$pws==""){
			echo "<script>alert('输入用户名或者密码');history.go(-1);</script>";
			exit;
		} 
		 else{
		 	
		 	$conn = mysqli_connect("localhost","root","123456") or die("失败");
		 	if(mysqli_error($conn)){
					echo mysqli_error();
					exit;
			 }
		mysqli_select_db($conn,"test1");
		mysqli_set_charset($conn,"utf8");
		$sql = "select username,userpwd from admin where username = '$user' and userpwd = '$pws'";
		$result = mysqli_query($conn,$sql);
		$num = mysqli_num_rows($result);
		echo $num;
		 if($num){ 
				_set($user);
				mysqli_close($conn);
				echo "<script>alert('成功登录'); window.location.href='index.php';</script>"; 
 					} else{ 
 						mysqli_close($conn);
 					echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
 					exit; 
 					} 
 				} 
 			}else { 
 				   echo "<script>alert('提交未成功！');</script>"; 
 				}

?>