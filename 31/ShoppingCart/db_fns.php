<?php
function db_connect()
{
	$result = new mysqli('localhost', 'root', 'root', 'book_sc');
	if ($result->connect_error) {
		return false;
	}
	$result->autocommit(true);
	return $result;
}

function db_result_to_array($result): array
{
	$res_array = array();
	for ($count = 0; $row = $result->fetch_assoc(); $count++) {
		$res_array[$count] = $row;
	}
	return $res_array;
}
