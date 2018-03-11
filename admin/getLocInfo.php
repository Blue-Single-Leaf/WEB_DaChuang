<?php
	/*自定义函数，用来处理字符串*/
	function getLocList($myStr)
	{
		$cont2 = explode("(",$myStr);//拆分字符串
		$l = sizeof($cont2);			//取数组长度
		$end = array();					
		for($i = 1; $i < $l;$i++)		//分别处理分开app的名字和分数，并保留两位小数
		{
			$cont3 = explode(",",$cont2[$i]);
			$num = sizeof($cont3);
			for($k = 1;$k < 4;$k++)
			{
				$cont3[$k] = str_replace('"',"",$cont3[$k]);
			}
			$cont3[4] = str_replace(")","",$cont3[4]);
			$end[$i] = array('time' => $cont3[0],'lng' => $cont3[1],'lat' => $cont3[2],'addr' => $cont3[3],'remark' => $cont3[4]);
			//$end[$i]['score'] = round(floatval($end[$i]['score']),2);
		}
		/*处理最后一个*/
		$end[$l-1]['remark'] = str_replace("]","",$end[$l-1]['remark']);
		//$end[$l-1]['score'] = round(floatval($end[$l-1]['score']),2);
		return $end;					//返回数组
	}
?>
<?php
	header('content-type:text/html;charset=utf-8');
	$mysqli=new mysqli('localhost','******','******','******');
	if($mysqli->errno){
		die('Connect Error'.$mysqli->error);
	}
	$mysqli->set_charset('UTF8');
	$record = array();
	$j = 0;
	if (!isset($_GET['p']))
	{
		$page = 1;
	}
	else
	{
		$page = $_GET['p'];
	}
	
	
	//2根据页码取出数据:php对mysql的处理
	
	$pagesize = 3;
	$showpage = 5;
	//获取数据总行数
	$sql = "select id from userLoc_info ";
	$mysqli_result=$mysqli->query($sql);
	if(isset($mysqli_result->num_rows)){
		$total = $mysqli_result->num_rows;
	}
	else $total="0";
	//计算总页数
	$total_pages = ceil($total/$pagesize);
	//3显示数据和分页条
	$page_banner = "<div id = 'page'>";
	//计算偏移量
	$pageoffset = ($showpage-1)/2;
	//初始化数据
	$start = 1;
	$end = $total_pages;

	//$sql = "SELECT * FROM userLoc_info LIMIT ".($page-1)*$pagesize .",$pagesize";
	$userid = "8bf6f6d063085b30efed9a36529052da";
	$sql = "SELECT * FROM userLoc_info where userId like "."'"."%$userid%"."'";
	//echo $sql;
	//echo "<br/>";
	$query = $mysqli->query($sql);
	$result = $query->fetch_array();
	//echo "userId = ".$result['userId'];
	//echo "<br/>"."info = ".$result['userLocInfo'];
///*	while($result = $query->fetch_array())
//	{
//		$record[$j] = $result;
//		$j++;
//		$userId = $result['userId'];
		$locInfo = $result['userLocInfo'];
		$Location = getLocList($locInfo);
//		$num = sizeof($Location);
//		echo 'userId = '.$userid.'<br/><br/>';
//		for($i = 1;$i <= $num;$i++)
//		{
//		echo $Location[$i]['time'].'&nbsp&nbsp'.$Location[$i]['lng'].'&nbsp&nbsp'.$Location[$i]['lat'].'&nbsp&nbsp'.$Location[$i]['addr'].'&nbsp&nbsp'.$Location[$i]['remark'].'<br/>';
//		}
//		echo '<br/><br/>*********************************<br/><br/>';
//	}
//
?>