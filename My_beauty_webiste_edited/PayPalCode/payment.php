<?php 



 
 if(!empty($type))
 {
interface payStrategy {
    public function pay($amount);
}
 
class payByCC implements payStrategy {
     
     
    public function pay($amount = 0) {
        
        return "credtCard.php";
    }
     
}

class payByPaypal implements payStrategy {
     
     
    public function pay($amount = 0) {

       return "formPaypal.php";
        
    }
     
}
 

class payByCash implements payStrategy {
      
    public function pay($amount = 0) {

        return "cashondel.php";
    }
 
}


class shoppingCart {
         
    public $amount = 0;
     
    public function __construct($amount = 0) {
        $this->amount = $amount;
    }
     
    public function getAmount() {
        return $this->amount;
    }
     
    public function setAmount($amount = 0) {
        $this->amount = $amount;
    }
 
    
}



 


}

  ?>


        




 

 