<?php

spl_autoload_register(function ($class){
        include $class . ".php";
        });


class supplier{

    public $db;
    public $columnChart;
    public $pieChart;

    function __construct(){

    	$this->db          = Database::getInstance();

    	

    }

	function showproductProfit($jsonEncodedData){
         

       $this->columnChart = new FusionCharts("column3d", "myFirstChart" , 500, 300, "chart-1", "json", $jsonEncodedData);
       $this->pieChart    = new FusionCharts("pie3d","mySecoundChart" , 500, 300, "chart-2", "json", $jsonEncodedData);  
       $arrayName = array($this->columnChart->render(),$this->pieChart->render());
       return $arrayName;
	}

	function showsupplierProducts($id){

	   return $this->db->getRows("SELECT product_name,no_in_stock from product where supplier=?",[$id]);
	}

	function viewFeedbackDetails($id){

		   
	   return $this->db->getRows("SELECT product.product_name, AVG(rating_id) as productRating FROM product,rating_product WHERE rating_product.product_id = product.product_no AND product.supplier =? GROUP BY product.product_no ORDER BY productRating DESC",[$id]);
	}

	function viewSupplierProfile($id){

	     return $this->db->getRows("SELECT ID,Full_name,
                               email, 
                               username,
                               password,
                               address,
                               phone_number
                             FROM supplier where ID =?", [$id]);
    }

    function editpersonalinformation($email,$password,$name,$phone,$address,$supplier_id){
    
     $this->db->updateRow("UPDATE `supplier` SET `email` =? , `password` =? , `Full_name` =? , `phone_number` =? , `address` =?  WHERE `supplier`.`ID` =?",[$email,$password,$name,$phone,$address,$supplier_id]);
     return true;
    }

}