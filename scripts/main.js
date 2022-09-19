function displayUsers(){
    $('#displayUsers').Tabledit({
        url: 'scripts/handlers/userHandler.php',
        columns: {
            identifier: [0, 'UserId'],
            editable: [
                [1, 'UserFirstName'],
                [2, 'UserLastName'],
                [3, 'UserDOB'],
                [4, 'UserEmail'],
                [5, 'UserPhoneNo'],
            ]
        }, 
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == "delete") {
                $("#" + data.id).remove();
                $("#displayUsers").DataTable().ajax.reload();
            }
        },
    });
}

$(document).ready(function(){
    //Form input dynamic styling
    $('form input').blur(function(){
        if(!$(this).val()){
            $(this).css('border','1px solid red');
        } else{
            $(this).css('border','1px solid green');
        }
    });

    //User Manager
    $('#searchUID').keyup(function(){
        var searchUID = $('#searchUID').val();

        $.post('./scripts/handlers/searchHandler.php', {searchName : searchUID}, function(data){
            $('#searchResult').html(data);
            displayUsers();
        });
    });

    $('#searchFName').keyup(function(){
        var searchFName = $('#searchFName').val();

        $.post('./scripts/handlers/searchHandler.php', {searchName : searchFName}, function(data){
            $('#searchResult').html(data);
            displayUsers();
        });
    });

    displayUsers();
});

//! Vanila JS (Not in jquery syntax)
function showToast(){
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