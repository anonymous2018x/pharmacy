<?php
spl_autoload_register(function ($class){
        include "classes/" . $class . ".php";
        });   

$db = Database::getInstance();
session_start();

  if(isset($_COOKIE['username']) && !isset($_SESSION['username'])){
   
   $_SESSION['ID'] = $_COOKIE['id'];
   $_SESSION['username'] = $_COOKIE['username'];
   $_SESSION['full_name'] = $_COOKIE['full_name'];
   $_SESSION['status'] = $_COOKIE['status'];

  }
if(isset($_SESSION['username']))
  {
  	if($_SESSION['status'] == 'user'){
    $id       = $_SESSION['ID'];
   $username = $_SESSION['username'];
   $name     = $_SESSION['full_name'];
   $qty_no  = $db->getRowColumn("SELECT SUM(qty) from `userproduct` where user_id=?",[$id]);
   }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
  }else{header("location: login.php");}
   

  if(isset($_GET['do']) && $_GET['do']=='logout'){

    $user = new registrationAndLogin();
    $user->logout();
    header("location: login.php");
  }
  
  

  $product_cart = $db->getRows("SELECT * FROM product where product_no in (select pro_id from userproduct where user_id=?)",[$id]);
  $total_price  = 0;
  $discount     = 0;
  $taxes        = 0;
  $count_cart   = $db->getRowCount("SELECT * FROM product where product_no in (select pro_id from userproduct where user_id=?)",[$id]);

if(isset($_GET['-id'])){
	$check = $db->updateRow("UPDATE `userproduct` SET `qty` = qty - 1 WHERE pro_id =? && qty > 1",[$_GET['-id']]);
		header("location: product_summary.php");
}
elseif(isset($_GET['id_plus'])){
	if($qty_no < 20){
	$check   = $db->updateRow("UPDATE `userproduct` SET `qty` = qty + 1 WHERE pro_id =? && qty < 20",[$_GET['id_plus']]);
		header("location: product_summary.php");
	}
}
elseif(isset($_GET['removeid'])){
	$check = $db->deleteRow("DELETE from `userproduct` WHERE pro_id =? && user_id=?",[$_GET['removeid'],$id]);
		header("location: product_summary.php");

}




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Product summary</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6">Welcome! <strong><?php if(isset($_SESSION['username']))
  {
    
               echo $name;

  } else echo "";

  ?></strong></div>
	<div class="span6">
	<div class="pull-right">
		
		
	</div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="homepage.php"><img width="193px" height="47" src="themes/images/logo.png" alt="Bootsshop"/></a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<form class="form-inline navbar-search" method="post" action="products.php" >
		<input id="srchFld" class="srchTxt" type="text" />
		  <select class="srchTxt">
			<option>All</option>
			<option>Skin Care </option>
			<option>Men Care </option>
			<option>Dental Care </option>
			<option>Hair Care </option>
			<option>Intimiate Care </option>
		</select> 
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="userProfile.php">My Account</a></li>
	 <li class=""><a href="orders.php">My Orders</a></li>
	 <li class=""><a href="contact.php">Contact</a></li>
	 <li class="">
	 <?php
      if(isset($_SESSION['username'])){
      	echo "<a href='?do=logout' style='padding-right:0'><span class='btn btn-large btn-success'>Logout</span></a>";
      }else echo "<a href='login.php' style='padding-right:0'><span class='btn btn-large btn-success'>Login</span></a>";

	 ?>
	</li>
    </ul>
  </div>
</div>
</div>
</div>
<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<div id="sidebar" class="span3">
		
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
			<li><a href="products.php?category_number=1">Skin Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['1']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=6">Men Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['6']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=2">Hair Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['2']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=3">Dental Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['3']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=5">Baby Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['5']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=4">intimate Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['4']) . " ]" ?></a></li>
		</ul>
		<br/>
		 
			<div class="thumbnail">
				<img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
				<div class="caption">
				  <h5>Payment Methods</h5>
				</div>
			  </div>
	</div>
