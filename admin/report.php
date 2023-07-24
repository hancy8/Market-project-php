<?php

session_start();

include("connection.php");

include("../includes/functions.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$user=$_SESSION['user'];

include("header_admin.php");
$id_truck=$_GET['id'];
?>

<div class="container">

<div>
<h3>Closing</h3>
<br>

<form class="form-inline text-center" method="post">
  <div class="form-group">
    <label for="supplier">Select Supplier:</label>
	<select name="supplier" class="form-control">
		
		<?php
			$get_cat=mysqli_query($conn, "SELECT * FROM suppliers");
			while($cat=mysqli_fetch_array($get_cat))
			{
				$id=$cat['supplier_id'];
				$name=$cat['supplier_name'];
				
				echo '<option value="'.$id.'">'.$name.'</option>';
				
			}
		?>

	</select>
  </div>
  <!--<div class="form-group">
    <label for="date">Select Date:</label>
	<input type="date" class="form-control" name="date">
  </div>-->
  <!--<div class="form-group">
    <label for="truck">Select Truck:</label>
	<select name="truck" class="form-control">
		
		<?php
			/* $get_truck=mysqli_query($conn, "SELECT * FROM purchases");
			while($truck=mysqli_fetch_array($get_truck))
			{
				$purchase_id=$truck['purchase_id'];
				$truck=$truck['truck_id'];
				
				echo '<option value="'.$pruchase_id.'">'.$truck.'</option>';
				
			} */
		?>

	</select>
  </div>-->
  <button type="submit" name="report_filter" class="btn btn-default">Submit</button>
</form>

<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Truck</th><th>Supplier</th><th>Product</th><th>Added On</th><th>Total</th><th>Sold</th><th>Remaining</th><th>Commission</th><th>Income</th><th>Action</th>
</tr>

<?php

if(isset($_POST['report_filter']))
{
	
	if(isset($_POST['supplier']))
	{
		$supp_id=$_POST['supplier'];
	}
	
	$sql=mysqli_query($conn, "SELECT * FROM purchases as a INNER JOIN purchase_details as b ON a.purchase_id=b.purchase_id WHERE b.supplier_id='$supp_id' && b.purchase_id='$id_truck' && a.status='open' GROUP BY a.purchase_id");
	
}
	
	/* if(isset($_POST['truck']))
	{
		$truck_id=$_POST['truck'];
	} */
		
	/* if(isset($_POST['date']))
	{
		$getdate=$_POST['date'];
		$get_date=explode('-',$getdate);
		$date=$get_date[2].'-'.$get_date[1].'-'.$get_date[0];
	}
	else
	{
		$date=date("d-m-Y");		 //Current Date
	} */
	
/* 	$sql=mysqli_query($conn, "SELECT * FROM sales WHERE supplier_id='$supplier_id' && sale_date='$date' ORDER BY sale_date DESC");
	
	$sql=mysqli_query($conn, "SELECT * FROM purchases as a INNER JOIN purchase_details as b ON a.purchase_id=b.purchase_id WHERE b.supplier_id='$supp_id' GROUP BY a.purchase_id");
	
	$sql=mysqli_query($conn, "SELECT * FROM purchases WHERE status='open'");

else
{ */

else
{
	$sql=mysqli_query($conn, "SELECT * FROM purchases WHERE purchase_id=$id_truck && status='open'");
}	
	
// }

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='10' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$purchase_id=$select['purchase_id'];
	$truck_id=$select['truck_id'];
	$status=$select['status'];
	$date=$select['purchase_date'];
	$time=$select['purchase_time'];
	$get_purchase_details=mysqli_query($conn, "SELECT * FROM purchase_details WHERE purchase_id='$purchase_id' && status='open'");
	while($purchase_details=mysqli_fetch_array($get_purchase_details))
	{
		$supplier_id=$purchase_details['supplier_id'];
		$pro_id=$purchase_details['product_id'];
		$qty=$purchase_details['quantity'];
	
		$supplier=getSupplier($supplier_id);
		$product=getProduct($pro_id);
		
		
	$total_purchase_items=GetTotal($purchase_id,$supplier_id,$pro_id);
	$total_sold_items=GetSold($purchase_id,$supplier_id,$pro_id);
	$total_revenue=GetRevenue($purchase_id,$supplier_id,$pro_id);
	$total_commission=GetCommission($purchase_id,$supplier_id,$pro_id);
	
	$expenses=GetExpenses($purchase_id, $supplier_id);
	$total_expenses=$expenses+$total_commission;
	$supplier_income=$total_revenue-$total_expenses;
	//echo $total_revenue."<br> EXP:".$total_expenses."<br>";
	$remaining=$total_purchase_items-$total_sold_items;
/* Only those purchases/truks will be shown that have atleast one product having remaining zero stock */
	if($remaining==0)
	{
	
	if(isset($_POST['report_filter']))		//Restricted Records (of Selected Filter Supplier Only)
	{
		if($supplier_id==$supp_id )
		{
			echo "
		<form method='post'>
		<input type='hidden' name='purchaseid' value='$purchase_id' />
		<input type='hidden' name='filter' value='yes' />
		<input type='hidden' name='supplierid' value='$supplier_id' />
		<input type='hidden' name='productid' value='$pro_id' />
		<input type='hidden' name='income' value='$supplier_income' />
		<input type='hidden' name='expenses' value='$expenses' />
		<input type='hidden' name='commission' value='$total_commission' />
		<tr id='$purchase_id'>
		<td>".$purchase_id."</td>
		<td>".$truck_id."</td>
		<td>".$supplier."</td>
		<td>".$product."</td>
		<td>".$date."&nbsp;&nbsp;".$time."</td>
		<td>".$total_purchase_items."</td>
		<td>".$total_sold_items."</td>
		<td>".$remaining."</td>
		<td>".$total_commission."</td>
		<td>".$supplier_income."</td>
		<td><a href='report1.php?purchase_id=$purchase_id&supplier_id=$supp_id'><div class='btn btn-default btn-sm'> Details </div></a><button class='btn btn-primary btn-sm' name='close'> Close </button></td></tr></form>";
		}
		
	}
	else
	{
		echo "
		<form method='post'>
		<tr id='$purchase_id'>
		<input type='hidden' name='purchaseid' value='$purchase_id' />
		<input type='hidden' name='filter' value='no' />
		<input type='hidden' name='supplierid' value='$supplier_id' />
		<input type='hidden' name='productid' value='$pro_id' />
		<input type='hidden' name='income' value='$supplier_income' />
		<input type='hidden' name='expenses' value='$expenses' />
		<input type='hidden' name='commission' value='$total_commission' />
		<input type='hidden' name='sup_name' value='$supplier' />

		<td>".$purchase_id."</td>
		<td>".$truck_id."</td>
		<td>".$supplier."</td>
		<td>".$product."</td>
		<td>".$date."&nbsp;&nbsp;".$time."</td>
		<td>".$total_purchase_items."</td>
		<td>".$total_sold_items."</td>
		<td>".$remaining."</td>
		<td>".$total_commission."</td>
		<td>".$supplier_income."</td>
		<td><a href='report1.php?purchase_id=$purchase_id'><div class='btn btn-default btn-sm'> Details </div></a><button name='close' class='btn btn-primary btn-sm'> Close </button></td></tr></form>";
	}
	
		
		
	}
	
	}

}

}
?>

