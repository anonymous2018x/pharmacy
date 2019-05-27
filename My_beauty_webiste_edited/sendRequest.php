
<?php 


session_start();

        spl_autoload_register(function ($class){
        include "classes/" . $class . ".php";
        });
        
            $db = Database::getInstance();
            $supplier = new supplier();
if(isset($_SESSION['username']) && $_SESSION['status'] == 'supplier'){

       $id       = $_SESSION['ID'];
       $username = $_SESSION['username'];
       $name     = $_SESSION['full_name'];

       }else{ header("location: homepage.php");}

      if(isset($_GET['do']) && $_GET['do']=='logout'){
        $adminlogout = new registrationAndLogin();
        $adminlogout->logout();
        header("Location: login.php");
      }    
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$text1 = $_POST["text"];
    
      $db->insertRow("INSERT INTO `notification` (`id`, `text`, `supplier_id`) VALUES (?,?,?)",[NULL,$text1,$id]);

        header("location: supplierPage.php");

	}

     $strQuery = $db->getRows("SELECT product_name,SUM(price) from product,purchase_product WHERE supplier = 20161819 and product_id = product_no GROUP by product_no",[]);
  
      // If the query returns a valid response, prepare the JSON string
      if ($strQuery) {
      // The `$arrData` array holds the chart attributes and data
      $arrData = array(
          "chart" => array(
              "caption" => "",
              "subCaption" => "",
              "numberPrefix" => "EGP",
              "theme"=> "ocean"
            )
        );

      $arrData["data"] = array();

        // Push the data into the array
      foreach($strQuery as $row) {
          array_push($arrData["data"], array(
              "label" => $row["product_name"],
              "value" => $row["SUM(price)"]
              )
          );
        }

      $jsonEncodedData = json_encode($arrData);
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
   <center> 


  
        <div class="form-style-3">

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

        <fieldset><legend>SEND REQUEST</legend>
<label for="field6"><span>Message <span class="required">*</span></span><textarea name="text" class="textarea-field"></textarea></label>
<label><span>&nbsp;</span><input type="submit" value="Send Request" /></label>
</fieldset>

    </form> 
  </div>
  </center>


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



