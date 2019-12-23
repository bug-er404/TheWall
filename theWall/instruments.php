<?php
/*
 * INSTRUMENTS CATEGORY PAGE.
 * DISPLAYS INSTRUMENTS ACCORDING TO THE CATEGORY
 * AND CAN BE FILTERED BY BRANDS
 *
 */

include 'inc/header.php';
// Connect to database
include 'inc/dbconnect.php';
?>


    <div class = "container">
        <h5 class="mb-4 text-light my-3 text-center">Filter by Brand</h5>
        <form class="form-inline" action = "#" method = "POST">
            <?php
            // Get all brands sfor filter
            $rows   = $db->query( "select brandID, brandName from Brand" );
            $brands = $rows->fetchAll( PDO::FETCH_NUM );

            foreach ( $brands as $brand ) {
                ?>
                <div class="form-check">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="<?php
                        echo $brand[ 0 ];
                        ?>">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description text-light"><?php
                            echo $brand[ 1 ];
                            ?></span>
                    </label>
                </div>
                <?php
            } //$brands as $brand
            ?>
            <button type="submit" class="btn btn-outline-secondary mb-2 my-2" name="filter" value="filter">Filter</button>
        </form>
    </div>

<?php
// Check which group is being requested
// Guitars
if ( isset( $_GET[ 'guitars' ] ) ) {
    // Create a query
    $results    = $db->query( "select guitarID, guitarImage, guitarName, guitardescription, brandID from Guitar" );
    // Execute the query that returns the results in an Array
    $instrument = $results->fetchAll( PDO::FETCH_NUM );


    if ( count( $instrument ) == 0 )
        echo $instrument . " not found";
    else {
        ?>
        <h1 id="guitars" class="display-4 text-center my-5 text-light mx-auto disableBlur">Guitars in Store</h1>
        <div class="container row mx-auto">

            <?php
            foreach ( $instrument as $item ) {
                if ( isset( $_POST[ 'filter' ] ) && isset( $_POST[ $item[ 4 ] ] ) ) {
                    ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="card border-secondary mb-3">
                            <a href="/single_instrument?guitar=<?php
                            echo $item[ 0 ];
                            ?>" class="stretched-link">
                                <img class="card-img-top" src="<?php
                                echo $item[ 1 ];
                                ?>" alt="Guitar Photo">
                                <div class="card-body text-secondary">
                                    <h1 class="card-header text-center"><?php
                                        echo $item[ 2 ];
                                        ?></h1>
                                    <p class="card-text text-center"><?php
                                        echo $item[ 3 ];
                                        ?></p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php
                } //isset($_POST['filter']) && isset($_POST[$item[4]])
                if ( !isset( $_POST[ 'filter' ] ) ) {
                    ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="card border-secondary mb-3">
                            <a href="/single_instrument?guitar=<?php
                            echo $item[ 0 ];
                            ?>" class="stretched-link">
                                <img class="card-img-top" src="<?php
                                echo $item[ 1 ];
                                ?>" alt="Guitar Photo">
                                <div class="card-body text-secondary">
                                    <h1 class="card-header text-center"><?php
                                        echo $item[ 2 ];
                                        ?></h1>
                                    <p class="card-text text-center"><?php
                                        echo $item[ 3 ];
                                        ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                } //!isset($_POST['filter'])
            } //$instrument as $item
            ?>
        </div>
        <?php
    }
} //isset($_GET['guitars'])

