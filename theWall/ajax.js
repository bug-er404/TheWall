$(function () {
    $("#addReview input").on("click", function() {
        let rating = $("#productRating").val();
        let review = $("#productReview").val();

        $.ajax({
            type: 'POST',
            url: 'reviews.php',
            data: 'category='+categoryID+'&postid='+postID+'&rate='+rating+'&productReview='+review,
            success : function(resp) {
                if(ratingNum > 1)
                    alert("Thank you for your participation! You have rated " + postID + " with " + rating + " stars.");
                else
                    alert("Thank you for your participation! You have rated " + postID + " with " + rating + " star.");

                $( ".rating input" ).each(function() {
                    if($(".rating").val() <= parseInt(resp[1])){
                        $(this).attr('checked', 'checked');
                    }else{
                        $(this).prop( "checked", false );
                    }
                });

                $("#ratingScore").text(resp[1]);
                $("#memberRaters").text(resp[1]);

            }
        });
    });

    $("#save-review").on("click", function () {
        alert("Your review has been saved successfully! Click \"Post Review\" to post it on the website.");
    });
});