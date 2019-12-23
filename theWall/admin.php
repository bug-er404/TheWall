<?php
/*
 * ADMIN PANEL WITH ADMIN OPTIONS TO INTERACT WITH THE DATABASE.
 * ADMIN PERMISSION REQUIRED.
 */
// Checking if user has admin privileges:
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    include "inc/header.php";
    ?>
    <h1 id="guitars" class="display-4 text-light text-center mx-auto mt-3">Admin page</h1>
    <div class="container row mx-auto mt-3 pt-3 pb-4">
        <div class="col-lg-7">
            <div class="card border-secondary mb-3">
                <div class="card-body text-secondary">
                    <h3 class="card-header">Add a Product</h3>
                    <a href="/upload" class="btn btn-danger btn-sm">Add instrument</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-secondary mb-3">
                <div class="card-body text-secondary">
                    <h3 class="card-header"> Update Price of a Product</h3>
                    <a class="btn btn-danger btn-sm" href="/updatePrice?guitars">Guitars</a>
                    <a class="btn btn-danger btn-sm" href="/updatePrice?basses">Basses</a>
                    <a class="btn btn-danger btn-sm"href="/updatePrice?drums">Drums</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-secondary mb-3">
                <div class="card-body text-secondary">
                    <h3 class="card-header">Delete a Product</h3>
                    <a class="btn btn-danger btn-sm" href="/deleteItem?guitars">Guitars</a>
                    <a class="btn btn-danger btn-sm" href="/deleteItem?basses">Basses</a>
                    <a class="btn btn-danger btn-sm"href="/deleteItem?drums">Drums</a>                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-secondary mb-3">
                <div class="card-body text-secondary">
                    <h3 class="card-header">Add a new Brand</h3>
                    <form action="addBrand" method="POST">
                        <div class="form-group">
                            <label for="brandName">Brand Name:</label>
                            <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Add Brand Name">
                        </div>
                        <div class="form-group">
                            <label for="brandDescription">Brand Description:</label>
                            <textarea aria-label="Description" class="form-control" id="brandDescription" name="brandDescription" placeholder="Add Brand Description"></textarea>
                        </div>
                        <button id="addBrand" type="submit" class="btn btn-danger btn-sm">Add Brand</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-secondary mb-3">
                <div class="card-body text-secondary">
                    <h3 class="card-header">Delete a Brand</h3>
                    <form action="deleteBrand" method="POST">
                        <label for="brandid">Select Brand to Delete:</label>
                        <select class="custom-select form-control" id="brandid" name="brandid">
                            <?php
                            include 'inc/dbconnect.php';
                            try {
                                $insert  = $db->query( "select brandID, brandName from Brand" );
                                // Execute the insert
                                $results = $insert->fetchAll( PDO::FETCH_NUM );

                                foreach ( $results as $item ) {
                                    ?>
                                    <option value="<?php
                                    echo $item[ 0 ];
                                    ?>"><?php
                                        echo $item[ 1 ];
                                        ?></option>
                                    <?php
                                } //$results as $item
                            }
                            catch ( Exception $e ) {
                                echo "Error fetching Brands!" . $e->getMessage();
                            }
                            ?>
                        </select>
                        <button id="deleteBrand" type="submit" class="btn btn-danger btn-sm">Delete Brand</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-secondary mb-3">
                <div class="card-body text-secondary">
                    <h3 class="card-header">Edit Brand Information</h3>
                    <form action="updateBrand" method="POST">
                        <label for="updatebrandid">Select Brand to Update:</label>
                        <select class="custom-select form-control" id="updatebrandid" name="updatebrandid">
                            <?php
                            try {
                                $insert  = $db->query( "select brandID, brandName from Brand" );
                                // Execute the insert
                                $results = $insert->fetchAll( PDO::FETCH_NUM );

                                foreach ( $results as $item ) {
                                    ?>
                                    <option value="<?php
                                    echo $item[ 0 ];
                                    ?>"><?php
                                        echo $item[ 1 ];
                                        ?></option>
                                    <?php
                                } //$results as $item
                            }
                            catch ( Exception $e ) {
                                echo "Error fetching Brands!" . $e->getMessage();
                            }
                            ?>
                        </select>
                        <div class="form-group">
                            <label for="newbrandName">New Brand Name:</label>
                            <input type="text" class="form-control" id="newbrandName" name="newbrandName" placeholder="Add New Brand Name">
                        </div>
                        <div class="form-group">
                            <label for="newbrandDescription">New Brand Description:</label>
                            <textarea aria-label="Description" class="form-control" id="newbrandDescription" name="newbrandDescription" placeholder="Add New Brand Description"></textarea>
                        </div>
                        <button id="updateBrand" type="submit" class="btn btn-danger btn-sm">Update Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
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


include 'inc/footer.php';
include 'register.php';
?>
