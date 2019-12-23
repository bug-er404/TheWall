<?php
/*
 * FILE TO DELETE ITEM FROM THE DATABASE
 * ADMIN PERMISSION REQUIRED.
 */

// Checking if user has admin privileges:
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    include 'inc/header.php';
    // Connect to database
    include 'inc/dbconnect.php';
    ?>

    <?php
    // Check which group is being requested
    // Guitars
    if ( isset( $_GET[ 'guitars' ] ) ) {
        // Create a query
        $results    = $db->query( "select guitarID, guitarImage, guitarName from Guitar" );
        // Execute the query that returns the results in an Array
        $instrument = $results->fetchAll( PDO::FETCH_NUM );


        if ( count( $instrument ) == 0 )
            echo $instrument . " not found";
        else {
            ?>
            <h1 id="guitars" class="display-4 text-center my-5 text-light mx-auto disableBlur">Delete Guitar Item</h1>
            <div class="container row mx-auto">

            <?php
            foreach ( $instrument as $item ) {
                ?>
                <div class="col-md-6 col-lg-6">
                    <div class="card border-secondary mb-3">
                        <img class="card-img-top" src="<?php
                        echo $item[ 1 ];
                        ?>" alt="Guitar Photo">
                        <div class="card-body text-secondary">
                            <h1 class="card-header text-center"><?php
                                echo $item[ 2 ];
                                ?></h1>
                            <form class="form-inline" action = "#" method = "POST">
                                <button type="submit" class="btn btn-danger mb-2" name = "id" id="id" value ="<?php
                                echo $item[ 0 ];
                                ?>">Delete Item</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } //$instrument as $item
        } //$instrument as $item
        ?>
        </div>
        <?php
    } //isset( $_GET[ 'guitars' ] )

    // Basses
    if ( isset( $_GET[ 'basses' ] ) ) {
        // Create a query
        $results    = $db->query( "select bassID, bassImage, bassName from Bass" );
        // Execute the query that returns the results in an Array
        $instrument = $results->fetchAll( PDO::FETCH_NUM );


        if ( count( $instrument ) == 0 )
            echo $instrument . " not found";
        else {
            ?>
            <h1 id="basses" class="display-4 text-center my-5 text-light mx-auto disableBlur">Delete Bass Item</h1>
            <div class="container row mx-auto">

            <?php
            foreach ( $instrument as $item ) {
                ?>
                <div class="col-md-6 col-lg-6">
                    <div class="card border-secondary mb-3">
                        <img class="card-img-top" src="<?php
                        echo $item[ 1 ];
                        ?>" alt="Bass Photo">
                        <div class="card-body text-secondary">
                            <h1 class="card-header text-center"><?php
                                echo $item[ 2 ];
                                ?></h1>
                            <form class="form-inline" action = "#" method = "POST">
                                <button type="submit" class="btn btn-danger mb-2" name = "id" id="id" value ="<?php
                                echo $item[ 0 ];
                                ?>">Delete Item</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } //$instrument as $item
        }
        ?>
        </div>
        <?php
    } //isset( $_GET[ 'basses' ] )


    // Drums
if ( isset( $_GET[ 'drums' ] ) ) {
    // Create a query
    $results    = $db->query( "select drumID, drumImage, drumName from Drum" );
    // Execute the query that returns the results in an Array
    $instrument = $results->fetchAll( PDO::FETCH_NUM );


if ( count( $instrument ) == 0 )
    echo $instrument . " not found";
else {
    ?>
    <h1 id="drums" class="display-4 text-center my-5 text-light mx-auto disableBlur">Delete Drum Item</h1>
    <div class="container row mx-auto">

        <?php
        foreach ( $instrument as $item ) {
            ?>
            <div class="col-md-6 col-lg-6">
                <div class="card border-secondary mb-3">
                    <img class="card-img-top" src="<?php
                    echo $item[ 1 ];
                    ?>" alt="Guitar Photo">
                    <div class="card-body text-secondary">
                        <h1 class="card-header text-center"><?php
                            echo $item[ 2 ];
                            ?></h1>
                        <form class="form-inline" action = "#" method = "POST">
                            <button type="submit" class="btn btn-danger mb-2" name = "id" id="id" value ="<?php
                            echo $item[ 0 ];
                            ?>">Delete Item</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } //$instrument as $item
        }
        } //isset( $_GET[ 'drums' ] )
        ?>
    </div>

    <?php
    // Connect to database
    include 'inc/dbconnect.php';


    if ( isset( $_POST[ 'id' ] ) ) {
        // target url to reload to
        $target = 0;
        try {
            if ( isset( $_GET[ 'guitars' ] ) ) {
                $target = "/deleteItem?guitars";
                // Create insert statements as variable
                $insert = $db->prepare( "DELETE FROM Guitar WHERE guitarID = ?" );
            } //isset( $_GET[ 'guitars' ] )
            if ( isset( $_GET[ 'basses' ] ) ) {
                $target = "/deleteItem?basses";
                // Create insert statements as variable
                $insert = $db->prepare( "DELETE FROM Bass WHERE bassID = ?" );

            } //isset( $_GET[ 'basses' ] )
            if ( isset( $_GET[ 'drums' ] ) ) {
                $target = "/deleteItem?drums";
                // Create insert statements as variable
                $insert = $db->prepare( "DELETE FROM Drum WHERE drumID = ?" );

            } //isset( $_GET[ 'drums' ] )

            // Create insert statements as variable
            $insert->bindParam( 1, $_POST[ 'id' ] );

            // Execute the insert
            $insert->execute();
            ?>

            <script type="text/javascript">
                alert("Item deleted successfully.");
                window.location.href = '<?php
                    echo $target;
                    ?>';
            </script>
            <?

        }
        catch ( Exception $e ) {
            echo "Error updating price!" . $e->getMessage();
        }
    } //isset( $_POST[ 'id' ] )

    include 'inc/footer.php';
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