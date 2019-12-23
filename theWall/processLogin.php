<?php
/*
 * FILE TO PROCESS LOGIN
 *
 */

// For hashing
$salt = "thewall2019";

$email = $_POST['email'];
$password = sha1($_POST['password'].$salt);

// Connect to database
include 'inc/dbconnect.php';
// Get results
$insert = $db->prepare("select email, pw, memberID from Member where email = ? AND pw = ?");
$insert->bindParam(1, $email);
$insert->bindParam(2, $password);
$insert->execute();
// Get results as array
$searchresult = $insert->fetchAll();

if(count($searchresult) == 0) {?>
    <p class="lead text-light">
        <?php
    echo $email . " not found";?>
    </p>
    <script type="text/javascript">
        window.location.href = '/';
    </script>
    <?php
    exit;}

// variable to hold id
$id = 0;

// Checking if admin, and redirecting to admin page.
foreach ($searchresult as $entry) {
    $id = $entry[2];
    $insert = $db->query("select adminID, memberID from Admin where memberID =".$entry[2]);
}
$searchresult = $insert->fetchAll();

// Checking if admin to redirect to admin page
// Otherwise to the home page.
if(count($searchresult) == 0) {
    $_SESSION['user']=$id;
    // Storing cookies
    $cookie_name = "user";
    $cookie_value = $id;
    setcookie($cookie_name, $id, time() + (86400 * 30),"/");
    ?>
    <script type="text/javascript">
        window.location.href = document.referrer;
    </script>
    <?php
}
else{
    $_SESSION['admin']=$id;
    $cookie_name = "admin";
    $cookie_value = $id;
    setcookie($cookie_name, $id, time() + (86400 * 30),"/");
?>
<script type="text/javascript">
    window.location.href = '/admin';
</script>
    <?php
}




