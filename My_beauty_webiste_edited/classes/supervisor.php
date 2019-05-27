<?php

spl_autoload_register(function ($class){
        include $class . ".php";
      });

class supervisor{

	public $id;
	public $full_name;
	public $username;
	public $password;
	public $email;
	public $salary;
	public $phone;
  public $productObject;
  public $purchaseObject;
  public $feedbackObject;
  public $userObject;
  public $packageObject;
  public $db;


public function __construct()
    {   
        $this->productObject    = new product();
        $this->purchaseObject   = new purchases();   
        $this->feedbackObject   = new feedback();
        $this->userObject       = new user();
        $this->packageObject    = new purchase_Shipping();
        $this->db               = Database::getInstance();

    }
	function viewProductDetails($category_no){
       return $this->productObject->viewProductDetails($category_no);
	}
	function viewPurchaseDetails(){
	   return $this->purchaseObject->viewPurchaseDetails(); 
	}
	function viewFeedbackDetails(){
	   return $this->feedbackObject->viewFeedbackDetails();
	}
	function showRatings($category_number){
	   return $this->productObject->showRatings($category_number);
	}
    function viewUserProfile($id){
       return $this->userObject->viewUserProfile($id);
    }
    function viewUserPurchases($id){
       return $this->userObject->viewUserPurchases($id);
    }
    function addShippingDetails($package_distnation, $package_source, $purchase_number , $Expected_DEL, $UserID){
       return $this->packageObject->addShippingDetails($package_distnation, $package_source, $purchase_number , $Expected_DEL, $UserID);
    }
    function addProducts($product_description,$product_img,$No_in_stock,$Product_name,$product_price,$Supplier,$Category_number){
    	return $this->productObject->addProducts($product_description,$product_img,$No_in_stock,$Product_name,$product_price,$Supplier,$Category_number);
    }
    function deleteProduct($id){
    	return $this->productObject->deleteProduct($id);
    }
    
   function viewAllProducts(){
   	    return $this->productObject->viewAllProducts();
   }
   function viewOwnProfile($id){
        return $this->db->getRow("SELECT ID,Full_name,email,username,salary,phone_number from supervisor where ID =?", [$id]);
   }
   function deleteRow($query, $params = []){
        $this->db->deleteRow($query, $params);
   }
   function getRow($query, $params = []){
        return $this->db->getRows($query, $params);
   }

}


?>