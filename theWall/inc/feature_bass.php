<?php
/*
 * FEATURED BASSES
 */
// Connect to database
include 'dbconnect.php';

// Create a query
$results = $db->query("select bassID, bassImage, bassName, bassDescription, bassFeature from Bass 
                                    WHERE bassFeature='Y' ORDER BY RAND() LIMIT 4");

// Execute the query that returns the results in an Array
$guitarinfo = $results->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- guitars -->
<h3 id="basses" class="display-4 text-center my-5 text-light mx-auto disableBlur">Featured Bass</h3>
<div class="container row mx-auto">
    <?php
    // Printing array contents
    foreach($guitarinfo as $guitar){ ?>
        <div class="col-md-6 col-lg-6">
            <div class="card border-secondary mb-3">
                <a href="/single_instrument?bass=<?php echo $guitar[bassID] ?>" class="stretched-link">
                <img class="card-img-top" src="<?php echo $guitar[bassImage]?>" alt="Guitar Photo">
                <div class="card-body text-secondary">
                    <h1 class="card-header text-center"><?php echo $guitar[bassName] ?></h1>
                    <p class="card-text text-center"><?php echo $guitar[bassDescription]?></p>
                </div>
                </a>
            </div>
        </div>
    <?php } ?>
</div><!-- /Guitars -->