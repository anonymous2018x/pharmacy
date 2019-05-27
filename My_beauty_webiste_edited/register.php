<?php
// define variables and initialize with empty values
    session_start();
    spl_autoload_register(function ($class){
            include "classes/" . $class . ".php";
        });    

    $db = Database::getInstance();

    if(isset($_SESSION['username']))
	  {
	    header("location: homepage.php");
	  }
    $_form = new registrationAndLogin();
  if($_SERVER['REQUEST_METHOD'] == 'POST'){      
    if($_form->isUserExist($_POST['username'])){
               echo "<script>alert('this Username is already exist')</script>";
    }else{
           $register = $_form->UserRegister($_POST['name'],$_POST['email'],$_POST['username'],$_POST['password'],$_POST['address'],$_POST['phone'],$_POST['date'],$_POST['gender']);
         if($register){
           $to      = $_POST['email'];
           $subject = "Registration is done!";
           $txt     = "Welcome to our website Mr/Mrs " . $_POST['name'] . " You will get notification for every new products!";
           $headers = "From: 24HourPharmacy@example.com" . "\r\n" .
                      "CC: abdelrahman.ashraf@yahoo.com";
            mail($to,$subject,$txt,$headers);
            $_form->Login($_POST['username'],$_POST['password'],0);
            header("location: homepage.php");
        }else echo "<script>alert('this username is already exsist!')</script>";
    }
}

 
   
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Resgisteration</title>
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
		
		<a href="product_summary.php"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 3 ] Itemes in your cart </span> </a> 
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
    <ul class="breadcrumb">
		<li><a href="homepage.php">Home</a> <span class="divider">/</span></li>
		<li class="active">Registration</li>
    </ul>
	<h3> Registration</h3>	
	<div class="well">
	<!--
	<div class="alert alert-info fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div>
	<div class="alert fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div>
	 <div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div> -->
	<form id="myForm" name="myForm" method="POST" class="form-horizontal" >
		<h4>Your personal information</h4>
		
		<div class="control-group">
			<label class="control-label" for="inputFname1">Full name <sup>*</sup></label>
			<div class="controls">
			  <input id="name" name="name" type="text" id="inputFname1" placeholder="First Name">
			  <br>
			  					         <div style="color:red;" id="y2" class="valiationStyle"></div>

			</div>

		 </div>

		 <div class="control-group">
			<label class="control-label" for="inputLnam">Gender <sup>*</sup></label>
			<div class="controls">
          <input id="gender-male" type="radio" name="gender" 
           value="male" id="gender-male"/>
          <label for="gender-male">Male</label>
          <input id="gender-female" type="radio" name="gender"
           value="female" id="gender-female"/>
          <label for="gender-female">Female</label>		
          		<br>                 <div style="color:red;" id="y9" class="valiationStyle"></div>

          	</div>

		 </div>

		 <div class="control-group">
			<label class="control-label" for="inputLnam">Username <sup>*</sup></label>
			<div class="controls">
			  <input id="username" name="username" type="text" id="inputLnam" placeholder="Username">
			  <br> 		         <div style="color:red;" id="y4" class="valiationStyle"></div>
			</div>
		 </div>

		<div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input id="email" name="email" type="text" id="input_email" placeholder="Email">
		  <br> 	          <div style="color:red;" id="y3" class="valiationStyle"></div>

		</div>
	  </div>	  

	<div class="control-group">
		<label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
		<div class="controls">
		  <input id="password" name="password" type="password" id="inputPassword1" placeholder="Password">
		  <br> 	          <div style="color:red;" id="y5" class="valiationStyle"></div>
		</div>
	  </div>	  

