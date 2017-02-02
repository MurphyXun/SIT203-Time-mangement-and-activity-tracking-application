<?php

	include('__json_encode.php');
	$Username_mb=$_GET["username"];
	$Password_mb=$_GET["password"];

	include('connect.php');
	$query_username="select * FROM Account WHERE Username='".$Username_mb."'";
	$stmt=oci_parse($connect,$query_username);
	if(!$stmt)
	{
		echo "An error occurred in parsing the sql string.\n";
		exit;
	}

	oci_execute($stmt);

	while(oci_fetch($stmt))
	{
		$Password_db=oci_result($stmt,2);
	}

	if($Password_db != $Password_mb)
	{
		$flag=false;
		$result = array(
		"code" => 400,
		"message" => "fail",
		"data" => array("username"=>"murphy", "phone"=>"0451576788"));
		echo __json_encode($result);
	}
	else
	{
		$flag=true;
		echo __json_encode($result);
	}
	oci_close($connect);
?>
