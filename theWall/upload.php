<?php
/*
 * FILE TO ADD AN ITEM BY UPLOADING AN IMAGE.
 * ADMIN PERMISSION REQUIRED.
 */
include "inc/header.php";
include 'inc/dbconnect.php';

// Checking if user has admin privileges:
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    ?>
    <!-- Image upload form -->
    <div class = "card col-lg-4 mx-auto mt-4 mb-4 d-block">
        <div class = "card-body">
            <form method="post" action="<?php
            echo htmlentities( $_SERVER[ 'PHP_SELF' ] );
            ?>"  enctype="multipart/form-data">
                <label class="form-control-label" for="productImage">Upload product image first to add a new instrument:</label>
                <input id="productImage" type="file" class="form-control mb-2" name="productImage">
                <input type="submit" id="uploadImage" class="btn btn-danger btn-sm" value = "Upload Image">
                <button type="button" class="btn btn-danger btn-sm my-2 my-sm-0" data-toggle="modal" data-target="#addProduct">Add Product</button><br>
                <a href="/admin" class="btn btn-danger btn-sm my-2">Go back</a>
            </form>

            <?php

            // To upload images on request.
            if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
                $target_dir    = "img/";
                $target_file   = $target_dir . basename( $_FILES[ "productImage" ][ "name" ] );
                // var_dump($target_file); //FOR DEBUG ONLY
                $uploadOk      = 1;
                $imageFileType = pathinfo( $target_file, PATHINFO_EXTENSION );

                // Check if file already exists
                if ( file_exists( $target_file ) ) {
                    echo "File already exists... on the server";
                    $uploadOk = 0;
                } //file_exists( $target_file )

                // Check file size if you want
                if ( $_FILES[ "productImage" ][ "size" ] > 500000 ) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                } //$_FILES[ "productImage" ][ "size" ] > 500000
                // Allow certain file formats
                if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                } //$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"

                if ( $uploadOk == 1 ) {
                    if ( move_uploaded_file( $_FILES[ "productImage" ][ "tmp_name" ], $target_file ) ) {
                        echo "The file " . basename( $_FILES[ "productImage" ][ "name" ] ) . " has been uploaded.";
                        $_POST[ 'targetImage' ] = $target_file;
                    } //move_uploaded_file( $_FILES[ "productImage" ][ "tmp_name" ], $target_file )
                    else {
                        echo "Sorry, there was an error uploading your file...";
                    }
                } //$uploadOk == 1
            } //$_SERVER[ 'REQUEST_METHOD' ] == 'POST'
            ?>
        </div>
    </div>


    <?php
    // Admin forms
    include "addProduct.php";
    include "inc/footer.php";
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