<div class="control-group">
		<label class="control-label" for="inputPassword1">Confirm Password <sup>*</sup></label>
		<div class="controls">
		  <input id="confirmPassword" name="confirm_password" type="password" id="inputPassword1" placeholder="Confirm Password">
		<br> 	          <div style="color:red;" id="y6" class="valiationStyle"></div>
		</div>
	  </div>	  

		<div class="control-group">
		<label class="control-label">Date of Birth <sup>*</sup></label>
		<div class="controls">
		  <input id="date" name="date" type="Date">
		  <br>                      <div style="color:red;" id="y10" class="valiationStyle"></div>

		</div>
	  </div>

	

		
		
		
		<div class="control-group">
			<label class="control-label" for="address">Address<sup>*</sup></label>
			<div class="controls">
			  <input id="address" name="address" type="text" id="address" placeholder="Adress"/> <span>Street address, P.O. box, company name, c/o</span>
			  <br> 		        <div style="color:red;" id="y7" class="valiationStyle"></div>

			</div>
		</div>

		
		
			
		
		
		
		<div class="control-group">
			<label class="control-label" for="phone">Phone Number <sup>*</sup></label>
			<div class="controls">
			  <input id="phone" name="phone" type="number"  name="phone" id="phone" placeholder="phone"/> <span>You must register at least one phone number</span>
			  <br>		        <div style="color:red;" id="y8" class="valiationStyle"></div>

			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="phone">Terms and Conditions <sup>*</sup></label>
			<div class="controls">
        <label for="terms">I accept the terms and conditions for signing up to this service, and hereby confirm I have read the privacy policy.</label>
        			  <input type="checkbox" id="terms"/>

			</div>
		</div>
		
		
		
	<p><sup>*</sup>Required field	</p>
	
	<div class="control-group">
			<div class="controls">
				
				<input type="button" class="button"   value="SIGNUP" onclick="validation()">
			</div>
		</div>		
	</form>
</div>

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
	
	<!-- Themes switcher section ============================================================================================= -->

	</div>
</div>
<span id="themesBtn"></span>

    <script type="text/javascript">
count=0;
 
 function validation() 
 {
    
count=0;
     var x1,x2,x3,x4,x5,x6,x7,text;
     

    // Get the value of the input field with id="numb"
    x2 = document.getElementById("name").value;
    x3 = document.getElementById("email").value;
    x4 = document.getElementById("username").value;
    x5 = document.getElementById("password").value;
    x6 = document.getElementById("confirmPassword").value;
    x7 = document.getElementById("address").value;
    x8 = document.getElementById("phone").value;
    x9 = document.getElementById("date").value;

    // If x is Not a Number or less than one or greater than 10
    //->>>>>>>>>>>>name
    if (x2.length < 1  || !isNaN(x2)) {
        text = "* Name Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y2").innerHTML = text;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(x3)) {
        text = "* Email Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y3").innerHTML = text;
    //->>>>>>>>>>>>username
    if (x4.length < 1 || !isNaN(x4)) {
        text = "* Username Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y4").innerHTML = text;
    //->>>>>>>>>>>>password
    if (x5.length < 8) {
        text = "* Password Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y5").innerHTML = text;
    //->>>>>>>>>>>>password confirm
    if (x6.length < 1 || x6 != x5) {
        text = "* Confrim Password not match";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y6").innerHTML = text;
    //->>>>>>>>>>>>address
    if (x7.length < 1 || !isNaN(x7)) {
        text = "* Address Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y7").innerHTML = text;
    //->>>>>>>>>>>>phone
    if (isNaN(x8) || x8 < 1) {
        text = "* Phone not valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y8").innerHTML = text;
    //->>>>>>>>>>>>>>>>>>>>>>gender
    if (document.getElementById("gender-male").checked || document.getElementById("gender-female").checked) {
        text = "";
        count++;
     } else {
                      text = "* You must select one choice";
    }
    document.getElementById("y9").innerHTML = text;
    if (x9.length < 1) {
        text = "* Birth Date is not valid";
     } else {
        text = "";
        count++;         
    }
    document.getElementById("y10").innerHTML = text;
            if(count==9)
            {
                 document.getElementById('myForm').submit();
              
            }
     }
     count0=0;
   </script>
</body>

</html>