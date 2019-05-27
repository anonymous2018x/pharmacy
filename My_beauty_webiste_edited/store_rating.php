<?php
    if(isset($_POST&#91;'star'&#93;)){  
        $star = htmlentities($_POST&#91;'star'&#93;);
        //valid star id array
        $valid_star = array('1','2','3','4','5');
 
        //show a error message if some hacker (Noobs) try to change the star id
        if(!in_array($star, $valid_star)){
            echo "<b class='r'>Fuck You. It's Your Dads Website.</b>";
            exit();
        }
 
        // STORE THE RATING INTO DATABASE
 
        // Display the result
        echo "<b class='g'>Thanks! You rated this product {$star} Stars.</b>";
    }
?>