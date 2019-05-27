<?php 


    session_start();

    if(isset($_SESSION['username'])){
     if($_SESSION['status'] == 'user' && isset($_SESSION['total_price'])){
       $id                      = $_SESSION['ID'];
       $username                = $_SESSION['username'];
       $name                    = $_SESSION['full_name'];
       }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
    else{header("location: ../homepage.php");}
       
   }else{header("location: login.php");}

    spl_autoload_register(function ($class){
            include "../classes/" . $class . ".php";
        });


        $db               = Database::getInstance();

    if(isset($_GET['process']) && $_GET['process'] == "success"){

     	$db->insertRow("INSERT INTO `purchase` (`purch_no`, `netfees` , `discount`, `total`, `UserID`, `date`, `method` , `complete`, `updated`, `old` ) VALUES (?,?,?,?,?,?,?,?,?,?)",[NULL,$_SESSION['taxes'],$_SESSION['discount'],$_SESSION['total_price'],$_SESSION['ID'],date("Y/m/d"),$_GET['method'],'0','0','0']);
     	$new_purchase = $db->getRowColumn("SELECT purch_no from purchase where UserID=? and old=0",[$_SESSION['ID']]);
                        $db->updateRow("UPDATE purchase set old=? where purch_no=?",['1',$new_purchase]);
        $usercart = $db->getRows("SELECT pro_id,qty from userproduct where user_id =?",[$_SESSION['ID']]);
        $no_in_stock = $db->getRows("SELECT no_in_stock FROM product where product_no in (select pro_id from userproduct where user_id =?)",[$_SESSION['ID']]);
        foreach ($usercart as $row){
         $db->insertRow("INSERT into purchase_product (`product_id`, `purchase_no`, `id`) values (?,?,?)",[$row['pro_id'],$new_purchase,NULL]);
        }
     	foreach ($usercart as $row) {
				  $qty = $row['qty'];
				  $pro_id = $row['pro_id'];

				  foreach ($no_in_stock as $row) {
				  	
				   $new_no = $row['no_in_stock'] - $qty;	
                   $db->updateRow("UPDATE `product` SET `no_in_stock` =? WHERE `product`.`product_no` =?",[$new_no, $pro_id]);
                   break;

				  }
     	}
        
     	$result = $db->deleteRow("DELETE from userproduct where user_id=?",[$_SESSION['ID']]);
     	$UserEmail = $db->getRowColumn("SELECT email from users where ID=?",[$_SESSION['ID']]);

             $to      = $UserEmail;
             $subject = "Order #" .$new_purchase;
             $txt     = "Your order is processing we will notify you once it is ready to deliver - Your payment method is " . $_GET['method'] ;
             $headers = "From: 24HourPharmacy@example.com" . "\r\n" .
                      "CC: tika-1996@hotmail.com";
             mail($to,$subject,$txt,$headers);
     		 header("location: ../orders.php");
     
     }elseif(isset($_GET['process']) && $_GET['process'] == "faild"){ header("location: ../homepage.php");}
     else{header("location: ../homepage.php");}

    
 ?>