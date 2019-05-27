<?php
    
        session_start();
        require_once "../observerClass.php";
        spl_autoload_register(function ($class){
        include "../classes/" . $class . ".php";
        });
                $supervisorData;
                $supervisor = new supervisor();
                $db = Database::getInstance();
                if(isset($_COOKIE['username']) && !isset($_SESSION['username'])){
   
   $_SESSION['ID'] = $_COOKIE['id'];
   $_SESSION['username'] = $_COOKIE['username'];
   $_SESSION['full_name'] = $_COOKIE['full_name'];
   $_SESSION['status'] = $_COOKIE['status'];

  }
        
       if(isset($_SESSION['username']) && $_SESSION['status'] == 'supervisor'){

       $id       = $_SESSION['ID'];
       $username = $_SESSION['username'];
       $name     = $_SESSION['full_name'];
       $supervisorData = $supervisor->viewOwnProfile($id);

      }else{ header("location: ../homepage.php");}

		  if(isset($_GET['do']) && $_GET['do']=='logout'){
		    $supervisor = new registrationAndLogin();
		    $supervisor->logout();
        header("Location: ../login.php");

		  }    
       
       $Distnationerr = $sourceerr = $purchase_noerr = $UserIDerr = $Expected_DELerr = $UserEmailerr = "";
       $Distnation = $source = $purchase_no = $UserID = $Expected_DEL = $UserEmail = "";
       $count = 0;
       $profile_Data;
       $Purch_data;
   if(isset($_GET["id"]))
    {   
       $profile_Data = $supervisor->viewUserProfile($_GET["id"]);
       $Purch_data   = $supervisor->viewUserPurchases($_GET["id"]);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      
      if (empty($_POST["Distnation"])) {
        $Distnationerr                = "* this field is required";
      }else{$Distnation               = $_POST['Distnation'];
            $count++;}
      // email
      if (empty($_POST["supplier"])) {
        $sourceerr                    = "* this field is required";
      }else{$source                   = $_POST['supplier'];
            $count++;}
      // username
      if (empty($_POST["purchase_no"])) {
        $purchase_noerr               = "* this field is required";
      }else{
        $purchase_no                  = $_POST['purchase_no'];
            $count++;} 
       if (empty($_POST["UserID"])) {
        $UserIDerr                    = "* this field is required";
      }else{
        $UserID                       = $_POST['UserID'];
            $count++;}
       if (empty($_POST["Expected_DEL"])) {
        $Expected_DELerr              = "* this field is required";
      }else{
        $Expected_DEL                 = $_POST['Expected_DEL'];
            $count++;}
       if (empty($_POST["UserEmail"])) {
        $UserEmailerr                 = "* this field is required";
      }else{  
        $UserEmail                    = $_POST['UserEmail'];
            $count++;}
      }

      if($count == 6){
        $Data = $supervisor->addShippingDetails($Distnation,$source,$purchase_no,$Expected_DEL, $UserID);
        if($Data){
         echo "<script>alert('Registration is completed succssfully ')</script>";
           $to      = $UserEmail;
           $subject = "Package Informtion";
           $txt     = "Your Package is ready to deliever at " . $Expected_DEL;
           $headers = "From: 24HourPharmacy@example.com" . "\r\n" .
                      "CC: abaradah@gmail.com";
            mail($to,$subject,$txt,$headers);
        }
                    header('Location: supervisorControlPage.php');  
                    echo "<script>alert('Registration is completed succssfully ')</script>";

      }


        $array = $supervisor->getRow("SELECT * from notification", []);

        /*objects for observers*/
        $observerObject = new PatternObserver();
        $subjectObject  = new PatternSubject();
        $subjectObject->setObservers();
        $subjectObject->attach($observerObject);

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
<!-- Supervisor Css -->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

	<style type="text/css">
		    #noti_Container {
        position:relative;
    }
       
    /* A CIRCLE LIKE BUTTON IN THE TOP MENU. */
    #noti_Button {
        width:28px;
        height:28px;
        line-height:25px;
        border-radius:50%;
        -moz-border-radius:50%; 
        -webkit-border-radius:50%;
        background:#FFF;
        margin:20px 10px 0 10px;
        cursor:pointer;
    }
        
    /* THE POPULAR RED NOTIFICATIONS COUNTER. */
    #noti_Counter {
        display: inline-block;
        position:absolute;
        background:#E1141E;
        color:#FFF;
        font-size:10px;
        font-weight:normal;
        padding:1px 4px;
        margin:8px 0 0 31px;
        border-radius:50px;
        -moz-border-radius:1px; 
        -webkit-border-radius:1px;
        z-index:1;
    }
        
    /* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
    #notifications {
        display: block;
        white-space: nowrap;
        display:none;
        width:400px;
        overflow:scroll;
        overflow-x: hidden;
        position:fixed;
        top:88px;
        right:223px;
        background:#FFF;
        border:solid 1px rgba(100, 100, 100, .20);
        -webkit-box-shadow:0 3px 8px green;
        z-index: 100;
        border-bottom-left-radius: 25px;
        border-top-left-radius: 25px;
    }    
    .noti_content{
    	padding:8px;
    	padding-top:0px;
    }
    .seeAll {
        background:#F6F7F8;
        padding:8px;
        font-size:12px;
        font-weight:bold;
        border-top:solid 1px rgba(100, 100, 100, .30);
        text-align:center;
    }
    .seeAll a {
        color:#3b5998;
    }
    .seeAll a:hover {
        background:#F6F7F8;
        color:#3b5998;
        text-decoration:underline;
    }
    h3 {
        display:block;
        color:#333; 
        background:#FFF;
        font-weight:bold;
        font-size:13px;    
        padding:8px;
        margin:0;
        border-bottom:solid 1px rgba(100, 100, 100, .30);
    }
    .dropbtn {
    background-color:none;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
	}

	/* The container <div> - needed to position the dropdown content */
	.dropdown {
	    position: relative;
	    display: inline-block;
	}

	/* Dropdown Content (Hidden by Default) */
	.dropdown-content {
	    display: none;
	    position: fixed;
	    background-color: #f9f9f9;
	    min-width: 150px;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 1;
	    cursor: pointer;
	    border-bottom-left-radius: 25px;
	    border-bottom-right-radius: 25px;
	    border-top-left-radius: 25px;
	    border-top-right-radius: 25px;

	}

	/* Links inside the dropdown */
	.dropdown-content a {
	    color: black;
	    padding: 1px 16px;
	    text-decoration: none;
	    display: block;

	}

	/* Change color of dropdown links on hover */
	.dropdown-content a:hover {background-color: #3e8e41;border-bottom-left-radius: 25px;
    border-bottom-right-radius: 25px;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;}

	/* Show the dropdown menu on hover */
	.dropdown:hover .dropdown-content {
	    display: block;
	}

	/* Change the background color of the dropdown button when the dropdown content is shown */
	.dropdown:hover .dropbtn {
	    background-color: none;
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
    <a class="brand" href="supervisorControlPage.php"><img width="193px" height="47" src="../themes/images/logo.png" alt="Bootsshop"/></a>
    <ul id="topMenu" class="nav pull-right">
               <li class=""><a href="supervisorControlPage.php">DashBoard</a></li>
    <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Product Details</a>
        <div class="dropdown-content">
			<a href="supervisorControlPage.php?do=skinCare">Skin Care</a>
			<a href="supervisorControlPage.php?do=menCare">Men Care </a>
			<a href="supervisorControlPage.php?do=dentalCare">Dental Care </a>
			<a href="supervisorControlPage.php?do=hairCare">Hair Care </a>
			<a href="supervisorControlPage.php?do=intimateCare">Intimiate Care </a>
		</div>
	 </li>
	 <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Product Rating</a>
        <div class="dropdown-content">
			<a href="supervisorControlPage.php?do=RskinCare">Skin Care</a>
			<a href="supervisorControlPage.php?do=RmenCare">Men Care </a>
			<a href="supervisorControlPage.php?do=RdentalCare">Dental Care </a>
			<a href="supervisorControlPage.php?do=RhairCare">Hair Care </a>
			<a href="supervisorControlPage.php?do=RintimiateCare">Intimiate Care </a>
		</div>
	 </li>
	 <li class=""><a href="../product/manageProduct.php">Manage Product</a></li>
	 <li id="noti_Container">
              <?php $sql = $supervisor->getRow("SELECT COUNT(*) from notification", []);
                                             foreach($sql as $row){ 
                                              if($row["COUNT(*)"] > 0){
                                               echo "<div id='noti_Counter'>" . $row["COUNT(*)"] . "</div>";}
                                              else { 
                                               echo "<div></div>";
                                            } 
                                          } 
                ?>
                                             <!--SHOW NOTIFICATIONS COUNT.-->
                
                <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                <div id="noti_Button"><center><i class="fa fa-bell-o" aria-hidden="true"></i></center></div>    

                <!--THE NOTIFICAIONS DROPDOWN BOX.-->
                <div id="notifications">
                    <h3>Notifications</h3>
                    <div><?php 
            
  

       


      
    
            foreach ($array as $value) {
            
              echo '<div class="noti_content"><a style="color:black;" href="#">';
                $value["text"] = strlen($value["text"]) > 55 ? substr($value["text"],0,50)."..." : $value["text"];
                $subjectObject->setData($value["text"]);//();
                $subjectObject->notify();
                      
                echo '</a></div>';

              }
     ?>
     </div>
                    <div class="seeAll"><a href="supervisorControlPage.php?do=seeAll">See All </a></div>
                </div>
            </li>
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

      if(isset($_GET['do']) && $_GET['do'] == 'clear'){ $supervisor->deleteRow("DELETE from notification",[]);
                                                            header("Location: " . $_SERVER['PHP_SELF']);}
      elseif(isset($_GET['do']) && $_GET['do'] == 'clearAll'){$supervisor->deleteRow("DELETE FROM `notification` where id=?",[$_GET['noti_id']]);                                 
                                                            header("Location: " . $_SERVER['PHP_SELF']);}                                                    
      elseif(isset($_GET['do']) && $_GET['do']=='seeAll')         {$notification = $array;} 
      ?>
      <center>
       <div style ="width: 90%;background-color: white;
                            border-bottom-left-radius: 25px;
                            border-bottom-right-radius: 25px;
                            border-top-left-radius: 25px;
                            border-top-right-radius: 25px;" >
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver;">

          <label class="fa fa-user" style="float:left;margin:10px;font-size: 30px;"> User Information</label></div>
        <div  class="card-body">
          <div class="table-responsive">
          <table style="border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
              <tr>
                <td >ID</td>
                <td >Full Name</td>
                <td >Age </td>
                <td >Email</td>
                <td >Username</td>
                <td >Address</td>
                <td >Gender</td>
                <td >Phone</td>
              </tr>
          </thead>
          <tbody>
          <?php
            foreach($profile_Data as $row){
            echo "<tr>";
            echo "<td>" .  $row['ID']                  .  "</td>";
            echo "<td>" .  $row['full_name']           .  "</td>";
            echo "<td>" .  $row['birthdate']                 .  "</td>";
            echo "<td>" .  $row['email']               .  "</td>";
            echo "<td>" .  $row['username']            .  "</td>";
            echo "<td>" .  $row['address']             .  "</td>";
            echo "<td>" .  $row['gender']              .  "</td>";
            echo "<td>" .  $row['phone_number']        .  "</td>
                  </tr>";
             }
             ?>
          </tbody>
            </table>
            </div>
        </div>
      <div class="card-footer small text-muted" style="background-color:##F0EDED;border-top:1px solid silver"><b style="color:black;"> Updated <?php echo date("l\, F jS\, Y ") ?></b></div>

          </div><br>

          <br>
          <div style ="width: 90%;background-color: white;
                            border-bottom-left-radius: 25px;
                            border-bottom-right-radius: 25px;
                            border-top-left-radius: 25px;
                            border-top-right-radius: 25px;" >
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver;">

          <label class="fa fa-bill" style="float:left;margin:10px;font-size: 30px;"> User Purchase</label></div>
        <div  class="card-body">
          <div class="table-responsive">
          <table style="border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
              <tr>
                <td >purch_No </td>
                <td >Netfees</td>
                <td >Discount</td>
                <td >Total</td>
                <td >Date</td>
                <td >Completed</td>
             </tr>
</thead>
          <tbody>
          <?php
            foreach($Purch_data as $row){
            echo "<tr>";
          echo "<td>" .  $row['purch_no']           .  "</td>";
          echo "<td>" .  $row['netfees']            .  "</td>";
          echo "<td>" .  $row['discount']           .  "</td>";
          echo "<td>" .  $row['total']              .  "</td>";
          echo "<td>" .  $row['date']               .  "</td>";
          echo "<td>" .  $row['complete']           .  "</td>
                  </tr>";
            }
             ?>
          </tbody>
            </table>
            </div>
        </div>
      <div class="card-footer small text-muted" style="background-color:##F0EDED;border-top:1px solid silver"><b style="color:black;"> Updated <?php echo date("l\, F jS\, Y ") ?></b></div>

          </div><br><br><hr style="border-top: 3px double rgba(12,29,0,1.00);"><br>

</center>
  <form method="POST" action=""> 
    <center>

        <div class="row">

      <h4>NEW PACKAGE</h4>
    
       <table>
        <tr>
        <th><input type="text" placeholder="Distnation" name="Distnation" /></th>
        <th><?php
        $query = $db->getRows("SELECT ID FROM supplier",[]);
          echo '<select name="supplier">';
                       echo '<option value="" selected disabled hidden>Choose supplier ID</option>';
          foreach($query as $row) {
             echo '<option value="'.$row['ID'].'">'.$row['ID'].'</option>';
          }
          echo '</select>';
          ?></th>
        <th><?php
        $query = $db->getRows("SELECT purch_no FROM purchase",[]);
          echo '<select name="purchase_no">';
                       echo '<option value="" selected disabled hidden>Choose Purchase No</option>';
          foreach($query as $row) {
             echo '<option value="'.$row['purch_no'].'">'.$row['purch_no'].'</option>';
          }
          echo '</select>';
          ?></th>

        <th><?php
        $query = $db->getRows("SELECT ID FROM users");
          echo '<select name="UserID">';
                       echo '<option value="" selected disabled hidden>Choose User ID</option>';
          foreach($query as $row) {
             echo '<option value="'.$row['ID'].'">'.$row['ID'].'</option>';
          }
          echo '</select>';
          ?></th>
        <th><?php
        $query = $db->getRows("SELECT email FROM users");
          echo '<select name="UserEmail">';
                       echo '<option value="" selected disabled hidden>Choose User Email</option>';
          foreach($query as $row) {
             echo '<option value="'.$row['email'].'">'.$row['email'].'</option>';
          }
          echo '</select>';
          ?></th>

          
            <tr>
                <th><span style="color: red"><?php echo $Distnationerr; ?></span></th>

                <th><span style="color: red"><?php echo $sourceerr; ?></span></th>

                <th><span style="color: red"><?php echo $purchase_noerr; ?></span></th>

                <th><span style="color: red"><?php echo $UserIDerr; ?></span></th>

                <th><span style="color: red"><?php echo $UserEmailerr; ?></span></th>
              </tr>
            </table>
<br>
        <h4>Expected Del Date</h4>
            <input style="padding-left: 10px" type="date" name="Expected_DEL">


            <br>
                


                <span style="color: red"><?php echo $Expected_DELerr; ?></span>
   
 <button name="delete" style="width:100px;height:30px;border-bottom-left-radius: 25px;
                            border-bottom-right-radius: 25px;
                            border-top-left-radius: 25px;
                            border-top-right-radius: 25px;"" type="submit">Submit</button>
        </div>
</center>
  </form>        
     
  </div>
</div>
</div>
   
<!-- Sidebar end=============================================== -->
		
<!-- Footer ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
			
		 </div>
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