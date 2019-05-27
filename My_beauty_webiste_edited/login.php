<?php
    
   
    spl_autoload_register(function ($class){
            include "classes/" . $class . ".php";
        });
   $db  = Database::getinstance();
   
   $usernameerr = "";

   session_start();
   if(isset($_SESSION['username'])){
   	header("location: homepage.php");
   }

   $login_form = new registrationAndLogin();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(isset($_POST['cookie'])){

    	$user = $login_form->Login($username, $password,1);
    }else{
    	$user = $login_form->Login($username, $password,0);
    }
        if ($user == 1) {
      header("location: admin/adminControlPage.php");
    } elseif($user == 2) {
      header("location: supervisor/supervisorControlPage.php");
    } elseif ($user == 3) {
    	      header("location: supplierPage.php");
    } elseif ($user == 4) {
      header("location: homepage.php");
    } else{// Registration Failed
      $usernameerr = "* Username or Password is Invalid";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
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
	<div class="span6">Welcome!</div>
	<div class="span6">
	<div class="pull-right">
		
		<a href="product_summary.php"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 0 ] Itemes in your cart </span> </a> 
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
			<option>Skin Care</option>
			<option>Men Care </option>
			<option>Dental Care </option>
			<option>Hair Care </option>
			<option>Intimiate Care </option>
		</select> 
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="contact.php">Contact</a></li>
	 <li class="">
	 <a href="login.php" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
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
		<div class="well well-small"><a id="myCart" href="product_summary.php"><img src="themes/images/ico-cart.png" alt="cart">0 Items in your cart  <span class="badge badge-warning pull-right">EGP 0</span></a></div>
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
		<li class="active">Login</li>
    </ul>
	<h3> Login</h3>	
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well">
			<h5>DON'T HAVE AN ACCOUNT ?</h5><br/>
			<form action="register.php">
				
			  <div class="controls">
			  <button type="submit" class="btn block">Create Your Account</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>ALREADY REGISTERED ?</h5>
			<form id="myForm" method="POST">
			  <div class="control-group">
				<label class="control-label" for="inputEmail1">Username</label>
				<div class="controls">
				  <input name="username" class="span3"  value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} ?>" type="text" id="inputEmail1" placeholder="Username">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="inputPassword1">Password</label>
				<div class="controls">
				  <input name="password" type="password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>" class="span3"  id="inputPassword1" placeholder="Password">
				  <br>                        <div style="color:red;" id="y2"><?php echo $usernameerr ?></div>

				</div>
				
			  </div>
			  <div class="control-group">
				<div class="controls">
				<input type="Checkbox" name="cookie"><a style="text-decoration:none;"> &nbsp&nbspRemember me</a>
				<br><br>
				  <input type="button" class="btn"   value="Sign in" onclick="validation()">

				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
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
<script type="">
  count=0;
 
 function validation() 
 {
    
count=0;
     var x1,text;
     

    // Get the value of the input field with id="numb"
    x2 = document.getElementById("inputPassword1").value;
    

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