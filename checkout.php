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


<body  style="background-color:#43BFC7">
		
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
			  



<h2> Payment options for you</h2>

<?php
$ip = getUserIP();

$get_customer = "select * from customers where customer_ip= '$ip' ";

$run_customer = mysqli_query($con,$get_customer);

$customer = mysqli_fetch_array($run_customer);

$customer_id=$customer['customer_id'];
//$customer_id  = $_GET['customer_id'];

?>
	
<b>Pay with PayPal</b><a href="payonline.php"><img src="images/paypal.jpg" width="200" height="100"></a><b>Or</b><a href="order.php?c_id=<?php echo $customer_id; ?>">
&nbsp Pay offline</a>
				</b><br><br><br>

				<b> If you choose to pay offline then Please check your E-mail Account for Invoice Details</b>




			
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




