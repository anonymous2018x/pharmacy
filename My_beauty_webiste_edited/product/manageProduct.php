<?php
    
        session_start();
        require_once "../observerClass.php";
        
        spl_autoload_register(function ($class){
        include "../classes/" . $class . ".php";
        });
        $supervisorData;
        $supervisor   = new supervisor();
        $db           = DataBase::getInstance();
       


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
        header("location: ../login.php");
		  }    
        $idNotFound  =                                                                                                   "";
        $showme      =                                                                                                   "";
        $Product_no  = $No_in_stock  = $Product_name  = $Supplier  = $Category_number  = $Product_price  =               "";
        $count       = 0;
        $data        = $supervisor->viewAllProducts();
        $array       = $supervisor->getRow("SELECT * from notification", []);
        
        /*objects for observers*/
        $observerObject = new PatternObserver();
        $subjectObject  = new PatternSubject();
        $subjectObject->setObservers();
        $subjectObject->attach($observerObject);




        if($_SERVER['REQUEST_METHOD'] == 'POST'){


  //---------------------for Deleting Product-------------------------//

if(isset($_POST['delete']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
      $id   = $_POST['id'];
      if($db->getRowCount("SELECT * FROM product WHERE product_no =?",[$id]) > 0){
        $result = $supervisor->deleteProduct($id);
        if($result){echo "<script>alert('completed succssfully ')</script>";Header('Location: '.$_SERVER['PHP_SELF']);}
          else{$idNotFound = "* this product is under proccessing and can't be deleted!";}
      } else {
        $idNotFound = "* This id is incorrect";
      }
   }
}

  //---------------------for Adding new Product-------------------------//
  if(isset($_POST['addProduct']) && $_SERVER['REQUEST_METHOD'] == 'POST'){

      

      if (empty($_POST["Num_in_stock"])) {
        $No_in_stocko = "* this field is required";
      }elseif($_POST["Num_in_stock"] < 0){$No_in_stocko = "* this number is incorrect";}else{$No_in_stock    = $_POST['Num_in_stock'];$count++;}
      //----------------------------------------------//
      if (empty($_POST["name"])) {
        $Product_nameo = "* this field is required";
      }else{$Product_name   = $_POST['name'];$count++;}
      //----------------------------------------------//
      if (empty($_POST["price"])) {
        $Product_priceo = "* this field is required";
      }elseif($_POST["price"] < 0){$Product_priceo = "* this number is incorrect";}else{$product_price    = $_POST['price'];$count++;}
      //----------------------------------------------//
      if (empty($_POST["numOfsupplier"])) {
        $Suppliero = "* this field is required";
      }else{$Supplier = $_POST['numOfsupplier'];$count++;}
      //---------------------------------------------//
      if (empty($_POST["CCategory_numbero"])) {
        $Category_numbero = "* this field is required";
      }else{
            if($_POST["CCategory_numbero"] == 'skin care'){
            $Category_number = 1;
           }elseif($_POST["CCategory_numbero"] == 'hair care'){
            $Category_number = 2;
           }elseif($_POST["CCategory_numbero"] == 'dental care'){
            $Category_number = 3;
           }elseif($_POST["CCategory_numbero"] == 'medical care'){
            $Category_number = 4;
           }elseif($_POST["CCategory_numbero"] == 'baby care'){
            $Category_number = 5;
           }elseif($_POST["CCategory_numbero"] == 'men care'){
            $Category_number = 6;
           }
           $count++;
        }

      $product_description = $_POST['product_description'];

      $target      = "../themes/images/products/". basename($_FILES['image']['name']);
      $product_img = "themes/images/products/" . $_FILES['image']['name']; 
    }

      if($count == 5){
      $result = $supervisor->addProducts($product_description,$product_img,$No_in_stock,$Product_name,$product_price,$Supplier,$Category_number);
       if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
          $msg = true;
        }else{
          $msg = false;
        }
      if($result && $msg){ echo "<script>alert('completed succssfully ')</script>";Header('Location: ../supervisor/supervisorControlPage.php');
      }else{echo "<script>alert('Sorry Faild :( ')</script>";}
    }

    if(isset($_GET['id'])){
      $db->deleteRow("DELETE from notification where supplier_id=?",[$_GET['id']]);
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Manage Product</title>
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
    input[type='file'] {
  opacity:0    
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
    <a class="brand" href="../supervisor/supervisorControlPage.php"><img width="193px" height="47" src="../themes/images/logo.png" alt="Bootsshop"/></a>
    <ul id="topMenu" class="nav pull-right">
         <li class=""><a href="../supervisor/supervisorControlPage.php">DashBoard</a></li>
    <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Product Details</a>
        <div class="dropdown-content">
			<a href="../supervisor/supervisorControlPage.php?do=skinCare">Skin Care</a>
			<a href="../supervisor/supervisorControlPage.php?do=menCare">Men Care </a>
			<a href="../supervisor/supervisorControlPage.php?do=dentalCare">Dental Care </a>
			<a href="../supervisor/supervisorControlPage.php?do=hairCare">Hair Care </a>
			<a href="../supervisor/supervisorControlPage.php?do=intimateCare">Intimiate Care </a>
		</div>
	 </li>
	 <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Product Rating</a>
        <div class="dropdown-content">
			<a href="../supervisor/supervisorControlPage.php?do=RskinCare">Skin Care</a>
			<a href="../supervisor/supervisorControlPage.php?do=RmenCare">Men Care </a>
			<a href="../supervisor/supervisorControlPage.php?do=RdentalCare">Dental Care </a>
			<a href="../supervisor/supervisorControlPage.php?do=RhairCare">Hair Care </a>
			<a href="../supervisor/supervisorControlPage.php?do=RintimiateCare">Intimiate Care </a>
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
                    <div class="seeAll"><a style="padding-right: 100px;" href="../supervisor/supervisorControlPage.php?do=seeAll">See All </a><a href="?do=clear">Clear All</a></div>
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
if(isset($_GET["id"]))
    {   
       $Supplier_Data = $db->getRows("SELECT ID,Full_name,email,username,address,phone_number from supplier where id=?",[$_GET["id"]]);
    }

    if(isset($Supplier_Data)){
  echo '<center>  <div style ="overflow:auto;height:300px;width: 90%;background-color: white;
                            border-bottom-left-radius: 25px;
                            border-bottom-right-radius: 25px;
                            border-top-left-radius: 25px;
                            border-top-right-radius: 25px;" >
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver;">

          <label class="fa fa-cube" style="float:left;margin:10px;font-size: 30px;"> Product Data Table o</label></div>
        <div  class="card-body">
          <div class="table-responsive">
          <table style="border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
    <tr>
      <td >ID </td>
      <td >Name</td>
      <td >Email</td>
      <td >Username</td>
      <td >Address</td>
      <td >phone_number</td>
    </tr>
</thead>
<tbody>';
  
      foreach($Supplier_Data as $row)
      {
        echo "<tr>";
          echo "<td>" .  $row['ID'] .  "</td>";
          echo "<td>" .  $row['Full_name']  .  "</td>";
          echo "<td>" .  $row['email'] .  "</td>";
          echo "<td>" .  $row['username']    .  "</td>";
          echo "<td>" .  $row['address']     .  "</td>"; 
          echo "<td>" .  $row['phone_number']     .  "</td>
         </tr>" ; 
        
      }
  
 echo ' </tbody>
            </table>
            </div>
        </div>
                

          </div><hr style="border-top: 3px double rgba(12,29,0,1.00);"><br><br><br><br>
        </center>';
      }
        ?>

<form method="POST" action="manageProduct.php" enctype="multipart/form-data">
    <center>
    <div class="row">
      <br><br>
      <h2>New Product</h2>
<br><br>

        <input type="number" placeholder="no_in_Stock" name="Num_in_stock" /  required>


        <input type="text" placeholder="product_name" name="name" /  required>

        

        <input type="number" placeholder="product_Price" name="price" /  required>



        <?php
          $query = $db->getRows("SELECT ID FROM supplier",[]);
          echo '<select name="numOfsupplier" required>';
                       echo '<option value="" selected disabled hidden>Choose supplier ID</option>';
          foreach ($query as $row) {
             echo '<option value="'.$row['ID'].'">'.$row['ID'].'</option>';
          }
          echo '</select>';
          ?>

        <?php
          $query = $db->getRows("SELECT category_name FROM category",[]);
          echo '<select name="CCategory_numbero" required>';
                       echo '<option value="" selected disabled hidden>Choose the Category Name</option>';
          foreach ($query as $row) {
             echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
          }
          echo '</select>';

          if(isset($_GET['do']) && $_GET['do'] == 'clear'){ $db->deleteRow("DELETE from notification",[]);}
          ?>


          <div>

    <input type="file" name="image">
    <h4><span style="cursor: pointer;" id='button'>Select File</span><h4>
          <span id='val'></span>

         </div>
         <br>
                             <textarea style="width:53%;height: 100px;" name="product_description" placeholder="Product description" required></textarea>



      <br><br>
      <button name="addProduct" style="width:150px;height:50px;border-bottom-left-radius: 25px;
                            border-bottom-right-radius: 25px;
                            border-top-left-radius: 25px;
                            border-top-right-radius: 25px;"" type="submit">Add Product</button>
    </div>
  </center>
  </form>
<br>
<hr style="border-top: 3px double rgba(12,29,0,1.00);">
<br>
<br>
<center>  <div style ="overflow:auto;height:300px;width: 90%;background-color: white;
                            border-bottom-left-radius: 25px;
                            border-bottom-right-radius: 25px;
                            border-top-left-radius: 25px;
                            border-top-right-radius: 25px;" >
        <div class="card-header" style="height: 55px;background-color:#F0EDED;border:1px solid silver;">

          <label class="fa fa-cube" style="float:left;margin:10px;font-size: 30px;"> Product Data Table o</label></div>
        <div  class="card-body">
          <div class="table-responsive">
          <table style="border: 3px double rgba(12,29,0,1.00);" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
    <tr style="background-color: #272727;color: white;">
      <td >Product_Number </td>
      <td >No_In_Stock</td>
      <td >Product_Name</td>
      <td >Supplier</td>
      <td >Category_Number</td>
    </tr>
</thead>
<tbody>
  <?php
      foreach($data as $row)
      {
        echo "<tr>";
          echo "<td>" .  $row['product_no'] .  "</td>";
          echo "<td>" .  $row['no_in_stock']  .  "</td>";
          echo "<td>" .  $row['product_name'] .  "</td>";
          echo "<td>" .  $row['supplier']    .  "</td>";
          echo "<td>" .  $row['category_number']     .  "</td>"; 
         "</tr>" ; 
        
      }
  ?>
  </tbody>
            </table>
            </div>
        </div>
                

          </div><br><br><hr style="border-top: 3px double rgba(12,29,0,1.00);"><br><br><br><br>
        </center>
  <form method="POST" action="">
    <center>
    <h2>ID To Delete : </h2><br>
    <input type="number" placeholder="Product_ID" name="id" required> 
                         <h5 style="color:red;padding-left: 170px;"><?php echo $idNotFound; ?></h5>
    <button name="delete" style="width:150px;height:50px;border-bottom-left-radius: 25px;
                            border-bottom-right-radius: 25px;
                            border-top-left-radius: 25px;
                            border-top-right-radius: 25px;"" type="submit">Delete</button>
    <br><br>


</center>
  </form>
  <br><br><hr style="border-top: 3px double rgba(12,29,0,1.00);"><br><br><br><br>


<br>
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
<script type="text/javascript">
  $('#button').click(function(){
   $("input[type='file']").trigger('click');
})

$("input[type='file']").change(function(){
   $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
})   
</script>
</body>
</html>