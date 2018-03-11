document.write("<script language='javascript'   	   src='https://api.map.baidu.com/api?v=2.0&ak=GjVjUaTgRSfmQ2u4ZqW8kS9MojwCzvZ4&s=1'></script>");

/* document.write("<script type='text/javascript' src='jquery.js'></script>"); */
	function draw(points,color,addrArr,timeArr,remarkArr){
			
	
		var resultPoints = [];
		var convertor = new BMap.Convertor();
		var i = 0,j = 0;
		$.each(points,function(){i++;});
		$.each(points,function(key,value)
		{
			var aa = key;
			point = new BMap.Point(value[0],value[1]);
			var pointArr = [];
			pointArr.push(point);
			translateCallback = function(data)
			{
				var bb = aa;
				if(data.status === 0)
				{
					resultPoints[bb] = data.points[0];
					j++;
					if(i == j){
						drawLine(resultPoints,color,addrArr,timeArr,remarkArr);
					}
				}
				translateCallback = null;
				aa = null;
				
			}
			convertor.translate(pointArr, 1, 5,translateCallback);
		});
		//while(i == 0 || j == 0);
		//alert("i = " + i + "  " + "j = " + j);
		
	}


	function drawLine(pointArray,color,addr,time,remark)
	{
		
		var prePoint,nextPoint;
		var existAddr = new Array();
//		var i = 0;
//		$.each(pointArray,function(){i++;});
//		alert(i);
		$.each(pointArray,function(i,item1){
			//var pointTemp = new BMap.Point(item[0],item[1]);
			//alert("111");
			//var TempMarker = new BMap.Marker(item);
			if($.inArray(addr[i],existAddr) == -1)
			{
				var TempMarker = new BMap.Marker(item1);
				map.addOverlay(TempMarker);
			}
			
			if(i == 0)
			{
				prePoint = item1;
				map.centerAndZoom(item1, 16);  // 初始化地图,设置中心点坐标和地图级别
				time[0] = " " + time[0];
			}
			else if(i == 1)
			{
				nextPoint = item1;
			}
			else
			{
				prePoint = nextPoint;
				nextPoint = item1;
			}
			if($.inArray(addr[i],existAddr) == -1)
			{
				TempMarker.setTitle(addr[i]);
				var label1 = new BMap.Label(time[i].substr(0,5) + "-" + time[i].substr(5,2) + "-" +time[i].substr(7,2) + "  " + time[i].substr(9,2) + ":" + time[i].substr(11,2) + ":" + time[i].substr(13,2),	{offset:new BMap.Size(20,-10)});
				TempMarker.setLabel(label1);
				var label2 = new BMap.Label((i+1)+"",	{offset:new BMap.Size(-24,-10)});
				TempMarker.setLabel(label2);
				existAddr.push(addr[i]);
			}
			if(i != 0)
			{
				var polyline = new BMap.Polyline([prePoint,nextPoint],
				{strokeColor:color,//设置颜色 
				strokeWeight:3, //宽度
				strokeOpacity:0.5});//透明度
				map.addOverlay(polyline);
			}
			//alert(1);
		});
			//alert(map.getCenter().lng + " " + map.getCenter().lat);
	}
	function ajax(userId)
	{
		$.get("test.php?userId="+userId,null,function(data,status,xObj)
		{
			var htm = ""
			var dataJson = $.parseJSON(data);
			//var dataArr = JSON.parse(dataJson);
			var i,j,length;
			var timeArr = new Array();
			var LngLatArr = new Array();
			var addrArr = new Array();
			var remarkArr = new Array();
			var inner = "";
			j = 0;
			$.each(dataJson,function(index,value)
			{
				j++;
				timeArr.push(value.time);
				LngLatArr.push([value.lng,value.lat]);
				addrArr.push(value.addr);
				remarkArr.push(value.remark);
			});
			//for(i = 1;i < dataJson.length;i++)
//			{
//				//alert(dataJson.1);
//				
//			}	
		
/*			for(i = 0;i < j;i++)
			{
				//alert(LngLatArr[i][0]);
				//alert(time[i]);
				inner += timeArr[i] + "  " + "[" + LngLatArr[i][0] + "," + LngLatArr[i][1] + "]" + "  " + addrArr[i] + "  <br/>";			
			}
			
			$("div#test").html(inner);
*/			draw(LngLatArr,"blue",addrArr,timeArr,remarkArr);
//			$("div#test").html(data);
		})
		
	}