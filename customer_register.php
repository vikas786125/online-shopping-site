<?php

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


<body>
		
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
					<li><a href="my_account.php">My Account</a></li>
					<li><a href="user_register.php">Sign up</a></li>
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
           <b style="float:right;">&nbsp Welcome Guest!</b>
			   <b style="color:yellow; float:right; "><a href="cart.php" style="color: #FF0;">&nbsp Go to Cart</a></b>
				   <span style="float:right;">- Total Items:- <?php items(); ?> Total Price:<?php total_price(); ?>
				  &nbsp 	<a href="logout.php" style="color: #F93"> Logout</a>
				   </span>
				   
				   
				   </div>
				   


			   </div>
			
			<form action="customer_register.php" method="post" enctype="multipart/form-data"/>
			<table width="750" align="center">
			<tr align="center"><td colspan="8"><h2>Create an Account</h2></td></tr>

				<tr><td align="right"><b>Name:</b></td>
					<td><input type="text" name="c_name" required/></td>
				</tr>

				<tr><td align="right"><b>E-Mail:</b></td>
					<td><input type="text" name="c_email" required/></td>
				</tr>

				<tr><td align="right"><b>Password:</b></td>
					<td><input type="Password" name="c_pass" required/></td>
				</tr>

				<tr><td align="right"><b>Country:</b></td>
					<td><select name="c_country">
						<option>Select Country</option>
						<option>India</option>
						<option>United States</option>
						<option>Kuwait</option>
						<option>Pakistan</option>
						<option>South Africa</option>
					</select></td>
				</tr>

				<tr><td align="right"><b>City:</b></td>
					<td><input type="text" name="c_city" required/></td>
				</tr>

				<tr><td align="right"><b>Contact:</b></td>
					<td><input type="text" name="c_contact" required/></td>
				</tr>

				<tr><td align="right"><b>Address:</b></td>
					<td><input type="text" name="c_address" required/></td>
				</tr>

				<tr><td align="right"><b>Image:</b></td>
					<td><input type="file" name="c_image" required/></td>
				</tr>

				<tr align="center">
					<td colspan="8"><input type="submit" name="register" value="submit"/></td>
				</tr>

			</table>
			
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


<?php
if(isset($_POST['register'])){

	$c_name = $_POST['c_name'];
	$c_email = $_POST['c_email'];
	$c_pass = $_POST['c_pass'];
	$c_country = $_POST['c_country'];
	$c_city = $_POST['c_city'];
	$c_contact = $_POST['c_contact'];
	$c_address = $_POST['c_address'];
	$c_image = $_FILES['c_image']['name'];
	$c_image_tmp = $_FILES['c_image']['tmp_name'];

	$c_ip = getUserIP();

	$insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) values ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";

	$run_customer = mysqli_query($con,$insert_customer);

	move_uploaded_file($c_image_tmp,"customer/customer_photos/$c_image");

	echo "<script>alert('Account Created Successfully, Thank You!')</script>";

	$sel_cart = "select from cart where ip_add='$c_ip'";

	$run_cart = mysqli_query($con,$sel_cart);

	$check_cart = mysqli_num_rows($run_cart);

	if($check_cart>0){

		$_SESSION['customer_email']=$c_email;
        
		echo "<script>window.open('checkout.php','_self')</script>";
	}
	else{
		echo "<script>window.open('index.php','_self')</script>";
	}

    

}




?>

