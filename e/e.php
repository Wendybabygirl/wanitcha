<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>วณิชชา สดใส (มายด์มิ้นท์)</title>
</head>

<body>
<h1>วณิชชา สดใส (มายด์มิ้นท์)</h1>

	<form method="post" action="">
    กรอกข้อมูล<input type="text" name="a" autofocus>
    <input type="submit" name="Submit" value="OK">
	</form>
    <hr>
    
<?php
/*if(isset($_POST['Submit'])){
	echo $_POST['a'];
}*/

if(isset($_POST['Submit'])){
	$a = $_POST['a'];
	if ($a == "dog" or $a =="หมา" or $a =="สุนัข"){
		echo "<img src='1.jpg' width='540'>";
	}
	else if($a == "cat" || $a =="แมว" || $a =="เหมียว"){
		echo "<img src='2.jpg' width='540'>";
	}
	else if($a == "tiger" or $a =="เสีย" or $a =="เสือ"){
		echo "<img src='3.jpg' width='540'>";
	}else{
		echo "กรอกข้อมูลไม่ถูุกต้อง";
	}
}	
?>

</body>
</html>