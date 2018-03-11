<?php 
session_start();
require 'getAppInfo.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" href="../css/mb.css"  rel="stylesheet" />
<link href="../css/showInfo.css" type="text/css" rel="stylesheet" />
<title>大创数据展示平台</title>
<!--百度地图密钥:GjVjUaTgRSfmQ2u4ZqW8kS9MojwCzvZ4-->
</head>
<body>
<div id = "top_div">
	<div id = "myTitle">
    	<span id = "titleContent" ><span id =  "important">&nbsp;&nbsp;大创</span>&nbsp;&nbsp;数据展示平台</span>
    </div>
    <div id = "userInfo">
    	<img src="../images/用户图标1.jpg" id = "userImg" />
        <span id = "userWelcome">Welcome &nbsp;&nbsp;&nbsp;&nbsp;<span id = "username"><?php 
		if(isset($_SESSION['username'])) echo $_SESSION['username'];
		else echo "张三";?></span></span>
    </div>
</div>
<div id = "mid_div">
<?php
$l_record = sizeof($record);
for($k = 0;$k < $l_record;$k++)
{


?>
	<div class = "maxDiv">
<?php
		$userName = $record[$k]['userName'];
		$id = $record[$k]['userId'];
		$userInfo = $record[$k]['userInfo'];
		//echo "username = ".$userName."<br/>";
		//echo "userInfo = ".$userInfo."<br/>";
		$pushApp = getList($userInfo);
?>
		<div class = "indexDiv">
			<span class = "userName1" > 用户名:<span class = "userName2"><?php echo $userName;?></span></span>
			<span class = "userId1" > 用户编号:<span class = "userId2" ><?php echo $id;?></span></span>
		</div>
		<div class = "firstDiv">
			<div class = "circle1">
			<span class = "num1">1</span>
			</div>
			<span class = "app1" style = "font-size:
			<?php 
				$appName = $pushApp[1]['name'];
				$len = mb_strlen($appName);
				if($len >= 8 && preg_match('/[\x{4e00}-\x{9fa5}]/u', $appName) == 0) echo "14px";
				else if($len >= 8) echo "20px;";
				else if($len >= 7) echo "22px;";
				else if($len >= 6) echo "24px;";
			?>
			">
			<?php echo $appName;?></span>
			<div class = "app1_level">推荐指数：<span class = "app1_score"><?php echo $pushApp[1]['score'];?></span></div>
		</div>
		<div class = "secondDiv">
			<div class = "circle2">
			<span class = "num2">2</span>
			</div>
			 <span class = "app2" style = "font-size:
			<?php 
				$appName = $pushApp[2]['name'];
				$len = mb_strlen($appName);
				if($len >= 8) echo "18px;";
				else if($len >= 7) echo "20px;";
				else if($len >= 6) echo "24px;";
			?>
			">
			<?php echo $appName;?></span>
			<div class = "app2_level">推荐指数：<span class = "app2_score"><?php echo $pushApp[2]['score'];?></span></div>
		</div>
		<div class = "lastDiv">
		<?php
				 $l = sizeof($pushApp) > 9 ? 9:sizeof($pushApp);
				 for($i = 4;$i <= $l;$i++)
				 {
		?>
			<div class = "other">
				<?php echo $i;?> &nbsp;&nbsp;
				<span style = "font-size:
			<?php 
				$appName = $pushApp[$i]['name'];
				$len = mb_strlen($appName);
				if($len > 5) echo "11px;";
				else if($len >= 4) echo "12px;";
			?>
			">
				<a title="<?php echo $appName;?>">
				<?php 
				if($len > 8 && preg_match('/[\x{4e00}-\x{9fa5}]/u', $appName) == 0) echo mb_substr($appName,0,8)."...";
				else if($len <= 8 && preg_match('/[\x{4e00}-\x{9fa5}]/u', $appName) == 0) echo $appName;
				else if($len > 6)
					echo mb_substr($appName,0,5)."...";
				else 
					echo $appName;
				?>
                </a></span>
				<span class = "other_score"><?php echo $pushApp[$i]['score'];?></span>
			</div>
		   <?php  }?>
		</div>
		<div class = "thirdDiv">
			<div class = "circle3">
			<span class = "num3">3</span>
			</div>
			 <span class = "app3" style = "font-size:
			<?php 
				$appName = $pushApp[3]['name'];
				$len = mb_strlen($appName);
				if($len >= 12) echo "12px";
				else if($len >= 8 && preg_match('/[\x{4e00}-\x{9fa5}]/u', $appName) == 0) echo "16px";
				else if($len >= 8) echo "14px;";
				else if($len >= 5) echo "16px;";
				else if($len >= 4) echo "22px;";
			?>
			">
			<?php echo $appName;?></span>
			<div class = "app3_level">推荐指数：<span class = "app3_score"><?php echo $pushApp[3]['score'];?></span></div>
		</div>
	</div>
<?php 
	}
?>
 <?php	//分页
if($page > 1){
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".($page-1)."' ><上一页</a>";
}else{
    $page_banner.="<span class='disable'>首页</span>";
    $page_banner.="<span class='disable'><上一页</span>";
}

if($total_pages > $showpage){
    if($page > $pageoffset+1){
        $page_banner.="...";
    }
    if($page > $pageoffset){
        $start = $page - $pageoffset;
        $end = $total_pages > $page+$pageoffset?$page+$pageoffset:$total_pages;
    }else{
        $start = 1;
        $end = $total_pages > $showpage ? $showpage:$total_pages;
    }
    if($page + $pageoffset > $total_pages){
        $start = $start - ($page+$pageoffset-$end);
    }
}
for($i=$start;$i<=$end;$i++){
    if($page==$i){
        $page_banner.="<span class='current'>{$i}</span>";
    }else{
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".$i."' >$i</a>";
    }
}
//尾部省略
if($total_pages > $showpage && $total_pages >$page+$pageoffset){
    $page_banner.="...";
}

if($page < $total_pages){
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".($page+1)."' >下一页></a>";
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".($total_pages)."'>尾页</a>";
}else{
    $page_banner.="<span class='disable'>下一页></span>";
    $page_banner.="<span class='disable'>尾页</span>";
  }
$page_banner.="&nbsp;&nbsp;共{$total_pages}页&nbsp;&nbsp;";
$page_banner.="<form action = 'appInfo.php' method='get'>";
$page_banner.="到第<input type='text' size='2' name='p' value='$page'>页";
$page_banner.="<input type='submit' value='确定'>";
$page_banner.="</form></div>";
echo $page_banner;
?> 
</div>
<div id = "bottom_div">
	<div id = "project1">
    	<img src="../images/火影忍者.jpeg" id = "project1Img" />
        <span id = "project1Font"><a href="appInfo">用户推荐app</a></span>
    </div>
    <div id = "project2">
    	<img src="../images/火影忍者.jpeg" id = "project2Img" />
        <span id = "project2Font"><a href = "map.php">地图热点</a></span>
    </div>
</div>
<div id = "intro_div">
	<div id = "ss">吉林大学南湖校区刘坤大创小组--@版权所有</div>
</div>
</body>
</html>