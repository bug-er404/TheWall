<?php // AJAX TEST FILE ?>


<!--<style type="text/css">-->

<!--    .star_rated { color: gold; }-->
<!--    .star {text-shadow: 0 0 1px #F48F0A; cursor: pointer;  }-->
<!--</style>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!--<script type="text/javascript">-->
<!--    function ratestar($id, $rate){-->
<!--        $.ajax({-->
<!--            type: 'POST',-->
<!--            url: 'rating.php',-->
<!--            data: 'functionName=update&productid='+$id+'&rating='+$rate,-->
<!--            success: function(data) {-->
<!--                location.reload();-->
<!--                console.log(data);-->
<!--            }-->
<!--        });-->
<!--    }-->
<!--</script>-->
<?php
//include 'rating.php';
//include 'inc/dbconnect.php';
//
//$id=1;
//// Query for rating
//$publicrate = $db->prepare("select ratingID, COUNT(rating) as ratingNum, FORMAT((SUM(rating) / COUNT(rating)),2) as avgRating
//                                     from Rating where guitarID = ? group by guitarID ");
//
//// Get the rating
//$publicrate->bindParam(1, $id);
//$publicrate->execute();
//$publicrate = $publicrate->fetchAll(PDO::FETCH_NUM);
//
//
//?>
<!--<table>-->
<!--    <thead>-->
<!--    <th>Product</th>-->
<!--    <th>Rating</th>-->
<!--    </thead>-->
<!--    --><?php
//    foreach($publicrate as $data) {
//        ?>
<!--        <tr>-->
<!--            <td>--><?php //echo $data[1]; ?><!--</td>-->
<!--            <td>-->
<!--                <div class="star">-->
<!--                    --><?php
//                    for($i = 1; $i <= 5; $i++) {
//                        if($i <= $data[2]) {
//                            ?>
<!--                            <span class="star_rated" onclick="ratestar(--><?php //echo $data[0]; ?>//, <?php //echo $i; ?>//)">&#x2605;</span>
//                        <?php //}  else {  ?>
<!--                            <span onclick="ratestar(--><?php //echo $data[0]; ?>//, <?php //echo $i; ?>//)">&#x2605;</span>
//                        <?php // }
//                    }
//                    ?>
<!--                </div>-->
<!--            </td>-->
<!--        </tr>-->
<!--        --><?php
//    }
//    ?>
<!--</table>-->
