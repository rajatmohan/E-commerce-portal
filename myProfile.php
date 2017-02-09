<?php
session_start();
if(!isset($_SESSION['ID']))
header('Location:index.php');
   $string2="";
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   if(isset($_POST['username_submit']))
   {
      if(isset($_POST['new_username'])&&!empty($_POST['new_username']))
	  {
	     $username=$_POST['new_username'];
		 $query="select* from users where username=?";
		 try{
			 $query_prepare=$conn->prepare($query);
             $query_prepare->execute(array($username));
     	     $rows=$query_prepare->fetchAll();
			 if(count($rows)==0)
			 {
		        $query="update users set username=? where id=?";
                $query_prepare=$conn->prepare($query);
                $query_prepare->execute(array($username,$_SESSION['ID'])); // PDOStatement object
                $string2="username changed";
             }
			 else
		     {
			    $string2="Username already exits";
		     }
		 }
         catch(PDOException $e)
         {
                 $string2='some error occured:'.$e->getMessage();
         }
	  }
   }
   if(isset($_POST['signin_submit']))
   {
      if(isset($_POST['new_userfullname'])&&isset($_POST['new_userphoneno']))	
      {
	      $phoneno=$_POST['new_userphoneno'];
	      $fullname=strtoupper($_POST['new_userfullname']);
	      try{
			$query="update users set name=?,phoneno=? where id=?";
			$query_prepare=$conn->prepare($query);
            $query_prepare->execute(array($fullname,$phoneno,$_SESSION['ID']));
			$string2="Account updated";
		    }
		   catch(PDOException $e)
           {
             $string2='some error occured:'.$e->getMessage();
           }
       }
       else
        $string2="Some fields empty";
   }
   if(isset($_POST['changepass_submit']))
   {
      if(isset($_POST['new_password'])&&isset($_POST['new_confpassword']))	
      {
	     $password=$_POST['new_password'];
         $confpassword=$_POST['new_confpassword'];
	      if(!empty($password)&&!empty($confpassword))
          {
		     if($password===$confpassword)
             {
			     try{
			        $query="update users set password=password(?) where id=?";
			        $query_prepare=$conn->prepare($query);
                    $query_prepare->execute(array($password,$_SESSION['ID']));
			        $string2="Password changed";
		          }
		          catch(PDOException $e)
                  {
                     $string2='some error occured:'.$e->getMessage();
                  }
			  }
			  else
			     echo 'Password did not match';
		   }
		   else
		     echo 'Some field empty';
	   }
   }
   $query="select username,name,phoneno from users where id=? limit 1";
   try{
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($_SESSION['ID']));
   $row=$query_prepare->fetch();
   }
   catch(PDOException $e)
   {
      die ('some error occur '.$e->getMessage());
   }
?>
<?php
	require_once('commonbar.php');
	require_once('navigation.php');
	showheader("Edit your Details");
	shownavigation();
?>

    <div class="container-fluid" style="background-color:#2f4f4f">
    <form action="myProfile.php" method="post">
    	<div class="row">
            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">
            <label for="username"><span style="color:#98CCDF">Username: </span></label>
            <input type="text" name="new_username" class="form-control" value="<?php echo $row['username'];?>" maxlength="30">
            </div>
        </div>
        <button input type="submit" name="username_submit" class="btn  btn-primary col-lg-offset-4 col-md-offset-3 col-sm-offset-3">Change Username</button> 
    </form>
    <form action="myProfile.php" method="post">
  		<div class="row">
           <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">
           <label for="fullname"><span style="color:#98CCDF">Name: </span></label>
           <input type="text" name="new_userfullname" class="form-control" value="<?php echo $row['name'];?>" maxlength="30">
           </div>
       </div>
       <div class="row">
           <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">
           <label for="phoneno"><span style="color:#98CCDF">Phone Number: </span></label>
           <input type="text" name="new_userphoneno" class="form-control" value="<?php echo $row['phoneno'];?>" maxlength="10">
           </div>
       </div>
       <button input type="submit" name="signin_submit" class="btn  btn-primary col-lg-offset-4 col-md-offset-3 col-sm-offset-3">Update Details</button>                    
    </form>
    
    <form action="myProfile.php" method="post">
      <div class="row">
          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">
           <label for="password"><span style="color:#98CCDF">New Password: </span></label>
           <input type="password" name="new_password" class="form-control" maxlength="41">
          </div>
      </div>
	   <div class="row">
           <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">
           <label for="password"><span style="color:#99CCDF">Confirm New Password: </span></label>
           <input type="password" name="new_confpassword" class="form-control" maxlength="41">
           </div>
       </div>
       <button input type="submit" name="changepass_submit" class="btn  btn-primary col-lg-offset-4 col-md-offset-3 col-sm-offset-3">Change Password</button>
    </form>
    </div>

	<?php
    if($string2!="")
    {
       echo '<div class="warning">';
	   echo $string2;
	   echo '</div>';
    }
    ?>
 
</body>
</html>