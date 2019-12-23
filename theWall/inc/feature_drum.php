<?php
/*
 * FEATURED DRUMS
 */

// Connect to database
include 'dbconnect.php';

// Create a query
$results = $db->query("select drumID, drumName, drumDescription, drumImage, drumFeature from Drum
                                    WHERE drumFeature='Y' ORDER BY RAND() LIMIT 3");

// Execute the query that returns the results in an Array
$drums = $results->fetchAll(PDO::FETCH_ASSOC);
?>
<div id = "pageBackground2"></div>
<h3 id="drums" class="display-4 text-center my-5 text-light disableBlur">Featured Drums</h3>
<ul class="list-group">

    <?php
    // Printing array contents
    foreach($drums as $row){ ?>
        <li class="list-group-item">

            <div class="d-flex justify-content-center">
                <a href="/single_instrument?drum=<?php echo $row['drumID'] ?>">
                <img src="<?php echo $row['drumImage'] ?>" alt="Drum Image" class="mb-1 rounded mx-auto d-block img-thumbnail">
            </div>
            <h1 class="text-center text-light lead"><?php echo $row['drumName'] ?></h1>
            <p class="mb-3 text-light text-center"><?php echo $row['drumDescription'] ?></p>
            </a>
        </li>
        <?php
    }
    ?>
</ul><!-- /schedule -->

<!-- callout button -->
<button type="button" class="btn btn-outline-danger btn-lg d-block mx-auto my-5" data-toggle="modal" data-target="#register">Don't Miss Out on the Best Offers, Join Now!</button>

<div id = "pageBackground3"></div>