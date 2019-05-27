<?php
    
        session_start();
        require_once "../observerClass.php";
        spl_autoload_register(function ($class){
        include "../classes/" . $class . ".php";
        });




        $supervisorData;
        $supervisor = new supervisor();
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
    <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Product Details</a>
        <div class="dropdown-content">
			<a href="?do=skinCare">Skin Care</a>
			<a href="?do=menCare">Men Care </a>
			<a href="?do=dentalCare">Dental Care </a>
			<a href="?do=hairCare">Hair Care </a>
			<a href="?do=intimateCare">Intimiate Care </a>
		</div>
	 </li>
	 <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Product Rating</a>
        <div class="dropdown-content">
			<a href="?do=RskinCare">Skin Care</a>
			<a href="?do=RmenCare">Men Care </a>
			<a href="?do=RdentalCare">Dental Care </a>
			<a href="?do=RhairCare">Hair Care </a>
			<a href="?do=RintimiateCare">Intimiate Care </a>
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
                    <div class="seeAll"><a style="padding-right: 100px;" href="?do=seeAll">See All </a><a href="?do=clear">Clear All</a></div>
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
	
	 <center>
      <?php
      /*Links ->>>>>>>>>>>>>>>>>>>>>*/ 
        $purchaseData = $supervisor->viewPurchaseDetails();
        $productData;
        $feedbackData = $supervisor->viewFeedbackDetails();
        $ratingData;
        $Userdata;
      if(isset($_GET['do']) && $_GET['do']=='skinCare')           {$productData  = $supervisor->viewProductDetails(1);}
      elseif(isset($_GET['do']) && $_GET['do']=='hairCare')       {$productData  = $supervisor->viewProductDetails(2);}
      elseif(isset($_GET['do']) && $_GET['do']=='dentalCare')     {$productData  = $supervisor->viewProductDetails(3);}
      elseif(isset($_GET['do']) && $_GET['do']=='intimateCare')   {$productData  = $supervisor->viewProductDetails(4);}
      elseif(isset($_GET['do']) && $_GET['do']=='babyCare')       {$productData  = $supervisor->viewProductDetails(5);}
      elseif(isset($_GET['do']) && $_GET['do']=='menCare')        {$productData  = $supervisor->viewProductDetails(6);} 
      elseif(isset($_GET['do']) && $_GET['do']=='RskinCare')      {$ratingData   = $supervisor->showRatings(1);} 
      elseif(isset($_GET['do']) && $_GET['do']=='RhairCare')      {$ratingData   = $supervisor->showRatings(2);}
      elseif(isset($_GET['do']) && $_GET['do']=='RdentalCare')    {$ratingData   = $supervisor->showRatings(3);}
      elseif(isset($_GET['do']) && $_GET['do']=='RintimateCare')  {$ratingData   = $supervisor->showRatings(4);}
      elseif(isset($_GET['do']) && $_GET['do']=='RbabyCare')      {$ratingData   = $supervisor->showRatings(5);}
      elseif(isset($_GET['do']) && $_GET['do']=='RmenCare')       {$ratingData   = $supervisor->showRatings(6);}
      elseif(isset($_GET['do']) && $_GET['do']=='UserID')         {$Userdata     = $userData->viewUserProfile($row['UserID']);}
      elseif(isset($_GET['do']) && $_GET['do']=='ViewOwnProfile') {$supervisorData = $supervisor->viewOwnProfile($id);}
      elseif(isset($_GET['do']) && $_GET['do'] == 'clear'){ $supervisor->deleteRow("DELETE from notification",[]);}
      elseif(isset($_GET['do']) && $_GET['do'] == 'clearAll'){$supervisor->deleteRow("DELETE FROM `notification` where id=?",[$_GET['noti_id']]);}                                                    
      elseif(isset($_GET['do']) && $_GET['do']=='seeAll')         {$notification = $array;} 
      /*product details ->>>>>>>>>>>>>>>>>*/
      if(isset($productData))
        {
           echo '
    <div style ="overflow:auto;height:300px;width: 90%;background-color: white;" >
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver;">

          <label class="fa fa-cube" style="float:left;margin:10px;font-size: 30px;"> Product Data Table - ' . $_GET['do'] . '</label></div>
        <div  class="card-body">
          <div class="table-responsive">
          <table style="border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
             <tr>
                <th >Product Name</th>
                <th >No in Stock</th>
                <th >Price</th>
                <th >Supplier</th>
             </tr>
      </thead>';
      
        echo "<tbody>";
          foreach($productData as $row){
            echo "<tr>";
          echo "<td>" .  $row['product_name']  .  "</td>";
          echo "<td>" .  $row['no_in_stock']   .  "</td>";
          echo "<td>" .  $row['price']  .  "</td>";
          echo "<td>" .  $row['supplier']     .  "</td>
                  </tr>";
          }
            echo '</tbody>
            </table>
            </div>
        </div>
                <div class="card-footer small text-muted" style="background-color:##F0EDED;border-top:1px solid silver"><b style="color:black;"> Updated ' . date("l\, F jS\, Y ") . ' </b></div>

          </div><br><br><hr style="border-top: 3px double rgba(12,29,0,1.00);"><br>';

        } 
        /*rating product ->>>>>>>>>>>>>>>>>>>>*/
       elseif(isset($ratingData))
        {
         echo '
         <div style ="overflow:auto;height:300px;width: 90%;background-color: white;" >
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver">

          <label class="fa fa-star" style="font-size: 30px;float:left;margin:10px;"> FeedBack Data Table - ' . $_GET['do'] . '</label></div>
        <div  class="card-body">
          <div class="table-responsive">
          <table style="border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
             <tr>
                  <td>product name</td>
                  <td>Product Rating</td>
                  </tr>
        </thead>';

        echo "<tbody>";
          foreach($ratingData as $row){
            echo "<tr>";
          echo "<td>" . $row['product_name']    . "</td>";
          echo "<td>" . $row['productRating']   . "</td>
                  </tr>";
          
            }
            echo '</tbody>
            </table>
            </div>
        </div>
                <div class="card-footer small text-muted" style="background-color:##F0EDED;border-top:1px solid silver"><b style="color:black;"> Updated ' . date("l\, F jS\, Y ") . ' </b></div>

          </div><br><br><hr style="border-top: 3px double rgba(12,29,0,1.00);"><br>';

        }
        /*notification ->>>>>>>>>>>>>>>>>*/
        elseif(isset($notification))
        {
         echo '
         <div style ="overflow:auto;height:300px;width: 90%;background-color: white;" >
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver">

          <label class="fa fa-bell-o" style="font-size: 30px;float:left;margin:10px;"> Notifications Data Table</label></div>
        <div  class="card-body">
          <div class="table-responsive">
          <table style="table-layout:fixed;border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
             <tr>

                  <td>Notifications</td>
                  <td>Supplier</td>
                  <td>Request</td>
                  </tr>
        </thead>';

        echo "<tbody>";
          foreach($notification as $row){
            echo "<tr>";
          echo "<td style='word-wrap:break-word;overflow-wrap:break-word;'>" . $row['text']    . "</td>";
          echo "<td style='word-wrap:break-word;overflow-wrap:break-word;'>" . $row['supplier_id']   . "</td>";
          echo "<td style='word-wrap:break-word;overflow-wrap:break-word;'><a href='../product/manageProduct.php?id=" . $row['supplier_id'] . "'>Accept</a><a style='float:right' href='?do=clearAll&noti_id=" . $row['id'] . "'>Reject</a></td>
                  </tr>";
            }
            echo '</tbody>
            </table>
            </div>
        </div>
                <div class="card-footer small text-muted" style="background-color:##F0EDED;border-top:1px solid silver"><b style="color:black;"> Updated ' . date("l\, F jS\, Y ") . ' </b></div>

          </div><br><br><hr style="border-top: 3px double rgba(12,29,0,1.00);"><br>';

        }
        /*purchase table ------------------------------------->*/
      echo '
    <div style ="overflow:auto;height:300px;width: 90%;background-color: white;" >
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver">

          <label class="fa fa-shopping-cart" style="font-size: 30px;float:left;margin:10px;"> Orders Data Table</label></div>
        <div  class="card-body">
          <div class="table-responsive">
          <table style="border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
             <tr>
                <th >purch_No </th>
                <th >Netfees</th>
                <th >Discount</th>
                <th >Total</th>
                <th >User ID</th>
                <th >Date</th>
                <th >completed</th>
             </tr>
      </thead>';
      
        echo "<tbody>";
          foreach($purchaseData as $row){
            echo "<tr>";
          echo "<td>" .  $row['purch_no']  .  "</td>";
          echo "<td>" .  $row['netfees']   .  "</td>";
          echo "<td>" .  $row['discount']  .  "</td>";
          echo "<td>" .  $row['total']     .  "</td>";
          if($row['complete'] == '1'){ echo "<td>" . $row['UserID'] . "</td>";}
          else {echo "<td><a style='color:blue;' href='purchaseShippingPage.php?id=" . $row['UserID'] . "'>" .  $row['UserID'] .  "</a>";
          echo "</td>";}
          echo "<td>" .  $row['date']      .  "</td>";
          echo "<td>" .  $row['complete']      .  "</td> 
                  </tr>";
          }
            echo '</tbody>
            </table>
            </div>
        </div>
                <div class="card-footer small text-muted" style="background-color:##F0EDED;border-top:1px solid silver"><b style="color:black;"> Updated ' . date("l\, F jS\, Y ") . ' </b></div>

          </div><br><br><hr style="border-top: 3px double rgba(12,29,0,1.00);"><br>';
          /* feedBack table ->>>>>>>>>>>>>>>>>>>>*/

           echo '
         <div style ="overflow:auto;height:300px;width: 90%;" 
                      class="card mb-3">
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver">
          <label class="fa fa-comments" style="font-size: 30px;float:left;margin:10px;"> FeedBack Data Table</label></div>
        <div  class="card-body">
          <div class="table-responsive">
        <table style="border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
             <tr>
                <th >Feedback_no </th>
                <th >Feedback_text</th>
                <th >UserId</th>
                <th >Email_fd</th>
                <th >Date_fd</th>
              </tr></thead>';
              echo "<tbody>";
          foreach($feedbackData as $row){
            echo "<tr>";
          echo "<td>" .  $row['feedback_no']    .  "</td>";
          echo "<td>" .  $row['feedback_text']  .  "</td>";
          echo "<td>" .  $row['userID']         .  "</td>";
          echo "<td>" .  $row['email_FB']       .  "</td>";
          echo "<td>" .  $row['date_FB']        .  "</td>
                  </tr>";
             }
  
         echo '</tbody>
            </table>
            </div>
        </div>
                <div class="card-footer small text-muted" style="background-color:##F0EDED;border-top:1px solid silver"><b style="color:black;"> Updated ' . date("l\, F jS\, Y ") . ' </b></div>

          </div><br><br></center>';

        /* supervisor data ------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
        
      
     
    ?>
   
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