<?php
session_start();
include("includes/db.php");
include("functions/functions.php");

?>


<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ONLINE GENERAL STORE</title>
<link rel="stylesheet" href="styles/style1.css" media="all" />
</head>


<body style="background-color:#43BFC7" >
		
    <!--Main Container Starts-->
     <div class="main_wrapper">

       <!--HEADER STRAT-->
       <div class="header_wrapper">
	      <a href="index.php"><img src="images/123.jpg" style="float:left"></a>
		  <img src="images/banner4.jpg" style="float:right"> 
	   
	   
	   </div>
	   <!--HEADER END-->
	   
	   <!--NAVIGATION STRAT-->
	   <div id="navbar">
	     <ul id="menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="all_products.php">All Products</a></li>
					<li><a href="customer/my_account.php">My Account</a></li>
					<?php 
					if(isset($_SESSION['customer_email'])){  
					echo "<span style='display:none;'>;<li><a href='../customer_login.php'>Sign up</a></li></span>";
				     }
				     else{
				     	echo "<li><a href='../customer_login.php'>Sign up</a></li>";
				     }

					?>
					<li><a href="cart.php">Cart</a></li>
					<li><a href="contact.php">Contact Us</a></li>
					
				</ul>

					<div id="form">
					<form method="get" action="results.php" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="Search a Product"/>
						<input type="submit" name="search" value="Search"/>
					</form>
							
					</div>
	   
	   </div>
	   
	   <!--NAVIGATION END-->
	   
	   <!--CONTENT STRAT-->
	   <div class="content_wrapper">
	     <div id="left_content">
		   <div id="sidebar_title">CATEGORY</div>
		   <ul id="cats">
			 <?php
			   getCats();
			   ?>
			</ul>
			
			<div id="sidebar_title">BRANDS</div>
			  <ul id="cats">
								
				<?php 
				getBrands();
				?>
			</ul>
			
			</div>
		 
		 <div id="right_content">
		 <?php   
		 cart();
		    ?>
		   <div id="navbar1">
		       <div>
			       <b style="float:right;">Welcome Guest!</b>
			       
			   <b style="color:yellow; float:right; "><a href="index.php" style="color: #FF0;">Continue Shopping</a></b>
				   <span style="float:right;">- Total Items:- <?php items(); ?> Total Price:<?php total_price();   ?>
				   <!--<?php 
				   		if (!isset($_SESSION['customer_email'])) {
				   			echo "<a href = 'customer_login.php' style='color:#F93;'>Login</a>";
				   		}
				   		else{
				   			echo "<a href = 'logout.php' style='color:#F93;'>Logout</a>";
				   		}

				   	?>-->
				   	<?php  sesan();    ?>
				   </span>
				   
				   
				   </div>
				   


			   </div>
			<div  id="product_box"><br>
			  <form action="cart.php" method="post" enctype="multipart/form-data">
			  	
			  	<table width="740" align="center" bgcolor="#0099CC">

			  			<tr>
			  				<td><b>Remove</td></b></td>
			  				<td><b>Products</b></td>
			  				<td><b>Quantity</b></td>
			  				<td><b>Total Price</b></td>

			  			</tr>
<?php
$ip_add = getUserIP();

	$total = 0;

	$sel_price = "select * from cart where ip_add='$ip_add'";

	$run_price = mysqli_query($con,$sel_price);

	while ($record= mysqli_fetch_array($run_price)){

        $pro_id = $record['p_id'];

        $pro_price = "select * from products where product_id='$pro_id'";

        $run_pro_price = mysqli_query($con,$pro_price);

        while ($p_price=mysqli_fetch_array($run_pro_price)) {

        	$product_price = array($p_price['product_price']);
        	
        	$product_title = $p_price['product_title'];

        	$product_image = $p_price['product_img1']; 

        	$only_price = $p_price['product_price'];

        	$values = array_sum($product_price);

        	$total +=$values;


      
    
 ?>
			  			<tr>
			  				<td><input type="checkbox" name="remove[]" value=" <?php echo $pro_id ?> "></td>
			  				<td><?php echo $product_title ?><br><img src="admin_area/product_images/<?php echo $product_image; ?>" height="80" width="80"></td>
			  				<td><input type="text" name="qty" value="1" size="3" /></td>
<?php 

					if(isset($_POST['update'])){
						$qty = $_POST['qty'];
						$insert_qty = "update cart set qty='$qty' where ip_add='$ip_add'";
						$run_qty= mysqli_query($con,$insert_qty);
						$total=$total*$qty;

					}


?>

			  				<td><?php echo "INR  ". $only_price  ?></td>

			  			</tr>
 <?php }}  ?>
 						<tr>
 						<td colspan = "3" align="right"><b> Sub Total :</b></td>
 						<td align="right"><b><?php echo "INR  ".$total  ?></b></td>
 						</tr>
<br>
 						<tr>
 							<td><input type="submit" name="update" value="Update Cart"/></td>
 							<td><input type="submit" name="continue" value="Continue Shopping"/></td>

 							<?php 
				   		if (!isset($_SESSION['customer_email'])) {
				   			
				   			echo "<td><button><a href = 'customer_login.php' style='color:#F93;'>Checkout</a></button></td>";

				   		}
				   		else{
				   			if ($total>0) {
				   				
				   			echo "<td><button><a href = 'checkout.php'>Checkout</a></button></td>";
				   		                  }
				   		        else{
				   		        	echo "<td><button><a href = 'index.php'>Add items</a></button></td>";
				   		        }

				   	       }

				   	?>

 							<!--<td><button><a href="checkout.php" style="text-decoration: none;color: #000;">Checkout</a></button></td>-->


 						</tr>
			  	 </table>

			  </form>


<?php
function updatecart(){
	global $con;
 if(isset($_POST['update'])){

		foreach ($_POST['remove'] as $remove_id) {
			$delete_products = "delete from cart where p_id='$remove_id'";
			$run_delete = mysqli_query($con,$delete_products);
			if ($run_delete) {
				echo "<script>window.open('cart.php','_self')</script>";
			}
		}
			
}
if (isset($_POST['continue'])) {
				echo "<script>window.open('index.php','_self')</script>";
			}

		}
echo @$up_cart= updatecart();
?>			
			</div> 
		 
		 </div>
	    </div>
	   
	   <!--CONTENT END-->
	   
	   <!--FOOTER START-->
	   <div class="footer">Footer area
	     <p align="center">$Written by-Vikaskumar GUPTA</p>
	   
	   </div>
	   <!--FOOTER END-->




     </div>
<!--Main Container Ends-->
</body>
</html>




