<?php
/*
 * FILE TO ADD BRAND TO THE DATABASE.
 * ADMIN PERMISSION REQUIRED.
 */

header( "Refresh:1; http://smaharj.students.acg.edu/admin.php", true, 303 );
// Add new brand

// Checking if user has admin privileges:
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    include "inc/header.php";
    include 'inc/dbconnect.php';
    try {
        $insert = $db->prepare( "insert into Brand
    (brandName, brandDescription) values (?,?)" );
        // Create insert statements as variable
        $insert->bindParam( 1, $_POST[ 'brandName' ] );
        $insert->bindParam( 2, $_POST[ 'brandDescription' ] );
        // Execute the insert
        $insert->execute();
        ?>
        <script type="text/javascript">
        alert("Brand added successfully!");
        </script>
        <?php
    }
    catch ( Exception $e ) {
        echo "Error registering!" . $e->getMessage();
    }
} //isset( $_COOKIE[ 'admin' ] )
// Else we redirect back to the home page
else {
    http_response_code( 403 );
    ?>
    <script type="text/javascript">
        window.location.href = 'inc/4013';
    </script>
    <?php
    exit;
}
