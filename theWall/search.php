<?php
/*
 * SEARCH PAGE
 * CAN SEARCH BY NAME AND BRAND
 */

include 'inc/header.php';

// Recommender flag to display recommended products according to the search
$recommenderFlag = 0;

// Sanitize input:
$_GET     = filter_input_array( INPUT_GET, FILTER_SANITIZE_STRING );
$criteria = htmlspecialchars( $_GET[ 'value' ] );
?>
<h1 id="searchResult" class="display-4 text-center my-5 text-light mx-auto disableBlur">Search result for
    <em>
        <?php
        echo $criteria;
        ?>
    </em>:
</h1>
<?php
// Checking for generic searches and redirecting
// to main generic page:
if ( $criteria == "guitar" || $criteria == "guitars" ) {
    ?>
    <script type="text/javascript">
        window.location.href = '/instruments?guitars=viewall';
    </script>
    <?php
} //$criteria == "guitar" || $criteria == "guitars"
if ( $criteria == "drum" || $criteria == "drums" ) {
    ?>
    <script type="text/javascript">
        window.location.href = '/instruments?drums=viewall';
    </script>
    <?php
} //$criteria == "drum" || $criteria == "drums"
if ( $criteria == "bass" || $criteria == "basses" ) {
    ?>
    <script type="text/javascript">
        window.location.href = '/instruments?basses=viewall';
    </script>
    <?php
} //$criteria == "bass" || $criteria == "basses"

?>

<div class="container row mx-auto">
    <?php
    // Checking if search entry is more than two characters
    if ( strlen( $criteria ) < 3 ) {
        ?>
        <p class = "text-light lead">
            <?php
            echo "Search entry should be more than 2 characters!" . '<br />';
            ?>
        </p>
        <?php
    } //strlen( $criteria ) < 3
    else {
        // Variable to hold all results
        $results;
        // connect to db
        include 'inc/dbconnect.php';
        // Get results from Guitars
        $insert    = $db->prepare( "select guitarID,guitarImage, guitarName,guitarDescription from Guitar join Brand using (brandID) where guitarName like ?
OR brandName like ? " );
        $searchfor = "%" . $criteria . "%";
        $insert->bindParam( 1, $searchfor );
        $insert->bindParam( 2, $searchfor );
        $insert->execute();
        $searchresult = $insert->fetchAll( PDO::FETCH_NUM );
        if ( count( $searchresult ) != 0 ) {
            $recommenderFlag = 'guitar';
        } //count( $searchresult ) != 0
        foreach ( $searchresult as $entry ) {
            ?>
            <div class="col-md-6 col-lg-6">
                <div class="card border-secondary mb-3">
                    <a href="/single_instrument?guitar=<?php
                    echo $entry[ 0 ];
                    ?>" class="stretched-link">
                        <img class="card-img-top" src="<?php
                        echo $entry[ 1 ];
                        ?>" alt="Guitar Photo">
                        <div class="card-body text-secondary">
                            <h1 class="card-header text-center">
                                <?php
                                echo $entry[ 2 ];
                                ?>
                            </h1>
                            <p class="card-text text-center">
                                <?php
                                echo $entry[ 3 ];
                                ?>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        } //$searchresult as $entry
        // Get results from Basses
        $insert    = $db->prepare( "select bassID, bassImage, bassName, bassDescription from Bass join Brand using (brandID) where bassName like ?
OR brandName like ? " );
        $searchfor = "%" . $criteria . "%";
        $insert->bindParam( 1, $searchfor );
        $insert->bindParam( 2, $searchfor );
        $insert->execute();
        $searchresult1 = $insert->fetchAll( PDO::FETCH_NUM );
        if ( count( $searchresult1 ) != 0 ) {
            $recommenderFlag = 'bass';
        } //count( $searchresult1 ) != 0
        foreach ( $searchresult1 as $entry ) {
            ?>
            <div class="col-md-6 col-lg-6">
                <div class="card border-secondary mb-3">
                    <a href="/single_instrument?guitar=<?php
                    echo $entry[ 0 ];
                    ?>" class="stretched-link">
                        <img class="card-img-top" src="<?php
                        echo $entry[ 1 ];
                        ?>" alt="Guitar Photo">
                        <div class="card-body text-secondary">
                            <h1 class="card-header text-center">
                                <?php
                                echo $entry[ 2 ];
                                ?>
                            </h1>
                            <p class="card-text text-center">
                                <?php
                                echo $entry[ 3 ];
                                ?>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        } //$searchresult1 as $entry
        // Get results from Drums
        $insert    = $db->prepare( "select drumID, drumImage, drumName, drumDescription from Drum join Brand using (brandID) where drumName like ?
OR brandName like ? " );
        $searchfor = "%" . $criteria . "%";
        $insert->bindParam( 1, $searchfor );
        $insert->bindParam( 2, $searchfor );
        $insert->execute();
        $searchresult2 = $insert->fetchAll( PDO::FETCH_NUM );
        if ( count( $searchresult2 ) != 0 ) {
            $recommenderFlag = 'drum';
        } //count( $searchresult2 ) != 0
        foreach ( $searchresult2 as $entry ) {
            ?>
            <div class="col-md-6 col-lg-6">
                <div class="card border-secondary mb-3">
                    <a href="/single_instrument?guitar=<?php
                    echo $entry[ 0 ];
                    ?>" class="stretched-link">
                        <img class="card-img-top" src="<?php
                        echo $entry[ 1 ];
                        ?>" alt="Guitar Photo">
                        <div class="card-body text-secondary">
                            <h1 class="card-header text-center">
                                <?php
                                echo $entry[ 2 ];
                                ?>
                            </h1>
                            <p class="card-text text-center">
                                <?php
                                echo $entry[ 3 ];
                                ?>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        } //$searchresult2 as $entry
        $results = array_merge( $searchresult, $searchresult1, $searchresult2 );
        if ( count( $results ) == 0 ) {
            ?>
            <p class="text-light lead">
            <?php
            echo $criteria . " not found";
        } //count( $results ) == 0
        ?>
        </p>
        <?php
    }
    ?>
</div>
<?php
// Recommendation:
if ( $recommenderFlag == 'guitar' ) {
    include 'inc/feature_guitar.php';
} //$recommenderFlag == 'guitar'
elseif ( $recommenderFlag == 'bass' ) {
    include 'inc/feature_bass.php';
} //$recommenderFlag == 'bass'
elseif ( $recommenderFlag == 'drum' ) {
    include 'inc/feature_drum.php';
} //$recommenderFlag == 'drum'
else {
    include 'inc/feature_guitar.php';
}
include 'inc/newsletter.php';
include 'inc/footer.php';
?>
