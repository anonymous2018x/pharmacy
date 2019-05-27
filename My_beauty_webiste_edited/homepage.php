<?php
    
   
   spl_autoload_register(function ($class){
            include "classes/" . $class . ".php";
        });
   $db = Database::getInstance();
   $user = new registrationAndLogin();
   $results_per_page = 6;
   $rs_result = $db->getRows("SELECT * FROM product where updated = 0 ORDER BY product_no ASC LIMIT 1, ".$results_per_page,[]);
   $count            = 0;
   $results_per_page2 = 4;
   $rs_result2 = $db->getRows("SELECT * FROM product ORDER BY product_no ASC LIMIT 5, ".$results_per_page2,[]);
   $rs_result3 = $db->getRows("SELECT * FROM product ORDER BY product_no ASC LIMIT 9, ".$results_per_page2,[]);
   $rs_result4 = $db->getRows("SELECT * FROM product ORDER BY product_no ASC LIMIT 13, ".$results_per_page2,[]);
   $rs_result5 = $db->getRows("SELECT * FROM product ORDER BY product_no ASC LIMIT 17, ".$results_per_page2,[]);

  session_start();

  if(isset($_COOKIE['username']) && !isset($_SESSION['username'])){
   
   $_SESSION['ID'] = $_COOKIE['id'];
   $_SESSION['username'] = $_COOKIE['username'];
   $_SESSION['full_name'] = $_COOKIE['full_name'];
   $_SESSION['status'] = $_COOKIE['status'];

  }

  if(isset($_SESSION['username'])){

  	if( $_SESSION['status'] == 'user'){

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
       
  	}else{
  	   $full_cart = "";
  	   $count_in_cart = $db->getRowCount("SELECT pro_id from userproduct where user_id=? and pro_id=?",[$id,$product_id]);
  	   if($count_in_cart > 0){
  	   	$show = $db->updateRow("UPDATE `userproduct` SET `qty` = qty + 1 WHERE user_id=? and pro_id =? && qty < 20",[$id,$product_id]);
  	   	         header("location: homepage.php");

  	   }else{
  	   $show  = $db->insertRow("INSERT into userproduct values (NULL,?,?,?,?)",[$id,$product_id,$price_product,$qty]);}
  	            header("location: homepage.php");

      }
     }
    }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
   	elseif($_SESSION['status'] == 'supplier'){header("location: supplierPage.php");}
	}

  if(isset($_GET['do']) && $_GET['do']=='logout'){

	   $user->logout();
	   header("location: login.php");
  }

	   
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <title>Home Page</title>
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
		<a href="product_summary.php"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i>[
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
    <a class="brand" href="homepage.php"><img width="193px" height="47" src="themes/images/logo.png" alt="Bootsshop"/></a>
		<form class="form-inline navbar-search" method="post" action="products.php" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="srchFld" class="srchTxt" type="text" />
		  <select class="srchTxt">
			<option>All</option>
			<option>Skin Care</option>
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
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		  <div class="item active">
		  <div class="container">
			<a href="products.php"><img style="width:100%" src="themes/images/carousel/01.jpg" alt="special offers"/></a>
			<div class="carousel-caption">
				  <h4>hello</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="products.php"><img style="width:100%" src="themes/images/carousel/02.jpg" alt=""/></a>
				<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="products.php"><img src="themes/images/carousel/03.jpg" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
			
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="products.php"><img src="themes/images/carousel/04.jpg" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		   
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="products.php"><img src="themes/images/carousel/05.jpg" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
			</div>
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="products.php"><img src="themes/images/carousel/06.jpg" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div> 
</div>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<div id="sidebar" class="span3">
		<div class="well well-small"><a id="myCart" href="product_summary.php"><img src="themes/images/ico-cart.png" alt="cart"><?php
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
			<li><a href="products.php?category_number=4">intimate Care <?php echo "[ " . $db->getRowCount("SELECT * FROM product where category_number =?",['4']) . " ]" ?></a></li>
		</ul>
		<br/>
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
			<div class="well well-small">
			<h4>Featured Products <small class="pull-right">16+ featured products</small></h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
			<div class="carousel-inner">
			  <div class="item active">
			  <ul class="thumbnails">

					<?php

			  	foreach ($rs_result2 as $row) {
			  	?>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>"><img src="<?php echo $row['product_img'] ?>"></a>
					<div class="caption">
					  <h5><?php echo $row['product_name'] ?></h5>
					  <h4><a class="btn" href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>">VIEW</a> <span class="pull-right">EGP <?php echo $row['price'] ?></span></h4>
					</div>
				  </div>
				</li>
			  <?php
}
			  ?>
				</ul>
			</div>
			   <div class="item">
			  <ul class="thumbnails">

					<?php

			  	foreach ($rs_result3 as $row) {
			  	?>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>"><img src="<?php echo $row['product_img'] ?>"></a>
					<div class="caption">
					  <h5><?php echo $row['product_name'] ?></h5>
					  <h4><a class="btn" href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>">VIEW</a> <span class="pull-right">EGP <?php echo $row['price'] ?></span></h4>
					</div>
				  </div>
				</li>
			  <?php
}
			  ?>
				</ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">

					<?php

			  	foreach ($rs_result4 as $row) {
			  	?>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>"><img src="<?php echo $row['product_img'] ?>"></a>
					<div class="caption">
					  <h5><?php echo $row['product_name'] ?></h5>
					  <h4><a class="btn" href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>">VIEW</a> <span class="pull-right">EGP <?php echo $row['price'] ?></span></h4>
					</div>
				  </div>
				</li>
			  <?php
}
			  ?>
				</ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">

					<?php

			  	foreach ($rs_result5 as $row) {
			  	?>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>"><img src="<?php echo $row['product_img'] ?>"></a>
					<div class="caption">
					  <h5><?php echo $row['product_name'] ?></h5>
					  <h4><a class="btn" href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>">VIEW</a> <span class="pull-right">EGP <?php echo $row['price'] ?></span></h4>
					</div>
				  </div>
				</li>
			  <?php
}
			  ?>
				</ul>
			  </div>
			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
		</div>
		<h4>Latest Products </h4>
		<?php
		foreach ($rs_result as $row) {
		?>
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
					<a  href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>"><img src="<?php echo $row['product_img'] ?>"></a>
					<div class="caption">
					  <h5><?php echo $row['product_name'] ?></h5>
					  <p> 
						<?php echo $row['product_describtion'] ?> 
					  </p>
					 
					  <h4 style="text-align:center"><a class="btn" href="<?php if(!isset($_SESSION['username'])){
        	echo 'login.php';
        }else echo 'product_details.php?id=' . $row['product_no']; ?>"> <i class="icon-zoom-in"></i></a> <a class="btn" href="<?php 

					  if(!isset($_SESSION['username'])){echo 'login.php';}

        	          else {echo '?id=' . $row['product_no'] . '&price='. $row['price'] ;} ?>"


        	>Add to <i class="icon-shopping-cart">

        </i></a> <a class="btn btn-primary" href=""><?php echo $row['price'] ?></a></h4>
					</div>
				  </div>
				</li>
				<?php 
}
				?>
			  </ul>	

		</div>
		</div>
	</div>
</div>
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
<script type="">
  count=0;
 
 function validation() 
 {
    
count=0;
     var x1,x2,text;
     

    // Get the value of the input field with id="numb"
    x2 = document.getElementById("password").value;
    

    // If x is Not a Number or less than one or greater than 10
    //->>>>>>>>>>>>name
    if (x2.length < 1) {
        text = "* Username or Password is Invalid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y2").innerHTML = text;
                if(count==1)
            {
                 document.getElementById('myForm').submit();
              
            }
     }
     count0=0;
   </script>
</body>
</html>