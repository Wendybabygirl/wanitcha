<?php
include("connectdb.php");
if(isset($_GET['id'])){
	$sid = $_GET['id'];
	$sql3="SELECT * FROM student WHERE s_id='{$sid}'";
	$rs3 = mysqli_query($conn, $sql3);
	$data3 = mysqli_fetch_array($rs3);
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>วณิชชา สดใส (มายด์มิ้นท์)</title>
</head>

<body>
<h1>แก้ไขข้อมูลนิสิต -- วณิชชา สดใส (มายด์มิ้นท์)</h1>

<form method="post" action="">
	รหัสนิสิต <input type="text" name="sid" autofocus required readonly
    				value="<?php echo $data3['s_id'];?>"><br>
    ชื่อนิสิต <input type="text" name="sname" required
    				value="<?php echo $data3['s_name'];?>"><br>
    ที่อยู่<br> 
    <textarea name="saddress"><?php echo $data3['s_address'];?></textarea><br>
    เกรดเฉลี่ย <input type="text" name="sgpax" required
    				value="<?php echo $data3['s_gpax'];?>"><br>
    
    คณะ
    <select name="fid">
    <?php
	$sql2= "SELECT * FROM faculty";
	$rs2=mysqli_query($conn,$sql2);
	while($data2=mysqli_fetch_array($rs2)){
	?>
    	<option value = "<?php echo $data2['f_id'];?>"<?php if ($data2['f_id']==$data3['f_id']){
			echo"selected";}else{echo"";} ?> > <?php echo $data2['f_name']; ?> </option>
        
     <?php } ?>
     </select>
     <br><br>
     <button type="submit" name="Submit">บันทึก</button>
</form>
<hr>

<?php
	if(isset($_POST['Submit'])){
	include("connectdb.php");
	$sid = $_POST['sid'];
	$sname = $_POST['sname'];
	$saddress = $_POST['saddress'];
	$sgpax = $_POST['sgpax'];
	$fid = $_POST['fid'];
	$sql = "UPDATE student SET s_name = '{$sname}', s_address='{$saddress}', s_gpax = '{$sgpax}', f_id = '{$fid}' WHERE s_id = '{$_GET['id']}' ";
	mysqli_query($conn,$sql) or die ("insert error");
	
	echo "<script>";
	echo "alert('แก้ไขข้อมูลสำเร็จ');";
	echo"window.location='select_student2.php';";
	echo "</script>";
	}
?>

</body>
</html>