<?php 
    
    spl_autoload_register(function ($class){
            include "../classes/" . $class . ".php";
        });

    $object = new classAdmin();
    $array = $object->showTable("supplier");
    $array2 = $object->showTable("supervisor");
    $numberOFRow = count($array);
    $numberOFRow2 = count($array2);
 ?>
<?php

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $check=0;
        $tt=false;
        if(isset($_POST['submit2'])){
            $id2 = $_POST["D_ID"];
                if($id2>0){
                    if($numberOFRow){
                        foreach ($array as $value) {
                        if($value['ID']==$id2){
                            $tt = $object->Delete_Supplier("supplier",$id2);
                             $check = 1;
                            break;
                        }

  
                    }
                    }
                    
                    if($check==0){
                        echo "<script>alert('Input Not Found')</script>";
                        header("Refresh:0; url=adminManage.php");}
                        
                if($tt){
                    
                    header("Refresh:0; url=adminManage.php");
                }
            }
            else {echo "<script>alert('Faild Input')</script>"; header("Refresh:0; url=adminManage.php");}
        }
                
    }

   if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['submit1'])){
                    $register = new classAdmin();
                    $id = $_POST["ID"];
                    $fullName = $_POST["FullName"];
                    $emial = $_POST["Email"];
                    $userName= $_POST["username"];
                    $pass = $_POST["password"];
                    $add = $_POST["address"];
                    $phone_number = $_POST["phone"];
                    $ch=$register->supplier_registration("supplier",$id,$fullName,$emial,$userName,$pass,$add,$phone_number);
                    if($ch)
                    {
                        echo "<script>alert('Registration is completed succssfully ')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                    else{
                        echo "<script>alert('Dont Dublicate Primary ID OR Any Unique')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                    }   
            
             }
             ////////////////////////////////888888888888888888888888888888888888888888888888888/////////////
              if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $check=0;
        $tt=false;
        if(isset($_POST['submit4'])){
            $id2 = $_POST["D_ID0"];
                if($id2>0){
                    if($numberOFRow2){
                        foreach ($array2 as $value) {
                        if($value['ID']==$id2){

                            $tt = $object->Delete_Supplier("supervisor",$id2);
                             $check = 1;
                            break;
                        }

  
                    }
                    }
                    
                    if($check==0){
                        echo "<script>alert('Input Not Found2')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                        
                if($tt){
                    
                    header("Refresh:0; url=adminManage.php");
                }
            }
            else {
                echo "<script>alert('Faild Input2')</script>";
                header("Refresh:0; url=adminManage.php");
            }
        }
                
    }

   if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['submit3'])){
                    $register = new classAdmin();
                    $id = $_POST["ID0"];
                    $fullName = $_POST["FullName0"];
                    $emial = $_POST["Email0"];
                    $userName= $_POST["username0"];
                    $pass = $_POST["password0"];
                    $add = $_POST["address0"];
                    $phone_number = $_POST["phone0"];
                    $ch=$register->supplier_registration("supervisor",$id,$fullName,$emial,$userName,$pass,$add,$phone_number);
                    if($ch)
                    {
                        echo "<script>alert('Registration is completed succssfully ')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                    else{
                        echo "<script>alert('Dont Dublicate Primary ID OR Any Unique')</script>";
                        header("Refresh:0; url=adminManage.php");
                    }
                    }   
            
             }
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>AdminManager</title>
<style type="text/css">
body{
    margin: 0px;
    padding: 0px;
    background-color:#B0C4DE;
}
input[type=text],[type=email],[type=number],[type=password] {
    width:175px;
    padding: 7px 20px;
    margin: 0px 0px;
    box-sizing: border-box;
    border: 2px solid gray;
    border-radius: 10px;
}

