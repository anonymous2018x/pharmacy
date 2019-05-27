<?php
    
        session_start();

        spl_autoload_register(function ($class){
        include "../classes/" . $class . ".php";
        });

        
       $db = Database::getInstance(); 
        
       if(isset($_SESSION['username'])){

       $id       = $_SESSION['ID'];
       $username = $_SESSION['username'];
       $name     = $_SESSION['full_name'];

       }else{ header("location: ../homepage.php");}

      if(isset($_GET['do']) && $_GET['do']=='logout'){
        $adminlogout = new registrationAndLogin();
        $adminlogout->logout();
        header("Location: ../login.php");
      }
  
      if($_SERVER['REQUEST_METHOD'] == "GET"){
                $supervisor = $db->getRows("SELECT * from supervisor where ID=?",[$_GET['id']]);
                foreach ($supervisor as $row) {
                    $supervisor_id = $row['ID'];
                    $Full_name     = $row['Full_name'];
                    $email         = $row['email'];
                    $username      = $row['username'];
                    $salary        = $row['salary'];
                    $phone         = $row['phone_number'];
                }
              }

      if($_SERVER['REQUEST_METHOD'] == "POST"){
                 
                if(isset($_POST['submit'])){ 
                $result = $db->updateRow("UPDATE supervisor SET Full_name=?,email=?,salary=?,phone_number=? 
                                          WHERE ID=?",[$_POST["full_name"],$_POST["email"],$_POST["salary"],$_POST["phone"],$supervisor_id]);
                

                if($result){

                        header("location: adminManage.php");
                }else {

                        echo "<script>alert('Sorry! there is something wrong happened..')</script>";
                }
            } 
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


div .valiationStyle{
    display:inline-block;
    width:150px;
    font-size: 13px;
    color: red;
    
}
    .tableStyle{
        width: 90%;
        margin: 20px 0px;
     background-color: #fff;
    display: inline-table;
    margin-top:0px;
    border-radius: 3px;

        
    }
    .tableStyle, th, td{
        border: 1px solid #cdcdcd;
    }
    .tableStyle th, table td{
        padding: 5px;
        text-align: left;
    }
    h1{
        text-align: center;
        color:#fff;
        background-color: gray;
        margin: 0px;
    }

     .part{
        width:98.5%;
        min-height: 150px;
        display: inline-block;
        background-color:#B0C4DE;
        padding: 10px;
    }
    .button {
  display: inline-block;
  padding: 7px 10px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;

 
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  }
  hr.fancy-line { 
    border: 3; 
    margin-right: 20px;
    height: 3px; 
    background-image: -webkit-linear-gradient(left, red, blue, gray); 
    background-image: -moz-linear-gradient(left, green, red, yellow); 
    background-image: -ms-linear-gradient(left, gray, red, blue; 
    background-image: -o-linear-gradient(left, blue, yellow, red; 
    box-shadow: 0px -2px 4px rgba(136,136,136,0.75);
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
    <a class="brand" href="supervisorControlPage.php"><img src="../themes/images/logo.png" alt="Bootsshop"/></a>
    <ul id="topMenu" class="nav pull-right">
    <li><a href="charts.php">Profits</a></li>
    <li><a href="?do=feedbackDetails">View FeedBack</a></li>
    <li><a href="?do=purchaseDetails">Purchases Details</a></li>
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
   <center>
 <h1>Admin Control</h1>

    <div class="part">
      <?php 
      
  echo '

 <table>
<tr>
          <form   name="myForm"   id="myForm"   method="POST">

                <td><input type="number"   id="phone"    value="' . $phone . '"      name="phone"></td>

        <td><input type="text"     id="name"     Value="' . $Full_name . '"   name="full_name"></td>


        <td><input type="email"    id="email"    value="'  . $email . '"      name="email"></td>



        <td><input type="number" id="salary"  value="' .$salary . '" name="salary"></td>
               
      </tr>
      <tr>
                        <td><div style="float: left;" id="y7" class="valiationStyle"></div></td>

                        <td><div  id="y2" class="valiationStyle"></div></td>

                        <td><div id="y3" class="valiationStyle"></div></td>

                        <td><div id="y6" class="valiationStyle"></div></td>

        <input type="submit" name="submit" class="button" value="Update supervisor" />
        
        </form>
</tr>
</table>
       

        <br><br>
      
';

?>
        
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

</body>
</html>
<script type="text/javascript">

function validation2() 
 {
    
count=0;
     var x2,x3,x4,x6,x7,text;
     

    // Get the value of the input field with id="numb"
    x2 = document.getElementById("name").value;
    x3 = document.getElementById("email").value;
    x6 = document.getElementById("salary").value;
    x7 = document.getElementById("phone").value;

    // If x is Not a Number or less than one or greater than 10

    if (x2.length < 1  || !isNaN(x2)) {
        text = "* FullName Not Valid";
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


    if (x6.length < 1 ) {
        text = "* this input is not valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y6").innerHTML = text;

    if (isNaN(x7) || x7 < 1) {
        text = "* Phone Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y7").innerHTML = text;
 
            if(count==4)
            {
                 document.getElementById('myForm').submit();
              
            }
     }
    

</script>


