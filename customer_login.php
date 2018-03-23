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
					<li><a href="customer/my_account.php">My Account</a></li>
					<li><a href="customer_login.php">Sign up</a></li>
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
				  &nbsp 	<?php 
				   		if (!isset($_SESSION['customer_email'])) {
				   			echo "<a href = '../customer_login.php' style='color:#F93;'>Login</a>";
				   		}
				   		else{
				   			echo "<a href = 'logout.php' style='color:#F93;'>Logout</a>";
				   		}

				   	?>
				   </span>
				   
				   
				   </div>
				   


			   </div>
			<div  id="product_box">
			  <?php
@session_start();
include("includes/db.php");



?>
<div>
<h2>Login Or Register</h2>
	<form action="customer_login.php" method="post">
	<table width="700" bgcolor="#66CCCC" align="center">
	<tr>
		<td align="center"><b> Your Email</b><input type="text" name="c_email" /></td>
	</tr>
	
	<tr>	
	    <td align="center"><b>Your Password</b>
	    <input type="password" name="c_pass"/>
	    </td>
	</tr>
	
	<tr align="center">
		<td colspan="4"><a href="forgot_pass.php">forgot password</a></td>
	</tr>

	<tr align="center">
		<td colspan="4"><input type="submit" name="c_login" value="Login"/></td>
	</tr>

	</table>
	</form>
	<h2 style="float: right;padding: 10px;"><a href="customer_register.php">New?Register here</a></h2>
</div>

<?php

	if(isset($_POST['c_login'])){

		$customer_email  = $_POST['c_email'];
		$customer_pass  = $_POST['c_pass'];

		$sel_customer = "select * from customers where customer_email='$customer_email' && customer_pass='$customer_pass'";

		$run_customer = mysqli_query($con,$sel_customer);

		$check_customer = mysqli_num_rows($run_customer);

		if (!$check_customer) {
    die(mysqli_error($con));}

		$get_ip = getUserIP();

		$sel_cart = "select * from cart where ip_add='$get_ip'";

		$run_cart = mysqli_query($con,$sel_cart);

		$check_cart = mysqli_num_rows($run_cart);

		if( $check_customer==0) {
			echo "<script>alert('Email or password is incorrect, please try again!') </script>";
		     exit();
		     }

		  if($check_customer==1 AND $check_cart==0){

		  	    $_SESSION['customer_email']=$customer_email;

		  		echo "<script>window.open('customer/my_account.php','_self')</script>";
           
           }
           else{
           	$_SESSION['customer_email']=$customer_email;
           	echo "<script>window.open('index.php','_self')</script>";
           }
		
	}

	

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




