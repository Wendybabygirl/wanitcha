<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>วณิชชา สดใส (มายด์มิ้นท์)</title>
</head>

<body>
<h1>วณิชชา สดใส (มายด์มิ้นท์)</h1>

	<form method="post" action="">
    รหัสนิสิต <input type="number" name="a" autofocus>
    <input type="submit" name="Submit" value="OK">
	</form>
    <hr>
    
<?php
    if (isset($_POST['Submit'])){
        $id = $_POST['a'];
        echo "รหัสนิสิต: ".$id . "<br>";
        $y = substr($id, 0, 2);
        echo "<img src='http://202.28.32.211/picture/student/{$y}/{$id}.jpg' width='400'>";
    }
    ?>

</body>
</html>