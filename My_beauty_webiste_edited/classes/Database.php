<?php 

class Database{

    public         $host    = "localhost";
    public         $user    = "root";
    public         $pass    = "root";
    public         $db      = "abdelrahman";
    public         $options = [];
    public         $isConn;
    public         $datab;
    private static $instance;
    
    // connect to db
    public function __construct(){
        $this->isConn = TRUE;
        try{
        $this->datab = new pdo("mysql:host={$this->host};dbname={$this->db};charset=utf8",$this->user,$this->pass,$this->options);
        $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
    catch(PDOException $e){
        echo "not connected :" . $e->getMessage();
        } 
        
    }
    // disconnect from db
    public function Disconnect(){
        $this->datab = NULL;
        $this->isConn = FALSE;
    }
    // get row
    public function getRow($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function getRowAssoc($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function getRowColumn($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function getRowCount($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    //this function makes sure there's only 1 instance of the Database class
    public static function getInstance(){
    if(!isset(Database::$instance)){
        Database::$instance = new Database();
    }
            return Database::$instance;     
    }
    // get rows
    public function getRows($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // insert row
    public function insertRow($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            return FALSE;
        }
    }
    // update row
    public function updateRow($query, $params = []){
        $this->insertRow($query, $params);
    }
    // delete row
    public function deleteRow($query, $params = []){
        $this->insertRow($query, $params);
    }
}

?>