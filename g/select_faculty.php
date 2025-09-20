<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>วณิชชา สดใส (มายด์มิ้นท์)</title>
</head>

<body>
<h1>แสดงข้อมูลคณะ -- วณิชชา สดใส (มายด์มิ้นท์)</h1>

<?php
	include("connectdb.php");
	$sql = "select * from faculty";
	$rs = mysqli_query($conn,$sql);
	while ($data = mysqli_fetch_array($rs)){
		echo $data["f_id"]."<br>";
		echo $data["f_name"]."<hr>";
	}
	mysqli_close($conn);
?>

</body>
</html>