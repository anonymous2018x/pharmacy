<?php



   spl_autoload_register(function ($class){
            include "classes/" . $class . ".php";
        });
  
     $db               = Database::getInstance();
  session_start();
    $old_passworderr   = "";
  if(isset($_COOKIE['username']) && !isset($_SESSION['username'])){
   
   $_SESSION['ID'] = $_COOKIE['id'];
   $_SESSION['username'] = $_COOKIE['username'];
   $_SESSION['full_name'] = $_COOKIE['full_name'];
   $_SESSION['status'] = $_COOKIE['status'];

  }
  if(isset($_SESSION['username'])){
     if( $_SESSION['status'] == 'user'){
	   $id                      = $_SESSION['ID'];
	   $username                = $_SESSION['username'];
	   $name                    = $_SESSION['full_name'];
	   $user                    = new user();
	 }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}  
	   
   }else{
   	header("location: homepage.php");
   }
   
   $userInformation = $user->viewUserProfile($id);
   //--------------------Logout------------------------------->
  if(isset($_GET['do']) && $_GET['do']=='logout'){


	   $user = new registrationAndLogin();
	   $user->logout();
	   header("location: login.php");
   }
   
   //----------------For User Cart---------------------->
   $count  = $db->getRowCount("SELECT id from `userproduct` where user_id=?",[$id]);
   if($count < 1){

   	$cart   = 0;
    $price  = 0;
   }else{

    $cart   = $db->getRowColumn("SELECT SUM(qty) from `userproduct` where user_id=?",[$id]);
    $price  = $db->getRowColumn("SELECT SUM(pro_price * qty) from userproduct where user_id=?",[$id]);
   }
   
   if($_SERVER['REQUEST_METHOD'] == 'POST'){

   	if(isset($_POST['account'])){
   	foreach ($userInformation as $row) {
   		$old_password = $row["password"];
   	}
   	if($_POST['old_password'] == $old_password){
   	$result = $user->editaccountinformation($_POST["email"],$_POST["password"],$id);
   	if($result){
   		$to      = $_POST['email'];
        $subject = "Update is Done!";
        $txt     = "Mr/Mrs " . $_POST['name'] . " You have Updated Your Account information 
                                                                          just wanted to let you know ;)";
        $headers = "From: 24HourPharmacy@example.com" . "\r\n" .
                    "CC: abdelrahman.ashraf@yahoo.com";
        mail($to,$subject,$txt,$headers);
        header("location: userProfile.php");
   	}
   }else{$old_passworderr = "Your old password is wrong!";}
  }elseif(isset($_POST['personal'])) {
    foreach ($userInformation as $row) {
   		$old_password = $row["password"];
   	}
   	if($_POST['old_password'] == $old_password){
   	$result = $user->editpersonalinformation($_POST["name"],$_POST["phone"],$_POST["address"],$_POST["date"],$id);
   	if($result){
   		$to      = $_POST['email'];
        $subject = "Update is Done!";
        $txt     = "Mr/Mrs " . $_POST['name'] . " You have Updated Your information just wanted to let you know ;)";
        $headers = "From: 24HourPharmacy@example.com" . "\r\n" .
                    "CC: abdelrahman.ashraf@yahoo.com";
        mail($to,$subject,$txt,$headers);
        header("location: userProfile.php");
   	}
   }else{$old_passworderr = "Your password is wrong!";}

  	
  }
 }
    
    


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Editing profile ...</title>
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
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

	<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}


