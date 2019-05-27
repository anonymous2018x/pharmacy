<?php 
include 'classAdmin.php';
    include '../DataBase/DataBase.php';


    echo"<iframe  width ='100%' height='90%' src='Graph.php'></iframe>";
    
     if($_SERVER['REQUEST_METHOD'] == "POST"){
        $year = $_POST['year'];
        $object = new classAdmin();
        $object->setYear($year);
     }

    
 ?>

<form method="POST" action="" >
	<input type = "number" name="year" placeholder="Enter Year To Show Profits" style="width:180px">
	<input type = "submit" required> 
	<a href="../adminControlPage.php">main Control</a>
</form>





 