<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>วณิชชา สดใส (มายด์มิ้นท์)</title>
</head>

<body>
<h1>เพิ่มข้อมูลคณะ -- วณิชชา สดใส (มายด์มิ้นท์)</h1>

<form method="post" action="">
	ชื่อคณะ <input type="text" name="fname" autofocus required>
    <button type="submit" name="Submit">บันทึก</button>
</form>
<hr>

<?php
	if(isset($_POST['Submit'])){
	include("connectdb.php");
	$fname = $_POST['fname'];
	$sql = "INSERT INTO faculty VALUES (NULL, '{$fname}');";
	mysqli_query($conn,$sql) or die ("insert error");
	
	echo "<script>";
	echo "alert('บันทึกข้อมูลสำเร็จ');";
	echo "</script>";
	}
?>

<?php
	include("connectdb.php");
	$sql = "select * from faculty";
	$rs = mysqli_query($conn,$sql);
	while ($data = mysqli_fetch_array($rs)){
		echo $data['f_id']."<br>";
		echo $data['f_name']."<br>";
		echo "<a href='delete_faculty.php?fid={$data['f_id']}'onClick = 'return confirm(\"ยืนยันการลบ?\")'> ลบ </a><hr>";
	}
	mysqli_close($conn);
?>

</body>
</html>