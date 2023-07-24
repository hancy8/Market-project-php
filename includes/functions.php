<?php



function getCustomer($cust_id)
{
	include('connection.php');
	
	// $cust_id=id;
	$get_customer=mysqli_query($conn, "SELECT * FROM customers WHERE customer_id='$cust_id'");
	$count=mysqli_num_rows($get_customer);
	while($cust=mysqli_fetch_array($get_customer))
	{
		$customer=$cust['customer_name'];
	}
	if($count>0)
	{
		return $customer;
	}
	else
	{
		return 0;
	}
}

function getSupplier($supp_id)
{
	
	include('connection.php');
	$supplier="";
	$get_supplier=mysqli_query($conn, "SELECT * FROM suppliers WHERE supplier_id='$supp_id'");
	while($supp=mysqli_fetch_array($get_supplier))
	{
		$supplier=$supp['supplier_name'];
	}
	
	return $supplier;
}

function getProduct($pro_id)
{
	include('connection.php');
	
	// $cust_id=id;
	$product="";
	$get_product=mysqli_query($conn, "SELECT * FROM products WHERE product_id='$pro_id'");
	while($pro=mysqli_fetch_array($get_product))
	{
		$product=$pro['product_name'];
	}
	
	return $product;
}

function getCategory($cat_id)
{
	include('connection.php');
	
	// $cust_id=id;
	$get_category=mysqli_query($conn, "SELECT * FROM product_cats WHERE cat_id='$cat_id'");
	while($cat=mysqli_fetch_array($get_category))
	{
		$category=$cat['cat_name'];
	}
	
		return $category;
	
}

function GetRemaining($purchase_id,$supplier_id,$product_id,$quantity)
{

include("connection.php");


$gettotal=mysqli_query($conn, "SELECT sum(quantity) as count FROM purchases as a INNER JOIN purchase_details as b ON a.purchase_id=b.purchase_id WHERE a.status='open' && a.purchase_id='$purchase_id' && b.supplier_id='$supplier_id' && b.product_id='$product_id'");

// $count=mysqli_num_rows($gettotal);

while($getinitialcount=mysqli_fetch_array($gettotal))
{
	$initial_count=$getinitialcount['count'];
}

/* echo $initial_count;
die(); */

$getsales=mysqli_query($conn, "SELECT sum(quantity) as sum FROM sales WHERE purchase_id='$purchase_id' && supplier_id='$supplier_id' && product_id='$product_id'");

while($getsalesum=mysqli_fetch_array($getsales))
{
	$sales_count=$getsalesum['sum'];
}

/* echo $sales_count;
die(); */

$totalcount=$initial_count-$sales_count;

/* echo $totalcount;
die(); */

if($totalcount>=0)
{

	$remaining=$totalcount-$quantity;

	return $remaining;

}
else
{
	return "";
}

}

function GetTotal($purchase_id, $supplier_id, $product_id) //Purchase Quantity of a specific product related to some supplier in a specific purchase
{
	include("connection.php");
	
	$gettotal=mysqli_query($conn, "SELECT * FROM purchase_details WHERE purchase_id='$purchase_id' && supplier_id='$supplier_id' && product_id='$product_id' && status='open'");

while($getcount=mysqli_fetch_array($gettotal))
{
	$count=$getcount['quantity'];
}

$check=mysqli_num_rows($gettotal);


if($check>0)
{
	return $count;
}
else
{
	return "";
}


}

function GetSold($purchase_id, $supplier_id, $product_id) //Purchase Quantity of a specific product related to some supplier in a specific purchase
{
	include("connection.php");
	
	/* echo $purchase_id, $supplier_id, $product_id;
	die(); */
	
	$getsales=mysqli_query($conn, "SELECT sum(quantity) as count FROM sales WHERE purchase_id='$purchase_id' && supplier_id='$supplier_id' && product_id='$product_id'");

while($getcount=mysqli_fetch_array($getsales))
{
	$count=$getcount['count'];
}

return $count;

}

function GetRevenue($purchase_id, $supplier_id, $product_id) //Revenue from a specific product related to some supplier in a specific purchase
{
	include("connection.php");
	
	$getrevenue=mysqli_query($conn, "SELECT sum(bill) as revenue FROM sales WHERE purchase_id='$purchase_id' && supplier_id='$supplier_id' && product_id='$product_id'");

while($getcount=mysqli_fetch_array($getrevenue))
{
	$revenue=$getcount['revenue'];
}

return $revenue;

}

function GetCommission($purchase_id, $supplier_id, $product_id) //Commission generated from all products related to particular purchase
{
	include("connection.php");
	
	$getcomm=mysqli_query($conn, "SELECT sum(commission) as commission FROM sales WHERE purchase_id='$purchase_id' && supplier_id='$supplier_id' && product_id='$product_id'");

while($getcount=mysqli_fetch_array($getcomm))
{
	$commission=$getcount['commission'];
}

return $commission;

}

function GetExpenses($purchase_id, $supplier_id) //Expenses of a particular supplier for a particular purchase
{
	include("connection.php");
	
	$getexp=mysqli_query($conn, "SELECT * FROM purchases as a INNER JOIN purchase_details as b ON a.purchase_id=b.purchase_id WHERE a.purchase_id='$purchase_id' && b.status='open'");
	
	$count=mysqli_num_rows($getexp);
	
	//echo $count;

while($getcount=mysqli_fetch_array($getexp))
{
	$expense=$getcount['transport_cost'];
}
//echo $expense;
// echo round($expense);

$expenses=$expense/$count;

$supplier_expenses=round($expenses);

return $supplier_expenses;

}

function CloseTruck($purchase_id)
{
	include("connection.php");
	
	$getcomm=mysqli_query($conn, "SELECT sum(commission) as commission FROM sales WHERE purchase_id='$purchase_id' && status='1'");


while($getcount=mysqli_fetch_array($getcomm))
{
	$commission=$getcount['commission'];
}

return $commission;

}

function getTruck($truck_id)
{
	
	include('connection.php');
	$supplier="";
	$get_supplier=mysqli_query($conn, "SELECT * FROM purchases WHERE purchase_id='$truck_id'");
	while($supp=mysqli_fetch_array($get_supplier))
	{
		$supplier=$supp['truck_id'];
	}
	
	return $supplier;
}
?>