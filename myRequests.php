<?php
   session_start();
   if(!isset($_SESSION['ID'])){
   	   header('Location:index.php');
   }
   require_once('commonbar.php');
   require_once('navigation.php');
   showheader("My Requests");
   shownavigation();
?>

<script type="text/javascript">
function deleteRequest(serialNo,i)
{
  var xmlhttp=null;
  var id=i;
  try
  {
     xmlhttp=new XMLHttpRequest();     
  }
  catch(e)
  {
     try
     {
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
     }
     catch(e)
     {
       xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
  }
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
  var url='deleteRequest.php?serialNo='+serialNo;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
}

function updateRequest(serialNo,i)
{
  var xmlhttp=null;
  var id='updatestatus'+i;
  var bidPrice=document.getElementById('bidPrice'+i).value;
  try
  {
     xmlhttp=new XMLHttpRequest();     
  }
  catch(e)
  {
     try
     {
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
     }
     catch(e)
     {
       xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
  }
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
  var url='updateRequest.php?serialNo='+serialNo+'&bidPrice='+bidPrice;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
}
</script>

<?php

   require_once('include/config.inc.php');
   require_once('include/connect.inc.php'); 
   
   try{
	   $query='select* from requests where buyerId = ? order by time DESC ';
	   $query_prepare=$conn->prepare($query);
	   $query_prepare->execute(array($_SESSION['ID'])); 			// PDOStatement object
	   $rows=$query_prepare->fetchAll();
	   $num_rows=count($rows);
	   ?>
   
   <div class="container-fluid" style="background-color:#2f4f4f">
    
  	<?php echo '<h4 align="center" style="color:#98CCDF">You have made '.$num_rows.' requests till now </br> (after updating keep on refreshing the page)</h4>';?>
  
   <?php
   		$i=1;
   echo '<div class="row">';
   foreach($rows as $row)
   {
	echo'<div class="container" style="background-color:#2f4f4f" id="'.$i.'">'; 
		 echo'<div class="row well col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 " style="" >';
		 $query2='select COUNT(*),max(bidPrice) from requests where productId=?';
		 $query_prepare2=$conn->prepare($query2);
		 $query_prepare2->execute(array($row['productId'])); // PDOStatement object
		 $row2=$query_prepare2->fetch();
   ?>
    <div class="row">
     <?php echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><image src="uploads/'.$row['productId'].'.jpg" height="240" width="240" alt="image not found" style="border-radius:5%"></div>';
	 echo '<div>';
	 if($row2['COUNT(*)'] <= 0){
		echo '<p><b>No one else has requested this Item</b></p>';
	 }
	 else{
    	echo '<p>This Item is Requested by <b>'.$row2['COUNT(*)'].' other people </b></p>';
		echo '<p><b>Maximum Bid Price</b> till now is Rs <b>'.$row2['max(bidPrice)'].'</b></p>';  
	 }
	 $query='select users.username,users.name,users.phoneno,products.userId from products,users where products.productId = ? and users.Id=products.userId limit 1';
     $query_prepare=$conn->prepare($query);
     $query_prepare->execute(array($row['productId'])); // PDOStatement object
     $row2=$query_prepare->fetch();
	 if(!isset($row2['username'])){
		echo"Product deleted";
 	 }
	 else if($row['accepted']=='y'){  
	    echo '<p>Your Request Status: <b>Accepted <b>';
		echo '<p><b>Contact Details of Seller:-</b></p>';
		echo '<p></b>Username: </b>'.$row2['username'].'</p>';
	    echo '<p><b>Name: </b>'.$row2['name'].'</p>';
        echo '<p><b>Phone Number: </b>'.$row2['phoneno'].'</p>';
	 }
	 else if($row['accepted']=='n'){
	    echo '<p>Your Request Status: <b>Rejected</b></p>';
		echo '<div class="form-inline">';
		echo '<input type="text" class="form-control" id="bidPrice'.$i.'" value="'.$row['bidPrice'].'">';
		echo '<button class="btn btn-sm btn-warning" onClick="updateRequest('.$row['serialNo'].','.$i.');">Update Request</button>';
		echo '</div>';
		echo'<div id="updatestatus'.$i.'"></div>';
		echo'</br>';
	 }
	 else{ 
	    echo '<p><b>No Response from Seller</b></p>';
		echo '<div class="form-inline">';
		echo '<input type="text" class="form-control" id="bidPrice'.$i.'" value="'.$row['bidPrice'].'">';
		echo '<button class="btn btn-sm btn-primary" onClick="updateRequest('.$row['serialNo'].','.$i.');">Update Request</button>';
		echo '</div>';
		echo '<div id="updatestatus'.$i.'"></div>';
		echo '</br>';
	 }
	echo '<button class="btn btn-danger" onClick="deleteRequest('.$row['serialNo'].','.$i.');">Delete request</button>';
     $i++;   

	echo '</div>';
	echo '</div>';  
	echo'</div>';
  echo '</div>';  
   }
  
   }
   
   catch(PDOException $e){
   		die('some error occured:'.$e->getMessage());
   }
   $conn=null;
 ?>  
    
  </body>
  </html>