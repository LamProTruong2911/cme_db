

<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    $t = date("Y-m-d H:i:s", time());
    $N = 1000;
    $idSensor = 1;
    $idMaster = 1; 
    $limitT = 12;

    if (!empty( $_GET['limitT'] )) {
      $limitT = $_GET['limitT'];
    }
    $min_x = $limitT*-60;
	//Chart 1
    $sql = "SELECT T,  timeStamp,airHumidity FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T, timeStamp, airHumidity 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp1 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
		$p->time =  $rowInfo["timeStamp"];
        $p->y =  floatval($rowInfo["airHumidity"]);
        $rows_temp1[] = $p;
        
      }      
    }
    // sensor 2
    $idSensor = 2;
    $sql = "SELECT T,  timeStamp,airHumidity FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T, timeStamp, airHumidity 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp2 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->y =  floatval($rowInfo["airHumidity"]);
        $p->time =  $rowInfo["timeStamp"];
		$rows_temp2[] = $p;
       
      }      
    }
    // sensor 3
    $idSensor = 3;
    $sql = "SELECT T,  timeStamp, airHumidity FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T, timeStamp, airHumidity 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp3 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->time =  $rowInfo["timeStamp"];
		$p->y =  floatval($rowInfo["airHumidity"]);
        $rows_temp3[] = $p;
        
      }      
    }
    //convert the PHP array into JSON format, so it works with javascript
    $json_array_temp1 = json_encode($rows_temp1);
    $json_array_temp2 = json_encode($rows_temp2);
    $json_array_temp3 = json_encode($rows_temp3);
	
	//Chart2
	$idSensor = 1;
	$sql = "SELECT T,  timeStamp,airTemperature FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,airTemperature 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp1 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->time =  $rowInfo["timeStamp"];
		//$p->label =  $rowInfo["timeStamp"];
		$p->y =  floatval($rowInfo["airTemperature"]);
        $rows_temp1[] = $p;
        
      }      
    }
    // sensor 2
    $idSensor = 2;
    $sql = "SELECT T,  timeStamp,airTemperature FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,airTemperature 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp2 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->time =  $rowInfo["timeStamp"];
		//$p->label =  $rowInfo["timeStamp"];
		$p->x =  $rowInfo["T"]; 
        $p->y =  floatval($rowInfo["airTemperature"]);
        $rows_temp2[] = $p;
        
      }      
    }
    // sensor 3
    $idSensor = 3;
    $sql = "SELECT T,  timeStamp,airTemperature FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,airTemperature 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp3 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->time =  $rowInfo["timeStamp"];
		//$p->label =  $rowInfo["timeStamp"];
		$p->y =  floatval($rowInfo["airTemperature"]);
        $rows_temp3[] = $p;
        
      }      
    }


    //convert the PHP array into JSON format, so it works with javascript
    $json_array_temp4 = json_encode($rows_temp1);
    $json_array_temp5 = json_encode($rows_temp2);
    $json_array_temp6 = json_encode($rows_temp3);
	//
    
	//Chart3
	$idSensor = 1;
    $sql = "SELECT T,  timeStamp,soilHumidity FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,soilHumidity 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp1 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->time =  $rowInfo["timeStamp"];
		$p->y =  floatval($rowInfo["soilHumidity"]);
        $rows_temp1[] = $p;
        
      }      
    }
    // sensor 2
    $idSensor = 2;
    $sql = "SELECT T,  timeStamp,soilHumidity FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,soilHumidity 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp2 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->time =  $rowInfo["timeStamp"];
		$p->y =  floatval($rowInfo["soilHumidity"]);
        $rows_temp2[] = $p;
        
      }      
    }
    // sensor 3
    $idSensor = 3;
    $sql = "SELECT T,  timeStamp,soilHumidity FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,soilHumidity 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp3 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->time =  $rowInfo["timeStamp"];
		$p->y =  floatval($rowInfo["soilHumidity"]);
        $rows_temp3[] = $p;
        
      }      
    }


    //convert the PHP array into JSON format, so it works with javascript
    $json_array_temp7 = json_encode($rows_temp1);
    $json_array_temp8 = json_encode($rows_temp2);
    $json_array_temp9 = json_encode($rows_temp3);
    
	//
	//Chart4
	$idSensor = 1;
    $sql = "SELECT T,  timeStamp,soilTemperature FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,soilTemperature 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp1 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->time =  $rowInfo["timeStamp"];
		$p->y =  floatval($rowInfo["soilTemperature"]);
        $rows_temp1[] = $p;
        
      }      
    }
    // sensor 2
    $idSensor = 2;
    $sql = "SELECT T,  timeStamp,soilTemperature FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,soilTemperature 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp2 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->time =  $rowInfo["timeStamp"];
		$p->x =  $rowInfo["T"]; 
        $p->y =  floatval($rowInfo["soilTemperature"]);
        $rows_temp2[] = $p;
        
      }      
    }
    // sensor 3
    $idSensor = 3;
    $sql = "SELECT T,  timeStamp,soilTemperature FROM (
      select TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T,  timeStamp,soilTemperature 
        from data_warehouse 
            where 
              idSensor = ". $idSensor ." and idMaster = " . $idMaster . " and        
              TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) > " . -$limitT*60 . " 
              order by T DESC limit " . $N . ") temp order by temp.T ASC;";
    //echo $sql;
    $records = $conn->prepare($sql);
    $rows_temp3 = array();
    if ($records->execute()) {        
      $c = 0;
      while ($rowInfo = $records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $rowInfo["T"]; 
        $p->time =  $rowInfo["timeStamp"];
		$p->y =  floatval($rowInfo["soilTemperature"]);
        $rows_temp3[] = $p;
        
      }      
    }


    //convert the PHP array into JSON format, so it works with javascript
    $json_array_temp10 = json_encode($rows_temp1);
    $json_array_temp11 = json_encode($rows_temp2);
    $json_array_temp12 = json_encode($rows_temp3);
	//
