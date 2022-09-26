function displayUsers() {
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
            $.toast('User has been successfully edited.');
            if (data.action == "delete") {
                $("#" + data.id).remove();
                $("#displayUsers").DataTable().ajax.reload();
            }
        },
    });
}

function displaySubmissions() {
    $('#displaySubmissions').Tabledit({
        url: 'scripts/handlers/submissionHandler.php',
        columns: {
            identifier:
                [0, 'SubmissionId'],
            editable: [
                [1, 'UserId'],
                [2, 'SubmissionTimestamp'],
                [3, 'SubmissionPath'],
            ]
        },
        restoreButton: false,
        onSuccess: function (data, textStatus, jqXHR) {
            if (data.action == "delete") {
                $("#" + data.id).remove();
                $("#displaySubmissions").DataTable().ajax.reload();
            }
        },
    });
}

$(document).ready(function () {
    //Form input dynamic styling
    $('form input').blur(function () {
        if (!$(this).val()) {
            $(this).css('border', '1px solid red');
        } else {
            $(this).css('border', '1px solid green');
        }
    });

    /* START OF User Manager */
    $('#searchUID').keyup(function () {
        var searchUID = $('#searchUID').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByUID: searchUID }, function (data) {
            $('#searchResult').html(data);
            displayUsers();
        });
    });

    $('#searchFName').keyup(function () {
        var searchFName = $('#searchFName').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByFName: searchFName }, function (data) {
            $('#searchResult').html(data);
            displayUsers();
        });
    });

    $('#searchLName').keyup(function () {
        var searchLName = $('#searchLName').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByLName: searchLName }, function (data) {
            $('#searchResult').html(data);
            displayUsers();
        });
    });

    $('#searchDOB').keyup(function () {
        var searchDOB = $('#searchDOB').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByDOB: searchDOB }, function (data) {
            $('#searchResult').html(data);
            displayUsers();
        });
    });

    $('#searchEmail').keyup(function () {
        var searchEmail = $('#searchEmail').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByEmail: searchEmail }, function (data) {
            $('#searchResult').html(data);
            displayUsers();
        });
    });

    $('#searchPhoneNo').keyup(function () {
        var searchPhoneNo = $('#searchPhoneNo').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByPhoneNo: searchPhoneNo }, function (data) {
            $('#searchResult').html(data);
            displayUsers();
        });
    });

    /* END OF User Manager */

    
    /* START OF Submission Manager */

    $('#searchSID').keyup(function () {
        var searchSID = $('#searchSID').val();

        $.post('./scripts/handlers/searchHandler.php', { searchBySID: searchSID }, function (data) {
            $('#searchResult').html(data);
            displaySubmissions();
        });
    });

    //! Will eventually changed to include the user's name instead of their id
    $('#searchName').keyup(function () {
        var searchName = $('#searchName').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByName: searchName }, function (data) {
            $('#searchResult').html(data);
            displaySubmissions();
        });
    });

    $('#searchSID').keyup(function () {
        var searchSID = $('#searchSID').val();

        $.post('./scripts/handlers/searchHandler.php', { searchBySID: searchSID }, function (data) {
            $('#searchResult').html(data);
            displaySubmissions();
        });
    });

    $('#searchTimestamp').keyup(function () {
        var searchTimestamp = $('#searchTimestamp').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByTimestamp: searchTimestamp }, function (data) {
            $('#searchResult').html(data);
            displaySubmissions();
        });
    });

    $('#searchPath').keyup(function () {
        var searchPath = $('#searchPath').val();

        $.post('./scripts/handlers/searchHandler.php', { searchByPath: searchPath }, function (data) {
            $('#searchResult').html(data);
            displaySubmissions();
        });
    });

    /* END OF Submission Manager */
    displayUsers();
    displaySubmissions();

});

//! Vanila JS (Not in jquery syntax)
function showToast() {
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