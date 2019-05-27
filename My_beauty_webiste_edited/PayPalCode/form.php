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
       
   }else{header("location: ../login.php");}
	
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	   $type        = $_POST['optradio'];
         $total_price = $_POST['total'];
         $discount    = $_POST['discount'];
         $taxes       = $_POST['taxes'];

      include_once 'payment.php';

      if($type =="Paypal"){
        $payment = new payByPaypal();
      }else if($type =="Cash On Delivery"){
        $payment = new payByCash();
      }else if($type =="CreditCard"){
        $payment = new payByCC();
      }
     

      $link = $payment->pay($_POST['total']);

      
   }
     

    
     


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body onload="document.forms['member_signup'].submit()">
 	<div>
 <form  id="lol" action="<?php echo $link ?>" method="post" name="member_signup">

 <input type="hidden" value="<?php echo $total_price; ?>" name="total">

    <input type="hidden" value="<?php echo $discount; ?>" name="discount">

  <input type="hidden" value="<?php echo $taxes; ?>" name="taxes">

                           
                                    
</form>
</div>
<script>document.getElementById('lol').submit();</script>

 </body>
 </html>
