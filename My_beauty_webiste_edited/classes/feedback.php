
<?php

        spl_autoload_register(function ($class){
	    	include $class . ".php";
	    });

class feedback
{
	public $db;


	public function __construct(){
		$this->db = DataBase::getInstance();
	}




 	 public function viewFeedbackDetails()
  	{
		return  $this->db->getRows("SELECT * from feedback",[]);
	}
}



