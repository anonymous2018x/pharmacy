<?php



   spl_autoload_register(function ($class){
            include "classes/" . $class . ".php";
        });
  
     $db               = Database::getInstance();
     $results_per_page = 6;
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
	   if(isset($_GET['id'])){
	   $_SESSION['product_id']  = $_GET['id'];
	   	   }else{header("location: products.php");}

	   }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
   }else{header("location: products.php");}

   
   //------------check if the user has already rated or not--->
    $check = $db->getRowCount("SELECT id from rating_product where product_id=? and user_id=?",[$_SESSION['product_id'],$id]);
   
   //--------------------Logout------------------------------->
  if(isset($_GET['do']) && $_GET['do']=='logout'){
       
	   $user = new registrationAndLogin();
	   $user->logout();
	   header("location: login.php");
   }
   //-----------------------for geting rating----------------->
   $rating          = $db->getRowColumn("SELECT AVG(rating_id) as productRating FROM rating_product,product WHERE rating_product.product_id = product.product_no and product.product_no =?",[$_SESSION['product_id']]);
   $rating          =  number_format($rating, 1, '.', ','); // to make the rating approxmated
   //-----------------------for the product showing ----------> 
   $product_details = $db->getRows("SELECT * from product where product_no=?",[$_SESSION['product_id']]);
   //-----------------------for the products in the bottom---->
   $rs_result       = $db->getRows("SELECT * FROM product where updated = 0 ORDER BY product_no ASC LIMIT 6",[]);
  //---------------for adding in the cart -------------------->
  if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['qty'])){

  	$qty   = $_GET['qty'];
  	$price = $db->getRowColumn("SELECT price from product where product_no=?",[$_SESSION['product_id']]);
  	$cart_qty  = $db->getRowColumn("SELECT SUM(qty) from `userproduct` where user_id=?",[$id]);

  	if($cart_qty == 20){
       $full_cart = "Full";
       header("location: product_details.php");
  	}else{ if($qty <= 20 && $qty >= 1){
  	   $full_cart = "";
  	   $show  = $user->addToCart($id,$_SESSION['product_id'],$price,$qty);
  	   if($show){
        
    	header("location: product_details.php");
         }
       }else {$full_cart = "";echo "<script>alert('not valid value')</script>";header("location: product_details.php");}
     }
    } 
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
   //---------------for Rating product------------------->
     if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
     	
     	 if(isset($_POST['rating-5'])){
         $result = $user->rateProduct($_SESSION['product_id'],5,$id);
         }elseif(isset($_POST['rating-4'])){
         $result = $user->rateProduct($_SESSION['product_id'],4,$id);
         }elseif(isset($_POST['rating-3'])){
         $result = $user->rateProduct($_SESSION['product_id'],3,$id);
         }elseif(isset($_POST['rating-2'])){
         $result = $user->rateProduct($_SESSION['product_id'],2,$id);
         }elseif(isset($_POST['rating-1'])){
         $result = $user->rateProduct($_SESSION['product_id'],1,$id);
         }else{ $result == false;}

         if($result){

         	header("location: product_details.php?id=" . $_SESSION['product_id']);
         }else header("location: product_details.php?id=" . $_SESSION['product_id']);
      }
    
    


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Product Details</title>
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

	<style type="text/css" id="enject">
		.star-rating {
    direction: rtl;
    display: inline-block;
    padding: 20px
}

.star-rating input[type=radio] {
    display: none
}