?>
<?php
	$_sql = "SELECT TIMESTAMPDIFF(MINUTE,'" . $t . "',timeStamp) as T, timeStamp, note_flag, player, name, color from note";
	$_records = $conn->prepare($_sql);
	$_records->execute();
	
	$rows = array();
	
	while ($_rowInfo = $_records->fetch(PDO::FETCH_ASSOC)) {
        $p = new \stdClass();
        $p->x =  $_rowInfo["T"];
		$p->note =  $_rowInfo["note_flag"];
		$p->player =  $_rowInfo["player"];
		$p->name =  $_rowInfo["name"];
		$p->time =  $_rowInfo["timeStamp"];
		$p->color =  $_rowInfo["color"];
		
		$rows[] = $p;
      }
	$json_array = json_encode($rows);
	
	function show_title($limitT){
		if ($limitT>=720)
			{
				echo 'Độ ẩm không khí trong ' . $limitT/720.0 . ' tháng gần đây';
			}
			if ($limitT>=168 && $limitT< 720)
			{
				echo 'Độ ẩm không khí trong ' . $limitT/168.0 . ' tuần gần đây';
			}	
			
			if ($limitT>=24 && $limitT< 168)
			{
				echo 'Độ ẩm không khí trong ' . $limitT/24.0 . ' ngày gần đây';
			}
			if ($limitT<24)	
			{
				echo 'Độ ẩm không khí trong ' . $limitT . ' giờ gần đây';
			}
	}
	function show_title_at($limitT){
		if ($limitT>=720)
			{
				echo 'Nhiệt độ không khí trong ' . $limitT/720.0 . ' tháng gần đây';
			}
			if ($limitT>=168 && $limitT< 720)
			{
				echo 'Nhiệt độ không khí trong ' . $limitT/168.0 . ' tuần gần đây';
			}	
			
			if ($limitT>=24 && $limitT< 168)
			{
				echo 'Nhiệt độ không khí trong ' . $limitT/24.0 . ' ngày gần đây';
			}
			if ($limitT<24)	
			{
				echo 'Nhiệt độ không khí trong ' . $limitT . ' giờ gần đây';
			}
	}
	function show_title_sh($limitT){
		if ($limitT>=720)
			{
				echo 'Độ ẩm rơm trong ' . $limitT/720.0 . ' tháng gần đây';
			}
			if ($limitT>=168 && $limitT< 720)
			{
				echo 'Độ ẩm rơm trong ' . $limitT/168.0 . ' tuần gần đây';
			}	
			
			if ($limitT>=24 && $limitT< 168)
			{
				echo 'Độ ẩm rơm trong ' . $limitT/24.0 . ' ngày gần đây';
			}
			if ($limitT<24)	
			{
				echo 'Độ ẩm rơm trong ' . $limitT . ' giờ gần đây';
			}
	}
	function show_title_st($limitT){
		if ($limitT>=720)
			{
				echo 'Nhiệt độ rơm trong ' . $limitT/720.0 . ' tháng gần đây';
			}
			if ($limitT>=168 && $limitT< 720)
			{
				echo 'Nhiệt độ rơm trong ' . $limitT/168.0 . ' tuần gần đây';
			}	
			
			if ($limitT>=24 && $limitT< 168)
			{
				echo 'Nhiệt độ rơm trong ' . $limitT/24.0 . ' ngày gần đây';
			}
			if ($limitT<24)	
			{
				echo 'Nhiệt độ rơm trong ' . $limitT . ' giờ gần đây';
			}
	}
	
