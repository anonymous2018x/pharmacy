<?php



   spl_autoload_register(function ($class){
            include "classes/" . $class . ".php";
        });
  
     $db               = Database::getInstance();
     session_start();

  if(isset($_COOKIE['username']) && !isset($_SESSION['username'])){
   
   $_SESSION['ID'] = $_COOKIE['id'];
   $_SESSION['username'] = $_COOKIE['username'];
   $_SESSION['full_name'] = $_COOKIE['full_name'];
   $_SESSION['status'] = $_COOKIE['status'];

  }
  if(isset($_SESSION['username'])){
     if($_SESSION['status'] == 'user'){
	   $id                      = $_SESSION['ID'];
	   $username                = $_SESSION['username'];
	   $name                    = $_SESSION['full_name'];
	   $user                    = new user();
	   }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
	   
   }else{header("location: login.php");}
   
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
   
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['do'])){
       
      $target      = "themes/images/products/". basename($_FILES['image']['name']);
      $product_img = "themes/images/products/" . $_FILES['image']['name']; 
      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
          $msg = true;
        }else{
          $msg = false;
        }

        if($msg){

          $result = $db->updateRow("UPDATE `users` SET `user_picture` =? WHERE ID =?",[$product_img,$id]);
          
            header("location: userProfile.php");
          
    }    
        }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $name; ?></title>
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

input[type='file'] {
  opacity:0    
}
.imgDescription {
  position:absolute;
  top: 215px;
  
  background:rgba(250,250,250,0.42);
  color:black;
  font-size: 20px;
  visibility: hidden;
  opacity: 0;
  border-bottom-right-radius:250px;
  border-bottom-left-radius:250px;
  border-top-right-radius:250px;
  border-top-left-radius:250px;
  width:200px;
  height:200px;
  text-decoration: none;
  /*remove comment if you want a gradual transition between states
      -webkit-transition: visibility opacity 0.2s;
      */
}
.imgWrap:hover .imgDescription {
  visibility: visible;
  opacity: 1;
  text-decoration: none;
}
.m_title:first-letter {
    text-transform: uppercase;
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
    <li class="active">My profile</li>
    </ul>	

	 <?php
  


  foreach ($userInformation as $row) {

       
     ?>
     <div class="pull-right">
      <br><br><br>
      <h1 class="m_title"><?php echo $row["full_name"]; ?></h1></div>
      <div class="imgWrap"><a href="?do=picture"><img style="border-top-left-radius: 100px;
                  border-top-right-radius: 100px;
                  border-bottom-left-radius: 100px;
                  border-bottom-right-radius: 100px;
                  height: 200px;width:200px;" src="<?php echo $row["user_picture"]; ?>">
                  <center><p class="imgDescription"><br><br><br><br>Click to Change</p></center>
                  </a></div>
                  <?php
      if(isset($_GET['do']) && $_GET['do'] == 'picture'){

        echo '<form method="POST" enctype="multipart/form-data"><div>
    <input type="file" name="image">
    <h4><span style="cursor: pointer;" id="button">Please select your new picture <i class="fa fa-file-image-o"></i></span><h4>

          <span id="val"></span>

         </div><input type="submit" value="Confirm"></form>';
      }




        ?>
 <br><br> 
    


<h4><strong>Account Information</strong></h4>
  <br>
      <table >
      <thead>
      	<tr>
      		<th >Email </th>
      		<th ><?php echo $row['email'] ?></th>
      	</tr>
      	<tr>
      		<th >Password </th>
      		<th ><?php $row['password'] = str_repeat('*', strlen($row['password'])); echo $row['password'] ?></th>
      	</tr>
      		
      </thead>     
      
</table>
<div class="pull-right">
	<a href="edituserprofile.php?edit=account"><span style="font-size: 20px;" class="btn btn-mini btn-primary"><i class="fa fa-pencil-square-o"></i>
        Edit
        </span> </a>
	</div>
	<br>
		<h4><strong>Personal Information</strong></h4>
		<br>
		<table >
      <thead>
      	<tr>
      		<th >Name </th>
      		<th ><?php echo $row['full_name'] ?></th>
      	</tr>
      	<tr>
      		<th >Gender </th>
      		<th ><?php echo $row['gender'] ?></th>
      	</tr>
      	<tr>
      		<th >Birthdate </th>
      		<th ><?php echo $row['birthdate'] ?></th>
      	</tr>
      	<tr>
      		<th >Phone </th>
      		<th ><?php echo "0" . $row['phone_number'] ?></th>
      	</tr>
      	<tr>
      		<th >Address </th>
      		<th ><?php echo $row['address'] ?></th>
      	</tr>

      		
      </thead>     
      
</table>
<div class="pull-right">
	<a href="edituserprofile.php?edit=personal"><span style="font-size: 20px;" class="btn btn-mini btn-primary"><i class="fa fa-pencil-square-o"></i>
        Edit
        </span> </a>
	</div>

<?php }; ?>

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
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
    /*STAR RATING*/
 
    $('.star').on("mouseover",function(){
        //get the id of star
        var star_id = $(this).attr('id');
        switch (star_id){
            case "star-1":
                $("#star-1").addClass('star-checked');
                break;
            case "star-2":
                $("#star-1").addClass('star-checked');
                $("#star-2").addClass('star-checked');
                break;
            case "star-3":
                $("#star-1").addClass('star-checked');
                $("#star-2").addClass('star-checked');
                $("#star-3").addClass('star-checked');
                break;
            case "star-4":
                $("#star-1").addClass('star-checked');
                $("#star-2").addClass('star-checked');
                $("#star-3").addClass('star-checked');
                $("#star-4").addClass('star-checked');
                break;
            case "star-5":
                $("#star-1").addClass('star-checked');
                $("#star-2").addClass('star-checked');
                $("#star-3").addClass('star-checked');
                $("#star-4").addClass('star-checked');
                $("#star-5").addClass('star-checked');
                break;
        }
    }).mouseout(function(){
        //remove the star checked class when mouseout
        $('.star').removeClass('star-checked');
    });
 
     
    $('.star').click(function(){
        //get the stars index from it id
        var star_index = $(this).attr("id").split("-")[1],
            product_id = $("#product_id").val(), //store the product id in variable
            star_container = $(this).parent(), //get the parent container of the stars
            result_div = $("#result"); //result div
         
        $.ajax({
            url: "store_rating.php",
            type: "POST",
            data: {star:star_index,product_id:product_id},
            beforeSend: function(){
                star_container.hide(); //hide the star container
                result_div.show().html("Loading..."); //show the result div and display a loadin message
            },
            success: function(data){
                result_div.html(data);
            }
        });
    });
 
});
</script>
<script type="text/javascript">
  $('#button').click(function(){
   $("input[type='file']").trigger('click');
})

$("input[type='file']").change(function(){
   $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
})   
</script>