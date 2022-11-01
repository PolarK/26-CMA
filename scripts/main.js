$.getScript("./scripts/user.js");
$.getScript("./scripts/submission.js");
$.getScript("./scripts/profile.js");
$.getScript("./scripts/conference.js");

$(document).ready(function () {
    dynamicUserSearch();
    dynamicSubmissionSearch();
    dynamicConferenceSearch();

    //Form input dynamic styling
    $('form input').blur(function () {
        if (!$(this).val()) {
            $(this).css('border', '1px solid red');
        } else {
            $(this).css('border', '1px solid green');
        }
    });

    $("button").click(function (event) {
        var curentPath = window.location.pathname;

        var rawID = event.target.id;
        var tableID = "#field-".concat(rawID);
        var id = rawID.split("-").pop();

        if (rawID.includes('edit')) {
            switch (curentPath) {
                case "/manageUsers":
                    editUserData(rawID, tableID);
                    break;

                case "/profile":
                    $('#uPass-'.concat(id)).val(""); 
                    editProfileData(rawID, tableID);
                    break;

                case "/manageConferences": 
                    editConferenceData(rawID, tableID);
                break; 
            }
        }

        if (rawID.includes('disable')) {
            switch (curentPath) {
                case "/manageUsers":
                    disableUserData(rawID, tableID);
                    break;

                case "/manageConferences":
                    disableConferenceData(rawID, tableID, "disable", "0");
                    break;
            }
        }

        if (rawID.includes('enable')) {
            switch (curentPath) {
                case "/manageConferences":
                    disableConferenceData(rawID, tableID, "enable", "1");
                    break;
            }
        }

    });


});
