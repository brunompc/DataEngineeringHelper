<?php

function getArrayFromDb($database, $username, $password, $sql) {
	$db = new PDO('mysql:host=localhost;dbname=' . $database, $username, $password);
	$rs = $db->query($sql);
	$res = array();
	foreach($rs as $row) {
		$res[] = $row;
	}
	return $res;
}

//$array = getArrayFromDb("empresa", "root", "", "select * from funcionarios");

$array = getArrayFromDb("dp_old", "root", "", "select * from submission limit 0, 10");

echo "yolo<br>";
print_r($array);

?>