?>

<!DOCTYPE HTML>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <style>
        .canvasjs-chart-tooltip{
        pointer-events: auto !important;
	}  
	
	.dropbtn {
		background-color: #4CAF50;
		color: white;
		padding: 3px;
		font-size: 16px;
		border: none;
		cursor: pointer;
	}

	.dropdown {
		position: relative;
		display: inline-block;
	}

	.dropdown-content {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 160px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
	}

	.dropdown-content a {
		color: black;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
	}

	.dropdown-content a:hover {background-color: #f1f1f1}

	.dropdown:hover .dropdown-content {
		display: block;
	}

	.dropdown:hover .dropbtn {
		background-color: #3e8e41;
	}
	.slidecontainer {
    width: 100%;
	}

	.slider {
		-webkit-appearance: none;
		width: 100%;
		height: 25px;
		background: #d3d3d3;
		outline: none;
		opacity: 0.7;
		-webkit-transition: .2s;
		transition: opacity .2s;
	}

	.slider:hover {
		opacity: 1;
	}

	.slider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 25px;
		height: 25px;
		background: #4CAF50;
		cursor: pointer;
	}

	.slider::-moz-range-thumb {
		width: 25px;
		height: 25px;
		background: #4CAF50;
		cursor: pointer;
	}
	</style>
    <script type="text/javascript">
        window.onload = function() {
            var arr_flag = JSON.parse('<?php echo $json_array; ?>');
            //console.log(arr_flag);
            var color = "blue";
            var array = [{
                min: 0,
                max: 5
            }, {
                min: 6,
                max: 11
            }, {
                min: 12,
                max: 17
            }, {
                min: 18,
                max: 23
            }, {
                min: 24,
                max: 29
            }, {
                min: 30,
                max: 35
            }, , {
                min: 36,
                max: 41
            }];
            var xCol = [];
            var flag = {
                name: "flag",
                type: "rangeColumn",
                toolTipContent: "<b>{name}</b> <hr/>Thời gian: {time} </br> Note: {flag} <hr/><a href = 'merge.php?remove='{name}>Remove</a>",
                dataPoints: []
            }
            //
            var o = {
                title: {
                    text: "<?php  show_title($limitT); ?>",
                    fontFamily: "tahoma",
					fontSize: 25,
                },
                axisX: {
                    title: "Thời gian lùi lại tính theo phút",
                    minimum: <?php echo $min_x; ?>,
                    maximum: 0,
                    //
                    stripLines: xCol,
                    suffix: " phút"
                    //
                },
                //
                dataPointWidth: 10,
                //
                axisY: {
                    title: "Độ ẩm",
                    lineColor: "#369EAD",
                    minimum: 0,
                    maximum: 100,
                    suffix: " %"
                },
                legend: {
                    verticalAlign: "bottom"
                },
                data: [{
                        type: "line",
                        showInLegend: true,
                        axisXIndex: 0,
                        legendText: "Cảm biến 1",
                        toolTipContent: "Time: {time}s </br> {y} %",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                        }
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        axisYIndex: 1,
                        legendText: "Cảm biến 2",
                        toolTipContent: "Time: {time}s </br> {y} % ",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                            console.log(e);
                        }
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        axisYIndex: 1,
                        legendText: "Cảm biến 3",
                        toolTipContent: "Time: {time}s </br> {y} % ",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                            //console.log(e.time)
                        }
                    },
                    flag
                ]
            };
            o.data[0].dataPoints = JSON.parse('<?php echo $json_array_temp1; ?>');
            o.data[1].dataPoints = JSON.parse('<?php echo $json_array_temp2; ?>');
            o.data[2].dataPoints = JSON.parse('<?php echo $json_array_temp3; ?>');
            //console.log(o.data[0].dataPoints);

            var chart = new CanvasJS.Chart("chartContainer", o);
            chart.render();

            //
            var o1 = {
                zoomEnabled: true,
                title: {
                    text: "<?php  show_title_at($limitT); ?>",
                    fontFamily: "tahoma",
					fontSize: 25,
                },
                //zoomEnabled: true, 
                axisX: {
                    title: "Thời gian lùi lại tính theo phút",
                    minimum: <?php echo $min_x; ?>,
                    maximum: 0,
                    //
                    stripLines: xCol,
                    suffix: " phút"
                    //
                },
                axisY: {
                    title: "Nhiệt độ",
                    lineColor: "#369EAD",
                    minimum: 0,
                    maximum: 50,
                    suffix: " °C"
                },
                //
                dataPointWidth: 10
                    //
                    ,
                legend: {
                    verticalAlign: "bottom"
                },
                data: [{
                        type: "line",
                        showInLegend: true,
                        axisXIndex: 0,
                        legendText: "Cảm biến 1",
                        toolTipContent: "Time: {time}s </br> {y} *C",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                        }
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        axisYIndex: 1,
                        legendText: "Cảm biến 2",
                        toolTipContent: "Time: {time}s </br> {y} *C ",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                            console.log(e);
                        }
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        axisYIndex: 1,
                        legendText: "Cảm biến 3",
                        toolTipContent: "Time: {time}s </br> {y} *C ",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                            //console.log(e.time)
                        }
                    },
                    flag
                ]
            };
            o1.data[0].dataPoints = JSON.parse('<?php echo $json_array_temp4; ?>');
            o1.data[1].dataPoints = JSON.parse('<?php echo $json_array_temp5; ?>');
            o1.data[2].dataPoints = JSON.parse('<?php echo $json_array_temp6; ?>');
            console.log(o1.data[0]);

            var chart1 = new CanvasJS.Chart("chartContainer1", o1);

            chart1.render();
            //
            //
            var o2 = {
                title: {
                    text: "<?php show_title_sh($limitT);?>",
                    fontFamily: "tahoma",
					fontSize: 25,
                },
                axisX: {
                    title: "Thời gian lùi lại tính theo phút",
                    stripLines: xCol,
                    minimum: <?php echo $min_x; ?>,
                    maximum: 0,
                    suffix: " phút"
                },
                axisY: {
                    title: "Độ ẩm",
                    lineColor: "#369EAD",
                    minimum: 0,
                    maximum: 100,
                    suffix: " %"
                },
                dataPointWidth: 10,
                legend: {
                    verticalAlign: "bottom"
                },
                data: [{
                        type: "line",
                        showInLegend: true,
                        axisXIndex: 0,
                        legendText: "Cảm biến 1",
                        toolTipContent: "Time: {time}s </br> {y} %",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                        }
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        axisYIndex: 1,
                        legendText: "Cảm biến 2",
                        toolTipContent: "Time: {time}s </br> {y} % ",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                            console.log(e);
                        }
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        axisYIndex: 1,
                        legendText: "Cảm biến 3",
                        toolTipContent: "Time: {time}s </br> {y} % ",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                            //console.log(e.time)
                        }
                    },
                    flag
                ]
            };
            o2.data[0].dataPoints = JSON.parse('<?php echo $json_array_temp7; ?>');
            o2.data[1].dataPoints = JSON.parse('<?php echo $json_array_temp8; ?>');
            o2.data[2].dataPoints = JSON.parse('<?php echo $json_array_temp9; ?>');
            //console.log(o.data[0].dataPoints);

            var chart2 = new CanvasJS.Chart("chartContainer2", o2);

            chart2.render();
            //
            //
            var o3 = {
                title: {
                    text: "<?php  show_title_st($limitT); ?>",
                    fontFamily: "tahoma",
					fontSize: 25,
                },
                axisX: {
                    title: "Thời gian lùi lại tính theo phút",
                    minimum: <?php echo $min_x; ?>,
                    maximum: 0,
                    //
                    stripLines: xCol,
                    suffix: " phút"
                    //
                },
                axisY: {
                    title: "Nhiệt độ",
                    lineColor: "#369EAD",
                    minimum: 0,
                    maximum: 50,
                    suffix: " °C"
                },
                //
                dataPointWidth: 10
                    //
                    ,
                legend: {
                    verticalAlign: "bottom"
                },
                data: [{
                        type: "line",
                        showInLegend: true,
                        axisXIndex: 0,
                        legendText: "Cảm biến 1",
                        toolTipContent: "Time: {time}s </br> {y} *C",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                        }
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        axisYIndex: 1,
                        legendText: "Cảm biến 2",
                        toolTipContent: "Time: {time}s </br> {y} *C ",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                            console.log(e);
                        }
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        axisYIndex: 1,
                        legendText: "Cảm biến 3",
                        toolTipContent: "Time: {time}s </br> {y} *C ",
                        click: function(e) {
                            $("#form_flag").show();
                            $("#in_x").val(e.dataPoint.time);
                            //console.log(e.time)
                        }
                    },
                    flag
                ]
            };
            o3.data[0].dataPoints = JSON.parse('<?php echo $json_array_temp10; ?>');
            o3.data[1].dataPoints = JSON.parse('<?php echo $json_array_temp11; ?>');
            o3.data[2].dataPoints = JSON.parse('<?php echo $json_array_temp12 ?>');
            //console.log(o.data[0].dataPoints);

            var chart3 = new CanvasJS.Chart("chartContainer3", o3);

            chart3.render();
            //
            var slider = document.getElementById("myRange");
            var output = document.getElementById("demo");
            //window.onload(-7000);
            $(document).ready(function() {
                slider.oninput = function() {
                    //window.onload(slider.value);
                    chart.axisX[0].set("minimum", slider.value);
                    chart1.axisX[0].set("minimum", slider.value);
                    chart2.axisX[0].set("minimum", slider.value);
                    chart3.axisX[0].set("minimum", slider.value);
                    output.innerHTML = slider.value;
                }
            });
            //
            var index;
            for (index = 0; index < arr_flag.length; index++) {
                var i = arr_flag[index].player;
                flag.dataPoints.push({
                    x: arr_flag[index].x,
                    y: [array[i].min, array[i].max],
                    flag: arr_flag[index].note,
                    color: arr_flag[index].color,

                    name: arr_flag[index].name,
                    time: arr_flag[index].time,
                    click: function(e) {
                        alert("Name:" + e.dataPoint.name + " Note:" + e.dataPoint.flag + " Time:" + e.dataPoint.x);
                    },
                });
                xCol.push({
                    value: arr_flag[index].x,
                    lineDashType: "dash",
                    color: arr_flag[index].color
                });
                chart.render();
                chart1.render();
				chart2.render();
				chart3.render();
            }
            //
        }

        function remove_space() {
            var str = $("#in_name").val();
            var _str = str.split(" ");
            var temp = "";
            for (var i = 0; i < _str.length - 1; i++) {
                temp += _str[i] + "_";
            }
            temp += _str[_str.length - 1];
            $("#in_name").val(temp);
            return temp;
        }
    </script>
    <script type="text/javascript" src="canvasjs.min.js"></script>
