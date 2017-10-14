<?php
    include('conn.php');
    $sql ="SELECT * from zuopin order by id desc";

    $result = mysqli_query($conn,$sql) or die("失败");
    $id = $_GET['id'];
    if($html = mysqli_fetch_array($result)){         
        }
    else{
            echo '<script>alert("用户不存在");history.go(-1);</script>'; 
        }

            if(isset($_GET['action'])) {
        //删除图书的动作
        if($_GET['action'] == "del") {
            //删除多个
            if(!empty($_POST['id'])) {
                $sql = "DELETE from zuopin where id in(".implode(',', $_POST['id']).")";
                //echo $sql;
            }else {
                //删除单个
                $sql = "DELETE from zuopin where id='{$_GET['id']}'";
            }

          
        



            $result = mysqli_query($conn,$sql) or die('连接失败');

            if(mysqli_affected_rows($conn)>0) {
                              
                echo "<script>alert('删除成功');</script><br>";


            } else {
                echo "<script>alert('删除失败');</script><br>";
            }   
           
        // var_dump($G);

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
         function del(){

      var msg=confirm("你确定删除此记录吗？");

      if(msg==true){

       return true;

      }else{

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
                <li><a href="http://www.jscss.me">管理员</a></li>
                <li><a href="http://www.jscss.me">修改密码</a></li>
                <li><a href="http://www.jscss.me">退出</a></li>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
            <?php
                include('conn.php');
                include('page.class.php');

                        
                            if(isset($_GET['action']) && $_GET['action']=='ser'){
                                 $tmp = !empty($_POST) ? $_POST : $_GET;
    
                                      $whr=array();
                             if(!empty($tmp['biaoti'])){
                                     $whr[] = "biaoti like '%{$tmp['biaoti']}%'";
                                  }
                                 
                      
                                      if(!empty($whr)){
                                        $where ="where".' '.implode("and", $whr);
                                        //echo $where;
                                      }else{
                                        $where = "";
                                      }
                                     
                                   }
                         //獲取總記錄數
                    $sql = "SELECT count(*) as total from zuopin {$where}";
                    //echo $sql."<br>";
                    $res = mysqli_query($conn,$sql);
                    $data = mysqli_fetch_assoc($res);

                    $num = 5;
                    //創建分頁對象
                    $page = new Page($data['total'],$num);
                        // $sql = "SELECT count(*) as total from topic {$where}";
                        $sql = "SELECT * from zuopin  {$where} order by id desc {$page->limit}";
                        //var_dump($sql);
                      //echo $sql."<br>";
                         $result = mysqli_query($conn,$sql) or die("gg");
                           echo '<form action="design.php?action=ser" method="post">';
                echo     '<table class="search-tab">';
                echo         '<tr>';
                echo           '<th width="120">选择分类:</th>';
                echo            '<td>';
                echo                '<select name="search-sort" id="">';
                echo                    '<option value="">全部</option>';        
                echo                   '<option value="19">精品界面</option><option value="20">推荐界面</option>';
                echo                '</select>';
                echo           '</td>';
                echo           '<th width="70">关键字:</th>';

                echo '<td><input class="common-text" placeholder="关键字" value="'.$tmp['biaoti'].'" name="biaoti" type="text"></td>';

                echo '<td><input class="btn btn-primary btn2" name="sersubmit" value="查询" type="submit"></td>';
                            
                echo '</tr>';
                     echo '</form>' ;  
                    echo '</table>';
                
            echo '</div>';
        echo '</div>';
       echo  '<div class="result-wrap">';
            
             echo   '<div class="result-title">';
                    echo '<div class="result-list">';
                  
                        echo '<a href="insert.php"><i class="icon-font"></i>新增作品</a>';
                         echo '<form action="design.php?action=del" method="post" >'; 
                        
                       echo '<a id="batchDel" href="design.php"><i class="icon-font"></i><input type="submit" class="adc" value="批量删除"  style="border:none;" name="dosubmit" onclick="return del()"></a>';
                       // echo '<a id="batchDel" href="design.php?action=del&id='.$id.'"><i class="icon-font"></i>批量删除</a>';
                            

                       echo '<a id="sname.php?action=sname" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>';
                    echo '</div>';
                echo '</div>';

                echo '<div class="result-content">';
                    echo '<table class="result-tab" width="100%">';
                        echo '<tr>';
                            echo '<th class="tc" width="5%"><input class="allChoose" name="id[]" type="checkbox" ></th>';
                            echo '<th>排序</th>';
                            echo '<th>ID</th>';
                            echo '<th>标题</th>';
                            echo '<th>审核状态</th>';
                            echo '<th>点击</th>';
                            echo '<th>发布人</th>';
                            echo '<th>更新时间</th>';
                            echo '<th>内容</th>';
                            echo '<th>操作</th>';
                        echo '</tr>';
            
                       
                       
                       
                        while(list($id,,$biaoti,$zuozhe,,$neirong,$time)=mysqli_fetch_row($result)){
                        echo '<tr>';
                        echo   '<td class="tc"><input type="checkbox" name="id[]" value="'.$id.'">
                    
                        </td>';
                        echo    '<td>';
                        // echo    '<input name="id[]" value="'.$id.'" type="hidden">';
                        echo    '<input class="common-input sort-input" name="ord[]" value="0" type="text"></td>';
                        echo     "<td>{$id}</td>";
                        echo     "<td title='黑色经典'>{$biaoti}</td>";
                        echo    '<td>0</td>';
                        echo    '<td>35</td>';
                        echo    "<td>{$zuozhe}</td>";
                        echo    "<td>{$time}</td>";
                        echo    "<td>{$neirong}</td>";
                        echo     '<td>';
                        echo     '<a class="link-update" name="domodify" href="xiugai.php?action=xiugai&id='.$id.'">修改</a>';
                        echo     '　';
                        echo     '<a class="link-del" onclick="return del()" href="delete.php?action=del&id='.$id.'">删除</a>';
                        echo    '</td>';
                        echo    '</tr>';
                    }
                   
                    echo  '</table>';
                    echo '<div class="list-page"> <tr><td colspan="10" align="right">'.$page->fpage().'</td></tr></div>';
                      
                  
               echo '</div>';
            echo '</form>';
            ?>
        </div>
        
    </div>
    <!--/main-->
</div>
</body>
</html>