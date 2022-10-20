// similar to import function but jQuery style 
$.getScript("./scripts/toast.js");
$.getScript("./scripts/button.js");

function enableProfileButtonClicks() {
    $("button").click(function (conference) {
        var rawID = conference.target.id;
        var tableID = "#field-".concat(rawID);
        
        if (rawID.includes('edit')) {
            editProfileData(rawID, tableID);
        }
    });
};

function editProfileData(rawID, tableID) {
    let editBox = "#box-".concat(rawID);

    // create buttons inside 'editBox' element's id
    $(editBox).append(
        createButton(['accept', rawID, 'success', 'check'], rawID, tableID),
        createButton(['cancel', rawID, 'danger', 'times'], rawID, tableID),
    );

    // when '✓' is clicked, update the table, show message, and revert button to original state 
    $("#accept-".concat(rawID)).click(function () {
        let id = rawID.replace('edit-', '-');


        removeButton("#accept-", rawID, tableID);
        removeButton("#cancel-", rawID, tableID);

        // hand the data to userHandler to process the changes
        $.post('./scripts/handlers/formHandler.php', {
            editByProfile: conference.target.id,
            UserId: $('#uID'.concat(id)).text(),
            UserFirstName: $('#uFName'.concat(id)).val(),
            UserLastName: $('#uLName'.concat(id)).val(),
            UserDOB: $('#uDOB'.concat(id)).val(),
            UserEmail: $('#uEmail'.concat(id)).val(),
            UserPhoneNo: $('#uPhoneNo'.concat(id)).val(),
            UserPassword: $('#uPass'.concat(id)).val(),
        }, function (data) {
            // bugs where input successfully submitted, button doesnt work
            $('#searchResult').html(data);
            enableProfileButtonClicks();
        });
    });

    // when 'X' is clicked, show message, and revert back to original state
    $("#cancel-".concat(rawID)).click(function () {
        let id = rawID.replace('edit-', '-');
        userToast([
            'Action Canceled!',
            'Your profile was not changed.',
            'info'
        ], rawID);

        removeButton("#accept-", rawID, tableID);
        removeButton("#cancel-", rawID, tableID);
    });
}