</head>

<body>
    <div id="div_add_flag">
        <button id="btn_flag">Thêm ghi chú</button>
        <button id="btn_remove_flag">Xóa ghi chú</button>
        <div id="form_flag" style="display: none;">
            <form action="">
                <fieldset>
                    <label>Thời gian</label>
                    <input type="text" id="in_x" name="x" value=""></input>
                    </br>
                    <label>Tên ghi chú</label>
                    <input type="text" id="in_name" name="name" value=""></input>
                    </br>

                    <label>Nội dung</label>
                    <textarea id="in_note" name="note" value=""></textarea>
                    </br>
                    <label>Chọn màu</label>
                    <input type="color" name="color" value="#A6A2A3">
                    </br>
                    <input type="submit" value="Thêm" onclick="remove_space();">
                </fieldset>
            </form>
        </div>

        <div id="remove_flag" style="display: none;">
            <form action="">
                <fieldset>
                    <label>Tên ghi chú</label>
                    <input id="in_remove_name" name="remove" value=""></input>
                    </br>
                    <input type="submit" value="Xóa">
                </fieldset>
            </form>
        </div>
        <script>
            $(document).ready(function() {
				$("#btn_flag").click(function() {
					$("#form_flag").show();
					$("#remove_flag").hide();
				});				
				$("#btn_remove_flag").click(function() {
					$("#remove_flag").show();
					$("#form_flag").hide();
				});
			});
		</script>
    </div>

    <div style="height: 400px; width: 48%; float: left;" id="chartContainer"></div>
    <div style="height: 400px; width: 48%; float: left;" id="chartContainer1"></div>
    <div style="height: 400px; width: 48%; float: left;" id="chartContainer2"></div>
    <div style="height: 400px; width: 48%; float: left;" id="chartContainer3"></div>

    <div class="slidecontainer">
        <input type="range" min="<?php echo $min_x;?>" max="0" value="<?php echo $min_x;?>" class="slider" id="myRange" style="width: 100%;">
        <p>Value: <span id="demo"></span> Phút</p> 
    </div>
</body>

</html>