</table>
</div>

</div>

</body>

<?php
if(isset($_POST['close']))
{
	
	/* $commission=1000;
	$income=2000;
	$expenses=500;

	echo "<script> alert('Purchase Successfully Closed! Expenses: '+$expenses+'. Commission: '+$commission+'. Supplier Income: '+$income); </script>";
	
	die(); */
	$sup_name_pay=$_POST['sup_name'];
	$purchase_id=$_POST['purchaseid'];
	$supplier_id=$_POST['supplierid'];
	$product_id=$_POST['productid'];
	$income=$_POST['income'];
	$expenses=$_POST['expenses'];
	$commission=$_POST['commission'];
	date_default_timezone_set('Asia/Karachi'); 
	$date=date("d-m-Y");
	// $filter=$_POST['filter'];
	
	$update_purchase_status=mysqli_query($conn, "UPDATE purchase_details SET status='closed' WHERE purchase_id='$purchase_id' && supplier_id='$supplier_id' && product_id='$product_id'");

	$supp_payment=mysqli_query($conn, "SELECT * FROM supplier_payment");
	while($supp_insert=mysqli_fetch_array($supp_payment))
	{
		$invoice_id=$supp_insert['invoice'];
		$invoice_name=$supp_insert['sup_name'];
		$invoice_amount=$supp_insert['total_amount'];	
		$invoice_remn=$supp_insert['remn'];		
	}

if($invoice_name==$sup_name_pay)
{
	echo $new_total=$invoice_amount+$income;
	echo $new_remn=$invoice_remn+$income;
	$update_payment=mysqli_query($conn, "UPDATE supplier_payment SET  total_amount = '$new_total', 
		remn = '$new_remn' WHERE invoice = '$invoice_id'");
}
else{
	$insert_payment_status=mysqli_query($conn, "INSERT INTO `supplier_payment` (`invoice`, `sup_name`, `total_amount`, `remn`, `total_paid`, `date`) VALUES (NULL, '$sup_name_pay', '$income', '$income', '', '$date');");
	
	
}

	$check_open_status=mysqli_query($conn, "SELECT * FROM purchase_details WHERE purchase_id='$purchase_id' && status='open'");
	
	$count_open=mysqli_num_rows($check_open_status);
	
	if($count_open==0)
	{
		$update_purchase_status=mysqli_query($conn, "UPDATE purchases SET status='closed' WHERE purchase_id='$purchase_id'");
	}
	
	if($update_purchase_status)
	{
		
	echo "<script> alert('Purchase Successfully Closed! Expenses: '+$expenses+'. Commission: '+$commission+'. Supplier Income: '+$income); </script>";
		echo "<script> location='report.php? id=".$purchase_id."'; </script>";
		
	}
}
?>