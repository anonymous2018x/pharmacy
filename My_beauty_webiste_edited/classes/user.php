<?php


   
        spl_autoload_register(function ($class){
        include $class . ".php";
      });

class user{

 public $userID       ;
 public $userFullName ;
 public $userAge      ;
 public $userEmail    ;
 public $userName     ;
 public $userPassword ;
 public $userAddress  ;
 public $userGender   ;
 public $userPhone    ;
 public $db;



   public function __construct(){

              $this->db = Database::getInstance();
     }

   function viewUserProfile($id){

	     return $this->db->getRows("SELECT ID,user_picture,full_name,
                               birthdate, 
                               email, 
                               username,
                               password,
                               gender,
                               address,
                               phone_number
                             FROM users where ID =?", [$id]);
     }



   function viewUserPurchases($id){

   	   return $this->db->getRows("SELECT *
                             FROM purchase where UserID =? && complete = 0", [$id]);
     }

  function rateProduct($product_id,$rate,$user_id){

       return $this->db->insertRow("INSERT into rating_product values (NULL,?,?,?)",[$product_id,$rate,$user_id]);
     }
  function addToCart($user_id,$product_id,$product_price,$product_qty){
       
       $count_in_cart = $this->db->getRowCount("SELECT pro_id from userproduct where user_id=? and pro_id=?",[$user_id,$product_id]);
       if($count_in_cart > 0){
        $show = $this->db->updateRow("UPDATE `userproduct` SET `qty` = qty + ? WHERE user_id=? and pro_id =? && qty < 20",[$product_qty,$user_id,$product_id]);
       }else{
       $show  = $this->db->insertRow("INSERT into userproduct values (NULL,?,?,?,?)",[$user_id,$product_id,$product_price,$product_qty]);}

       return $show;
     }

  function editaccountinformation($email,$password,$user_id){
    
     $this->db->updateRow("UPDATE `users` SET `email` =? , `password` =? WHERE `users`.`ID` =?",[$email,$password,$user_id]);
     return true;
  }

  function editpersonalinformation($name,$phone,$address,$birthdate,$user_id){
    
     $this->db->updateRow("UPDATE `users` SET `full_name` =? , `phone_number` =? , `address` =? , `birthdate` =? WHERE `users`.`ID` =?",[$name,$phone,$address,$birthdate,$user_id]);
     return true;
  }

 

}

?>