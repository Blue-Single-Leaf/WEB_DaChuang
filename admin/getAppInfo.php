<?php
	/*自定义函数，用来处理字符串*/
	function getList($myStr)
	{
		$cont2 = explode("('",$myStr);//拆分字符串
		$l = sizeof($cont2);			//取数组长度
		$end = array();					
		for($i = 1; $i < $l;$i++)		//分别处理分开app的名字和分数，并保留两位小数
		{
			$cont3 = explode("',",$cont2[$i]);
			$num = sizeof($cont3);
			$cont3[1] = str_replace("),","",$cont3[1]);
			$end[$i] = array('name' => $cont3[0],'score' => $cont3[1]);
			$end[$i]['score'] = round(floatval($end[$i]['score']),2);
		}
		/*处理最后一个*/
		$end[$l-1]['score'] = str_replace(")])","",$end[$l-1]['score']);
		$end[$l-1]['score'] = round(floatval($end[$l-1]['score']),2);
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
	$sql = "select id from user_info ";
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

	$sql = "SELECT * FROM user_info LIMIT ".($page-1)*$pagesize .",$pagesize";
	//echo $sql;
	//echo "<br/>";
	$query = $mysqli->query($sql);
	while($result = $query->fetch_array())
	{
		$record[$j] = $result;
		$j++;
		/*$userId = $result['userId'];
		$userInfo = $result['userInfo'];
		$pushApp = getList($userInfo);
		$num = sizeof($pushApp);
		echo 'userId = '.$userId.'<br/><br/>';
		for($i = 1;$i < $num;$i++)
		{
			echo $pushApp[$i]['name'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$pushApp[$i]['score'].'<br/>';
		}
		echo '<br/><br/>*********************************<br/><br/>';*/
	}
?>