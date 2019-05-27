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

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
         $userEmail = $db->getRowColumn("SELECT email from users where ID =?",[$id]);   

    $db->insertRow("INSERT INTO `feedback` (`feedback_no`, `feedback_text`, `userID`, `email_FB`, `date_FB`, `updated`) VALUES (?,?,?,?,?,?);",[NULL,$_POST['text'],$id,$userEmail,date("Y/m/d"),'0']);
  	 $to        = "tika-1996@hotmail.com";
     $subject   = $_POST['subject'];
     $txt       = $_POST['text'];
     $headers   = "From: " . $userEmail . "\r\n" .
                  "CC: 24HourPharmacy@example.com";
     mail($to,$subject,$txt,$headers);
     header("location: homepage.php");
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Contact</title>
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

  ?></strong></strong></div>
	<div class="span6">
	<div class="pull-right">
		
		<a href="<?php if(!isset($_SESSION['username'])){
        	echo "login.php";
        }else echo "product_summary.php"; ?> "><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [
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
	<hr class="soften">
	<h1>Visit us</h1>
	<hr class="soften"/>	
	<div class="row">
		<div class="span4">
		<h4>Contact Details</h4>
		<p>	3 El-Yasmeen,<br/> CA. 93727, EGP
			<br/><br/>
			hour24pharmacy@yahoo.com<br/>
			﻿Tel +201112481686<br/>
			Fax 123-456-5679<br/>
			web:hour24pharmacy.com
		</p>		
		</div>
			
		<div class="span4">
		<h4>Admins and there phones</h4>
		<br>
			<h5>MR/ Abdelrahman Ashraf</h5>
			<p>01112481686<br/><br/></p>
			<h5>MR/ Abdelrahman Mohamed</h5>
			<p>01154216453<br/><br/></p>
			<h5>MR/ Salah Hassanin</h5>
			<p>01060509340<br/><br/></p>
			<h5>MR/ Mohamed Ismael</h5>
			<p>01158110148<br/><br/></p>
			<h5>MR/ Ahmed Mohamed</h5>
			<p>01123485809<br/><br/></p>
		</div>
		<div class="span4">
		<h4>Email Us</h4>
		<form class="form-horizontal" method="POST">
        <fieldset>
          <div class="control-group">
           
              <input type="text" placeholder="name" class="input-xlarge"/>
           
          </div>
		   
		   <div class="control-group">
           
              <input type="text" placeholder="subject" class="input-xlarge" name="subject" />
          
          </div>
          <div class="control-group">
              <textarea rows="3" id="textarea" class="input-xlarge" name="text"></textarea>
           
          </div>

            <button class="btn btn-large" type="submit">Send Messages</button>

        </fieldset>
      </form>
		</div>
	</div>
	<div class="row">
	<div class="span12">
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDxSbc-xCyCj7BVB0g1WKp6jOUnn5y3iR8'></script><div style='overflow:hidden;height:300px;width:100%;'><div id='gmap_canvas' style='height:300px;width:100%;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='https://www.ah-werbemittel-hoderlein.de'>Werbemittel effektiv und einfach</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=e95abc6c631d5d2fc970c5257b5cf065956adfc3'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(30.0468612,31.359984499999996),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(30.0468612,31.359984499999996)});infowindow = new google.maps.InfoWindow({content:'<strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 24HourPharma</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;احمد الزمر, مدينه نصر<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; cairo<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
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
	

	</div>
</div>
<span id="themesBtn"></span>
</body>
</html>