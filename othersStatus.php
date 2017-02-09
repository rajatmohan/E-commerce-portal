<?php
session_start();
  if(isset($_GET['productId'])&&!empty($_GET['productId']))
  {
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   $productId=(int)$_GET['productId'];
   try{
	 $query2='select COUNT(*),max(bidPrice) from requests where productId=?';
     $query_prepare2=$conn->prepare($query2);
     $query_prepare2->execute(array($productId)); // PDOStatement object
     $row2=$query_prepare2->fetch();
	 if($row2['COUNT(*)']==0)
	 echo 'No requests';
	 else
	 {
	    echo 'Total '.$row2['COUNT(*)'].' requests  and maximum bid price is '.$row2['max(bidPrice)'];
	 }
	 }
	 catch(PDOException $e)
   {
   die('some error occured:'.$e->getMessage());
   }
 }
?>