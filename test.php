<?php
	header('content-type:text/html;charset=utf-8');
	$mysqli=new mysqli('localhost','myadmin','myadmin','db_dachuang');
	$mysqli->set_charset('UTF8');
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
	$userid = $_GET['userId'];
	$sql = "SELECT * FROM userLoc_info where userId like "."'"."%$userid%"."'";
	$query = $mysqli->query($sql);
	$result = $query->fetch_array();
	$mysqli->close();
//	$test['first'] = "first1";
//	$test['second'] = "second2";
//	die(json_encode($test));
	if(isset($query->num_rows))
	{
		$locInfo = $result['userLocInfo'];
		$Location = getLocList($locInfo);
		die(json_encode($Location));
	}
	else
	{
		echo "error";	
	}
?>