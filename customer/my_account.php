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
	      <a href="index.php"><img src="../images/123.jpg" style="float:left"></a>
		  <img src="../images/banner4.jpg" style="float:right"> 
	   
	   
	   </div>
	   <!--HEADER END-->
	   
	   <!--NAVIGATION STRAT-->
	   <div id="navbar">
	     <ul id="menu">
					<li><a href="../index.php">Home</a></li>
					<li><a href="../all_products.php">All Products</a></li>
					<li><a href="../customer/my_account.php">My Account</a></li>

					<?php 
					if(isset($_SESSION['customer_email'])){  
					echo "<span style='display:none;'>;<li><a href='../customer_login.php'>Sign up</a></li></span>";
				     }
				     else{
				     	echo "<li><a href='../customer_login.php'>Sign up</a></li>";
				     }

					?>
					<li><a href="../cart.php">Cart</a></li>
					<li><a href="../contact.php">Contact Us</a></li>
					
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
		   <div id="sidebar_title">Manage Account</div>
		   <ul id="cats">

		   <?php
		   	
		   		$customer_session = $_SESSION['customer_email'];
		   		
		   		$get_customer_pic = "select * from customers where customer_email='$customer_session'";

		   		$run_customer = mysqli_query($con,$get_customer_pic);

		   		$row_customer = mysqli_fetch_array($run_customer);

		   		$customer_picture = $row_customer['customer_image'];

		   		echo "<img src = 'customer_photos/$customer_picture' width='180' height='180'><br><a href='change_pic.php'>Change Photo</a>";
		   	



		   ?>

			  <li><a href="my_account.php?my_orders"> My Orders </a></li>
			  <li><a href="my_account.php?edit_account"> Edit Account </a></li>
			   <li><a href="my_account.php?change_pass"> Change Password </a></li>
			    <li><a href="my_account.php?delete_account">Delete Account  </a></li>
			     <li><a href="logout.php">Logout  </a></li>

			</ul>
			
			
			
			</div>
		 
		 <div id="right_content">
		 <?php   
		 cart();
		    ?>
		   <div id="navbar1">
		       <div>
           
<?php
           if(!isset($_SESSION['customer_email'])){
           	echo "<b>Welcome Guest!</b>";
           }
           else{
           	echo  "Welcome   " . $_SESSION['customer_email'] . "  to my shop";
           }
           
?>
			  <!-- <b style="color:yellow; float:right; "><a href="cart.php" style="color: #FF0;">&nbsp Go to Cart</a></b>
				   <span style="float:right;">- Total Items:- <?php items(); ?> Total Price:<?php total_price(); ?>
					<?php  sesan();  ?>
				   </span>-->
				   
				   
				   </div>
				   


			   </div>
			<div>

				<h2 style="background: #000; color: #FC9; padding: 20px; text-align: center;border-top: 2px solid #FFF;">Manage Your Account Here</h2>

			<?php   getDefault(); ?>

			<?php   
			if (isset($_GET['my_orders'])) {
			      	include("my_orders.php");
			      } 

			 if (isset($_GET['edit_account'])) {
			      	include("edit_account.php");
			      } 

			 if (isset($_GET['change_pass'])) {
			      	include("change_pass.php");
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




