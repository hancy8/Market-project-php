<?php

session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:../index.php');
}

$user=$_SESSION['user'];

include("header_admin.php");

?>
<head>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="container">

<div>
<h3>Welcome Back to Admin Panel!</h3>
<br><br>
  <div class="row padd">
  	<div class="col-xl-3 col-sm-2 mb-3">
 	<a href="managers.php"><div class="border border-danger shadow-lg p-3 mb-5">
 	<div class="rounded" align="center" >
 		  <i class="fa fa-user-plus fa-5x text-danger display-1" aria-hidden="true" style="font-size:7vw;" ></i>
 		  
 		<div class="border border-danger border-right-0 border-left-0 border-bottom-0">
 		  <h2 class="text-danger p-3" style="font-size:1.5vw;" >Managers</h2>
 		</div>
 	</div>
 </div></a>
            </div>
  	<div class="col-xl-3 col-sm-2 mb-3">
 	<a href="suppliers.php"><div class="border border-danger shadow-lg p-3 mb-5">
 	<div class="rounded" align="center" >
 		  <i class="fa fa-user-secret fa-5x text-danger display-1" aria-hidden="true" style="font-size:7vw;" ></i>
 		  
 		<div class="border border-danger border-right-0 border-left-0 border-bottom-0">
 		  <h2 class="text-danger p-3" style="font-size:1.5vw;" >Suppliers</h2>
 		</div>
 	</div>
 </div></a>
            </div>
            <div class="col-xl-3 col-sm-2 mb-3">
 	<a href="suppliers_payment.php"><div class="border border-danger shadow-lg p-3 mb-5">
 	<div class="rounded" align="center" >
 		  <i class="fa fa-credit-card fa-5x text-danger display-1" aria-hidden="true" style="font-size:7vw;" ></i>
 		  
 		<div class="border border-danger border-right-0 border-left-0 border-bottom-0">
 		  <h2 class="text-danger p-3" style="font-size:1.5vw;" >Suppliers Payment</h2>
 		</div>
 	</div>
 </div></a>
            </div>
  	<div class="col-xl-3 col-sm-2 mb-3">
 	<a href="salesmen.php"><div class="border border-danger shadow-lg p-3 mb-5">
 	<div class="rounded" align="center" >
 		  <i class="fa fa-users fa-5x text-danger display-1" aria-hidden="true" style="font-size:7vw;" ></i>
 		  
 		<div class="border border-danger border-right-0 border-left-0 border-bottom-0">
 		  <h2 class="text-danger p-3" style="font-size:1.5vw;" >Salesmen</h2>
 		</div>
 	</div>
 </div></a>
            </div>

  	<div class="col-xl-3 col-sm-2 mb-3">
 	<a href="customers.php"><div class="border border-danger shadow-lg p-3 mb-5">
 	<div class="rounded" align="center" >
 		  <i class="fa fa-shopping-cart fa-5x text-danger display-1" aria-hidden="true" style="font-size:7vw;" ></i>
 		  
 		<div class="border border-danger border-right-0 border-left-0 border-bottom-0">
 		  <h2 class="text-danger p-3" style="font-size:1.5vw;" >Customers</h2>
 		</div>
 	</div>
 </div></a>
            </div>

    <div class="col-xl-3 col-sm-2 mb-3">
 	<a href="purchases.php"><div class="border border-danger shadow-lg p-3 mb-5">
 	<div class="rounded" align="center" >
 		  <i class="fa fa-truck fa-15x text-danger display-1" aria-hidden="true" style="font-size:7vw;" ></i>
 		  
 		<div class="border border-danger border-right-0 border-left-0 border-bottom-0">
 		  <h2 class="text-danger p-3" style="font-size:1.5vw;" >Purchases</h2>
 		</div>
 	</div>
 </div></a>
            </div>
             <div class="col-xl-3 col-sm-2 mb-3">
 	<a href="add_sale.php"><div class="border border-danger shadow-lg p-3 mb-5">
 	<div class="rounded" align="center" >
 		  <i class="fa fa-shopping-basket fa-15x text-danger display-1" aria-hidden="true" style="font-size:7vw;" ></i>
 		  
 		<div class="border border-danger border-right-0 border-left-0 border-bottom-0">
 		  <h2 class="text-danger p-3" style="font-size:1.5vw;" >Sales</h2>
 		</div>
 	</div>
 </div></a>
            </div>


 <div class="col-xl-3 col-sm-2 mb-3">
 	<a href="truck_report.php">
 	<div class="border border-danger shadow-lg p-3 mb-5">
 	<div class="rounded" align="center" >
 		  <i class="fa fa-bar-chart fa-5x text-danger display-1" aria-hidden="true" style="font-size:7vw;" ></i>
 		  
 		<div class="border border-danger border-right-0 border-left-0 border-bottom-0">
 		  <h2 class="text-danger p-3" style="font-size:1.5vw;" >Report</h2>
 		</div>
 	</div>
 </div></a>
            </div>

  
      
                                    </div>

                                        </div>

</body>

<?php
//include('footer_admin.php');
?>