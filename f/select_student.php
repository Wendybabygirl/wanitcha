<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>วณิชชา สดใส (มายด์มิ้นท์)</title>
</head>

<body>
<h1>แสดงข้อมูลนิสิต -- วณิชชา สดใส (มายด์มิ้นท์)</h1>

<?php
	include("connectdb.php");
	$sql = "select * from student";
	$rs = mysqli_query($conn,$sql);
	while ($data = mysqli_fetch_array($rs)){
		echo "<img src = 'http://202.28.32.211/picture/student/67/{$data['s_id']}.jpg' width='260'> <br>";
		echo $data["s_id"]."<br>";
		echo $data["s_name"]."<br>";
		echo $data["s_address"]."<br>";
		echo $data["s_gpax"]."<br>";
		echo $data["f_id"]."<hr>";
	}
	mysqli_close($conn);
?>

</body>
</html>