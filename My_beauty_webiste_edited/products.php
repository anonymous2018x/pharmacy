<?php

   
   spl_autoload_register(function ($class){
            include "classes/" . $class . ".php";
        });

   $db               = Database::getInstance();
   $results_per_page = 9;
   $count            = 0;
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
   $count  = $db->getRowCount("SELECT id from `userproduct` where user_id=?",[$id]);
   if($count < 1){

   	$cart   = 0;
    $price  = 0;
   }else{
    
    $cart   = $db->getRowColumn("SELECT SUM(qty) from `userproduct` where user_id=?",[$id]);
    $price  = $db->getRowColumn("SELECT SUM(pro_price * qty) from userproduct where user_id=?",[$id]);
   }

	if(isset($_GET['id'])){

	   $product_id   = $_GET['id'];
	   $qty          = 1;
	   $price_product        = $db->getRowColumn("SELECT price from product where product_no=?",[$product_id]);
  	   $cart         = $db->getRowColumn("SELECT SUM(qty) from `userproduct` where user_id=?",[$id]);
  	if($cart >= 20){
       $full_cart = "FULL";
       if(isset($_GET['page']) == ""){
    	header("location: products.php?page=1&category_number=" . $_SESSION['$category_name']);
        }else{header("location: products.php?page=". $_GET['page'] . "&category_number=" . $_SESSION['$category_name']);}
  	}else{
  	   $full_cart = "";
  	   $count_in_cart = $db->getRowCount("SELECT pro_id from userproduct where user_id=? and pro_id=?",[$id,$product_id]);
  	   if($count_in_cart > 0){
  	   	$show = $db->updateRow("UPDATE `userproduct` SET `qty` = qty + 1 WHERE user_id=? and pro_id =? && qty < 20",[$id,$product_id]);
  	   }else{
  	   $show  = $db->insertRow("INSERT into userproduct values (NULL,?,?,?,?)",[$id,$product_id,$price_product,$qty]);}
  	   

  	if($show){
        
        if(isset($_GET['page']) == ""){
    	header("location: products.php?page=1&category_number=" . $_SESSION['$category_name']);
        }else{header("location: products.php?page=". $_GET['page'] . "&category_number=" . $_SESSION['$category_name']);}
       }
      }
     }
    }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
	}
   


  if(isset($_GET['do']) && $_GET['do']=='logout'){

    $user = new registrationAndLogin();
    $user->logout();
    header("location: login.php");
  }

  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $results_per_page;
	if(isset($_GET["category_number"]) && $_GET["category_number"] == "1"){
    
    $category_name = "Skin Care";
    $_SESSION['$category_name'] = "1";
	$rs_result = $db->getRows("SELECT * FROM product where category_number = 1 ORDER BY product_no ASC LIMIT $start_from, ".$results_per_page,[]);
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "2"){
    
    $category_name = "Hair Care";
    $_SESSION['$category_name'] = "2";
    $rs_result = $db->getRows("SELECT * FROM product where category_number = 2 ORDER BY product_no ASC LIMIT $start_from, ".$results_per_page,[]);	
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "3"){
    
    $category_name = "Dental Care";
    $_SESSION['$category_name'] = "3";
    $rs_result = $db->getRows("SELECT * FROM product where category_number = 3 ORDER BY product_no ASC LIMIT $start_from, ".$results_per_page,[]);	
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "4"){
    
    $category_name = "Medical Care";
    $_SESSION['$category_name'] = "4";
    $rs_result = $db->getRows("SELECT * FROM product where category_number = 4 ORDER BY product_no ASC LIMIT $start_from, ".$results_per_page,[]);	
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "5"){
    
    $category_name = "Baby Care";
    $_SESSION['$category_name'] = "5";
    $rs_result = $db->getRows("SELECT * FROM product where category_number = 5 ORDER BY product_no ASC LIMIT $start_from, ".$results_per_page,[]);	
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "6"){
    
    $category_name = "Men Care";
    $_SESSION['$category_name'] = "6";
    $rs_result = $db->getRows("SELECT * FROM product where category_number = 6 ORDER BY product_no ASC LIMIT $start_from, ".$results_per_page,[]);	
    }else{
    
    $category_name = "Skin Care";
    $_SESSION['$category_name'] = "1";
    $rs_result = $db->getRows("SELECT * FROM product where category_number = 1 ORDER BY product_no ASC LIMIT $start_from, ".$results_per_page,[]);
    }

	//CART----------------------->
	

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<style type="text/css">
  		.curPage{
  			    background-color: yellow;
  		}
  	</style>
    <meta charset="utf-8">
    <title>Products<?php if(isset($_GET['category_number'])){echo " - " . $category_name;}else echo ""; ?></title>
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
		<a href="<?php if(!isset($_SESSION['username'])){
        	echo "login.php";
        }else echo "product_summary.php"; ?> "><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i>[
        <?php
        if(!isset($_SESSION['username'])){
        	echo "0";
        }else{
        echo $cart;
        if(isset($_GET['id'])){
        echo "    ";
        echo $full_cart;
        }
    }
        ?>
        ] Items in your cart </span> </a> 
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
    <a class="brand" href="homepage.php"><img width="193px" height="47px" src="themes/images/logo.png" alt="Bootsshop"/></a>
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
		<div class="well well-small"><a id="myCart" href="<?php if(!isset($_SESSION['username'])){
        	echo "login.php";
        }else echo "product_summary.php"; ?>"><img src="themes/images/ico-cart.png" alt="cart"><?php
		if(!isset($_SESSION['username'])){
        	echo "0";
        }else{
        echo $cart;
        if(isset($_GET['id'])){
        echo "    ";
        echo $full_cart;
        }
    }
        ?>
     
        in your cart  <span class="badge badge-warning pull-right">
        EGP 
        <?php
        if(!isset($_SESSION['username'])){
        	echo "0";
        }else{
        echo $price;
        }
        ?></span></a></div>
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
			<li><a href="products.php?category_number=1">Skin Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['1']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=6">Men Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['6']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=2">Hair Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['2']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=3">Dental Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['3']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=5">Baby Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['5']) . " ]" ?></a></li>
			<li><a href="products.php?category_number=4">Medical Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['4']) . " ]" ?></a></li>
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
		<li><a href="products.php">Products Name</a><span class="divider">/</span></li>
		<li class="active"><?php echo $category_name; ?></li>
    </ul>
	<h3> Products Name <small class="pull-right"> <?php echo $db->getRowCount("SELECT * FROM product",[]) ?> product are available </small></h3>	
	<hr class="soft"/>
	
	  

