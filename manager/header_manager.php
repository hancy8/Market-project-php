<?php

/* User Validation on each page */

session_start();

include("../includes/connection.php");

if(!isset($_SESSION['user']))
{
	header('location:../index.php');
}

$user=$_SESSION['user'];

/* User Validation on each page */

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fruit Market Sialkot</title>

    <link rel="shortcut icon" href="../images/favicon.png" />
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	
    <link href="../css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Latest compiled and minified CSS Jasny -->
	<link rel="stylesheet" href="../css/jasny-bootstrap.min.css" />
	
	<!-- Typeahead for multiple inputs -->
	<link href="../plugins/typeahead/bootstrap-tagsinput-typeahead.css" rel="stylesheet" />
	<link href="../plugins/typeahead/bootstrap-tagsinput.css" rel="stylesheet" />
	
	<link href="../css/typeahead-style.css" rel="stylesheet" />
	
	
	
	<!--JavaScript Custom Functions-->
	<script src="../js/functions.js"></script>
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/top.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="../js/jasny-bootstrap.min.js"></script>

	
<!-- Responsive Tabs JS
<script src="../js/jquery.responsiveTabs.js" type="text/javascript"></script>

HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
WARNING: Respond.js doesn't work if you view the page via file://
[if lt IE 9]

<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>

[endif]-->

  </head>
  <body>
  
  <header>
    
    <div class="bg_color1">
       
       <div class="container">
          <div class="row">
          
             <div class="col-md-5">
               <div class="text1"><!--<img src="../images/logo_small.png" />--> <b>Fruit Market Sialkot</b> </div>
             </div>
             
             <div class="col-md-1"></div>
             
             <div class="col-md-6">
               <div class="toplinks">
              <div class="links">
                
				<?php
				if(isset($_SESSION['user']))
				{
					echo '
                <div class="logout"> 
					 <a href="logout.php"><span class="hidden-xs">Logout</span></a>
					</div>';
					
					$full_url = $_SERVER['REQUEST_URI'];								//get url
					$cur_url = explode('/', $full_url, 4);
					// $current_url = $cur_url[3];
					$cururl = $cur_url[3];
					$new = explode('.', $cururl, 2);
					$current_url = $new[0];
					// echo $current_url;
				}
				?>

              </div>
            </div>
             </div>
             
          </div>
       </div>
       
    </div>
    
    
    <div class="bg_color3">
      <div class="container">
        <div class="row">
           
           <div class="col-md-9">
           <div class="wsmenucontainer clearfix">

  
		<div class="topnav" id="myTopnav">
		  
				<a <?php if($current_url=="manager") echo 'class="active"'; ?> href="manager.php">Home</a>
		  <?php
		  
		  /* Check Manager's Access Start */
		  
		  $sql=mysqli_query($conn, "SELECT * FROM managers WHERE manager_id='$user'");

			while($select=mysqli_fetch_array($sql))
			{
				$supplier=$select['supplier_access'];
				$customer=$select['customer_access'];
				$stock=$select['stock_access'];
			}
		  
		  if($supplier=='1')
		  {  
		  ?>
		  
		  <a <?php if($current_url=="suppliers" || $current_url=="add_supplier" || $current_url=="edit_supplier") echo 'class="active"'; ?> href="suppliers.php">Suppliers</a>
		  
		  <?php
		  }
		  
		  if($customer=='1')
		  {  
		  ?>
		  
		  <a <?php if($current_url=="customers" || $current_url=="add_customer" || $current_url=="edit_customer") echo 'class="active"'; ?> href="customers.php">Customers</a>
		  
		  <?php
		  }
		  
		  if($stock=='1')
		  { 
		  ?>
		  
		  <a <?php if($current_url=="products" || $current_url=="add_product" || $current_url=="edit_product" || $current_url=="categories" || $current_url=="add_cat" || $current_url=="edit_cat") echo 'class="active"'; ?> href="products.php">Products</a>
		  
		  <?php
		  }
		  ?>
		  
		  <a <?php if($current_url=="reports") echo 'class="active"'; ?> href="#">Reports</a>
		  
			  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			  </a>
			  
		</div>
		  
              </div>
           </div>
           
        </div>
      </div>
    </div>
	
	<hr style="margin-top: 0px; margin-bottom: 20px;">
    
  </header>
  
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>