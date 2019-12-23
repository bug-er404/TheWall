<?php
/*
 * FILE TO PROCESS REGISTRATION FORM
 *
 */

header("Refresh:2; http://smaharj.students.acg.edu", true, 303);


// Connect to database
include 'inc/dbconnect.php';

try {
    $check = "Y";
    $uncheck = "N";
    $none = null;
    // For hashing
    $salt = "thewall2019";

    // Create insert statements as variable
    $insert = $db->prepare("insert into Member
        (name, email, branch, guitar, bass, percussion, cardnumber, 
        zipcode,cvv, expmonth, expyear,pw ) values (?,?,?,?,?,?,?,?,?,?,?,?)");
    $insert->bindParam(1, $_POST['name']);
    $insert->bindParam(2, $_POST['email']);
    $insert->bindParam(3, $_POST['branch']);
    $hash = sha1($_POST['password'].$salt);
    $insert->bindParam(12, $hash);
    if (isset($_POST['1']))
    {
        $insert->bindParam(4, $check);
    }
    else{
        $insert->bindParam(4, $uncheck);
    }
    if (isset($_POST['2']))
    {
        $insert->bindParam(5, $check);
    }
    else{
        $insert->bindParam(5, $uncheck);
    }
    if (isset($_POST['3']))
    {
        $insert->bindParam(6, $check);
    }
    else{
        $insert->bindParam(6, $uncheck);
    }

    // Checking if the registration opted for premium benefits
    if (empty($_POST["premium"])) {
        $insert->bindParam(7, $none);
        $insert->bindParam(8, $none);
        $insert->bindParam(9, $none);
        $insert->bindParam(10, $none);
        $insert->bindParam(11, $none);
    } else {
        $insert->bindParam(7, $_POST['cc-num']);
        $insert->bindParam(8, $_POST['zip']);
        $insert->bindParam(9, $_POST['cvv']);
        $insert->bindParam(10, $_POST['exp-month']);
        $insert->bindParam(11, $_POST['exp-year']);
        }


    // Execute the insert
    $insert->execute();

    echo "Thank you for registering" . $_POST['fname'] . '<br />';

}catch (Exception $e){
    echo "Error registering!" . $e->getMessage();
}

?>