<br class="clr"/>
<div class="tab-content">

	<div class="tab-pane  active" id="blockView">
		<ul class="thumbnails">
			<?php 
 foreach($rs_result as $row) {
?> 
            

			<li class="span3">
			  <div class="thumbnail">
				<a href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>">
					<img src="<?php echo $row["product_img"]; ?>" alt=""/>
				</a>
				<div class="caption">
				  <h5><?php echo $row["product_name"]; ?></h5>
				  <p> 
					 <?php echo $row["product_describtion"]; ?>
				  </p>
				   <h4 style="text-align:center"><a class="btn" href="product_details.php?id=<?php echo $row['product_no'] ?>"> <i class="icon-zoom-in"></i></a> <a class="btn" href="<?php if(!isset($_SESSION['username'])){
        	echo "login.php";
        }else{if(isset($_GET['page'])){echo "?page=" . $_GET['page'] . "&";}else echo "?"; ?>
				   id=<?php echo $row['product_no']; ?>&price=<?php echo $row["price"]; }?>">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">EGP<?php echo $row["price"]; ?></a></h4>
           <center><h4><?php if($row['no_in_stock'] > 0){echo "In stock!";}else {echo "Out of stock!";} ?></h4></center>
				</div>
			  </div>
			</li>
			<?php
 };
			?>
			
		  </ul>
	<hr class="soft"/>
	</div>
	
</div>
<?php 
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $results_per_page;
	if(isset($_GET["category_number"]) && $_GET["category_number"] == "1"){

	$row = $db->getRowAssoc("SELECT COUNT(product_no) AS total FROM product where category_number = 1",[]);

    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "2"){

    $row = $db->getRowAssoc("SELECT COUNT(product_no) AS total FROM product where category_number = 2",[]);
	
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "3"){

    $row = $db->getRowAssoc("SELECT COUNT(product_no) AS total FROM product where category_number = 3",[]);
	
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "4"){

    $row = $db->getRowAssoc("SELECT COUNT(product_no) AS total FROM product where category_number = 4",[]);
	
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "5"){

    $row = $db->getRowAssoc("SELECT COUNT(product_no) AS total FROM product where category_number = 5",[]);
	
    }elseif(isset($_GET["category_number"]) && $_GET["category_number"] == "6"){

    $row = $db->getRowAssoc("SELECT COUNT(product_no) AS total FROM product where category_number = 6",[]);
	
    }else{

    $row = $db->getRowAssoc("SELECT COUNT(product_no) AS total FROM product where category_number = 1",[]);

    }
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
?>

	<div class="pagination">
			<ul>
				<?php 
for ($i=1; $i<=$total_pages; $i++) {
  // print links for all pages
  if(isset($_GET['category_number'])){echo "<li><a href='products.php?category_number=" . $_GET['category_number'] . "&page=".$i."'";}
  else {echo "<li><a href='products.php?page=".$i."'";}

            if ($i==$page)  echo " style='background-color:blue;color:white;'";
            echo ">".$i."</a></li>"; 
}; 
?>
			
			</ul>
			</div>
			<br class="clr"/>
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<div  id="footerSection">
  <div class="container">
    <div class="row">
      <div class="span3">
        <h5>ACCOUNT</h5>
        <a href="userProfile.php">YOUR ACCOUNT</a>
        <a href="login.html">ORDER HISTORY</a>
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