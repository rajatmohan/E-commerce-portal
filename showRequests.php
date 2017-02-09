<?php
if(@$_SERVER['HTTP_REFERER']==='http://localhost/olx/seller.php')
{
if(isset($_GET['productId'])&&!empty($_GET['productId']))
{
require_once('include/config.inc.php');
require_once('include/connect.inc.php');
echo '</br>';
$query="select requests.*,users.name,users.phoneno,users.username from requests,users where productId =? and requests.buyerId=users.id and requests.accepted !='n' order by time ASC ";
$query_prepare=$conn->prepare($query);
$query_prepare->execute(array($_GET['productId']));
$rows=$query_prepare->fetchAll();
$conn=NULL;
if(count($rows)==0){
	echo"<h3>No Requests</h3>";
	die();
}
$i=1;
?>
<h3>Your Requests</h3>
<?php
foreach($rows as $row)
{
   echo'<div id="request'.$row['serialNo'].'">';
   if($row['accepted']=='h')
   {
	   echo '<b>Username: </b>'.$row['username'].'</br>';
	   echo '<b>Bid Price:</b>'.' Rs '.$row['bidPrice'].'</br>';
	   echo '<div id="showDetails'.$row['serialNo'].'"></div>';
	   echo '<button id="acceptorholdRequest'.$row['serialNo'].'" class="btn btn-success" onClick="acceptorholdRequest('.$row['serialNo'].','.$i.');">Accept</button>'."&nbsp;&nbsp;&nbsp;&nbsp;";
   }
   else
   { 
	   echo '<b>Username: </b>'.$row['username'].'</br';
	   echo '<b>Price: </b>'.' Rs '.$row['bidPrice'].'</br>';
	   echo '<div id="showDetails'.$row['serialNo'].'">';
	   echo '<b>Name: </b>'.$row['name'].'</br>';
       echo '<b>Phone no: </b>'.$row['phoneno'].'</br>';
	   echo '</div>';
	   echo '<button id="acceptorholdRequest'.$row['serialNo'].'" class="btn btn-primary" onClick="acceptorholdRequest('.$row['serialNo'].','.$i.');">Hold</button>';
   }
   echo '<button id="declineRequest'.$row['serialNo'].'" class="btn btn-danger" onClick="declineRequest('.$row['serialNo'].','.$i.');">Decline</button></br>';
   echo '</br></br>';
   echo '</div>';
   $i++;
}
}	
}
else
die('chalaki');						
?>
