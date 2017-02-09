<?php
session_start();
$string1="";
if(isset($_POST['sendOTP']))
{
  if(isset($_POST['new_username'])&&!empty($_POST['new_username']))
 {
           require_once('include/config.inc.php');
           require_once('include/connect.inc.php');
           $query="select emailAddress,id from users where username = ?";
           try{
              $query_prepare=$conn->prepare($query);
              $query_prepare->execute(array($_POST['new_username'])); // PDOStatement object
              $rows=$query_prepare->fetchAll();
              $num_rows=count($rows);
              if($num_rows==1)
               {
                  $string="ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
                  $mail_content=substr(str_shuffle($string), 0,6);
                  $content=$mail_content;
                  echo $mail_content;
                  $_SESSION['mail_content']=$mail_content;
                  $_SESSION['username']=$_POST['new_username'];
                  $mail_to=$rows[0]['emailAddress'];
                  mail($mail_to,"your OTP","Your OTP is $mail_content");
                  $string1='success';
              }
            else
             $string1='username not found';
               }
              catch(PDOException $e)
              {
                 $string1='Some error occured:'.$e->getMessage();
              }
              $conn=null;
   
 }
}
if(isset($_POST['submitotp']))
{
  if(isset($_POST['otp'])&&!empty($_POST['otp']))
  {
     if($_POST['otp']===$_SESSION['mail_content'])
     {
          require_once('include/config.inc.php');
           require_once('include/connect.inc.php');
           $query="select id,username from users where username = ?";
           try{
              $query_prepare=$conn->prepare($query);
              $query_prepare->execute(array($_SESSION['username'])); // PDOStatement object
              $rows=$query_prepare->fetchAll();
              $num_rows=count($rows);
              if($num_rows==1)
               {
                session_destroy();
                session_start();
                $_SESSION['ID']=$rows[0]['id'];
                 $_SESSION['username']=$rows[0]['username'];
               header('Location:myProfile.php');
              }
            else
             $string1='username not found';
               }
              catch(PDOException $e)
              {
                 $string1='Some error occured:'.$e->getMessage();
              }
              $conn=null;
     }
     else
      $string1='otp does not match';
  }
}
?>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="style/css/index.css">
  <link rel="stylesheet" href="style/css/bootstrap.min.css">
    <script src="style/js/jquery.min.js"></script>
    <script src="style/js/bootstrap.min.js"></script>
</head>


          <script src="style/js/jquery.min.js"> </script>
          <script src="style/js/bootstrap.min.js"> </script>
          <div class="container-fluid" style="background-color: #7cfc00;" >
          <h3 align:center>ENTER USERNAME AND WEBSITE WILL GENERATE OTP</h3>

            
               <div class="container-fluid-well col-lg-6 col-md-8 col-sm-6 col-xs-6 style="background-color: #111111;">
          <div class="form-group">
  <form action="forgotpassword.php" method="post">
                        <label for="username">USERNAME: </label><input type="text" name="new_username" class="form_control" value="" maxlength="30">
                            
                        <button input type="submit" name="sendOTP" class="btn btn-sm btn-danger">sendOTP</button>
                        
                  <form>
                  </div>
                  
                    <form action="forgotpassword.php" method="post">
  
                        <label for="otp">ENTER OTP: </label><input type="text" name="otp" class="form_control" value="" maxlength="30">
                            
                        <button input type="submit" name="submitotp" class="btn btn-sm btn-primary">SUBMITOTP</button>
                        
                    </form>
                  </div>
                  </div>
                </div>
              </div>
              <h2>this page is not working unable to use the mailer class </h2> 
    <?php

echo $string1;
    ?>           