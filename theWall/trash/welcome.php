<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="3; url=index.html" />
    <title>Login Successful</title>
</head>
<body>

<?php
$email = $_POST['email'];
$password = $_POST['password'];
// Connect to database
include 'dbconnect.php';
// Get results
$insert = $db->prepare("select email, password from login where email = ? AND password = ?");
$insert->bindParam(1, $email);
$insert->bindParam(2, $password);
$insert->execute();
// Get results as array
$searchresult = $insert->fetchAll();

if(count($searchresult) == 0) echo $email . " not found";
else{
    echo "Welcome";

}
?>


</body>
</html>


