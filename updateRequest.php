<?php
if(@$_SERVER['HTTP_REFERER']==='http://localhost/olx/myRequests.php')
{
if(isset($_GET['serialNo'])&&!empty($_GET['serialNo'])&&isset($_GET['bidPrice'])&&!empty($_GET['bidPrice']))
{
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   $query="update requests set bidPrice=? , accepted='h' ,time=CURRENT_TIMESTAMP ,statusTime=CURRENT_TIMESTAMP where serialNo=?";
   try{
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($_GET['bidPrice'],$_GET['serialNo']));
   echo '<b>Updated successfully.</b>';
   }
   catch(PDOException $e)
            {
             echo 'some error occur ',$e->getMessage();
            }
}
}
else
die('died');
?>