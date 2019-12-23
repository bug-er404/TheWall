<?php
/*
 * SINGLE INSTRUMENT PAGE.
 *
 */


include 'inc/header.php';
// Connect to database
include 'inc/dbconnect.php';

// Check which group is being requested
$category = 0;
// Guitars
if ( isset( $_GET[ 'guitar' ] ) ) {
    $id       = $_GET[ 'guitar' ];
    $category = '1';
    // Query for instrument
    $results  = $db->prepare( "select guitarID, guitarImage, guitarName, guitardescription, guitarPrice, 
                                    guitarSpecs, brandName, brandDescription from Guitar join Brand using (brandID) where guitarID = ?
                                    " );

    // Query for member review
    $reviews = $db->prepare( "select reviewID, reviewtext, rating from Review where guitarID = ? ORDER BY rating DESC;
                                    " );

    // Query for member rating
    $rating = $db->prepare( "select COUNT(rating) as ratingNum, FORMAT((SUM(rating) / COUNT(rating)),2) as avgRating
                                     from Review where guitarID = ? group by guitarID " );

    // Query for public rating
    $publicrate = $db->prepare( "select guitarID, COUNT(rating) as ratingNum, FORMAT((SUM(rating) / COUNT(rating)),2) as avgRating
                                     from Rating where guitarID = ? group by guitarID " );

    // AJAX script for updating review
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
        function ratestar($id, $rate){
            $.ajax({
                type: 'POST',
                url: 'rating.php',
                data: 'instr=guitar'+'&productid='+$id+'&rating='+$rate,
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <?php
} //isset( $_GET[ 'guitar' ] )
// Basses
if ( isset( $_GET[ 'bass' ] ) ) {
    $id       = $_GET[ 'bass' ];
    $category = '2';
    // Create a query
    $results  = $db->prepare( "select bassID, bassImage, bassName, bassDescription, bassPrice, bassSpecs, brandName, brandDescription from Bass join Brand using (brandID)
                                        where bassID=?" );

    // Query for review
    $reviews = $db->prepare( "select reviewID, reviewtext, rating from Review where bassID = ? ORDER BY rating DESC;
                                    " );

    // Query for rating
    $rating = $db->prepare( "select COUNT(rating) as ratingNum, FORMAT((SUM(rating) / COUNT(rating)),2) as avgRating
                                     from Review where bassID = ? group by bassID " );

    // Query for public rating
    $publicrate = $db->prepare( "select bassID, COUNT(rating) as ratingNum, FORMAT((SUM(rating) / COUNT(rating)),2) as avgRating
                                     from Rating where bassID = ? group by bassID " );
    // AJAX script for updating review
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
        function ratestar($id, $rate){
            $.ajax({
                type: 'POST',
                url: 'rating.php',
                data: 'instr=bass'+'&productid='+$id+'&rating='+$rate,
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <?php
} //isset( $_GET[ 'bass' ] )
// Drums
if ( isset( $_GET[ 'drum' ] ) ) {
    $id       = $_GET[ 'drum' ];
    $category = '3';
    // Create a query
    $results  = $db->prepare( "select drumID, drumImage, drumName, drumDescription, drumPrice,drumSpecs, brandName, brandDescription from Drum join Brand using (brandID)
                                        where drumID=?" );

    // Query for review
    $reviews = $db->prepare( "select reviewID, reviewtext, rating from Review where drumID = ? ORDER BY rating DESC;
                                    " );

    // Query for rating
    $rating = $db->prepare( "select COUNT(rating) as ratingNum, FORMAT((SUM(rating) / COUNT(rating)),2) as avgRating
                                     from Review where drumID = ? group by drumID " );

    // Query for public rating
    $publicrate = $db->prepare( "select drumID, COUNT(rating) as ratingNum, FORMAT((SUM(rating) / COUNT(rating)),2) as avgRating
                                     from Rating where drumID = ? group by drumID " );
    // AJAX script for updating review
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
        function ratestar($id, $rate){
            $.ajax({
                type: 'POST',
                url: 'rating.php',
                data: 'instr=drum'+'&productid='+$id+'&rating='+$rate,
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <?php
} //isset( $_GET[ 'drum' ] )
// Get instrument details
$results->bindParam( 1, $id );
$results->execute();

// Get reviews
$reviews->bindParam( 1, $id );
$reviews->execute();

// Get the rating
$rating->bindParam( 1, $id );
$rating->execute();

// Get the public rating
$publicrate->bindParam( 1, $id );
$publicrate->execute();

// Execute the query that returns the results in an Array
$instrument = $results->fetchAll( PDO::FETCH_NUM );
$reviews    = $reviews->fetchAll( PDO::FETCH_NUM );
$rating     = $rating->fetchAll( PDO::FETCH_NUM );
$publicrate = $publicrate->fetchAll( PDO::FETCH_NUM );

if ( count( $instrument ) == 0 )
    echo $instrument . " not found";
else {
    foreach ( $instrument as $item ) {
        ?>
        <div class="container" id="single">

            <h1 class="d-flex text-light display-4 mb-5 my-5 py-3"><?php
                echo $item[ 2 ];
                ?></h1>
            <img class="justify-content-center d-flex img-thumbnail mx-auto" src="<?php
            echo $item[ 1 ];
            ?>"
                 alt="Instrument Image">

            <p class="text-light lead text-center my-2 py-2"><?php
                echo $item[ 3 ];
                ?></p>

            <h4 class="text-light my-2 py-2">Price: $<?php
                echo $item[ 4 ];
                ?></h4><br>

            <h2 class="d-block text-light py-2">Brand: <?php
                echo $item[ 6 ];
                ?></h2>

            <h3 class="d-block text-light my-3 py-2"><u>Brand Description</u></h3>
            <p class="text-light lead"><?php
                echo $item[ 7 ];
                ?></p><br>

            <h2 class="d-block text-light my-3 py-2"><u>Product Specifications</u></h2>
            <p class="text-light lead"><?php
                echo $item[ 5 ];
                ?></p><br><br>

            <?php
            if ( count( $rating ) > 0 || count( $reviews ) > 0 ) {
                ?>
                <h1 class="d-block text-light my-4 py-4"><u>Product Reviews</u></h1>
                <table class = "my-4 py-3">
                    <thead>
                    <th class="d-block text-light">Public Rating on the Product</th>
                    </thead>
                    <?php
                    // PUBLIC RATING:
                    foreach ( $publicrate as $data ) {
                        ?>
                        <tr>
                            <td class="d-block text-light mr-4 ml-3"> <em>Average of <?php
                                    echo $data[ 2 ];
                                    ?> from <?php
                                    echo $data[ 1 ];
                                    ?> ratings</em></td>
                            <td>
                                <div class="star">
                                    <?php
                                    for ( $i = 1; $i <= 5; $i++ ) {
                                        if ( $i <= $data[ 2 ] ) {
                                            ?>
                                            <span class="star_rated starrate" onclick="ratestar(<?php
                                            echo $data[ 0 ];
                                            ?>, <?php
                                            echo $i;
                                            ?>)">&#x2605;</span>
                                            <?php
                                        } //$i <= $data[ 2 ]
                                        else {
                                            ?>
                                            <span class="starrate" onclick="ratestar(<?php
                                            echo $data[ 0 ];
                                            ?>, <?php
                                            echo $i;
                                            ?>)">&#x2605;</span>
                                            <?php
                                        }
                                    } //$i = 1; $i <= 5; $i++
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                    } //$publicrate as $data
                    ?>
                </table>


                <div class="d-inline-block s">
                    <p class="text-light lead d-inline">Member rating</p>
                    <?php
                    foreach ( $rating as $score ) {
                        ?>
                        <label for="rate5"><img src="img/rate_<?php
                            echo ( $score[ 1 ] >= 1 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate5" name="rate"
                               value="1" <?php
                        echo ( $score[ 1 ] >= 1 ) ? 'checked="checked"' : '';
                        ?>>
                        <label for="rate4"><img src="img/rate_<?php
                            echo ( $score[ 1 ] >= 2 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate4" name="rate"
                               value="2" <?php
                        echo ( $score[ 1 ] >= 2 ) ? 'checked="checked"' : '';
                        ?>>
                        <label for="rate3"><img src="img/rate_<?php
                            echo ( $score[ 1 ] >= 3 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate3" name="rate"
                               value="3" <?php
                        echo ( $score[ 1 ] >= 3 ) ? 'checked="checked"' : '';
                        ?>>
                        <label for="rate2"><img src="img/rate_<?php
                            echo ( $score[ 1 ] >= 4 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate2" name="rate"
                               value="4" <?php
                        echo ( $score[ 1 ] >= 4 ) ? 'checked="checked"' : '';
                        ?>>
                        <label for="rate1"><img src="img/rate_<?php
                            echo ( $score[ 1 ] >= 5 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate1" name="rate"
                               value="5" <?php
                        echo ( $score[ 1 ] >= 5 ) ? 'checked="checked"' : '';
                        ?>>
                        <?php
                    } //$rating as $score
                    ?>
                </div><br>
                <p class="text-light lead d-inline ml-4 pl-3"><em>Average rating of <span id = "ratingScore"><?php
                            echo $score[ 1 ];
                            ?></span> from
                        <span id="memberRaters"><?php
                            echo $score[ 0 ];
                            ?></span> members</em></p>
                <br><br>
                <div class="mb-4">
                    <p class="text-light lead d-inline mb-3"><u>Member reviews:</u></p><br>
                </div>

                <?php
                foreach ( $reviews as $review ) {
                    ?>
                    <div class="d-inline-block rating container ml-4 pl-4">
                        <label for="rate5"><img src="img/rate_<?php
                            echo ( $review[ 2 ] >= 1 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate5" name="rate"
                               value="1" <?php
                        echo ( $review[ 2 ] >= 1 ) ? 'checked="checked"' : '';
                        ?>>
                        <label for="rate4"><img src="img/rate_<?php
                            echo ( $review[ 2 ] >= 2 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate4" name="rate"
                               value="2" <?php
                        echo ( $review[ 2 ] >= 2 ) ? 'checked="checked"' : '';
                        ?>>
                        <label for="rate3"><img src="img/rate_<?php
                            echo ( $review[ 2 ] >= 3 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate3" name="rate"
                               value="3" <?php
                        echo ( $review[ 2 ] >= 3 ) ? 'checked="checked"' : '';
                        ?>>
                        <label for="rate2"><img src="img/rate_<?php
                            echo ( $review[ 2 ] >= 4 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate2" name="rate"
                               value="4" <?php
                        echo ( $review[ 2 ] >= 4 ) ? 'checked="checked"' : '';
                        ?>>
                        <label for="rate1"><img src="img/rate_<?php
                            echo ( $review[ 2 ] >= 5 ) ? 'filled' : 'empty';
                            ?>.png"
                                                height="30px"></label>
                        <input type="radio" id="rate1" name="rate"
                               value="5" <?php
                        echo ( $review[ 2 ] >= 5 ) ? 'checked="checked"' : '';
                        ?>>
                        <p class="text-light d-inline"><em>- "<?php
                                echo $review[ 1 ];
                                ?>"</em></p><br>
                    </div>
                    <?php
                } //$reviews as $review
            } //count( $rating ) > 0 || count( $reviews ) > 0
            else {
            }
            ?>
            <h1 class="d-block text-light my-4 py-4"><u>Add a Review</u></h1>
            <?php
            if ( isset( $_COOKIE[ 'user' ] ) || isset( $_COOKIE[ 'admin' ] ) ) {
                ?>
                <h3 class="card-header text-light">Review Product: <?php
                    echo $item[ 2 ];
                    ?></h3>
                <form action="reviews" method="POST">
                    <div class="form-group">
                        <div class="d-inline-block container ml-4 pl-4" id="productRating">
                            <label for="rate5"><img id="0" src="img/rate_filled.png" onclick="rateclick('0');"
                                                    height="30px"/></label>
                            <input type="radio" id="rate5" name="rate"
                                   value="1" <?php
                            echo ( $review[ 2 ] >= 1 ) ? 'checked="checked"' : '';
                            ?>>
                            <label for="rate4"><img id="1" src="img/rate_filled.png" onclick="rateclick('1');"
                                                    height="30px"/></label>
                            <input type="radio" id="rate4" name="rate"
                                   value="2" <?php
                            echo ( $review[ 2 ] >= 2 ) ? 'checked="checked"' : '';
                            ?>>
                            <label for="rate3"><img id="2" src="img/rate_filled.png" onclick="rateclick('2');"
                                                    height="30px"/></label>
                            <input type="radio" id="rate3" name="rate"
                                   value="3" <?php
                            echo ( $review[ 2 ] >= 3 ) ? 'checked="checked"' : '';
                            ?>>
                            <label for="rate2"><img id="3" src="img/rate_filled.png" onclick="rateclick('3');"
                                                    height="30px"/></label>
                            <input type="radio" id="rate2" name="rate"
                                   value="4" <?php
                            echo ( $review[ 2 ] >= 4 ) ? 'checked="checked"' : '';
                            ?>>
                            <label for="rate1"><img id="4" src="img/rate_filled.png" onclick="rateclick('4');"
                                                    height="30px"/></label>
                            <input type="radio" id="rate1" name="rate"
                                   value="5" <?php
                            echo ( $review[ 2 ] >= 5 ) ? 'checked="checked"' : '';
                            ?>>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="productReview" class = "text-light">Your thoughts about the product</label>
                        <textarea aria-label="Description" class="form-control" id="productReview" name="productReview" placeholder="Add your review here"></textarea>
                    </div>
                    <input type="hidden" value = "<?php
                    echo $category;
                    ?>" name="instr">
                    <button id="addReview" type="submit" class="btn btn-outline-success btn-sm" name="id" id="id" value="<?php
                    echo $id;
                    ?>">Add Review</button>
                </form>


                <?php
            } //isset( $_COOKIE[ 'user' ] ) || isset( $_COOKIE[ 'admin' ] )
            else {
                ?>
                <p class="text-light lead d-inline text-center"><em>You need to be a member to post reviews and rate the product.</em></p>
                <?php
            }
            ?>
        </div><br>
        <?php

    } //$instrument as $item
}


if ( isset( $_GET[ 'guitar' ] ) )
    include 'inc/feature_guitar.php';
// Basses
if ( isset( $_GET[ 'bass' ] ) )
    include 'inc/feature_bass.php';
// Drums
if ( isset( $_GET[ 'drum' ] ) )
    include 'inc/feature_drum.php';

include 'inc/newsletter.php';
include 'inc/footer.php';
?>