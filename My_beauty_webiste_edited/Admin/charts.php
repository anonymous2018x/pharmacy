<?php
    
        session_start();

        spl_autoload_register(function ($class){
        include "../classes/" . $class . ".php";
        });

        $adminManage = new classAdmin();
        $db          = Database::getInstance();
        if(isset($_COOKIE['username']) && !isset($_SESSION['username'])){
   
   $_SESSION['ID'] = $_COOKIE['id'];
   $_SESSION['username'] = $_COOKIE['username'];
   $_SESSION['full_name'] = $_COOKIE['full_name'];
   $_SESSION['status'] = $_COOKIE['status'];

  }
        if(isset($_SESSION['username']) && $_SESSION['status'] == 'admin'){

       $id       = $_SESSION['ID'];
       $username = $_SESSION['username'];
       $name     = $_SESSION['full_name'];

      }else{ header("location: ../homepage.php");}

      if(isset($_GET['do']) && $_GET['do']=='logout'){
        $adminlogout = new registrationAndLogin();
        $adminlogout->logout();
        header("Location: ../login.php");
      }    

      $strQuery = $db->getRows("SELECT monthname(date),SUM(total) from purchase WHERE year(date) = (SELECT year from additions WHERE id = 1) GROUP BY year(date),month(date)",[]);
  
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
              "label" => $row["monthname(date)"],
              "value" => $row["SUM(total)"]
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
    <link id="callCss" rel="stylesheet" href="../themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="../themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive --> 
  <link href="../themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
  <link href="../themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify --> 
  <link href="../themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../themes/images/ico/apple-touch-icon-57-precomposed.png">
