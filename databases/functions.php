<?php

function getArrayFromDb($host, $database, $username, $password, $sql) {
	$db = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
	$rs = $db->query($sql, PDO::FETCH_ASSOC);
	$res = array();
	foreach($rs as $row) {
		$res[] = $row;
	}
	return $res;
}

?>