<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="homepage.php">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small><?php echo $count_cart; ?> Item(s) </small>]<a href="products.php" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<br>
	<?php
	if(isset($_SESSION['username'])){
		echo '';
		}else {echo '
			<hr class="soft"/>

	<table class="table table-bordered">
		<tr><th> I AM ALREADY REGISTERED  </th></tr>
		 <tr> 
		 <td>
			<form class="form-horizontal">
				<div class="control-group">
				  <label class="control-label" for="inputUsername">Username</label>
				  <div class="controls">
					<input type="text" id="inputUsername" placeholder="Username">
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="inputPassword1">Password</label>
				  <div class="controls">
					<input type="password" id="inputPassword1" placeholder="Password">
				  </div>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn">Sign in</button> OR <a href="register.php" class="btn">Register Now!</a>
				  </div>
				</div>
				<div class="control-group">
					<div class="controls">
					  <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>
					</div>
				</div>
			</form>
		  </td>
		  </tr>
	</table>';}
			

	if($count_cart > 0){
	echo '<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Quantity/Update</th>
				  <th>Price</th>
				  <th>Discount</th>
                  <th>Tax</th>
                  <th>Total</th>
				</tr>
              </thead>
              <tbody>
';
              foreach ($product_cart as $row) {
              $qty = $db->getRowColumn("SELECT qty from userproduct WHERE pro_id=?",[$row["product_no"]]);
              $price = $row["price"] * $qty;
              echo 
              '
                <tr>
                  <td> <img width="60" src="' . $row["product_img"] . '" alt=""/></td>
                  <td>' . $row["product_name"] . '<br>' . $row["product_describtion"] . '</td>
					<td><div class="input-append"><input class="span1" style="max-width:34px" placeholder="' . $qty .'" id="appendedInputButtons" size="16" type="text" disabled><a href="?-id=' . $row["product_no"] . '" class="btn" type="button"><i class="icon-minus"></i></a><a href="?id_plus=' . $row["product_no"] . '" class="btn" type="button"><i class="icon-plus"></i></a><a href="?removeid=' . $row["product_no"] . '" class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></a>				</div>
				  </td>

                  <td>' . $price . '</td>
                  <td>'; if($row["discount"] == NULL){ echo "_";}else{echo $row["discount"] . "%";} 
                  echo '</td>
                  <td>'; if($row["tax"] == NULL){ echo "_";}else{echo $row["tax"];}
                  echo '</td>
                  <td>';  $discount_price = ($row["price"] * ($row["discount"]/100)); $price_reduced = ($row["price"] - $discount_price); $price_product = (($price_reduced + $row["tax"]) * $qty); echo (($price_reduced + $row["tax"]) * $qty); 
                  echo '</td>
                </tr>';

				                $total_price = $total_price + $price_product;
				                $discount    = $discount    + $discount_price;
				                $taxes       = $taxes       + $row["tax"];
                }
				
				echo '
                <tr>
                  <td colspan="6" style="text-align:right">Total Price:	</td>
                  <td>EGP ' . $total_price . '</td>
                </tr>
				 <tr>
                  <td colspan="6" style="text-align:right">Total Discount:	</td>
                  <td>EGP ' . $discount . '</td>
                </tr>
                 <tr>
                  <td colspan="6" style="text-align:right">Total Tax:	</td>
                  <td>EGP ' . $taxes . '</td>
                </tr>
				 <tr>
                  <td colspan="6" style="text-align:right"><strong>TOTAL</strong></td>
                  <td class="label label-important" style="display:block"> <strong>EGP ' . $total_price . '</strong></td>
                </tr>
				</tbody>
            </table>
		
		
            
			
	<a href="products.php" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<form method="POST" action="PayPalCode/Chosse_Payment.php">
	
	<input type="hidden" value="' . $total_price . '" name="total">

		<input type="hidden" value="' . $discount . '" name="discount">

	<input type="hidden" value="' . $taxes . '" name="taxes">

	<button action="" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></button>

	<form>
	';
}else{
         echo "<h1>Your cart is empty!</h1>";
}
	?>

</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="userProfile.php">YOUR ACCOUNT</a>
				<a href="orders.php">ORDER HISTORY</a>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="contact.php">CONTACT</a>  
				<a href="register.php">REGISTRATION</a>  
			 </div>
			
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="themes/images/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="themes/images/youtube.png" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		 <br>
		<p class="pull-right">&copy; 24hourpharamacy</p>
	</div><!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
	
	<!-- Themes switcher section ============================================================================================= -->

	</div>
</div>
<span id="themesBtn"></span>
</body>
</html>