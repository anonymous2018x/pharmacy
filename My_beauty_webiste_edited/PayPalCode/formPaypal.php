<?php


session_start();

if(isset($_SESSION['username'])){
     if($_SESSION['status'] == 'user' && isset($_POST['total'])){
       $id                      = $_SESSION['ID'];
       $username                = $_SESSION['username'];
       $name                    = $_SESSION['full_name'];
       }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
    else{header("location: ../homepage.php");}
       
   }else{header("location: login.php");}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $total_price = $_POST['total'];
      $discount    = $_POST['discount'];
      $taxes       = $_POST['taxes'];
      $_SESSION['total_price'] = $total_price;
      $_SESSION['discount'] = $discount; 
      $_SESSION['taxes'] = $taxes;
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form id="paypalForm" name="paypalForm" method="POST" action="paypal.php">
<input type="hidden" name="id" value="123">
<input type="hidden" name="CatDescription" value="Donation to bla bla">
<input type="hidden" name="payment" value="<?php echo $total_price; ?>">  
<input type="hidden" name="key" value="<?php echo md5(date("Y-m-d:").rand()); ?>">
<input type="hidden" value="<?php echo $total_price; ?>" name="total">

    <input type="hidden" value="<?php echo $discount; ?>" name="discount">

  <input type="hidden" value="<?php echo $taxes; ?>" name="taxes">

</form>
</body>
<script>document.getElementById('paypalForm').submit();</script>

</html>