<?php
  session_start();
  if(!isset($_SESSION['ID'])){
	  header('Location:index.php');
  }
  $count_notifications=0;
  require_once('include/config.inc.php');
  require_once('include/connect.inc.php');
  $query="select lastLogout from users where id=?";
  try{
	   $query_prepare=$conn->prepare($query);
	   $query_prepare->execute(array($_SESSION['ID']));
	   $row=$query_prepare->fetch();
	   $query2="select distinct category from products where userId!=? and uploadedTime >=?";
	   $query_prepare2=$conn->prepare($query2);
	   $query_prepare2->execute(array($_SESSION['ID'],$row['lastLogout']));
	   $rows2=$query_prepare2->fetchAll();
	   $n_category=count($rows2);
	   echo '<li>';
	   if($n_category!=0)
	   {
		?>
<div class="well">
	<div class="well"> 
    <?php
		 echo 'New items uploaded in category ';
     $count_notifications++;
	?>
    </div>
    <hr>
    <?php
		  for($i=0;$i<$n_category;$i++)
		  {
	?>
             <div class="row well">
    			<?php
			 echo $rows2[$i]['category'];
			 if($i!=$n_category-1)
			 echo ' , ';
				?>
    		</div>
    <?php
		  }
	 
	   }
	   else{
	?>
    <div class="well">
    	<?php
	   		echo '<b>no new product uploaded</b>';
	   }
	   echo '</li>';
	  	?>
    </div>
    <hr>
</div>
    <?php
	   $query3="select distinct products.category , requests.accepted from products,requests where requests.buyerId=? and requests.accepted!='h' and requests.productId=products.productId and requests.statusTime>=?";
	   $query_prepare3=$conn->prepare($query3);
	   $query_prepare3->execute(array($_SESSION['ID'],$row['lastLogout']));
	   $rows3=$query_prepare3->fetchAll();
     $category_accepted;
     $category_rejected;
     $a_i=0;
     $r_i=0;
	   foreach($rows3 as $row3)
	   {
		  //echo '<li>';
		  //echo 'Request for a product in category '.$row3['category'].' is ';
		  if($row3['accepted']=='y')
      {
        $category_accepted[$a_i]=$row3['category'];
        $a_i++;
		   //echo 'accepted';
      }
		  else
      {
        $category_rejected[$r_i]=$row3['category'];
        $r_i++;
		  //echo 'rejected';
      }
		  //echo '</li>';
	   }
     if($a_i!=0)
     {
       echo '<li>';
       echo '<b>';
       echo 'Your request for some product in category ';
       $count_notifications++;
       for($i=0;$i<$a_i;$i++)
         {
           if($i!=$a_i-1)
            echo $category_accepted[$i].',';
            else
            echo $category_accepted[$i];

         }
         if($a_i==1)
         echo '<b> is accepted</b>';
       else
        echo ' are accepted';
         echo '</li>';
     }
     if($r_i!=0)
     {
      echo '<li>';
       echo 'Your request for some product in category ';
       $count_notifications++;
       for($i=0;$i<$r_i;$i++)
         {
           if($i!=$r_i-1)
            echo $category_rejected[$i].',';
          else
            echo $category_rejected[$i];
         }
         if($r_i==1)
         echo ' is rejected';
          else
            echo ' are rejected';
         echo '</li>';
     }


	   $query4="select productId,category from products where userId=? ";
	   $query_prepare4=$conn->prepare($query4);
	   $query_prepare4->execute(array($_SESSION['ID']));
	   $rows4=$query_prepare4->fetchAll();
	   foreach($rows4 as $row4)
	   {
		  $query5="select count(*) from requests where productId=? and time>=?";
		  $query_prepare5=$conn->prepare($query5);
		  $query_prepare5->execute(array($row4['productId'],$row['lastLogout']));
		  $row5=$query_prepare5->fetch();
		  if($row5['count(*)']!=0)
		  {
        $count_notifications++;
			 echo '<li>';
			 echo $row5['count(*)'].'<b> requests for one of the product in category </b>'.$row4['category'];
			 echo '</li>';
       echo '<li class="divider">';
       echo '</li>';

		  }
	   }
   }
   catch(PDOException $e)
   {
      echo 'some error occured ',$e->getMessage();
   }
   echo ' <b>&nbsp number of notificatons = </b>'. $count_notifications;
   echo '</b>';
?>