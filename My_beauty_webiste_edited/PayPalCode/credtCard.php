<?php 
        session_start();

         if(isset($_COOKIE['username']) && !isset($_SESSION['username'])){
   
   $_SESSION['ID'] = $_COOKIE['id'];
   $_SESSION['username'] = $_COOKIE['username'];
   $_SESSION['full_name'] = $_COOKIE['full_name'];
   $_SESSION['status'] = $_COOKIE['status'];

  }
  if(isset($_SESSION['username'])){
     if($_SESSION['status'] == 'user' && isset($_POST['total'])){
       $id                      = $_SESSION['ID'];
       $username                = $_SESSION['username'];
       $name                    = $_SESSION['full_name'];
       }elseif($_SESSION['status'] == 'supervisor'){header("location: supervisor/supervisorControlPage.php");}
   elseif($_SESSION['status'] == 'admin'){header("location: admin/adminControlPage.php");}
    else{header("location: ../homepage.php");}
       
   }else{header("location: login.php");}

    if($_SERVER['REQUEST_METHOD'] == "POST")
    { 

     
      if(isset($_POST['total'])){
      $total_price = $_POST['total'];
      $discount    = $_POST['discount'];
      $taxes       = $_POST['taxes'];
      $_SESSION['total_price'] = $total_price;
      $_SESSION['discount'] = $discount; 
      $_SESSION['taxes'] = $taxes;
      }
      
        if(isset($_POST['buttonConfirm'])){
       $card = $_POST['cardNumber'];
       $cvv  = $_POST['cvv'];
       if ($card == '4716108999716531' && $cvv == '257') {
             echo "<script>alert('Success')</script>";
           header("location: CCsucess.php?process=success&method=credit card");
       }
       else if ($card == '5281037048916168' && $cvv == '043') {
            echo "<script>alert('Success')</script>";
           header("location: CCsucess.php?process=success&method=credit card");
       }
       else if ($card == '342498818630298' && $cvv == '3156') {
        echo "<script>alert('Success')</script>";
           header("location: CCsucess.php?process=success&method=credit card");
       }
       else echo "<script>alert('Falid')</script>";
     }
   }
 
 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/demo.css">
</head>

<body>
    <div class="container-fluid">
        <header>
            <div class="limiter">
                <h3 style="margin-left:30%;">Credit Card With Payform</h3>
                
            </div>
        </header>
        <div class="creditCardForm">
            <div class="heading">
                <h1>Confirm Purchase</h1>
            </div>
            <div class="payment">
                <form action="" method="POST">
                    <div class="form-group owner">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" id="owner" name="owner">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control"  name="cvv">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control"  name="cardNumber">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select>
                            <option value="01">January</option>
                            <option value="02">February </option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select>
                            <option value="16"> 2016</option>
                            <option value="17"> 2017</option>
                            <option value="18"> 2018</option>
                            <option value="19"> 2019</option>
                            <option value="20"> 2020</option>
                            <option value="21"> 2021</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="assets/images/visa.jpg" id="visa">
                        <img src="assets/images/mastercard.jpg" id="mastercard">
                        <img src="assets/images/amex.jpg" id="amex">
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="btn btn-default" >Confirm</button>
                       <input type="hidden" class="form-control"  name="buttonConfirm">

                    </div>
                    <input type="hidden" value="<?php echo $total_price; ?>" name="total">

    <input type="hidden" value="<?php echo $discount; ?>" name="discount">

  <input type="hidden" value="<?php echo $taxes; ?>" name="taxes">
                </form>
            </div>
        </div>

        <p class="examples-note">Here are some dummy credit card numbers and CVV codes so you can test out the form:</p>

        <div class="examples">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Card Number</th>
                            <th>Security Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Visa</td>
                            <td>4716108999716531</td>
                            <td>257</td>
                        </tr>
                        <tr>
                            <td>Master Card</td>
                            <td>5281037048916168</td>
                            <td>043</td>
                        </tr>
                        <tr>
                            <td>American Express</td>
                            <td>342498818630298</td>
                            <td>3156</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
