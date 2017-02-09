<?php
session_start();
if(isset($_GET['productId'])&&isset($_SESSION['ID'])&&!empty($_GET['productId'])&&!empty($_SESSION['ID'])&&isset($_GET['bidPrice'])&&!empty($_GET['bidPrice']))
{
	$productId=$_GET['productId'];
	$buyerId=$_SESSION['ID'];
	$bidPrice=$_GET['bidPrice'];
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   try
   {
   $query="select COUNT(*) from requests where productId=? and buyerId=?";
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($productId,$buyerId));
   $row=$query_prepare->fetch();
   if($row['COUNT(*)']==0)
   {
       $query="insert into requests(productId,buyerId,bidPrice,accepted) values(?,?,?,'h')";
       $query_prepare=$conn->prepare($query);
       $query_prepare->execute(array($productId,$buyerId,$bidPrice));
       echo '<b>bidding done</b>';
   }
   else
       echo 'request already sent';
   }
   catch(PDOException $e)
   {
       echo 'some error occur,request not sent sucessfully'.$e->getMessage();
   }

}
?>