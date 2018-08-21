<?php
	require "db_cme.php";
	$x = "";
	$note = "";
	$name = "";
	$remove = "";
	$color = "";
	$player = 0;
	if (!empty( $_GET['x'] )) {
      $x = $_GET['x'];
	  $note = $_GET['note'];
	  $name = $_GET['name'];
	  $color = $_GET['color'];
    }
	if (!empty( $_GET['remove'] )) {
      $remove = $_GET['remove'];
    }	
	
	if($x!="")
	{
		$sql = "INSERT INTO note (timeStamp, note_flag, player, name, color) VALUES ('".$x."','".$note."','".$player."','".$name."','".$color."');";
			$records = $conn->prepare($sql);
				$records->execute();		
	}

	
	if($remove!="")
	{
		$sql1 = "DELETE FROM note WHERE name ='".$remove."';";
			$records1 = $conn->prepare($sql1);
				$records1->execute();	
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>He Thong Theo Doi Moi Truong Nam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <!-- -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
	<style>
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
	.div_chart{
		float: left;
		border-style: solid;
	}
	</style>
	<!-- -->
</head>
<body>
    <!-- -->
	<center><h1 style= "font-family: tahoma;"> Biểu đồ theo dõi dữ liệu cảm biến nhà nấm AH18-0702 </h1></center>
	<div class="dropdown">
		<button class="dropbtn">Khoảng thời gian</button>
		<div class="dropdown-content">
			<a href="merge.php?limitT=3" class="btn" id="h_3" value="3">3 giờ</a>
			<a href="merge.php?limitT=6" class="btn" id="h_6" value="6">6 giờ</a>
			<a href="merge.php?limitT=12" class="btn" id="h_12" value="12">12 giờ</a>
			<a href="merge.php?limitT=24" class="btn" id="d_1" value="24">1 ngày</a>
			<a href="merge.php?limitT=168" class="btn" id="w_1" value="168">1 tuần</a>
			<a href="merge.php?limitT=336" class="btn" id="w_2" value="336">2 tuần</a>
			<a href="merge.php?limitT=720" class="btn" id="m_1" value="720">1 tháng</a>
			<a href="merge.php?limitT=2160" class="btn" id="m_1" value="2160">3 tháng</a>
		</div>
    </div>
	<!-- -->
    
    </div>
    <!-- -->
		<?php
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$t = date("Y-m-d H:i:s", time()	);
			echo "</br>Thời gian request: ".$t."s"."</br>";	
		?>
	
	</br>
	<div >
		<?php
			require "mergechart.php";
		?>
	</div>
</body>
</html>