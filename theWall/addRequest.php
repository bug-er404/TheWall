<?php
/*
 * FILE TO ADD A PRODUCT TO THE DATABASE.
 * ADMIN PERMISSION REQUIRED.
 */
header( "Refresh:2; http://smaharj.students.acg.edu/admin", true, 303 );
// Process product add request.
// Adds a product to the database.

// Checking if user has admin privileges:
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    // Connect to database
    include 'inc/dbconnect.php';

    try {
        if ( $_POST[ 'category' ] == "Guitar" ) {
            // Create insert statements as variable
            $insert = $db->prepare( "insert into Guitar
        (guitarName, guitarPrice, guitarDescription, guitarImage, brandID, guitarSpecs,
        guitarFeature) values (?,?,?,?,?,?,?)" );
        } //$_POST[ 'category' ] == "Guitar"
        if ( $_POST[ 'category' ] == "Bass" ) {
            // Create insert statements as variable
            $insert = $db->prepare( "insert into Bass
        (bassName, bassPrice, bassDescription, bassImage, brandID, bassSpecs,
        bassFeature) values (?,?,?,?,?,?,?)" );
        } //$_POST[ 'category' ] == "Bass"
        if ( $_POST[ 'category' ] == "Drum" ) {
            // Create insert statements as variable
            $insert = $db->prepare( "insert into Drum
        (drumName, drumPrice, drumDescription, drumImage, brandID, drumSpecs,
        drumFeature) values (?,?,?,?,?,?,?)" );
        } //$_POST[ 'category' ] == "Drum"


        // Create insert statements as variable
        $insert->bindParam( 1, $_POST[ 'newProduct' ] );
        $insert->bindParam( 2, $_POST[ 'productPrice' ] );
        $insert->bindParam( 3, $_POST[ 'productDesc' ] );
        $insert->bindParam( 4, $_POST[ 'targetImage' ] );
        $insert->bindParam( 5, $_POST[ 'brandid' ] );
        $insert->bindParam( 6, $_POST[ 'productSpecs' ] );
        $insert->bindParam( 7, $_POST[ 'feature' ] );

        // Execute the insert
        $insert->execute();

        echo "Product successfully added." . '<br />';

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

?>

