$.getScript("./scripts/user.js");

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
    dynamicUserSearch();

    $("button").click(function (event) {
        var rawID = event.target.id;
        var tableID = "#field-".concat(rawID);

        if (rawID.includes('edit')) {
            editUserData(rawID, tableID);
        }

        if (rawID.includes('disable')) {
            disableUserData(rawID);
        }

    });
    /* END OF User Manager */


});
