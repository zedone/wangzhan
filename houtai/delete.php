<?php
include('conn.php');
if(isset($_COOKIE['username'])){

	 if($_GET['action'] == "del"){
		
		if(!empty($_POST['id'])) {
				$sql = "DELETE from zuopin where id in(".implode(',', $_GET['id']).")";
				
			}
		
	else{
		//删除单个
		$sql = "DELETE from zuopin where id = '{$_GET['id']}'";
		
	}
		echo $sql;
		echo '<br>';
		$result = mysqli_query($conn,$sql) or die("连接失败");
		if(mysqli_affected_rows($conn)>0){
			 echo "<script>alert('删除成功');location.href='design.php';</script>";
		}else{
			 echo '<script>alert("删除失败");history.go(-2);</script>';
		}
		print_r($_GET);
		echo '<br>';
		print_r($_POST);
	}

}else{
	echo '<script>alert("请登录");history.go(-1);</script>';
}

?>