<!-- Admin Css $ JS -->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <script type="text/javascript" src="js/fusioncharts.js"></script>
    <script type="text/javascript" src="js/themes/fusioncharts.theme.carbon.js"></script>

  <style type="text/css">
  .alert-box {

    color:white;
    border-radius:10px;
    font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
    padding:10px 36px;
    margin:10px;
    font-size: 15px;
    border: 1px solid;
    background-color: green;

   }
  .alert-box span {
    font-weight:bold;
    text-transform:uppercase;
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
    <a class="brand" href="adminControlPage.php"><img width="193px" height="47" src="../themes/images/logo.png" alt="Bootsshop"/></a>
    <ul id="topMenu" class="nav pull-right">
    <li><a href="adminControlPage.php">DashBoard</a></li>
    <li><a href="adminControlPage.php?do=feedbackDetails">View FeedBack</a></li>
    <li><a href="adminControlPage.php?do=purchaseDetails">Purchases Details</a></li>
    <li><a href="adminManage.php">Manage Control</a></li>

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
<!-- Sidebar ================================================== -->
  <?php
     $columnChart = new FusionCharts("column3d", "myFirstChart" , 500, 300, "chart-1", "json", $jsonEncodedData);
     $columnChart->render();
     $pieChart    = new FusionCharts("pie3d","mySecoundChart" , 500, 300, "chart-2", "json", $jsonEncodedData);
     $pieChart->render();
      ?>
      <center>
      <table>
        <tr>
      <th><div class="alert-box">
                <i class="fa fa-comments"></i>
              <span><?php $sql= $db->getRows("SELECT COUNT(*) from feedback WHERE updated = 0",[]);
                                      foreach($sql as $row){
                                        echo $row["COUNT(*)"];
                                      }
                                      ?> 
                                      New FeedBack!</span>
            
            <a class="card-footer text-white clearfix small z-1" href="adminControlPage.php?do=feedbackDetails">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div></th>
        <th><div class="alert-box">
                <i class="fa fa-users"></i>
              <span>You have <?php $sql= $db->getRows("SELECT COUNT(*) from users",[]);
                                      foreach($sql as $row){
                                        echo $row["COUNT(*)"];
                                      }
                                      ?> Users!</span>
            <a class="card-footer text-white clearfix small z-1" href="adminControlPage.php?do=usersDetails">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div></th>
        <th><div class="alert-box">
                <i class="fa fa-shopping-cart"></i>
              <span><?php $sql= $db->getRows("SELECT COUNT(*) from purchase WHERE updated = 0",[]);
                                      foreach($sql as $row){
                                        echo $row["COUNT(*)"];
                                      }
                                      ?> New Orders!</span>
            <a class="card-footer text-white clearfix small z-1" href="adminControlPage.php?do=purchaseDetails">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div></th>
        <th><div class="alert-box">
                <i class="fa fa-cube"></i>
              <span><?php $sql= $db->getRows("SELECT COUNT(*) from product WHERE updated = 0",[]);
                                      foreach($sql as $row){
                                        echo $row["COUNT(*)"];
                                      }
                                      ?> New Product!</span>
            <a class="card-footer text-white clearfix small z-1" href="adminControlPage.php?do=productDetails">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div></th>
          </tr>
</table>
</center>
<br><br><br>

 <center>
  <table style="border-collapse: collapse;width: 100%;">
    <tr>
      <th style="padding-left: 65px;"><label style="font-size: 30px;" class="fa fa-pie-chart">  Pie Chart</label></th>
      <th><label style="font-size: 30px;" class="fa fa-bar-chart">  Bar Chart</label></th>
    </tr>
    <tr>
      <th style="padding-left: 65px;"><div id="chart-2"></div></th>
      <th><div id="chart-1"></div></th>
    </tr>
  </table>
</center>

<!-- Sidebar end=============================================== -->
    
<!-- Footer ================================================================== -->
  <div  id="footerSection">
  <div class="container">
    <div class="row">
        
      <div id="socialMedia" class="span3 pull-right">
        <h5>SOCIAL MEDIA </h5>
        <a href="#"><img width="60" height="60" src="../themes/images/facebook.png" title="facebook" alt="facebook"/></a>
        <a href="#"><img width="60" height="60" src="../themes/images/twitter.png" title="twitter" alt="twitter"/></a>
        <a href="#"><img width="60" height="60" src="../themes/images/youtube.png" title="youtube" alt="youtube"/></a>
       </div> 
     </div>
     <br>
    <p class="pull-right">&copy; Copyright VisionPharma.com</p>
  </div><!-- Container End -->
  </div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
  <script src="../themes/js/jquery.js" type="text/javascript"></script>
  <script src="../themes/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../themes/js/google-code-prettify/prettify.js"></script>
  
  <script src="../themes/js/bootshop.js"></script>
    <script src="../themes/js/jquery.lightbox-0.5.js"></script>
  
  <!-- Themes switcher section ============================================================================================= -->
<div id="secectionBox">
<link rel="stylesheet" href="../themes/switch/themeswitch.css" type="text/css" media="screen" />
<script src="../themes/switch/theamswitcher.js" type="text/javascript" charset="utf-8"></script>
  <div id="themeContainer">
  <div id="hideme" class="themeTitle">Style Selector</div>
  <div class="themeName">Oregional Skin</div>
  <div class="images style">
  <a href="../themes/css/#" name="bootshop"><img src="../themes/switch/images/clr/bootshop.png" alt="bootstrap business templates" class="active"></a>
  <a href="../themes/css/#" name="businessltd"><img src="../themes/switch/images/clr/businessltd.png" alt="bootstrap business templates" class="active"></a>
  </div>
  <div class="themeName">Bootswatch Skins (11)</div>
  <div class="images style">
    <a href="../themes/css/#" name="amelia" title="Amelia"><img src="../themes/switch/images/clr/amelia.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="spruce" title="Spruce"><img src="../themes/switch/images/clr/spruce.png" alt="bootstrap business templates" ></a>
    <a href="../themes/css/#" name="superhero" title="Superhero"><img src="../themes/switch/images/clr/superhero.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="cyborg"><img src="../themes/switch/images/clr/cyborg.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="cerulean"><img src="../themes/switch/images/clr/cerulean.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="journal"><img src="../themes/switch/images/clr/journal.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="readable"><img src="../themes/switch/images/clr/readable.png" alt="bootstrap business templates"></a> 
    <a href="../themes/css/#" name="simplex"><img src="../themes/switch/images/clr/simplex.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="slate"><img src="../themes/switch/images/clr/slate.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="spacelab"><img src="../themes/switch/images/clr/spacelab.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="united"><img src="../themes/switch/images/clr/united.png" alt="bootstrap business templates"></a>
    <p style="margin:0;line-height:normal;margin-left:-10px;display:none;"><small>These are just examples and you can build your own color scheme in the backend.</small></p>
  </div>
  <div class="themeName">Background Patterns </div>
  <div class="images patterns">
    <a href="../themes/css/#" name="pattern1"><img src="../themes/switch/images/pattern/pattern1.png" alt="bootstrap business templates" class="active"></a>
    <a href="../themes/css/#" name="pattern2"><img src="../themes/switch/images/pattern/pattern2.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern3"><img src="../themes/switch/images/pattern/pattern3.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern4"><img src="../themes/switch/images/pattern/pattern4.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern5"><img src="../themes/switch/images/pattern/pattern5.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern6"><img src="../themes/switch/images/pattern/pattern6.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern7"><img src="../themes/switch/images/pattern/pattern7.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern8"><img src="../themes/switch/images/pattern/pattern8.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern9"><img src="../themes/switch/images/pattern/pattern9.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern10"><img src="../themes/switch/images/pattern/pattern10.png" alt="bootstrap business templates"></a>
    
    <a href="../themes/css/#" name="pattern11"><img src="../themes/switch/images/pattern/pattern11.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern12"><img src="../themes/switch/images/pattern/pattern12.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern13"><img src="../themes/switch/images/pattern/pattern13.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern14"><img src="../themes/switch/images/pattern/pattern14.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern15"><img src="../themes/switch/images/pattern/pattern15.png" alt="bootstrap business templates"></a>
    
    <a href="../themes/css/#" name="pattern16"><img src="../themes/switch/images/pattern/pattern16.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern17"><img src="../themes/switch/images/pattern/pattern17.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern18"><img src="../themes/switch/images/pattern/pattern18.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern19"><img src="../themes/switch/images/pattern/pattern19.png" alt="bootstrap business templates"></a>
    <a href="../themes/css/#" name="pattern20"><img src="../themes/switch/images/pattern/pattern20.png" alt="bootstrap business templates"></a>
     
  </div>
  </div>
</div>
<span id="themesBtn"></span>
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
   <script>
    $(document).ready(function () {

        // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
        $('#noti_Counter')
            .css({ top: '-10px' })
            .animate({ top: '-2px', opacity: 1 }, 500);

        $('#noti_Button').click(function () {

            // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
            $('#notifications').fadeToggle('fast', 'linear', function () {
                if ($('#notifications').is(':hidden')) {
                    $('#noti_Button').css('background-color', '#00FF44');
                }
                else $('#noti_Button').css('background-color', '#FFF');        // CHANGE BACKGROUND COLOR OF THE BUTTON.
            });

            $('#noti_Counter').fadeOut('slow');                 // HIDE THE COUNTER.

            return false;
        });

        // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
        $(document).click(function () {
            $('#notifications').hide();

            // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
            if ($('#noti_Counter').is(':hidden')) {
                // CHANGE BACKGROUND COLOR OF THE BUTTON.
                $('#noti_Button').css('background-color', '#00FF44');
            }
        });

        /*$('#notifications').click(function () {
            return false;       // DO NOTHING WHEN CONTAINER IS CLICKED.
        });*/
    });
</script>
</body>
</html>