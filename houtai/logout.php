<?php 
	header("Content-Type:text/html;charset=utf-8");
	if(isset($_COOKIE["username"])){
		  if(@setcookie('username',"",time()-3600,"/","localhost")){
            echo "<script>alert('退出成功！');location.href='login.html'</script>";
        }else{
            echo "<script>alert('退出失败！');window.history.go(-1);</script>";
            echo "<script type='text/javascript'>location:reload();</script>";
        }
	}

?>