</style>
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
		<a href="product_summary.php"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i>
        [
        <?php
        echo $cart;
        if(isset($_GET['qty'])){
        echo "    ";
        echo $full_cart;
        }
        ?>
        ]
		Items in your cart </span> </a> 
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
		<div class="well well-small"><a id="myCart" href="product_summary.php"><img src="themes/images/ico-cart.png" alt="cart">

		<?php
        echo $cart;
        if(isset($_GET['qty'])){
        echo " ";
        echo $full_cart;
        }
        ?>

        Items in your cart  <span class="badge badge-warning pull-right">
        EGP 
        <?php
        echo $price;
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
    <li><a href="userProfile.php">My account</a> <span class="divider">/</span></li>
    <li class="active">Edit Profile</li>
    </ul>
    <?php 
    if(isset($_GET["edit"]) && $_GET["edit"] == "account"){
    echo '	
	<h4><strong>Account Information</strong></h4>
	<br>';
	 
  
  foreach ($userInformation as $row) {
  
    echo '

    <form method="POST" id="myForm">
      <table >
      <thead>
      	<tr>
      		<th >New email</th>
      		<th ><input id="email" type="email" name="email" value="' . $row["email"] . '"><div style="color:red;" id="y3" class="valiationStyle"></div></th>
      	</tr>
      	<tr>
      		<th >Old password</th>';
      		$row['password'] = str_repeat('*', strlen($row['password']));
      		echo '
      		<th ><input  type="password" name="old_password" placeholder="' .  $row['password'] . '"><div style="color:red;" id="" class="valiationStyle">' . $old_passworderr . '</div></th>
      	</tr>
      	<tr>
      		<th >New password</th>
      		<th ><input id="password" type="password" name="password"><div style="color:red;" id="y5" class="valiationStyle"></div></th>
      	</tr>
      	<tr>
      		<th >Confirm password</th>
      		<th ><input id="confirmPassword" type="password" name="confirm_password" ><div style="color:red;" id="y6" class="valiationStyle"></div></th>
      	</tr>
      		
      </thead>     
      
</table>
<div class="pull-right">
	<input type="hidden" name="account">
	<button type="button" class="btn btn-large btn-success" onclick="validation1()"><i class="fa fa-pencil-square-o"></i>
        Edit
        </button>
	</div>
</form>
';} //end of the foreach for the account 

}elseif(isset($_GET["edit"]) && $_GET["edit"] == "personal"){
	 echo '	
	<h4><strong>Account Information</strong></h4>
	<br>';
	 
  
  foreach ($userInformation as $row) {
  
    echo '<form method="POST" id="myForm">
      <table >
      <thead>
      	<tr>
      		<th >You new name</th>
      		<th ><input id="name" type="text" name="name" value="' . $row["full_name"] . '"><div style="color:red;" id="y2" class="valiationStyle"></div></th>
      	</tr>
      	
      	
      	<tr>
      		<th >New birthdate</th>
      		<th ><input id="date" type="date" name="date" value="' .  $row["birthdate"] .'"><div style="color:red;" id="y10" class="valiationStyle"></div></th>
      	</tr>
      	<tr>
      		<th >New phone</th>
      		<th ><input id="phone" type="number" name="phone" value="' . $row["phone_number"] . '"><div style="color:red;" id="y8" class="valiationStyle"></div></th>
      	</tr>
      	<tr>
      		<th >New address</th>
      		<th ><input id="address" type="text" name="address" value="' . $row["address"] . '"><div style="color:red;" id="y7" class="valiationStyle"></div></th>
      	</tr>
      	<tr>
      		<th >Please enter your password to confirm</th>';
      		$row['password'] = str_repeat('*', strlen($row['password']));
      		echo '
      		<th ><input  type="password" name="old_password" placeholder="' .  $row['password'] . '"><div style="color:red;" id="y5" class="valiationStyle">' . $old_passworderr . '</div></th>
      	</tr>
      		
      </thead>     
      
</table>
<div class="pull-right">
	<input type="hidden" name="personal">
	<button type="button" class="btn btn-large btn-success" onclick="validation2()"><i class="fa fa-pencil-square-o"></i>
        Edit
        </button>
	</div>
</form>
';} //end of the foreach for the personal
}  // end of the if condition


?>

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
<script type="text/javascript">
count=0;
 
 function validation1() 
 {
    
count=0;
     var x3,x5,x6,text;
     

    // Get the value of the input field with id="numb"
    x3 = document.getElementById("email").value;
    x5 = document.getElementById("password").value;
    x6 = document.getElementById("confirmPassword").value;

    // If x is Not a Number or less than one or greater than 10
    //->>>>>>>>>>>>name
   
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(x3)) {
        text = "* Email Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y3").innerHTML = text;
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
    
            if(count==3)
            {
                 document.getElementById('myForm').submit();
              
            }
     }

     function validation2() 
 {
    
count=0;
     var x2,x7,x8,x9,text;
     

    // Get the value of the input field with id="numb"
    x2 = document.getElementById("name").value;
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
    //->>>>>>>>>>>>>>>>>>>>date
    if (x9.length < 1) {
        text = "* Birth Date is not valid";
     } else {
        text = "";
        count++;         
    }
    document.getElementById("y10").innerHTML = text;
            if(count==4)
            {
                 document.getElementById('myForm').submit();
              
            }
     }
   </script>