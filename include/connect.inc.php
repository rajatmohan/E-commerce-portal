<?php
try{
	$conn=new PDO($dsn,$db_user,$db_password);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // To set PDO to raise exceptions whenever database errors occur
}
catch(PDOException $e)
{
	echo 'Connection failed: '.$e->getMessage();
	die();
}
?>
