<?php
session_start();
if(isset($_SESSION['ID']))
{
  require_once('include/config.inc.php');
  require_once('include/connect.inc.php');
  $query="update users set lastLogout=CURRENT_TIMESTAMP  where id=?";
  try{
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($_SESSION['ID']));
   }
   catch(PDOException $e)
   {
      echo 'some error occur ',$e->getMessage();
   }
  session_destroy();   
  header("Location:index.php");
}
else
die("not logged in");
?>
