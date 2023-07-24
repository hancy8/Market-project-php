
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
	 

  <!-- Demo scripts for this page-->



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
                <div id="google_translate_element"></div>
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
           
           <div class="col-md-12">
           <div class="wsmenucontainer clearfix">

  
		<div class="topnav" id="myTopnav">
		
		  
		  <a <?php if($current_url=="admin") echo 'class="active"'; ?> href="admin.php">Home</a>
		  
		  <a <?php if($current_url=="managers" || $current_url=="add_manager" || $current_url=="edit_manager") echo 'class="active"'; ?> href="managers.php">Managers</a>
		
		  <a <?php if($current_url=="suppliers" || $current_url=="add_supplier" || $current_url=="edit_supplier") echo 'class="active"'; ?> href="suppliers.php">Suppliers</a>
		  <a <?php if($current_url=="suppliers_payment" || $current_url=="add_payment" || $current_url=="edit_payment") echo 'class="active"'; ?> href="suppliers_payment.php">Supplier Payment</a>
		  
		  <a <?php if($current_url=="salesmen" || $current_url=="add_salesman" || $current_url=="edit_salesman") echo 'class="active"'; ?> href="salesmen.php">Salesmen</a>
		  
		  <a <?php if($current_url=="customers" || $current_url=="add_customer" || $current_url=="edit_customer") echo 'class="active"'; ?> href="customers.php">Customers</a>
		  
		  <a <?php if($current_url=="products" || $current_url=="add_product" || $current_url=="edit_product" || $current_url=="categories" || $current_url=="add_cat" || $current_url=="edit_cat") echo 'class="active"'; ?> href="products.php">Products</a>
		  
		  <a <?php if($current_url=="purchases" || $current_url=="add_purchase" || $current_url=="add_purchase_details" || $current_url=="edit_purchase" || $current_url=="view_purchase") echo 'class="active"'; ?> href="purchases.php">Purchases</a>
		  
		  <a <?php if($current_url=="sales" || $current_url=="add_sale" || $current_url=="add_single_sale") echo 'class="active"'; ?> href="add_sale.php">Sales</a>
		  <a <?php if($current_url=="expense" || $current_url=="add_expense" || $current_url=="edit_expense") echo 'class="active"'; ?> href="expense.php">Expense</a>
		  <a <?php if($current_url=="deadlock" || $current_url=="ass_deadlock" || $current_url=="edit_deadlock") echo 'class="active"'; ?> href="deadlock.php">DeadLock</a>
		  <a <?php if($current_url=="report" || $current_url=="report1" || $current_url=="truck_report" ) echo 'class="active"'; ?> href="truck_report.php">Reports</a>

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
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>