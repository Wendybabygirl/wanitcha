<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>วณิชชา สดใส (มายด์มิ้นท์)</title>
</head>

<body>
<h1>แสดงข้อมูลนิสิต -- วณิชชา สดใส (มายด์มิ้นท์)</h1>

<form method="post" action="">
	คำค้น <input type="text" name="k" autofocus>
    <button type="submit" name="Submit">ค้นหา</button>
</form>
<hr>

<?php
	$k = @$_POST['k'];
	include("connectdb.php");
	$sql = "SELECT * FROM student AS s
	INNER JOIN faculty AS f
	ON s.f_id = f.f_id
	WHERE (s.s_name LIKE '%{$k}%' OR  s.s_id LIKE '%{$k}%' OR s.s_address LIKE '%{$k}%' OR f.f_name LIKE '%{$k}%')";
	$rs = mysqli_query($conn,$sql);
	while ($data = mysqli_fetch_array($rs)){
		echo "<img src = 'http://202.28.32.211/picture/student/67/{$data['s_id']}.jpg' width='260'> <br>";
		echo $data["s_id"]."<br>";
		echo $data["s_name"]."<br>";
		echo $data["s_address"]."<br>";
		echo $data["s_gpax"]."<br>"; 
		echo $data["f_name"]."<hr>";
	}
	mysqli_close($conn);
?>

</body>
</html>