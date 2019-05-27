<?php
 
 session_start();
 spl_autoload_register(function ($class){
        include "classes/" . $class . ".php";
        });
        
            $db = Database::getInstance();
            $supplier = new supplier();
            $old_passworderr   = "";

if(isset($_COOKIE['username']) && !isset($_SESSION['username'])){
   
   $_SESSION['ID'] = $_COOKIE['id'];
   $_SESSION['username'] = $_COOKIE['username'];
   $_SESSION['full_name'] = $_COOKIE['full_name'];
   $_SESSION['status'] = $_COOKIE['status'];

  }
        if(isset($_SESSION['username']) && $_SESSION['status'] == 'supplier'){

		   $id       = $_SESSION['ID'];
		   $username = $_SESSION['username'];
		   $name     = $_SESSION['full_name'];
		   $supplierData = $supplier->viewSupplierProfile($id);


		  }else{ header("location: homepage.php");}    

 if($_SERVER['REQUEST_METHOD'] == 'POST'){


   	foreach ($supplierData as $row) {
   		$old_password = $row["password"];
   	}
   	if($_POST['old_password'] == $old_password){
   	$result = $supplier->editpersonalinformation($_POST["email"],$_POST["password"],$_POST["name"],$_POST["phone"],$_POST['address'],$id);
   	if($result){
   		$to      = $_POST['email'];
        $subject = "Update is Done!";
        $txt     = "Mr/Mrs " . $_POST['name'] . " You have Updated Your Account information just wanted to let you know ";
        $headers = "From: 24HourPharmacy@example.com" . "\r\n" .
                    "CC: abdelrahman.ashraf@yahoo.com";
        mail($to,$subject,$txt,$headers);
        header("location: supplierProfile.php");
   	}
   }else{$old_passworderr = "Your old password is wrong!";}
  
 
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
<!-- Admin Css $ JS -->
   <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <script type="text/javascript" src="admin/js/fusioncharts.js"></script>
    <script type="text/javascript" src="admin/js/themes/fusioncharts.theme.carbon.js"></script>

  <style type="text/css">

.form-style-3{
    max-width: 500px;
    font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-3 label{
    display:block;
    margin-bottom: 10px;
}
.form-style-3 label > span{
    float: left;
    width: 100px;
    color: green;
    font-weight: bold;
    font-size: 20px;
    text-shadow: 1px 1px 1px #fff;
}
.form-style-3 fieldset{
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    margin: 0px 0px 10px 0px;
    border: 1px solid #FFD2D2;
    padding: 20px;
    background: white;
    box-shadow: inset 0px 0px 15px green;
    -moz-box-shadow: inset 0px 0px 15px green;
    -webkit-box-shadow: inset 0px 0px 15px green;
}
.form-style-3 fieldset legend{
    color: green;
    border-top: 1px solid #FFD2D2;
    border-left: 1px solid #FFD2D2;
    border-right: 1px solid #FFD2D2;
    border-radius: 5px 5px 0px 0px;
    -webkit-border-radius: 5px 5px 0px 0px;
    -moz-border-radius: 5px 5px 0px 0px;
    background: #FFF4F4;
    padding: 0px 8px 3px 8px;
    box-shadow: -0px -1px 2px green;
    -moz-box-shadow:-0px -1px 2px #F1F1F1;
    -webkit-box-shadow:-0px -1px 2px #F1F1F1;
    font-weight: normal;
    font-size: 25px;
}
.form-style-3 textarea{
    width:600px;
    height:200px;
}
.form-style-3 input[type=text],
.form-style-3 input[type=date],
.form-style-3 input[type=datetime],
.form-style-3 input[type=number],
.form-style-3 input[type=search],
.form-style-3 input[type=time],
.form-style-3 input[type=url],
.form-style-3 input[type=email],
.form-style-3 select, 
.form-style-3 textarea{
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border: 1px solid #FFC2DC;
    outline: none;
    color: green;
    padding: 5px 8px 5px 8px;
    box-shadow: inset 1px 1px 4px grey;
    -moz-box-shadow: inset 1px 1px 4px grey;
    -webkit-box-shadow: inset 1px 1px 4px grey;
    background: white;
    width:50%;
}
.form-style-3  input[type=submit],
.form-style-3  input[type=button]{
    background: green;
    border: 1px solid #C94A81;
    padding: 5px 15px 5px 15px;
    color: #FFCBE2;
    box-shadow: inset -1px -1px 3px green;
    -moz-box-shadow: inset -1px -1px 3px green;
    -webkit-box-shadow: inset -1px -1px 3px green;
    border-radius: 3px;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;    
    font-weight: bold;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 5px solid #dddddd;
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
    <a class="brand" href="supplierPage.php"><img width="193px" height="47" src="themes/images/logo.png" alt="Bootsshop"/></a>
    <ul id="topMenu" class="nav pull-right">
    	<li><a href="supplierPage.php">Dashboard</a></li>
    <li><a href="supplierProfile.php">My account</a></li>
    <li><a href="sendRequest.php">Send Request</a></li>
    <li><a href="supplierPage.php?ratingData=click">Rating <i class="fa fa-star" aria-hidden="true"></i></a></li>


   <li class="">
   <?php
      if(isset($_SESSION['username'])){
        echo "<a href='?do=logout' style='padding-right:0'><span class='btn btn-large btn-success'>Logout</span></a>";
      }else echo "<a href='../login.php' style='padding-right:0'><span class='btn btn-large btn-success'>Login</span></a>";
      
   ?>
  </li>
    </ul>
  </div>
</div>
</div>
<ul>

  </ul>
</div>
<!-- Header End====================================================================== -->
<div id="mainBody">
  <div class="container">
  <div class="row">
        
<form method="POST" id="myForm">
      <table >
      <thead>
      	<?php

      	foreach ($supplierData as $row) {

      		?>

      	<tr>
      		<th >You new name</th>
      		<th ><input id="name" type="text" name="name" value="<?php echo $row["Full_name"]; ?>"><div style="color:red;" id="y2" class="valiationStyle"></div></th>
      	</tr>
      	
      	
      	<tr>
      		<th >New Email</th>
      		<th ><input id="email" type="email" name="email" value="<?php echo $row["email"]; ?>"><div style="color:red;" id="y3" class="valiationStyle"></div></th>
      	</tr>
        
      	<tr>
      		<th >New phone</th>
      		<th ><input id="phone" type="number" name="phone" value="<?php echo $row["phone_number"]; ?>"><div style="color:red;" id="y8" class="valiationStyle"></div></th>
      	</tr>
      	<tr>
      		<th >New address</th>
      		<th ><input id="address" type="text" name="address" value="<?php echo $row["address"]; ?>"><div style="color:red;" id="y7" class="valiationStyle"></div></th>
      	</tr>
      	 <tr>
      		<th >New password</th>
      		<th ><input id="password" type="password" value="" name="password"><div style="color:red;" id="y5" class="valiationStyle"></div></th>
      	</tr>
      	<tr>
      		<th >Please enter your old password to confirm</th>
      		<?php $row['password'] = str_repeat('*', strlen($row['password'])); ?>
      		<th ><input  type="password" name="old_password" placeholder="<?php echo $row['password']; ?>"><div style="color:red;" id="y6" class="valiationStyle"><?php echo $old_passworderr; ?></div></th>
      	</tr>
       <?php
   }

   ?>
      </thead>     
      
</table>
<div class="pull-right">
	<input type="hidden" name="personal">
	<button type="button" class="btn btn-large btn-success" onclick="validation2()"><i class="fa fa-pencil-square-o"></i>
        Edit
        </button>
	</div>
</form>

   </div>
 </div>
</div>
    
<!-- Footer ================================================================== -->
  <div  id="footerSection">
  <div class="container">
    <div class="row">
        
      <div id="socialMedia" class="span3 pull-right">
        <h5>SOCIAL MEDIA </h5>
        <a href="#"><img width="60" height="60" src="themes/images/facebook.png" title="facebook" alt="facebook"/></a>
        <a href="#"><img width="60" height="60" src="themes/images/twitter.png" title="twitter" alt="twitter"/></a>
        <a href="#"><img width="60" height="60" src="themes/images/youtube.png" title="youtube" alt="youtube"/></a>
       </div> 
     </div>
     <br>
    <p class="pull-right">&copy; Copyright VisionPharma.com</p>
  </div><!-- Container End -->
  </div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
  <script src="themes/js/jquery.js" type="text/javascript"></script>
  <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="themes/js/google-code-prettify/prettify.js"></script>
  
  <script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
  
  <!-- Themes switcher section ============================================================================================= -->

</body>
</html>
<script type="text/javascript">
	 function validation2() 
 {
    
count=0;
     var x7,x8,x9,x3,x5,text;
     

    // Get the value of the input field with id="numb"
    x2 = document.getElementById("name").value;
    x7 = document.getElementById("address").value;
    x8 = document.getElementById("phone").value;
    x3 = document.getElementById("email").value;
    x5 = document.getElementById("password").value;
    
    //->>>>>>>>>>>>>>>>>>>email
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
    
            if(count==5)
            {
                 document.getElementById('myForm').submit();
              
            }
     }
   </script>
