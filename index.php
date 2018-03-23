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


<body style="background-color:#43BFC7">
		
    <!--Main Container Starts-->
     <div class="main_wrapper" >

       <!--HEADER STRAT-->
       <div class="header_wrapper">
	      <a href="index.php"><img src="images/123.jpg" style="float:left"></a>
		  <img src="images/banner4.jpg" style="float:right"> 
	   
	   
	   </div>
	   <!--HEADER END-->
	   
	   <!--NAVIGATION STRAT-->
	   <div id="navbar" style="background-color:#3090C7">
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
					<!--<li><a href="customer_login.php">Sign up</a></li>-->
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
	   <
	   <!--CONTENT STRAT-->
	   <div class="content_wrapper">
	     <div id="left_content" style= "background-color:#3090C7">
		   <div id="sidebar_title" style=" background-color:#7DFDFE; color: black; font-family: courier"><b>CATEGORY</b></div>
		   <ul id="cats">
			 <?php
			   getCats();
			   ?>
			</ul>
			
			<div id="sidebar_title"style=" background-color:#7DFDFE; color: black; font-family: courier"><b>BRANDS</b></div>
			  <ul id="cats">
								
				<?php 
				getBrands();
				?>
			</ul>
			
			</div>
		 
		 <div id="right_content" style="background-color:white">
		 <?php   
		 cart();
		    ?>
		   <div id="navbar1" style="background-color:#3090C7">
		       <div>
           
<?php
           if(!isset($_SESSION['customer_email'])){
           	echo "<b>Welcome Guest!</b>";
           }
           else{
           	echo  "Welcome   " . $_SESSION['customer_email'] . "  to my shop";
           }
           
?>
			   <b style="color:yellow; float:right; "><a href="cart.php" style="color: #FF0;">&nbsp Go to Cart</a></b>
				   <span style="float:right;">- Total Items:- <?php items(); ?> Total Price:<?php total_price(); ?>
					<?php  sesan();  ?>
				   </span>
				   
				   
				   </div>
				   


			   </div>
			<div  id="product_box">
			  <?php
			    getPro();
			    getCatPro();
			    getBrandPro();
				?>
			
			</div> 
		 
		 </div>
	    </div>
	   
	   <!--CONTENT END-->
	   
	   <!--FOOTER START-->
	   <div class="footer" style="background-color:#3090C7; color: white;padding-top:20px;">
	     <p align="center"><b>$Written by-Vikaskumar Gupta, Maitri Gosalia,Ashish Jain</b></p>
	   
	   </div>
	   <!--FOOTER END-->




     </div>
<!--Main Container Ends-->
</body>
</html>




