<meta charset="utf-8">

<?php
	if(isset($_GET['fid'])){
	include("connectdb.php");
	$sql = "DELETE FROM faculty WHERE f_id='{$_GET['fid']}' ";
	mysqli_query($conn, $sql) or die ("ลบข้อมูลไม่สำเร็จ");
	
	echo "<script>";
	echo "window.location='insert_faculty.php';";
	echo "</script>";
	}
?>
