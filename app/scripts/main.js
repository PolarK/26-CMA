/* Simple function to check whether the input is empty */
$(document).ready(function(){
    $('#LoginForm input').blur(function(){
        if(!$(this).val()){
            $(this).css('border','1px solid red');
        } else{
            $(this).css('border','1px solid green');
        }
    });
});