<?php
function showdropdown(){
	?>
<div class="container-fluid">

    <div style="padding-top:20px" class="col-lg-offset-4 col-md-offset-4">
    	<div class="dropdown pull-left">
        	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">gadgets <span class="caret"></span></button>
            <ul class="dropdown-menu">
            	<li><a><button onClick="load('phones')"> phones </button></a></li>
                <li><a><button onClick="load('laptops')"> laptops </button></a></li>
            </ul>
        </div>
 
        <div class="dropdown pull-left">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">study materials <span class="caret"></span></button>
            <ul class="dropdown-menu">
            	<li><button onClick="load('books')"> books </button></li>
                <li><button onClick="load('notes')"> notes </button></li>
            </ul>
        </div>
 
        <div class="dropdown pull-left">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">bicycles <span class="caret"></span></button>
            <ul class="dropdown-menu">
            	<li><button onClick="load('cycle (boys)')"> for boys </button></li>
                <li><button onClick="load('cycle (girls)')"> for girls </button></li>
            </ul>
        </div>
        
        <div class="dropdown pull-left">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">lodging <span class="caret"></span></button>
            <ul class="dropdown-menu">
            	<li><button onClick="load('bucket')"> buckets </button></li>
                <li><button onClick="load('mattress')"> mattress </button></li>
            </ul>
        </div>
     </div>
 </div>
    <?php
}
    ?>
