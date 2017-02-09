<?php
session_start();
if(!isset($_SESSION['ID']))
header('Location:index.php');
require_once('include/config.inc.php');
require_once('include/connect.inc.php');
if(isset($_FILES['uploaded_image']['name'])&& isset($_POST['price'])&&isset($_POST['type'])&&isset($_POST['description']))
{
	$tempname=$_FILES['uploaded_image']['tmp_name'];
	$minprice=$_POST['price'];
	$prdcttype=$_POST['type'];
	$description=$_POST['description'];
  if(!empty($tempname)&&!empty($minprice)&&!empty($prdcttype)&&!empty($description))
	{
		$name=$_FILES['uploaded_image']['name'];
		$size=$_FILES['uploaded_image']['size'];
		$type=$_FILES['uploaded_image']['type'];
		$prdcttype=trim($prdcttype);
		$maxsize=3713052;
    $extension=strtolower(substr($name,strpos($name,'.')+1));
		if(($extension=='jpg'||$extension=='jpeg')&&$type=='image/jpeg'&&$size<=$maxsize)
		{
		if(move_uploaded_file($tempname,'uploads/'.$name))
		{
			$query="insert into products(userId,category,minPrice,description) value(?,?,?,?)";
            try{
            $query_prepare=$conn->prepare($query);
            $query_prepare->execute(array($_SESSION['ID'],$prdcttype,$minprice,$description));
            $query2="select productId from products where userId=? order by uploadedTime DESC limit 1 ";
            $query_prepare2=$conn->prepare($query2);
            $query_prepare2->execute(array($_SESSION['ID']));
            $aa=$query_prepare2->fetch();
            rename('uploads/'.$name,'uploads/'.$aa['productId'].'.jpg');

            }
            catch(PDOException $es)
            {
             echo 'some error occur ',$e->getMessage();
            }
          // PDOStatement object
		}
		else
		echo 'no file uploaded';
        }
        else 
          echo '<b>*image should be in jpeg or jpg format and size should be less than 3713052 Bytes</b>';
	}
}
?>

<script type="text/javascript">
function getXmlHttpObject()
{
  var xmlhttp=null;
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
  return xmlhttp;
}

function acceptorholdRequest(serialNo,i)
{
  var xmlhttp=null;
  var id='showDetails'+serialNo;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
  if(document.getElementById('acceptorholdRequest'+serialNo).innerHTML=="Accept")
  {
     var url='acceptRequest.php?serialNo='+serialNo;
     xmlhttp.open('GET',url,true);
     xmlhttp.send();
     document.getElementById('acceptorholdRequest'+serialNo).innerHTML="Hold";
  }
  else if(document.getElementById('acceptorholdRequest'+serialNo).innerHTML=="Hold")
  {
     var url='holdRequest.php?serialNo='+serialNo;
     xmlhttp.open('GET',url,true);
     xmlhttp.send();
     document.getElementById('acceptorholdRequest'+serialNo).innerHTML="Accept";
  }
  else;
}

function declineRequest(serialNo,i)
{
  var xmlhttp=null;
  var id='request'+serialNo;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
     var url='declineRequest.php?serialNo='+serialNo;
     xmlhttp.open('GET',url,true);
     xmlhttp.send();
	 document.getElementById(id).innerHTML=''; 
}

function showRequests(productId,i)
{
  var xmlhttp=null;
  var id='showRequests'+i;
  var inner=document.getElementById('requests'+i).innerHTML;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
  if(inner=='See Requests')
  {
  var url='showRequests.php?productId='+productId;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
  document.getElementById('requests'+i).innerHTML='Hide';
  }
  else
  {
     document.getElementById('requests'+i).innerHTML='See Requests';
     document.getElementById(id).innerHTML="";
  }
}

function deleteProduct(productId,i)
{
  var xmlhttp=null;
  var id=i;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
     var url='deleteProduct.php?productId='+productId;
     xmlhttp.open('GET',url,true);
     xmlhttp.send(); 
}
</script>

<?php
	require_once('commonbar.php');
	require_once('navigation.php');
	showheader("Upload an Item");
	shownavigation($_SESSION['username']);
	?>
<div class="container-fluid" style="background-color: #2f4f4f;">
    
   
    <div class="row well col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 " style="background-color: #d3d3d3;" >
      <h2 style="text-align:center">Item Information</h2>
        <form action="seller.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="uploaded_image">Upload Image</label>
                <input type="file" name="uploaded_image"><p class="help-block" required>
            </div>
            <div class="form-group">
                <label for="price">Minimum price</label>
                <input type="text" name="price" class="form-control" placeholder="in Rupees" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="5" name="description" placeholder="Give a description" required></textarea>
            </div>
            <div class="form-group">Type
                <select name="type" size ="1" id="type" class="form-control" required>
                <?php
                $fp=fopen("itemlist.txt","r");
                while($read=fgets($fp))
                {
                    ?>
                    <option value="<?php echo $read;?>"><?php echo $read;?></option>
                <?php
                }
                fclose($fp);
                ?>
                </select>
            </div>
            <button input type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

    <div class="container-fluid" style="background-color: #ffa500;" >
        <h2 style="text-align:center">Previous Uploads</h2>
        <?php
            try{
                $query="select * from products where userId=? order by uploadedTime DESC ";
                $query_prepare=$conn->prepare($query);
                $query_prepare->execute(array($_SESSION['ID']));
				$rows=$query_prepare->fetchAll();
				$i=1;
                foreach($rows as $row)
                {
                     $pos='./uploads/'.$row['productId'].'.jpg';
                	?>
                    <div class="container-fluid well col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2" id="<?php echo $i;?>"  style="background-color: #d3d3d3;">
                    	
                        	<div class="row col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        		<image src="<?php echo $pos ;?>" height="250" width="250" alt="image not found" style="border-radius:5%">
                            </div>
                        	<div class="row col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <p><?php echo '<b>Category: </b>'.$row['category'];?></p>
                                <p><?php echo '<b>Description: </b>'.$row['description'];?></p>
                                <p><?php echo '<b>Base price: </b>Rs '.$row['minPrice'].'</p><p><b>Upload Time: </b>'.$row['uploadedTime'];?></p>
                                <button id="requests<?php echo $i;?>" class="btn btn-primary" onClick="showRequests(<?php echo $row['productId'];?>,<?php echo $i;?>);">See Requests</button>
                                <button id="delete<?php echo $i;?>" class="btn btn-danger" onClick="deleteProduct(<?php echo $row['productId'];?>,<?php echo $i;?>);">Delete This Product</button>
                            </div>
                       	
                            <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showRequests<?php echo $i;?>">
                            </div>
                    </div>
                  
                    <?php
					       $i++; 
                }
            }
            catch(PDOException $e)
            {
                echo 'some error occur ',$e->getMessage();
            }
            ?>
    </div>
    
</body>
</html>
</html>