

<?php 

        spl_autoload_register(function ($class){
	    	include $class . ".php";
	    });
	     
    	 

	class classAdmin{

			public $purchaseObject;
			public $feedbackObject;
			public $db;
			 



		public function __construct(){

	        $this->purchaseObject = new purchases();   
	        $this->feedbackObject = new feedback();
	        $this->db             = DataBase::getInstance();
        }
		public function supplier_registration($table_name,$S_id, $S_fullname, $S_email, $S_userName, $S_pass, $S_add, $S_phone){

			$sql = $this->db->insertRow("INSERT INTO $table_name values(?,?,?,?,?,?,?,?)",[$S_id,$S_fullname,$S_email,$S_userName,$S_pass,$S_add,$S_phone,NULL]);
			return $sql;
		}

		public function showTable($table_name){		

			return $this->db->getRows("SELECT * FROM $table_name",[]);
		}

		public function Delete_Supplier($table_name,$id){
			if($table_name == 'supplier')
                   {$count = $this->db->getRowCount("SELECT product_no from product where supplier=?",[$id]);
                     if($count > 0){

                     	return false;
                     }
                    }
        	$sql =  $this->db->deleteRow("DELETE FROM $table_name WHERE $table_name.`ID` =?",[$id]);
			
			return $sql;
		}

		public function setYear($y){

        	$this->db->getRows("UPDATE `additions` SET `year` =? WHERE `additions`.`id` =?",[$y,'1']);
		}


		public function viewFeedbackDetails(){

		   $feedbackObject = new feedback();
		   return $feedbackObject->viewFeedbackDetails();
	   }

	    public function viewPurchaseDetails(){ 

		   $purchasesObject = new purchases();
		   return $purchasesObject->viewPurchaseDetails(); 
	   }


}
	



	
