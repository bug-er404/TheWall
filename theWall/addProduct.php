<!--=====================================
FORM MODAL TO ADD PRODUCT. ADMIN PERMISSIONS REQUIRED.
=====================================-->
<?php
// Checking if user has admin privileges:
if ( isset( $_COOKIE[ 'admin' ] ) ) {
    ?>
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="new product form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new product to The Wall
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- PRODUCT form -->
                    <form action = "addRequest" method = "POST" enctype="multipart/form-data">
                        <h5 class="mb-4">Add new product:
                        </h5>
                        <div class="form-group">
                            <label class="form-control-label" for="newProduct">Product Name:
                            </label>
                            <input id="newProduct" type="text" class="form-control" name="newProduct" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="productPrice">Product Price:
                            </label>
                            <input id="productPrice" type="text" class="form-control" name="productPrice" placeholder="Enter Product Price">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="productDesc">Product Description:
                            </label>
                            <input id="productDesc" type="text" class="form-control" name="productDesc" placeholder="Enter Product Description">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="newProduct">Product Image:
                            </label>
                            <input id="targetImage" type="text" readonly class="form-control" name="targetImage" value="<?php
                            echo $_POST[ 'targetImage' ];
                            ?>">
                        </div>
                        <div class="form-group">
                            <label for="brandid">Brand Name:
                            </label>
                            <select class="custom-select form-control" id="brandid" name="brandid">
                                <option value="2">Gibson
                                </option>
                                <option value="3">Yamaha
                                </option>
                                <option value="4">Epiphone
                                </option>
                                <option value="7">Fender
                                </option>
                                <option value="8">PRS
                                </option>
                                <option value="9">Ibanez
                                </option>
                                <option value="10">Pearl
                                </option>
                                <option value="11">Gretsch
                                </option>
                                <option value="12">Sterling
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="productSpecs">Product Specifications:
                            </label>
                            <input id="productSpecs" type="text" class="form-control" name="productSpecs" placeholder="Enter Product Specifications">
                        </div>
                        <div class="form-group">
                            <label for="feature">Feature Product:
                            </label>
                            <select class="custom-select form-control" id="feature" name="feature">
                                <option value="Y">YES
                                </option>
                                <option value="N">NO
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Product Category:
                            </label>
                            <select class="custom-select form-control" id="category" name="category">
                                <option value="Guitar">Guitar
                                </option>
                                <option value="Bass">Bass
                                </option>
                                <option value="Drum">Drum
                                </option>
                            </select>
                        </div>
                        <button id="addproduct" type="submit" class="btn btn-danger btn-lg">Add Product
                        </button>
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
?>
<!--  PHP CODE TO DYNAMICALLY LOAD BRANDS          -->
<?php
//            // Connect to database
//            include 'dbconnect.php';
//            try {
//            $insert = $db->query("select brandID, brandName from Brand");
//            // Execute the insert
//            $results->$insert->fetchAll(PDO::FETCH_ASSOC);
//
//            foreach ($results as $item) {
?>
<!--            <option value="-->
<?php //echo $item['brandID']
?>
<!--">-->
<?php //$item['brandName']
?>
<!--</option>-->
<?php
//}
//} catch (Exception $e) {
//    echo "Error fetching Brands!" . $e->getMessage();
//}
//
?>
