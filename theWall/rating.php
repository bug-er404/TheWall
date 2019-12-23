<?php
/*
 * FILE TO PROCESS GIVEN RATINGS
 *
 */

include 'inc/dbconnect.php';

if ( $_POST[ 'instr' ] == 'guitar' ) {

    $insert = $db->prepare( "insert into Rating (guitarID,rating) values (?,?)" );
    // Create insert statements as variable
    $insert->bindParam( 1, $_POST[ 'productid' ] );
    $insert->bindParam( 2, $_POST[ 'rating' ] );
    $insert->execute();

    return 'Data Updated Successfully';
} //$_POST[ 'instr' ] == 'guitar'

if ( $_POST[ 'instr' ] == 'bass' ) {

    $insert = $db->prepare( "insert into Rating (bassID,rating) values (?,?)" );
    // Create insert statements as variable
    $insert->bindParam( 1, $_POST[ 'productid' ] );
    $insert->bindParam( 2, $_POST[ 'rating' ] );
    $insert->execute();

    return 'Data Updated Successfully';
} //$_POST[ 'instr' ] == 'bass'

if ( $_POST[ 'instr' ] == 'drum' ) {

    $insert = $db->prepare( "insert into Rating (drumID,rating) values (?,?)" );
    // Create insert statements as variable
    $insert->bindParam( 1, $_POST[ 'productid' ] );
    $insert->bindParam( 2, $_POST[ 'rating' ] );
    $insert->execute();

    return 'Data Updated Successfully';
} //$_POST[ 'instr' ] == 'drum'
