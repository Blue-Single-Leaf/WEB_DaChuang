<?php 
session_start();
require 'getAppInfo.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/showInfo.css" type="text/css" rel="stylesheet" />
<title>数据展示</title>
</head>

<body>
<span style="font-size:36px;">欢迎&nbsp;&nbsp;<span style="color:red;">---<?php echo $_SESSION['username'];?>---</span>&nbsp;&nbsp;进入系统</span>
<br/><br/>
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
			if($len >= 24) echo "20px;";
			else if($len >= 21) echo "22px;";
			else if($len >= 18) echo "24px;";
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
			if($len >= 8) echo "20px;";
			else if($len >= 7) echo "22px;";
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
			if($len >= 8) echo "9px;";
			else if($len >= 7) echo "10px;";
			else if($len >= 6) echo "11px;";
			else if($len >= 5) echo "12px;";
		?>
        ">
			<?php echo $appName;?></span>
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
			if($len >= 8) echo "14px;";
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
</body>
</html>