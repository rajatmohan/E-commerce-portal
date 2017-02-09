<?php
function showheader($title){
	?>
    
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="style/css/index.css">
	<link rel="stylesheet" href="style/css/bootstrap.min.css">
    <script src="style/js/jquery.min.js"></script>
    <script src="style/js/bootstrap.min.js"></script>
</head>
    <body>
	<div class="container-fluid" style="background-color:#20b2aa";>
        <div class="row" style="background-color:#20b2aa"; >
            
            <div class="logo_text col-lg-1 col-md-1 col-sm-1 col-xs-1 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-offset-5" id = "logo_mini">mini</div>
            <div id="logo_o" class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            <div class = "logo_text" id = "logo_lx">LX</div>
        </div>
	<h4 style="text-align:center"><span class="label label-default">buy</span> or <span class="label label-default">sell</span>, <span class="label label-default">lend</span> or <span class="label label-default">borrow</span></h4>
    <hr>
    </div>
<?php
}
?>