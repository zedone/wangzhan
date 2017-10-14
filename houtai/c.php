<?php 

	function _set($user){

		setcookie("username",$user,time()+3600,"/","localhost");

	}

?>