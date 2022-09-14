$(document).ready(function(){
    // Load register form content when 'register' is clicked
/*  
    $('#displayRegisterForm').click(function(){
       $('#content').load('src\\pages\\register.php');
    });
*/
    window.onload(event){
        alert('a');
    }

    $('form input').blur(function(){
        if(!$(this).val()){
            $(this).css('border','1px solid red');
        } else{
            $(this).css('border','1px solid green');
        }
    });

    showToast(){
        // Function to be called when login or register
        var login = document.getElementById('login');
        var register = document.getElementById('register');
        var loginfail = document.getElementById('loginfail');

        // True, False, register to be changed to login validation
        if (true) {
            login.className = 'show';
            setTimeout(function () { login.className = login.className.replace("show", ""); }, 8000);
        }

        login.className = 'show';

        if (false) {
            loginfail.className = 'show';
            setTimeout(function () { loginfail.className = loginfail.className.replace("show", ""); }, 8000);
        }

        if (register) {
            register.className = 'show';
            setTimeout(function () { register.className = register.className.replace("show", ""); }, 8000);
        }
    }
});