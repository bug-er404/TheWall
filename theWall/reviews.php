<?php
/*
 * FILE TO PROCESS REVIEWS GIVEN BY USERS
 *
 */
include 'inc/dbconnect.php';

if ( !empty( $_POST[ 'rate' ] ) && !empty( $_POST[ 'productReview' ] ) ) {
    if ( ( $_POST[ 'instr' ] ) == '1' ) {

        $insert = $db->prepare( "insert into Review (guitarID,rating, reviewtext) values (?,?,?)" );
        // Create insert statements as variable
        $insert->bindParam( 3, $_POST[ 'productReview' ] );
        $insert->bindParam( 2, $_POST[ 'rate' ] );
        $insert->bindParam( 1, $_POST[ 'id' ] );
        $insert->execute();
    } //( $_POST[ 'instr' ] ) == '1'

    if ( ( $_POST[ 'instr' ] ) == '2' ) {

        $insert = $db->prepare( "insert into Review (bassID,rating, reviewtext) values (?,?,?)" );
        // Create insert statements as variable
        $insert->bindParam( 3, $_POST[ 'productReview' ] );
        $insert->bindParam( 2, $_POST[ 'rate' ] );
        $insert->bindParam( 1, $_POST[ 'id' ] );
        $insert->execute();

    } //( $_POST[ 'instr' ] ) == '2'

    if ( ( $_POST[ 'instr' ] ) == '3' ) {

        $insert = $db->prepare( "insert into Review (drumID,rating,reviewtext) values (?,?,?)" );
        // Create insert statements as variable
        $insert->bindParam( 3, $_POST[ 'productReview' ] );
        $insert->bindParam( 2, $_POST[ 'rate' ] );
        $insert->bindParam( 1, $_POST[ 'id' ] );
        $insert->execute();

    } //( $_POST[ 'instr' ] ) == '3'
    ?>
    <script type="text/javascript">
        alert("Review recorded successfully. Thank you!");
        window.location.href = document.referrer;
    </script>
    <?php
} //!empty( $_POST[ 'rate' ] ) && !empty( $_POST[ 'productReview' ] )
?>
<script type="text/javascript">
    alert("Problem recording review. Try again!");
    window.location.href = '/';
</script>
