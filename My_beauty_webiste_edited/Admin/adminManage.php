<?php
    
        session_start();

        spl_autoload_register(function ($class){
        include "../classes/" . $class . ".php";
        });
  
        $suppliererror = "";
        $object = new classAdmin();
        $array  = $object->showTable("supplier");
        $array2 = $object->showTable("supervisor");
        $numberOFRow  = count($array);
        $numberOFRow2 = count($array2);
        $db           = Database::getInstance();
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

       if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $tt=false;
        $count;

        if(isset($_POST['submit2'])){
            $id2 = $_POST["D_ID"];
            $count = $db->getRowCount("SELECT * from supplier where ID=?",[$id2]);
                if($id2>0){

                             if($count > 0){
                             $tt = $object->Delete_Supplier("supplier",$id2);
                             if($tt){ // check if the suppleir deleted succesfully
                    

                             }else { $suppliererror = "This supplier could not be deleted becasue he has products!";}

                             }else {echo "<script>alert('Input Not Found')</script>"; // if the supplier id is not found
                                    header("Refresh:5; url=adminManage.php");}
                        
                
            
            }else {echo "<script>alert('Faild Input')</script>"; header("Refresh:5; url=adminManage.php");}
                                          header("location: adminManage.php");

        }

      }        
    

   if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['submit1'])){
                    $register = new classAdmin();
                    $id = $_POST["ID"];
                    $fullName = $_POST["FullName"];
                    $emial = $_POST["Email"];
                    $userName= $_POST["username"];
                    $pass = $_POST["password"];
                    $add = $_POST["address"];
                    $phone_number = $_POST["phone"];
                    $ch=$register->supplier_registration("supplier",$id,$fullName,$emial,$userName,$pass,$add,$phone_number);
                    if($ch)
                    {
                        echo "<script>alert('Registration is completed succssfully ')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                    else{
                        echo "<script>alert('Dont Dublicate Primary ID OR Any Unique')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                  }   
            
             }
             ////////////////////////////////888888888888888888888888888888888888888888888888888/////////////
              if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $check=0;
        $tt=false;
        if(isset($_POST['submit4'])){
            $id2 = $_POST["D_ID0"];
                if($id2>0){
                    if($numberOFRow2){
                        foreach ($array2 as $value) {
                        if($value['ID']==$id2){

                             $tt = $object->Delete_Supplier("supervisor",$id2);
                             $check = 1;
                             header("Refresh:0; url=adminManage.php");
                            break;
                        }

  
                    }
                  }
                    
                    if($check==0){
                        echo "<script>alert('Input Not Found2')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                        
                if($tt){
                    
                    header("Refresh:0; url=adminManage.php");
                }
            }
            else {
                echo "<script>alert('Faild Input2')</script>";
                header("Refresh:0; url=adminManage.php");
            }
        }
                
    }

   if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['submit3'])){
                    $register = new classAdmin();
                    $id = $_POST["ID0"];
                    $fullName = $_POST["FullName0"];
                    $emial = $_POST["Email0"];
                    $userName= $_POST["username0"];
                    $pass = $_POST["password0"];
                    $add = $_POST["address0"];
                    $phone_number = $_POST["phone0"];
                    $ch=$register->supplier_registration("supervisor",$id,$fullName,$emial,$userName,$pass,$add,$phone_number);
                    if($ch)
                    {
                        echo "<script>alert('Registration is completed succssfully ')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                    else{
                        echo "<script>alert('Dont Dublicate Primary ID OR Any Unique')</script>";
                        header("Refresh:0; url=adminManage.php");
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
    <a class="brand" href="adminControlPage.php"><img width="193px" height="47" src="../themes/images/logo.png" alt="Bootsshop"/></a>
    <ul id="topMenu" class="nav pull-right">
    <li><a href="adminControlPage.php">DashBoard</a></li>
    <li><a href="charts.php">Profits</a></li>
    <li><a href="adminControlPage.php?do=feedbackDetails">View FeedBack</a></li>
    <li><a href="adminControlPage.php?do=purchaseDetails">Purchases Details</a></li>

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
        
        <form   name="myForm"   id="myForm"   method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div id="y1" class="valiationStyle" ></div>

        <input type="number"   id="id"       placeholder="ID"         name="ID">

        <input type="text"     id="name"     placeholder="FullName"   name="FullName">
                <div id="y2" class="valiationStyle"></div>

        <br>
                        <div id="y3" class="valiationStyle"></div>

        <input type="email"    id="email"    placeholder="Email"      name="Email">

        <input type="text"     id="username" placeholder="username"   name="username"> 
                <div id="y4" class="valiationStyle"></div>

        <br>                <div id="y5" class="valiationStyle"></div>

        <input type="password" id="password" placeholder="password"   name="password">

        <input type="text"     id="address"  placeholder="address"    name="address">
                <div id="y6" class="valiationStyle"></div>

        <br>
        <input type="number"   id="phone"    placeholder="phone"      name="phone">
        <br>
                <div id="y7" class="valiationStyle"></div>

        <br><br>

        <input type="button" class="button"   value="Add Supplier" onclick="validation()"  />
  
        <input type="hidden" name="submit1" value="" >
        </form>

        
       
    <table class="tableStyle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full_name</th>
                <th>Email</th>
                <th>UserName</th>
                <th>password</th>
                <th>address</th>
                <th>pnone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($numberOFRow>0)
            {
                    foreach ($array as $value) {
                    echo " <tr>
                               <td>"                      .$value['ID']           ."</td>
                               <td>"                      .$value['Full_name']    ."</td>
                               <td>"                      .$value['email']        ."</td>
                               <td>"                      .$value['username']     ."</td>
                               <td>"                      .$value['password']     ."</td>
                               <td>"                      .$value['address']      ."</td>
                               <td>"                      .$value['phone_number'] ."</td>";
                           "</tr>";
                }
            }
                
             ?>

        </tbody>
    </table>
    <div style="float:Right; margin-right:9px; margin-top:20px;">
         <form name="myForm2" id="myForm2" method="POST" action="" >
         <input type="number" placeholder="Enter ID"   name="D_ID" style="width:110px; "><br />
         <div id="" class="valiationStyle"><?php echo $suppliererror; ?></div>
         <br>
         <input type = "submit" class="button" value="Delete" name="submit2" style="width:110px;margin-top:10px">


    </form>

    </div>
     
     
</div>
<hr class="fancy-line"></hr>
     <!-- tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt !-->
     <div class="part">
     <form name="myForm3" id="myForm3" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div id="y10" class="valiationStyle"></div>
        <input type="number"   id="id0"       placeholder="ID"         name="ID0">
        <input type="text"     id="name0"     placeholder="FullName"   name="FullName0">
        <div id="y20" class="valiationStyle"></div>
        <br>
                <div id="y30" class="valiationStyle"></div>
        <input type="email"    id="email0"    placeholder="Email"      name="Email0">
        <input type="text"     id="username0" placeholder="username"   name="username0"> 
                <div id="y40" class="valiationStyle"></div>
<br>         <div id="y50" class="valiationStyle"></div>

        <input type="password" id="password0" placeholder="password"   name="password0">
        <input type="number"   id="address0"  placeholder="Salary"     name="address0">
                <div id="y60" class="valiationStyle"></div>
<br>
        <input type="number"   id="phone0"    placeholder="phone"      name="phone0">
               <br><div id="y70" class="valiationStyle"></div>

        <br><br>
        <input type="button" class="button"   value="Add Supervis" onclick="validation2()"  />
        <input type="hidden" name="submit3" value="" >
        </form>

        
    <table class="tableStyle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full_name</th>
                <th>Email</th>
                <th>UserName</th>
                <th>password</th>
                <th>Salary</th>
                <th>pnone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($numberOFRow2>0)
            {
                    foreach ($array2 as $value) {
                    echo " <tr>
                               <td>".$value['ID']           ."</td>
                               <td>".$value['Full_name']    ."</td>
                               <td>".$value['email']        ."</td>
                               <td>".$value['username']     ."</td>
                               <td>".$value['password']     ."</td>
                               <td>".$value['salary']      ."</td>
                               <td>".$value['phone_number'] ."</td>
                           </tr>";
                }
            }
                
             ?>

        </tbody>
    </table>
    <div style="float:Right; margin-right:9px; margin-top:20px;">
         <form name="myForm4" id="myForm4" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
         <input type="number" placeholder="Enter ID"   name="D_ID0" style="width:110px; "><br />
         <input type = "submit" class="button" value="Delete Row" name="submit4" style="width:110px;margin-top:10px">

    </form>

    </div>
     
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


</body>
</html>
<script type="text/javascript">
count=0;
 
 function validation() 
 {
    
count=0;
     var x1,x2,x3,x4,x5,x6,x7,text;
     

    // Get the value of the input field with id="numb"
    x1 = document.getElementById("id").value;
    x2 = document.getElementById("name").value;
    x3 = document.getElementById("email").value;
    x4 = document.getElementById("username").value;
    x5 = document.getElementById("password").value;
    x6 = document.getElementById("address").value;
    x7 = document.getElementById("phone").value;

    // If x is Not a Number or less than one or greater than 10
    if (isNaN(x1) || x1 < 1) {
        text = "*ID Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y1").innerHTML = text;

    if (x2.length < 1  || !isNaN(x2)) {
        text = "*FullName Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y2").innerHTML = text;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(x3)) {
        text = "*Email Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y3").innerHTML = text;

    if (x4.length < 1 || !isNaN(x4)) {
        text = "*UserName Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y4").innerHTML = text;

    if (x5.length < 5) {
        text = "*Password Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y5").innerHTML = text;

    if (x6.length < 1 || !isNaN(x6)) {
        text = "*Address Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y6").innerHTML = text;

    if (isNaN(x7) || x7 < 1) {
        text = "*Phone Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y7").innerHTML = text;
 
            if(count==7)
            {
                 document.getElementById('myForm').submit();
              
            }
     }
     count0=0;

    function validation2() {
 
count0=0;
     var x10,x20,x30,x40,x50,x60,x70,text0;
     

    // Get the value of the input field with id="numb"
    x10 = document.getElementById("id0").value;
    x20 = document.getElementById("name0").value;
    x30 = document.getElementById("email0").value;
    x40 = document.getElementById("username0").value;
    x50 = document.getElementById("password0").value;
    x60 = document.getElementById("address0").value;
    x70 = document.getElementById("phone0").value;

    // If x is Not a Number or less than one or greater than 10
    if (isNaN(x10) || x10 < 1) {
        text0 = "*ID Not Valid";
    } else {
        text0 = "";
        count0++;
    }

    document.getElementById("y10").innerHTML = text0;

    if (x20.length < 1  || !isNaN(x20)) {
        text0 = "*FullName Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    document.getElementById("y20").innerHTML = text0;
    var re0 = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re0.test(x30)) {
        text0 = "*Email Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    document.getElementById("y30").innerHTML = text0;

    if (x40.length < 1 || !isNaN(x40)) {
        text0 = "*UserName Not Valid";
    } else {
        text0 = "";
        count0++;
    }

    document.getElementById("y40").innerHTML = text0;

    if (x50.length < 5) {
        text0 = "*Password Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    
    document.getElementById("y50").innerHTML = text0;

    if (isNaN(x60) || x60 < 1) {
        text0 = "*Salary Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    document.getElementById("y60").innerHTML = text0;

    if (isNaN(x70) || x70 < 1) {
        text0 = "*Phone Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    document.getElementById("y70").innerHTML = text0;
    
            if(count0==7)
            {
                 document.getElementById('myForm3').submit();
              
            }
     }


</script>


