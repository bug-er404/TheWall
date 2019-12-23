
$(document).ready(function () {
    // Hiding response elements
    // console.log("document ready!");
    $('#payment').hide();
    $('#nameError').hide();
    $('#verifyError').hide();
    $('#passwordError').hide();
    $('#updateDone').hide();

    // Payment option for premium members
    $('#premium').on("click",function () {
        if ($(this).is(":checked")) {
            $('#payment').show();
        } else
            $('#payment').hide();
    });


    // Registration form submission
    $('#submit').on("click", function () {
        var nameLength = $('#name').val().length;
        if (nameLength < 4
            || $('#password').val() !== $('#verifypassword').val()
            ||$('#password').val().length<5) {
            event.preventDefault();
        }
    });

    // Registration name check
    $('#name').keyup(function () {
        let nameLength = $('#name').val().length;
        if (nameLength < 4) {
            $('#nameError').show();
        } else
            $('#nameError').hide();
    });

    // Check password
    $('#password').on("keyup", function(){
        let passwordLength = $('#password').val().length;
        if(passwordLength < 5){
            $('#passwordError').show();
        }
        else{
            $('#passwordError').hide();
        }
    });

    // Verify password
    $('#verifypassword').keyup(function(){
        if($('#password').val() !== $('#verifypassword').val()){
            $('#verifyError').show();
        }
        else{
            $('#verifyError').hide();
        }
    });

    // Enable popovers
    $(function () {
        $('[data-toggle="popover"]').popover();
    });



});

// Function for unsetting rating:
function rateclick(num){
    $('#productRating').css("pointer-events", "none");

    // Setting stars
    for(let i=4;i>num;i--){
        let span = '#'+i;
        $(span)[0].setAttribute('src', 'img/rate_empty.png');
    }

    // Setting value
    $('#productRating input').val(  parseInt(num)+1);

}