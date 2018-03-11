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
<div class = "maxDiv">
	<div class = "indexDiv">
    	<span class = "userName1" > 用户名：<span class = "userName2">用爱发电</span></span>
        <span class = "userId1" > 用户编号：<span class = "userId2" > uuii777888yc</span></span>
    </div>
    <div class = "firstDiv">
    	<div class = "circle1">
        <span class = "num1">1</span>
        </div>
        <span class = "app1">当当网</span>
        <div class = "app1_level">推荐指数：<span class = "app1_score">92.81</span></div>
    </div>
    <div class = "secondDiv">
    	<div class = "circle2">
        <span class = "num2">2</span>
        </div>
        <span class = "app2">携程</span>
        <div class = "app2_level">推荐指数：<span class = "app2_score">90.17</span></div>
    </div>
    <div class = "lastDiv">
    	<div class = "other">
        	4 &nbsp;&nbsp;58同城<span class = "other_score"> 86.77</span>
        </div>
        <div class = "other">
        	5 &nbsp;&nbsp;新东方<span class = "other_score">84.33</span>
        </div>
        <div class = "other">
        	6 &nbsp;&nbsp;<span style="font-size:14px">苏宁易购无</span><span class = "other_score">80.55</span>
        </div>
        <div class = "other">
        	7 &nbsp;&nbsp;百词斩<span class = "other_score">78.44</span>
        </div>
        <div class = "other" >
        	8 &nbsp;&nbsp;<span style="font-size:12px">扇贝单词哈哈</span><span class = "other_score">73.44</span>
        </div>
        <div class = "other">
        	9 &nbsp;&nbsp;爱奇艺<span class = "other_score">70.22</span>
        </div>
    </div>
    <div class = "thirdDiv">
    	<div class = "circle3">
        <span class = "num3">3</span>
        </div>
        <span class = "app3">优酷</span>
        <div class = "app3_level">推荐指数：<span class = "app3_score">88.72</span></div>
    </div>
</div>
</body>
</html>