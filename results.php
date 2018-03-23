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
		   <div id="navbar1">
		       <div>
			       <b style="float:right;">Welcome Guest!</b>
				   <b style="color:yellow; float:right; ">Shopping cart</b>
				   <span style="float:right;">- Items:-  Price:</span>
				   
				   
				   </div>
				   


			   </div>
			<div  id="product_box">
			  <?php

			   if (isset($_GET['search'])) {
			   
			   $user_keyword = $_GET['user_query'];

			   $get_products = "select * from products where product_keywords like '%$user_keyword%' ";

				$run_products =mysqli_query($con,$get_products);
				
				while($row_products = mysqli_fetch_array($run_products))
				{
					$pro_id = $row_products['product_id'];
			        $pro_title = $row_products['product_title'];
					$pro_cat = $row_products['cat_id'];
					$pro_brand= $row_products['brand_id'];
					$pro_desc = $row_products['product_desc'];
					$pro_price = $row_products['product_price'];
					$pro_image = $row_products['product_img1'];
					
					echo"<div id='single_product'><h3>$pro_title</h3>
					    <img src='admin_area/product_images/$pro_image' width='190' height='190' style='border:2px solid #333;' /><br>
						<p><b>Price:INR $pro_price </b></p>
						<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
						<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
						</div>
						";
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




