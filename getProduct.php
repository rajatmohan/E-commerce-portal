<?php
  session_start();
  if(!isset($_SESSION['ID']))
  header('Location:index.php');
  if(isset($_GET['pname'])&&!empty($_GET['pname'])&&isset($_GET['start']))
  {
   $product=$_GET['pname'];
   $start=(int)$_GET['start'];
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   try{
   $query='select COUNT(*) from products where category = ? and userId != ? ';
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($product,$_SESSION['ID'])); // PDOStatement object
   $rows=$query_prepare->fetch();
   $total_pages=((int)($rows['COUNT(*)']/3)==($rows['COUNT(*)']/3))?($rows['COUNT(*)']/3):(int)($rows['COUNT(*)']/3)+1;
   if($total_pages == 0)
   $total_pages=1;
   $query='select* from products where category = ? and userId != ? limit '.$start.',3';
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($product,$_SESSION['ID'])); // PDOStatement object
   $rows=$query_prepare->fetchAll();
   $num_rows=count($rows);
   $i=1;
   foreach($rows as $row)
   {
	 $query1='select COUNT(*) from requests where productId=? and buyerID=?';
     $query_prepare1=$conn->prepare($query1);
     $query_prepare1->execute(array($row['productId'],$_SESSION['ID'])); // PDOStatement object
     $row1=$query_prepare1->fetch();
     echo '<div id="'.$i.'" class="container-fluid well">';
     echo '<div class="row col-lg-5 col-md-5 col-sm-5 col-xs-5"><image src="uploads/'.$row['productId'].'.jpg" height="150" width="150" alt="image not found" style="border-radius:5%"></div>';
	 echo '<div class="row col-lg-7 col-md-7 col-sm-7 col-xs-7"><p><b>Category: </b>'.$row['category'].'</p>';
	 echo '<p><b>Description: </b>'.$row['description'].'</p>';
	 echo '<p><b>Base Price: </b>'.$row['minPrice'].'</p>';
	 echo '<p><b>Time Uploaded: </b>'.$row['uploadedTime'].'</p>';
	 if($row1['COUNT(*)']==0)
	 {
	    echo '<div id="forBid'.$i.'" class="form-inline">';
	    echo '<input type="text" class="form-control" id="bidPrice'.$i.'" value="'.$row['minPrice'].'">';
        echo '<button class="btn btn-md btn-primary" onClick="sendRequest('.$row['productId'].','.$i.')">Bid</button>';
		echo '</div>';
     }
	 ?>
	 <div id="<?php echo 'othersStatus'.$i;?>">
	 <?php
	 $query2='select COUNT(*),max(bidPrice) from requests where productId=?';
     $query_prepare2=$conn->prepare($query2);
     $query_prepare2->execute(array($row['productId'])); // PDOStatement object
     $row2=$query_prepare2->fetch();
	 if($row2['COUNT(*)']==0){
	 	echo '<h3>No requests</h3>';
	 }
	 else
	 {
	    echo '<p><b>Total Requests: </b>'.$row2['COUNT(*)'].'</p>';
		echo '<p><b>Maximum Bid Price: </b>'.$row2['max(bidPrice)'].'</p>';
	 }
	 echo '</div>';
	 ?>
	  </div>
	 <div class="container-fluid "id="<?php echo 'showStatus'.$i;?>"><?php if($row1['COUNT(*)']!=0) echo '<h3>Request already sent.</h3>' ; ?></div>
	 <?php
	 echo '</div>';
	 $i++;
	 //}
   }
   /*if($i==1)
   echo 'you have already sent request to all of them';
   else
   {*/
   $current_page=(int)($start/3)+1;
   if($current_page==1 && $total_pages!=1)
     echo '<button class="btn btn-success" onClick="increment(\''.$product.'\')">Next</button>';
   else if($current_page<$total_pages)
   {
     echo '<button class="btn btn-success" onClick="decrement(\''.$product.'\')">Previous</button>';
	 echo '<button class="btn btn-default" onClick="increment(\''.$product.'\')">Next</button>';
   }
   else if($current_page==$total_pages&&$total_pages!=1)
     echo '<button class="btn btn-success" onClick="decrement(\''.$product.'\')">Previous</button>';  
  //)
   $conn=null;
   }
    catch(PDOException $e)
   {
   die('some error occured:'.$e->getMessage());
   }
  }
else
echo 'some error occur';
?>