.star-rating label {
    color: #bbb;
    font-size: 34px;
    padding: 0;
    cursor: pointer;
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
    display: inline;

}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input[type=radio]:checked ~ label {
    color: #f2b600;
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
    <li><a href="products.php">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul>	
	<div class="row">	  
		<?php
		foreach ($product_details as $row) {
		?>
			<div id="gallery" class="span3">
            <a href="<?php echo $row['product_img']; ?>" title="For hair conditioning">
		   <img src="<?php echo $row['product_img']; ?>" style="width:100%" alt="<?php echo $row['product_name']; ?>"/>
            </a>
			<div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                  <div class="item active">
                   <a href="<?php echo $row['product_img1']; ?>"> <img style="width:29%" src="<?php echo $row['product_img1']; ?>" alt=""/></a>
                   <a href="<?php echo $row['product_img2']; ?>"> <img style="width:29%" src="<?php echo $row['product_img2']; ?>" alt=""/></a>
                   <a href="<?php echo $row['product_img3']; ?>" > <img style="width:29%" src="<?php echo $row['product_img3']; ?>" alt=""/></a>
                  </div>
                  
                </div>

              <!--  
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
			  -->
              </div>
			  
			 <div class="btn-toolbar">
			  <div class="btn-group">
				<span>
					
            

<?php
             if($check > 0){
             	echo "<h5><i class='active fa fa-star' aria-hidden='true' id=star-5></i> You have already Rated that Product</h5>";
             }else{

             	echo '
               					<div class="star-rating">

			  	<form method="POST">

			<input id="star-5" type="radio" name="rating-5" value="star-5">
			<label for="star-5" title="5 stars">
					<i class="active fa fa-star" aria-hidden="true" id=star-5></i>
			</label>
			<input id="star-4" type="radio" name="rating-4" value="star-4">
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="star-4" title="4 stars">
					<i class="active fa fa-star" aria-hidden="true" id=star-4></i>
			</label>
			<input id="star-3" type="radio" name="rating-3" value="star-3">
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="star-3" title="3 stars">
					<i class="active fa fa-star" aria-hidden="true" id=star-3></i>
			</label>
			<input id="star-2" type="radio" name="rating-2" value="star-2">
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="star-2" title="2 stars">
					<i class="active fa fa-star" aria-hidden="true" id=star-2></i>
			</label>
			<input id="star-1" type="radio" name="rating-1" value="star-1">
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="star-1" title="1 star">
					<i class="active fa fa-star" aria-hidden="true" id=star-1></i>
			</label>
			<br><br>
			<center>
			<input type="submit" value="Rate" class="btn btn-large btn-primary">
			</center>
			</form>
					</div>

			';}
			?>

				</span>
			  </div>
			</div>
			</div>
			<div class="span6">
				<h3><?php echo $row['product_name']; ?>  </h3>
				<div class="star-rating">
            <label>Over All Rating <?php echo $rating; ?>
</label></div>
				<hr class="soft"/>
				<form class="form-horizontal qtyFrm" method="GET">
				  <div class="control-group">
					<label class="control-label"><span>EGP <?php echo $row['price']; ?></span></label>
					<div class="controls">
					<input type="number" name="qty" class="span1" placeholder="Qty. 20" required/>
					  <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
					</div>
				  </div>
				</form>
				
				<hr class="soft"/>
				<h4><?php echo $row['no_in_stock']; ?> in the stock</h4>
				
				<hr class="soft clr"/>
				<p>
				<?php echo $row['product_describtion']; ?>
				
				</p>
				<br class="clr"/>
			<hr class="soft"/>
			</div>
						 <?php };?>

			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li><h3>Related products</h3></li>
            </ul>
             
		<br class="clr"/>
		<div class="tab-content">
			
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
					<?php
					 foreach($rs_result as $row) {
?> 
            

			<li class="span3">
			  <div class="thumbnail">
				<a href="product_details.php?id=<?php echo $row['product_no'] ?>">
					<img src="<?php echo $row["product_img"]; ?>" alt=""/>
				</a>
				<div class="caption">
				  <h5><?php echo $row["product_name"]; ?></h5>
				  <p> 
					 <?php echo $row["product_describtion"]; ?>
				  </p>
				   <h4 style="text-align:center"><a class="btn" href="product_details.php?id=<?php echo $row['product_no'] ?>"> <i class="icon-zoom-in"></i></a> <a class="btn" href="?qty=1&id=<?php echo $row['product_no']; ?>">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">EGP<?php echo $row["price"]; ?></a></h4>
				</div>
			  </div>
			</li>
			<?php
 };
			?>
			
				  </ul>
			</div>
		</div>
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