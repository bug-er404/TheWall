<?php
/*
 * FILE TO DELETE BRAND FROM THE DATABASE.
 * ADMIN PERMISSION REQUIRED.
 */

header( "Refresh:1; http://smaharj.students.acg.edu/admin", true, 303 );
// Checking if user has admin privileges:
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    // Connect to database
    include 'inc/dbconnect.php';

    try {
        $insert = $db->prepare( "DELETE FROM Brand WHERE brandID = ?" );

        // Create insert statements as variable
        $insert->bindParam( 1, $_POST[ 'brandid' ] );

        // Execute the insert
        $insert->execute();

        ?>
        <script type="text/javascript">
            alert("Brand deleted successfully!");
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
