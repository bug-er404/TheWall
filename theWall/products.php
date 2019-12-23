<?php
/*
 * CATALOG PAGE FOR ALL PRODUCTS
 * ONLY A VIEW LIST PAGE.
 */

include 'inc/header.php';


// Connect to database
include 'inc/dbconnect.php';

// Create a query
$results = $db->query( "select guitarID, guitarImage, guitarName from Guitar ORDER BY RAND()" );
$guitars = $results->fetchAll( PDO::FETCH_NUM );

$results = $db->query( "select bassID, bassImage, bassName from Bass ORDER BY RAND()" );
$basses  = $results->fetchAll( PDO::FETCH_NUM );

// Create a query
$results = $db->query( "select drumID, drumImage, drumName from Drum ORDER BY RAND()" );
$drums   = $results->fetchAll( PDO::FETCH_NUM );

$allproducts = array_merge( $drums, $basses, $guitars );
?>

    <!-- All products -->
    <h1 id="basses" class="display-4 text-center my-5 text-light mx-auto disableBlur">Products in Store</h1>
    <p class="text-light text-center mx-auto">This is only a catalog view page that can be used for quick browsing.
        Go "On the Wall" to get specific details on products.</p>
    <div class="container row mx-auto">
        <?php
        // Printing array contents
        foreach ( $allproducts as $product ) {
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="card border-secondary mb-2">
                    <img class="card-img-top" src="<?php
                    echo $product[ 1 ];
                    ?>" alt="Guitar Photo">
                    <div class="card-body text-secondary">
                        <h4 class="card-header text-center"><?php
                            echo $product[ 2 ];
                            ?></h4>
                    </div>
                </div>
            </div>
            <?php
        } //$allproducts as $product
        ?>
    </div><!-- /All products -->

<?php
include 'inc/newsletter.php';
include 'inc/footer.php';
?>