// Basses
if ( isset( $_GET[ 'basses' ] ) ) {
    // Create a query
    $results    = $db->query( "select bassID, bassImage, bassName, bassDescription, brandID from Bass" );
    // Execute the query that returns the results in an Array
    $instrument = $results->fetchAll( PDO::FETCH_NUM );


    if ( count( $instrument ) == 0 )
        echo $instrument . " not found";
    else {
        ?>
        <h1 id="basses" class="display-4 text-center my-5 text-light mx-auto disableBlur">Bass in Store</h1>
        <div class="container row mx-auto">

            <?php
            foreach ( $instrument as $item ) {
                if ( isset( $_POST[ 'filter' ] ) && isset( $_POST[ $item[ 4 ] ] ) ) {
                    ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="card border-secondary mb-3">
                            <a href="/single_instrument?bass=<?php
                            echo $item[ 0 ];
                            ?>" class="stretched-link">
                                <img class="card-img-top" src="<?php
                                echo $item[ 1 ];
                                ?>" alt="Bass Photo">
                                <div class="card-body text-secondary">
                                    <h1 class="card-header text-center"><?php
                                        echo $item[ 2 ];
                                        ?></h1>
                                    <p class="card-text text-center"><?php
                                        echo $item[ 3 ];
                                        ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                } //isset($_POST['filter']) && isset($_POST[$item[4]])
                if ( !isset( $_POST[ 'filter' ] ) ) {
                    ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="card border-secondary mb-3">
                            <a href="/single_instrument?bass=<?php
                            echo $item[ 0 ];
                            ?>" class="stretched-link">
                                <img class="card-img-top" src="<?php
                                echo $item[ 1 ];
                                ?>" alt="Bass Photo">
                                <div class="card-body text-secondary">
                                    <h1 class="card-header text-center"><?php
                                        echo $item[ 2 ];
                                        ?></h1>
                                    <p class="card-text text-center"><?php
                                        echo $item[ 3 ];
                                        ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                } //!isset($_POST['filter'])
            } //$instrument as $item
            ?>
        </div>
        <?php
    }
} //isset($_GET['basses'])


// Drums
if ( isset( $_GET[ 'drums' ] ) ) {
    // Create a query
    $results    = $db->query( "select drumID, drumImage, drumName, drumDescription, brandID from Drum" );
    // Execute the query that returns the results in an Array
    $instrument = $results->fetchAll( PDO::FETCH_NUM );


    if ( count( $instrument ) == 0 )
        echo $instrument . " not found";
    else {
        ?>
        <h1 id="drums" class="display-4 text-center my-5 text-light mx-auto disableBlur">Drums in Store</h1>
        <div class="container row mx-auto">

        <?php
        foreach ( $instrument as $item ) {
            if ( isset( $_POST[ 'filter' ] ) && isset( $_POST[ $item[ 4 ] ] ) ) {
                ?>
                <div class="col-md-6 col-lg-6">
                    <div class="card border-secondary mb-3">
                        <a href="/single_instrument?drum=<?php
                        echo $item[ 0 ];
                        ?>" class="stretched-link">
                            <img class="card-img-top" src="<?php
                            echo $item[ 1 ];
                            ?>" alt="Guitar Photo">
                            <div class="card-body text-secondary">
                                <h1 class="card-header text-center"><?php
                                    echo $item[ 2 ];
                                    ?></h1>
                                <p class="card-text text-center"><?php
                                    echo $item[ 3 ];
                                    ?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            } //isset($_POST['filter']) && isset($_POST[$item[4]])
            if ( !isset( $_POST[ 'filter' ] ) ) {
                ?>
                <div class="col-md-6 col-lg-6">
                    <div class="card border-secondary mb-3">
                        <a href="/single_instrument?drum=<?php
                        echo $item[ 0 ];
                        ?>" class="stretched-link">
                            <img class="card-img-top" src="<?php
                            echo $item[ 1 ];
                            ?>" alt="Guitar Photo">
                            <div class="card-body text-secondary">
                                <h1 class="card-header text-center"><?php
                                    echo $item[ 2 ];
                                    ?></h1>
                                <p class="card-text text-center"><?php
                                    echo $item[ 3 ];
                                    ?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            } //!isset($_POST['filter'])
        } //$instrument as $item
    }
    ?>
    </div>
    <?php
} //isset($_GET['drums'])

include 'inc/newsletter.php';
include 'inc/footer.php';
?>