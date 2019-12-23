<!-- signup form -->
<hr>
<div class="row py-4 text-muted">
    <div class="col-md col-xl-5">
        <p><strong>Our Promise To You</strong></p>
        <p>We only sell genuine top-grade products and offer the best offers in town! Sign up with your email (We don't spam!)</p>
    </div>
    <div class="col-md col-xl-5 ml-auto">
        <p><strong>Stay up-to-date on offers. Join our Newsletter!</strong></p>
        <form class="form" action = "#" method = "POST">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                <span class="input-group-btn">
                        <button class="btn btn-danger" type="submit" name="newsletter" id="newsletter">Sign up</button>
                </span>
            </div>
        </form>
    </div>
</div>
<hr>

<?php
// Connect to database
include 'dbconnect.php';

if(isset($_POST['email'])) {
    try {
        // Create insert statements as variable
        $insert = $db->prepare("insert into Newsletter
            (email) values (?)");
        // Create insert statements as variable
        $insert->bindParam(1, $_POST['email']);

        // Execute the insert
        $insert->execute();
        ?>
        <script type="text/javascript">
            alert("Registered for newsletter successfully.");
            window.location.href = document.referrer;
        </script>
        <?php
    } catch (Exception $e) {
        echo "Error registering!" . $e->getMessage();
    }
}
?>
