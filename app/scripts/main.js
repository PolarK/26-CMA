$(document).ready(function(){
    // Load register form content when 'register' is clicked
    $('#displayRegisterForm').click(function(){
       $('#content').load('src\\pages\\register.php');
    });

    $('form input').blur(function(){
        if(!$(this).val()){
            $(this).css('border','1px solid red');
        } else{
            $(this).css('border','1px solid green');
        }
    });
});