div .valiationStyle{
    display:inline-block;
    width:179px;
    font-size: 13px;
    color: red;
    
}
    table{
        width: 90%;
        margin: 20px 0px;
     background-color: #fff;
    display: inline-table;
    margin-top:0px;
    border-radius: 3px;

        
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 5px;
        text-align: left;
    }
    h1{
        text-align: center;
        color:#fff;
        background-color: gray;
        margin: 0px;
    }

     .part{
        width:98.5%;
        min-height: 150px;
        display: inline-block;
        background-color:#B0C4DE;
        padding: 10px;
    }
    .button {
  display: inline-block;
  padding: 7px 10px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;

 
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  
}
hr.fancy-line { 
    border: 3; 
    margin-right: 20px;
    height: 3px; 
    background-image: -webkit-linear-gradient(left, red, blue, gray); 
    background-image: -moz-linear-gradient(left, green, red, yellow); 
    background-image: -ms-linear-gradient(left, gray, red, blue; 
    background-image: -o-linear-gradient(left, blue, yellow, red; 
    box-shadow: 0px -2px 4px rgba(136,136,136,0.75);
}

</style>

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
</head>
<body>
    <h1><a class="fa fa-arrow-left" style="float: left;text-decoration: none;color: white" href="adminControlPage.php">Back to the DashBoard</a>Admin Control</h1>

    <div class="part">
        
        <form  name="myForm"   id="myForm"   method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
 
        <input type="number"   id="id"       placeholder="ID"         name="ID">
        <input type="text"     id="name"     placeholder="FullName"   name="FullName">
        <input type="email"    id="email"    placeholder="Email"      name="Email">
        <input type="text"     id="username" placeholder="username"   name="username"> 
        <input type="password" id="password" placeholder="password"   name="password">
        <input type="text"     id="address"  placeholder="address"    name="address">
        <input type="number"   id="phone"    placeholder="phone"      name="phone">

        <input type="button" class="button"   value="Add Supplier" onclick="validation()"  />
  
        <input type="hidden" name="submit1" value="" >
        </form>

        
        <div id="y1" class="valiationStyle" ></div>
        <div id="y2" class="valiationStyle"></div>
        <div id="y3" class="valiationStyle"></div>
        <div id="y4" class="valiationStyle"></div>
        <div id="y5" class="valiationStyle"></div>
        <div id="y6" class="valiationStyle"></div>
        <div id="y7" class="valiationStyle"></div>
       
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full_name</th>
                <th>Email</th>
                <th>UserName</th>
                <th>password</th>
                <th>address</th>
                <th>pnone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($numberOFRow>0)
            {
                    foreach ($array as $value) {
                    echo " <tr>
                               <td>".$value['ID']           ."</td>
                               <td>".$value['Full_name']    ."</td>
                               <td>".$value['email']        ."</td>
                               <td>".$value['username']     ."</td>
                               <td>".$value['password']     ."</td>
                               <td>".$value['address']      ."</td>
                               <td>".$value['phone_number'] ."</td>
                           </tr>

                        ";
                }
            }
                
             ?>

        </tbody>
    </table>
    <div style="float:Right; margin-right:9px; margin-top:20px;">
         <form name="myForm2" id="myForm2" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
         <input type="number" placeholder="Enter ID"   name="D_ID" style="width:110px; "><br />
         <input type = "submit" class="button" value="Delete" name="submit2" style="width:110px;margin-top:10px">

    </form>

    </div>
     
     
</div>
<hr class="fancy-line"></hr>
     <!-- tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt !-->
     <div class="part">
     <form name="myForm3" id="myForm3" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="number"   id="id0"       placeholder="ID"         name="ID0">
        <input type="text"     id="name0"     placeholder="FullName"   name="FullName0">
        <input type="email"    id="email0"    placeholder="Email"      name="Email0">
        <input type="text"     id="username0" placeholder="username"   name="username0"> 
        <input type="password" id="password0" placeholder="password"   name="password0">
        <input type="number"   id="address0"  placeholder="Salary"     name="address0">
        <input type="number"   id="phone0"    placeholder="phone"      name="phone0">

        <input type="button" class="button"   value="Add Supervis" onclick="validation2()"  />
        <input type="hidden" name="submit3" value="" >
        </form>

        
        <div id="y10" class="valiationStyle"></div>
        <div id="y20" class="valiationStyle"></div>
        <div id="y30" class="valiationStyle"></div>
        <div id="y40" class="valiationStyle"></div>
        <div id="y50" class="valiationStyle"></div>
        <div id="y60" class="valiationStyle"></div>
        <div id="y70" class="valiationStyle"></div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full_name</th>
                <th>Email</th>
                <th>UserName</th>
                <th>password</th>
                <th>Salary</th>
                <th>pnone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($numberOFRow2>0)
            {
                    foreach ($array2 as $value) {
                    echo " <tr>
                               <td>".$value['ID']           ."</td>
                               <td>".$value['Full_name']    ."</td>
                               <td>".$value['email']        ."</td>
                               <td>".$value['username']     ."</td>
                               <td>".$value['password']     ."</td>
                               <td>".$value['salary']      ."</td>
                               <td>".$value['phone_number'] ."</td>
                           </tr>

                        ";
                }
            }
                
             ?>

        </tbody>
    </table>
    <div style="float:Right; margin-right:9px; margin-top:20px;">
         <form name="myForm4" id="myForm4" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
         <input type="number" placeholder="Enter ID"   name="D_ID0" style="width:110px; "><br />
         <input type = "submit" class="button" value="Delete Row" name="submit4" style="width:110px;margin-top:10px">

    </form>

    </div>
     
    </div>
   
    





</body> 
</html>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
count=0;
 
 function validation() 
 {
    
count=0;
     var x1,x2,x3,x4,x5,x6,x7,text;
     

    // Get the value of the input field with id="numb"
    x1 = document.getElementById("id").value;
    x2 = document.getElementById("name").value;
    x3 = document.getElementById("email").value;
    x4 = document.getElementById("username").value;
    x5 = document.getElementById("password").value;
    x6 = document.getElementById("address").value;
    x7 = document.getElementById("phone").value;

    // If x is Not a Number or less than one or greater than 10
    if (isNaN(x1) || x1 < 1) {
        text = "*ID Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y1").innerHTML = text;

    if (x2.length < 1  || !isNaN(x2)) {
        text = "*FullName Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y2").innerHTML = text;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(x3)) {
        text = "*Email Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y3").innerHTML = text;

    if (x4.length < 1 || !isNaN(x4)) {
        text = "*UserName Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y4").innerHTML = text;

    if (x5.length < 5) {
        text = "*Password Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y5").innerHTML = text;

    if (x6.length < 1 || !isNaN(x6)) {
        text = "*Address Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y6").innerHTML = text;

    if (isNaN(x7) || x7 < 1) {
        text = "*Phone Not Valid";
    } else {
        text = "";
        count++;
    }
    document.getElementById("y7").innerHTML = text;
 
            if(count==7)
            {
                 document.getElementById('myForm').submit();
              
            }
     }
     count0=0;

    function validation2() {
 
count0=0;
     var x10,x20,x30,x40,x50,x60,x70,text0;
     

    // Get the value of the input field with id="numb"
    x10 = document.getElementById("id0").value;
    x20 = document.getElementById("name0").value;
    x30 = document.getElementById("email0").value;
    x40 = document.getElementById("username0").value;
    x50 = document.getElementById("password0").value;
    x60 = document.getElementById("address0").value;
    x70 = document.getElementById("phone0").value;

    // If x is Not a Number or less than one or greater than 10
    if (isNaN(x10) || x10 < 1) {
        text0 = "*ID Not Valid";
    } else {
        text0 = "";
        count0++;
    }

    document.getElementById("y10").innerHTML = text0;

    if (x20.length < 1  || !isNaN(x20)) {
        text0 = "*FullName Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    document.getElementById("y20").innerHTML = text0;
    var re0 = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re0.test(x30)) {
        text0 = "*Email Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    document.getElementById("y30").innerHTML = text0;

    if (x40.length < 1 || !isNaN(x40)) {
        text0 = "*UserName Not Valid";
    } else {
        text0 = "";
        count0++;
    }

    document.getElementById("y40").innerHTML = text0;

    if (x50.length < 5) {
        text0 = "*Password Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    
    document.getElementById("y50").innerHTML = text0;

    if (isNaN(x60) || x60 < 1) {
        text0 = "*Salary Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    document.getElementById("y60").innerHTML = text0;

    if (isNaN(x70) || x70 < 1) {
        text0 = "*Phone Not Valid";
    } else {
        text0 = "";
        count0++;
    }
    document.getElementById("y70").innerHTML = text0;
    
            if(count0==7)
            {
                 document.getElementById('myForm3').submit();
              
            }
     }


</script>


                    