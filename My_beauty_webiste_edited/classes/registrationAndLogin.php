<?php

spl_autoload_register(function ($class){
            include $class . ".php";
        });
         
class registrationAndLogin{


            public $db;


                    function __construct(){

                        $this->db = Database::getInstance();

                    }

            public function UserRegister($full_name,$email,$username,$password,$address,$phone,$date,$gender){
        	    //md5 for encrption
				$sql = $this->db->insertRow("INSERT INTO `users`(`id`, `full_name`, `birthdate`, `email`,
				       `username`, `password`, `address`, `gender`, `phone_number`) VALUES
				        (?,?,?,?,?,?,?,?,?)", ["",$full_name,$date,$email,$username,$password,$address,$gender,$phone]);
      			 if($sql){
                        return true;
                 }else{
                        return false;
                 }			 
		        }

		    public function isUserExist($username){
			$sql = $this->db->getRowCount("SELECT * FROM users WHERE username = ?", [$username]);
			if($sql > 0){
				return true;
			} else {
				return false;
			  }
            }

            public function Login($username, $password, $cookie){
            ///////////////////////////////ADMIN CHECK->>>>>>>>>>>
            if($this->db->getRowCount("SELECT admin_username, admin_password FROM admin WHERE admin_username =? and admin_password =?", [$username,$password]) > 0){
            $sql = $this->db->getRows("SELECT admin_fullName,admin_username, admin_password, id FROM admin WHERE admin_username =? and admin_password =?", [$username,$password]);
            session_start();
            foreach ($sql as $row) {
                $_SESSION['username']  = $username;
                $_SESSION['ID']        = $row['id'];
                $_SESSION['full_name'] = $row['admin_fullName'];
                if($cookie == 1){
                    setcookie("username",$username,time()+3600);
                    setcookie("password",$password,time()+3600);
                    setcookie("full_name",$row['admin_fullName'],time()+3600);
                    setcookie("id",$row['id'],time()+3600);
                    setcookie("status","admin",time()+3600);
                }

                $_SESSION['status']    = "admin";
            }
            
            return 1;}
            ///////////////////////////////SUPERVISOR CHECK->>>>>>>>>>>
            elseif($this->db->getRowCount("SELECT username, password FROM supervisor WHERE username =? and password =?", [$username,$password]) > 0){
            $sql = $this->db->getRows("SELECT Full_name,username, password, ID FROM supervisor WHERE username =? and password =?", [$username,$password]);
            session_start();
            foreach ($sql as $row) {
            $_SESSION['username']  = $username;
            $_SESSION['ID']        = $row['ID'];
            $_SESSION['full_name'] = $row['Full_name'];
            if($cookie == 1){ // 1 if the user clicked on remember me
                    setcookie("username",$username,time()+3600);
                    setcookie("password",$password,time()+3600);
                    setcookie("full_name",$row['Full_name'],time()+3600);
                    setcookie("id",$row['ID'],time()+3600);
                    setcookie("status","supervisor",time()+3600);
                }

                $_SESSION['status']    = "supervisor";
            }
            
            return 2;}
            //////////////////////SUPPLIER CHECK->>>>>>>>>>>>>>>>>>>>>
            elseif($this->db->getRowCount("SELECT username, password FROM supplier WHERE username =? and password =?", [$username,$password]) > 0){
            $sql = $this->db->getRows("SELECT username, password,Full_name,ID FROM supplier WHERE username =? and password =?", [$username,$password]);
            session_start();
            foreach ($sql as $row) {
                $_SESSION['username']  = $username;
                $_SESSION['ID']        = $row['ID'];
                $_SESSION['full_name'] = $row['Full_name'];
                if($cookie == 1){
                    setcookie("username",$username,time()+3600);
                    setcookie("password",$password,time()+3600);
                    setcookie("full_name",$row['Full_name'],time()+3600);
                    setcookie("id"      ,$row['ID'],time()+3600);
                    setcookie("status","supplier",time()+3600);
                }

                $_SESSION['status']    = "supplier";
            }
            
            return 3;}
            //////////////////////USER CHECK->>>>>>>>>>>>>>>>>>>>>>>>>>>
            if($this->db->getRowCount("SELECT username, password FROM users WHERE username =? and password =?",[$username,$password]) > 0){
            $sql = $this->db->getRows("SELECT username, password, ID, full_name FROM users WHERE username =? and password =?",[$username,$password]);
            session_start();
            foreach ($sql as $row) {
                $_SESSION['username']  = $username;
                $_SESSION['ID']        = $row['ID'];
                $_SESSION['full_name'] = $row['full_name'];
                if($cookie == 1){
                    setcookie("username",$username,time()+3600);
                    setcookie("password",$password,time()+3600);
                    setcookie("full_name",$row['full_name'],time()+3600);
                    setcookie("id",$row['ID'],time()+3600);
                    setcookie("status","user",time()+3600);
                }

                $_SESSION['status']    = "user";
            }
            
            
            return 4;}
			else{
				return FALSE;
			         }
				 }

            public function logout(){
                session_start();
                unset($_COOKIE['username']);
                unset($_COOKIE['password']);
                unset($_COOKIE['full_name']);
                unset($_COOKIE['id']);
                unset($_COOKIE['status']);
                setcookie("username",FALSE,time()+3600);
                setcookie("password",FALSE,time()+3600);
                setcookie("full_name",FALSE,time()+3600);
                setcookie("id",FALSE,time()+3600);
                setcookie("status",FALSE,time()+3600);
                session_unset();
                session_destroy();
                $this->db->Disconnect();
                unset($this->db);
                
            }
		}

