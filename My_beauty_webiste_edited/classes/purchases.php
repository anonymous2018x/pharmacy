
<?php

			spl_autoload_register(function ($class){
				    	include $class . ".php";
				    });
class purchases
{
	public $db;

  public function __construct(){
  	$this->db = DataBase::getInstance();
  }	

  public function viewPurchaseDetails(){
        
       return $this->db->getRows("SELECT * from purchase", []);

	}
}


?>
