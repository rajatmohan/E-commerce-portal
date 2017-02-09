<script>
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
function getNotifications()
{
	  var xmlhttp=null;
	  var id="notifications";
	  var xmlhttp=getXmlHttpObject();
	  xmlhttp.onreadystatechange=function(){
	  if(xmlhttp.readyState==4&&xmlhttp.status==200)
	  {
		 document.getElementById(id).innerHTML=xmlhttp.responseText;
	  }
	  }
	  if(document.getElementById('getNotifications').innerHTML=='Notifications')
	  {
		  var url='getNotifications.php';
		  xmlhttp.open('GET',url,true);
		  xmlhttp.send();
		  document.getElementById('getNotifications').innerHTML='Hide Notifications';
	  }
	  else
	  {
		  document.getElementById(id).innerHTML='';
		  document.getElementById('getNotifications').innerHTML='Notifications';
	  }
 }
</script>
<?php
function shownavigation(){
	?>
        <div class="container-fluid" >
            <ul class="nav nav-tabs">
            <li><a href="cell.php">Buy</a></li>
            <li><a href="seller.php">Sell/Previous Uploads</a></li>
            <li><a href="myProfile.php">Edit Profile</a></li>
            <li><a href="myRequests.php">My Requests</a></li>
            <li><a href="logout.php">Logout <b>[<?php echo $_SESSION['username']; ?>]</b></a></li>
            <div class="col-lg-2 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
            <button class="btn btn-primary" onClick="getNotifications();" id="getNotifications">Notifications</button>
            <div id="notifications" style="position:absolute; background-color:rgba(192,220,245,1.00); z-index:1000"></div>
            </div>
            </ul>
            
        </div>
	<?php
}
?>
