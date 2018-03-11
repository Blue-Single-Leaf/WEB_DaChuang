<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>得到文件信息</title>
</head>

<body>
<?php 
	/*初始化连接数据库*/
	header('content-type:text/html;charset=utf-8');
	$mysqli=new mysqli('localhost','******','******','******');
	if($mysqli->errno){
		die('Connect Error'.$mysqli->error);
	}
	$mysqli->set_charset('UTF8');
	
	/*判断数据库中有多少条记录*/
	$sql = "select userId from user_info";
	$query = $mysqli->query($sql);
	$l = $query->num_rows;
	
	/*将每条记录的编号取出，放入$old_id数组中，用于判断将要写入的数据是否已经存在，避免重复写入数据库*/
	$old_id = array();
	$i = 0;
	while($result = $query->fetch_array())
	{
		$old_id[$i] = $result['userId'];
		$i++;	
	}
	
	/*开始从文件里读取数据并写入数据库*/
	$i = ($l+1);
	//$fp = fopen("../result.txt","r") or exit("文件无法打开");
	$fp = fopen("../recommend_result.txt","r") or exit("文件无法打开");
	while(!feof($fp))
	{
		$cont = fgets($fp);
		if($cont == "") return;
		//$cont = iconv("gb2312","utf-8",$cont);
		$cont1 = explode("[",$cont);
		$cont1[0] = str_replace("(","",$cont1[0]);
		$cont1[0] = str_replace("'","",$cont1[0]);
		$id = str_replace(",","",$cont1[0]);
		if(!in_array($id,$old_id))					//确保无重复数据
		{
			$name = "用户"."$i";
			$userInfo = addslashes($cont1[1]);
			//echo $id."<br/>".$userInfo."\n";
			$insert_sql = "insert into user_info (userName,userId ,userInfo) values('$name','$id','$userInfo')";
			if($mysqli->query($insert_sql))
			$i++;
		}
	}
?>

</body>
</html>