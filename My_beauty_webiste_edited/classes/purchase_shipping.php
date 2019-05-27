<?php

    spl_autoload_register(function ($class){
            include $class . ".php";
        });

class purchase_shipping{

    public $package_number;
    public $package_destantion;
    public $package_source;
    public $purchase_number;
    public $expectedDEL;
    public $db;


    public function __construct(){
        $this->db = DataBase::getInstance();
    }


    function addShippingDetails($package_distnation, $package_source, $purchase_number , $Expected_DEL, $UserID){
				$sql = $this->db->insertRow("INSERT INTO `purchaseshipping` (`package_no`, `package_distnation`, `package_source`, `purchase_no`, `Expected_DEL`, `UserID`, `Delivered`) VALUES (?,?,?,?,?,?,?)",[NULL,$package_distnation,$package_source,$purchase_number,$Expected_DEL,$UserID, '0']);
                $this->db->updateRow("UPDATE `purchase` SET `complete` =? WHERE `purchase`.`purch_no` = $purchase_number",["1"]);
      			 
				return true;
    }




}




?>