<?php
	$conn= mysqli_connect("localhost","root","123456","test1","3306") or die("连接失败");
	mysqli_query($conn,"set names utf8");
	error_reporting(E_ALL || ~E_NOTICE);
	header("Content-Type: text/html; charset=utf-8");
?>