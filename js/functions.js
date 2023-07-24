function productdel(id)
{
	if(confirm("You are about to delete a Product's entire record. This will not be reversable. \nAre you sure you want to proceed?") == true)
	{
		
		$.ajax({
		url: "delete_product.php?id="+id, method: "post", dataType: "text", success: function(result) {
		
		$("#"+id).css("display","none");
		
			alert(result);
			// console.log(result);
		}
		});
	}
		
	else
	{
		return false;
	}

}

function catdel(id)
{
	if(confirm("You are about to delete a Product Category's entire record. This will not be reversable. \nAre you sure you want to proceed?") == true)
	{
		
		$.ajax({
		url: "delete_cat.php?id="+id, method: "post", dataType: "text", success: function(result) {
			
		$("#"+id).css("display","none");
			
			alert(result);
			// console.log(result);
		}
		});
	}
		
	else
	{
		return false;
	}

}

function managerdel(id)
{
	if(confirm("You are about to delete a Manager's entire record. This will not be reversable. \nAre you sure you want to proceed?") == true)
	{
		
		$.ajax({
		url: "delete_manager.php?id="+id, method: "post", dataType: "text", success: function(result) {
			
		$("#"+id).css("display","none");
			
			alert(result);
			// console.log(result);
		}
		});
	}
		
	else
	{
		return false;
	}

}

function supplierdel(id)
{
	if(confirm("You are about to delete a Supplier's entire record. This will not be reversable. \nAre you sure you want to proceed?") == true)
	{
		
		$.ajax({
		url: "delete_supplier.php?id="+id, method: "post", dataType: "text", success: function(result) {
			
		$("#"+id).css("display","none");
			
			alert(result);
			// console.log(result);
		}
		});
	}
		
	else
	{
		return false;
	}

}

function salesmandel(id)
{
	if(confirm("You are about to delete a Supplier's entire record. This will not be reversable. \nAre you sure you want to proceed?") == true)
	{
		
		$.ajax({
		url: "delete_salesman.php?id="+id, method: "post", dataType: "text", success: function(result) {
			
		$("#"+id).css("display","none");
			
			alert(result);
			// console.log(result);
		}
		});
	}
		
	else
	{
		return false;
	}

}

function customerdel(id)
{
	if(confirm("You are about to delete a Customer's entire record. This will not be reversable. \nAre you sure you want to proceed?") == true)
	{
		
		$.ajax({
		url: "delete_customer.php?id="+id, method: "post", dataType: "text", success: function(result) {
			
			$("#"+id).css("display","none");
			
			alert(result);
			// console.log(result);
		}
		});
	}
		
	else
	{
		return false;
	}

}

function purchasedel(id)
{
	if(confirm("You are about to delete a Purchase's entire record. This will not be reversable. \nAre you sure you want to proceed?") == true)
	{
		
		$.ajax({
		url: "delete_purchase.php?id="+id, method: "post", dataType: "text", success: function(result) {
			
			$("#"+id).css("display","none");
			
			alert(result);
			// console.log(result);
		}
		});
	}
		
	else
	{
		return false;
	}

}
function saledel(id)
{
	if(confirm("You are about to delete a Sale's entire record. This will not be reversable. \nAre you sure you want to proceed?") == true)
	{
		
		$.ajax({
		url: "delete_sale.php?id="+id, method: "post", dataType: "text", success: function(result) {
			
			$("#"+id).css("display","none");
			
			alert(result);
			// console.log(result);
		}
		});
	}
		
	else
	{
		return false;
	}

}

function LoginError()
{
	alert("Login Error! Incorrect username or password.")
}

function UpdateError()
{
	alert("Error! The record was not updated.")
}

function AddError()
{
	alert("Error! The record was not added.")
}

function ProAddAlert()
{
	alert("The record has been added successfully.")
	window.location='products.php';
}

function ProUpdateAlert()
{
	alert("The record has been updated successfully.")
	window.location='products.php';
}

function CusUpdateAlert()
{
	alert("The record has been updated successfully.")
	window.location='customers.php';
}

function OrderUpdateAlert()
{
	alert("The order has been approved successfully.")
	window.location='admin.php';
}

function OrderDelAlert()
{
	alert("The order has been deleted successfully.")
	window.location='admin.php';
}

function LogOutMsg()
{
	alert("You have Logged Out");
}

