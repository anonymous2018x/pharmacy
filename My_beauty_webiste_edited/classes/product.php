<?php

      spl_autoload_register(function ($class){
        include $class . ".php";
      });

class product{

	public $product_no      /*= array()*/;
	public $product_name    /*= array()*/;
	public $number_in_stock /*= array()*/;
	public $category_name   /*= array()*/;
  public $db;


  public function __construct(){
    $this->db = DataBase::getInstance();
  }

 	function viewProductDetails($category_number){
 	        $this->category_name = $category_number;
 	        if($this->category_name == 1){
              $sql = $this->db->getRows("SELECT product_no,
                            no_in_stock, product_name, supplier,price
                             FROM product where category_number =?", ["1"]);}
              elseif($this->category_name == 2){
              $sql = $this->db->getRows("SELECT product_no,
                            no_in_stock, product_name, supplier,price
                             FROM product where category_number =?", ["2"]);}
              elseif($this->category_name == 3){
              $sql = $this->db->getRows("SELECT product_no,
                            no_in_stock, product_name, supplier,price
                             FROM product where category_number =?", ["3"]);}
              elseif($this->category_name == 4){
              $sql = $this->db->getRows("SELECT product_no,
                            no_in_stock, product_name, supplier,price
                             FROM product where category_number =?", ["4"]);}
              elseif($this->category_name == 5){
              $sql = $this->db->getRows("SELECT product_no,
                            no_in_stock, product_name, supplier,price
                             FROM product where category_number =?", ["5"]);}
              elseif($this->category_name == 6){
              $sql = $this->db->getRows("SELECT product_no,
                            no_in_stock, product_name, supplier,price
                             FROM product where category_number =?", ["6"]);}
                 
				return $sql;
			} 



 



 	function showRatings($category_number){
     	 $this->category_name = $category_number;
		      if($this->category_name == 1){
              $sql = $this->db->getRows("SELECT product.product_name, AVG(rating_id) as productRating FROM product,rating_product WHERE rating_product.product_id = product.product_no AND product.category_number =? GROUP BY product.product_no ORDER BY productRating DESC", ["1"]);}
              elseif($this->category_name == 2){
              $sql = $this->db->getRows("SELECT product.product_name, AVG(rating_id) as productRating FROM product,rating_product WHERE rating_product.product_id = product.product_no AND product.category_number =? GROUP BY product.product_no ORDER BY productRating DESC", ["2"]);}
              elseif($this->category_name == 3){
              $sql = $this->db->getRows("SELECT product.product_name, AVG(rating_id) as productRating FROM product,rating_product WHERE rating_product.product_id = product.product_no AND product.category_number =? GROUP BY product.product_no ORDER BY productRating DESC", ["3"]);}
              elseif($this->category_name == 4){
              $sql = $this->db->getRows("SELECT product.product_name, AVG(rating_id) as productRating FROM product,rating_product WHERE rating_product.product_id = product.product_no AND product.category_number =? GROUP BY product.product_no ORDER BY productRating DESC", ["4"]);}
              elseif($this->category_name == 5){
              $sql = $this->db->getRows("SELECT product.product_name, AVG(rating_id) as productRating FROM product,rating_product WHERE rating_product.product_id = product.product_no AND product.category_number =? GROUP BY product.product_no ORDER BY productRating DESC", ["5"]);}
              elseif($this->category_name == 6){
              $sql = $this->db->getRows("SELECT product.product_name, AVG(rating_id) as productRating FROM product,rating_product WHERE rating_product.product_id = product.product_no AND product.category_number =? GROUP BY product.product_no ORDER BY productRating DESC", ["6"]);}
              	return $sql;
 	}


  function addProducts($product_description,$product_img,$No_in_stock,$Product_name,$product_price,$Supplier,$Category_number){
     
                $ins = $this->db->insertRow("INSERT INTO `product` (`product_no`, `product_img` , `product_img1` , `product_img2` , `product_img3` , `product_describtion` ,`no_in_stock`, `product_name`, `price`,  `tax`, `discount`,`supplier`, `category_number`, `updated`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);", [NULL,$product_img,$product_img,$product_img,$product_img,$product_description,$No_in_stock,$Product_name,$product_price,NULL,NULL,$Supplier,$Category_number,"0"]);
             
        return $ins;}
  

 function viewAllProducts(){

   return $this->db->getRows("SELECT * from product", []);

  }


  function deleteProduct($id){
    $check = 0;
    $sql = $this->db->getRows("SELECT purchase_no,complete from purchase_product,purchase where purchase_no = purch_no and product_id =? and complete IN (?, ?)", [$id,"1","0"]);
    $sql1 = $this->db->getRowCount("SELECT purchase_no,complete from purchase_product,purchase where purchase_no = purch_no and product_id =? and complete IN (?, ?)",[$id,"1","0"]);
    if($sql1 == 0){$check = 1;}
    else{
    foreach ($sql as $row) {
      if($row['complete'] == 1){
        $check = 1;
      }elseif($row['complete'] == 0){$check = 0;break;}      
    } 
  }

  if($check == 1){    $this->db->deleteRow("DELETE FROM `purchase_product` WHERE `purchase_product`.`product_id`   =?",[$id]);
                        $this->db->deleteRow("DELETE FROM `rating_product`   WHERE `rating_product`.`product_id`   =?",[$id]);
                        $this->db->deleteRow("DELETE FROM `product` WHERE `product`.`product_no`                   =?",[$id]);
                        return true;}
    else return false;

  }


  
  }


