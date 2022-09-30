$.getScript("./scripts/user.js");
$.getScript("./scripts/submission.js");
$.getScript("./scripts/profile.js");

$(document).ready(function () {
    //Form input dynamic styling
    $('form input').blur(function () {
        if (!$(this).val()) {
            $(this).css('border', '1px solid red');
        } else {
            $(this).css('border', '1px solid green');
        }
    });

    dynamicUserSearch();
    console.log("/\\ ");
    dynamicSubmissionSearch();

    $("button").click(function (event) {
        var curentPath = window.location.pathname;

        var rawID = event.target.id;
        var tableID = "#field-".concat(rawID);

        console.log(rawID);

        if (rawID.includes('edit')) {
            switch (curentPath) {
                case "/manageUsers":
                    editUserData(rawID, tableID);
                    break;

                case "/manageSubmissions":
                    editSubmissionData(rawID, tableID);
                    break;
                case "/profile":
                    editProfileData(rawID, tableID);
                    break;
            }
        }

        if (rawID.includes('disable')) {
            switch (curentPath) {
                case "/manageUsers":
                    disableUserData(rawID, tableID);
                    break;

                case "/manageSubmissions":
                    disableSubmissionData(rawID, tableID);
                    break;
            }
        }

    });

    /* START OF VIEW SUBMISSIONS */

    $('#rSearchCID').keyup(function () {
        var rSearchCID = $('#rSearchCID').val();

        $.post('./scripts/handlers/searchHandler.php', { rSearchByCID: rSearchCID }, function (data) {
            $('#rSearchResult').html(data);
        });
    });

    $('#rSearchUID').keyup(function () {
        var rSearchUID = $('#rSearchUID').val();

        $.post('./scripts/handlers/searchHandler.php', { rSearchByUID: rSearchUID }, function (data) {
            $('#rSearchResult').html(data);
        });
    });

    $('#rSearchUFName').keyup(function () {
        var rSearchUFName = $('#rSearchUFName').val();

        $.post('./scripts/handlers/searchHandler.php', { rSearchByUFName: rSearchUFName }, function (data) {
            $('#rSearchResult').html(data);
        });
    });

    $('#rSearchULName').keyup(function () {
        var rSearchULName = $('#rSearchULName').val();

        $.post('./scripts/handlers/searchHandler.php', { rSearchByULName: rSearchULName }, function (data) {
            $('#rSearchResult').html(data);
        });
    });

    $('#rSearchSubTime').keyup(function () {
        var rSearchSubTime = $('#rSearchSubTime').val();

        $.post('./scripts/handlers/searchHandler.php', { rSearchBySubTime: rSearchSubTime }, function (data) {
            $('#rSearchResult').html(data);
        });
    });

    $('#rSearchSubStatus').keyup(function () {
        var rSearchSubStatus = $('#rSearchSubStatus').val();

        $.post('./scripts/handlers/searchHandler.php', { rSearchBySubStatus: rSearchSubStatus }, function (data) {
            $('#rSearchResult').html(data);
        });
    });

    /* END OF VIEW SUBMISSIONS */


});
