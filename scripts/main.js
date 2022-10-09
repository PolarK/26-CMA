$.getScript("./scripts/user.js");
$.getScript("./scripts/submission.js");
$.getScript("./scripts/profile.js");
$.getScript("./scripts/conference.js");

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
    dynamicSubmissionSearch();
    dynamicConferenceSearch();

    $("button").click(function (event) {
        var curentPath = window.location.pathname;

        var rawID = event.target.id;
        var tableID = "#field-".concat(rawID);

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

                case "/manageEvents": 
                    editConferenceData(rawID, tableID);
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

                case "/manageEvents":
                    disableConferenceData(rawID, tableID, "disable", "0");
                    break;
            }
        }

        if (rawID.includes('enable')) {
            switch (curentPath) {
                case "/manageEvents":
                    disableConferenceData(rawID, tableID, "enable", "1");
                    break;
            }
        }

    });


});
