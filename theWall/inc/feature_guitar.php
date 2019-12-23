<?php
/*
 * FEATURED GUITARS
 */

// Connect to database
include 'dbconnect.php';

// Create a query
$results = $db->query("select guitarID, guitarImage, guitarName, guitardescription, guitarFeature from Guitar
                                WHERE guitarFeature='Y' ORDER BY RAND() LIMIT 3");

// Execute the query that returns the results in an Array
$guitarinfo = $results->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- guitars -->
<h3 id="guitars" class="display-4 text-center my-5 text-light mx-auto disableBlur">Featured Guitars</h3>
<div class="row mx-auto">
    <?php
    // Printing array contents
    foreach ($guitarinfo as $guitar){?>
    <div class="col-md-12 col-lg-4">
        <div class="card-deck mb-3">
            <a href="/single_instrument?guitar=<?php echo $guitar[guitarID] ?>" class="stretched-link">
                <img class="card-img-top" src="<?php echo $guitar[guitarImage] ?>" alt="Guitar Photo">
                <div class="card-body">
                    <h1 class="card-header text-light text-center"><?php echo $guitar[guitarName] ?></h1>
                    <p class="card-text text-light text-center mb-3"><?php echo $guitar[guitardescription] ?></p>
            </a>
        </div>
    </div>
</div>
<?php } ?>
</div><!-- /Guitars -->
<br>