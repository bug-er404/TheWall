<?php
/*
 * FILE TO UPDATE BRAND INFORMATION.
 * ADMIN PERMISSION REQUIRED.
 */
header( "Refresh:1; http://smaharj.students.acg.edu/admin", true, 303 );
// Update existing brand
// Checking if user has admin privileges:
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    // Connect to database
    include 'inc/dbconnect.php';

    try {
        $insert = $db->prepare( "UPDATE Brand SET brandName = ?, brandDescription = ? WHERE brandID = ?" );

        // Create insert statements as variable
        $insert->bindParam( 1, $_POST[ 'newbrandName' ] );
        $insert->bindParam( 2, $_POST[ 'newbrandDescription' ] );
        $insert->bindParam( 3, $_POST[ 'updatebrandid' ] );

        // Execute the insert
        $insert->execute();

        ?>
        <script type="text/javascript">
            alert("Brand updated successfully!");
        </script>
        <?php

    }
    catch ( Exception $e ) {
        echo "Error updating brand!" . $e->getMessage();
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
