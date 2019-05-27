
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

   }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
 }else{
    header("location: login.php");
   }

    
    $purchase_details  = $db->getRows("SELECT * from purchase where UserID=?",[$id]);
    
    if(isset($_GET['do']) && $_GET['do']=='logout'){

        $supervisor = new registrationAndLogin();
        $supervisor->logout();
        header("location: login.php");
      }    

   



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Orders</title>
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

    <style type="text/css">

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
    <table>
          <thead>
            <th>#Order</th>
            <th>Total taxes</th>
            <th>Total discount</th>
            <th>Total price</th>
            <th>Order Date</th>
            <th>Payment Method</th>
            <th>Situation</th>
            <th>Details</th>
          </thead>
   <?php
   foreach ($purchase_details as $row) {
        ?>

        
          <tbody>
            <td><?php echo $row['purch_no']; ?></td>
            <td><?php echo $row['netfees']; ?></td>
            <td><?php echo $row['discount']; ?></td>
            <td>EGP <?php echo $row['total']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['method']; ?></td>
            <td><?php if($row['complete'] == 0){echo "Processing!";}else{ echo "Ready to Deliver";} ?></td>
            <td><a class='btn btn-mini btn-primary' href="?purchase_no=<?php echo $row['purch_no']; ?>">See Purchase</a></td>
          </tbody>
<?php
}
?>
        </table>


        <?php


        if(isset($_GET['purchase_no'])){
          $purchase_product = $db->getRows("SELECT * from product,purchase_product where product_no = product_id and purchase_no =?",[$_GET['purchase_no']]);
          echo "<br><br><table>";
         
          foreach ($purchase_product as $row) {
           echo '
           <tbody>
            <th><a href="product_details.php?id='. $row['product_no'] .'"><img width="60" src="' . $row["product_img"] . '" alt=""/><a></th>
            <th>' .  $row['product_name'] . '</th>
            <th>EGP ' .  $row['price'] . '</th>
            <th>' .  $row['tax'] . ' TAXES</th>
            <th>' .  $row['discount'] . '% Discount</th>
          </tbody>';
          }

          echo "</table>";
        }
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
        <a href="login.php">ORDER HISTORY</a>
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