function get_product_cats()
{
	
	var pro_id=$("#product").val();
	
		$.ajax({
		url: "../includes/get_cats.php?id="+pro_id, method: "post", dataType: "text", success: function(result) {

			console.log(result);
			
				for(j=document.add_purchase_details_form.cat.options.length-1;j>=0;j--)
				{
					document.add_purchase_details_form.cat.remove(j);
				}
			
			if(result!=="")
			{
				//alert();
			
				var array = JSON.parse(result);
				
				// console.log(array);
				
					for (i=0; i<array.length; i++)
					{
						// console.log(array[i].cat_name);
						var option = document.createElement("OPTION");
						option.text = array[i].cat_name;
						option.value = array[i].cat_id;
						document.add_purchase_details_form.cat.options.add(option);
					} 
					
			}
			
		}
		});
	
}

function get_supplier_trucks()
{
	
	var supp_id=$("#supplier").val();
	
		$.ajax({
		url: "../includes/get_trucks.php?id="+supp_id, method: "post", dataType: "text", success: function(result) {

			console.log(result);
			
				for(j=document.add_sale_form.truck.options.length-1;j>=0;j--)
				{
					document.add_sale_form.truck.remove(j);
				}
			
			if(result!=="")
			{
			
				var array = JSON.parse(result);
				
				// console.log(array);
				
					for (i=0; i<array.length; i++)
					{
						// console.log(array[i].cat_name);
						var option = document.createElement("OPTION");
						option.text = array[i].truck_id;
						option.value = array[i].purchase_id;
						document.add_sale_form.truck.options.add(option);
					} 
					
			}
			
		}
		});
	
}

function get_supplier_products()
{
	
	var pur_id=$("#truck").val();        //purchase_id
	var sup_id=$("#supplier").val();
	
		$.ajax({
		url: "../includes/get_products.php?id="+pur_id+'&sup='+sup_id, method: "post", dataType: "text", success: function(result) {

			console.log(result);
			
				for(j=document.add_sale_form.product.options.length-1;j>=0;j--)
				{
					document.add_sale_form.product.remove(j);
				}
			
			if(result!=="")
			{
			
				var array = JSON.parse(result);
				
				// console.log(array);
				
					for (i=0; i<array.length; i++)
					{
						// console.log(array[i].cat_name);
						var option = document.createElement("OPTION");
						option.text = array[i].product_name;
						option.value = array[i].product_id;
						document.add_sale_form.product.options.add(option);
					} 
					
			}
			
		}
		});
	
}

function get_remaining()
{
	
	var pur_id=$("#truck").val();			//purchase_id
	var sup_id=$("#supplier").val();
	var pro_id=$("#product").val();
	var qty=$("#quantity").val();
	
		$.ajax({
		url: "../includes/get_remaining.php?pur_id="+pur_id+'&sup_id='+sup_id+'&pro_id='+pro_id+'&qty='+qty, method: "post", dataType: "text", success: function(result) {
		
		$("#remaining").val(result);
			
		}
		});
	
}

function calculate_total()
{
	
	var quantity=$("#quantity").val();
	var price=$("#price").val();
	var commission=$("#commission").val();
	
	var total=quantity*price;
	
	var comm=(commission/100) * total;
	
	var grand_total=total+comm;
	

	$("#total").val(grand_total);

	
}

function customer_section_hide()
{
	$("#credit_customer_section").hide();
}

function shuffle_payment(val)
{
	
	var value=val;
	
	if(value=='debit')
	{
		$("#credit_customer_section").hide();
	}
	
	if(value=='credit')
	{
		$("#credit_customer_section").show();
	}
	
}

function getreportsales(purchase_id, supplier_id)
{
	$.ajax({
		url: "../includes/get_report_sales.php?id="+pur_id+'&sup='+sup_id, method: "post", dataType: "text", success: function(result) {

			console.log(result);
			
				for(j=document.add_sale_form.product.options.length-1;j>=0;j--)
				{
					document.add_sale_form.product.remove(j);
				}
			
			if(result!=="")
			{
			
				var array = JSON.parse(result);
				
				// console.log(array);
				
					for (i=0; i<array.length; i++)
					{
						// console.log(array[i].cat_name);
						var option = document.createElement("OPTION");
						option.text = array[i].product_name;
						option.value = array[i].product_id;
						document.add_sale_form.product.options.add(option);
					} 
					
			}
	}
	});

}
function remaining_payment()
{
	 var price= $("#remaining1").val();
     var quan=  $("#amount_paid").val();
     var  total=price-quan;
     $("#remaining1").val(total);

	
}
