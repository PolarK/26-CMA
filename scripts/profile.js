// similar to import function but jQuery style 
$.getScript("./scripts/toast.js");
$.getScript("./scripts/button.js");


function editProfileData(rawID, tableID) {
    let editBox = "#box-".concat(rawID);

    // create buttons inside 'editBox' element's id
    $(editBox).append(
        createButton(['accept', rawID, 'success', 'check'], rawID, tableID),
        createButton(['cancel', rawID, 'danger', 'times'], rawID, tableID),
    );

    // when '✓' is clicked, update the table, show message, and revert button to original state 
    $("#accept-".concat(rawID)).click(function () {
        userToast([
            'Action Completed!',
            'Your profile was successfully changed.',
            'success'
        ]);

        removeButton("#accept-", rawID, tableID);
        removeButton("#cancel-", rawID, tableID);

        // hand the data to userHandler to process the changes
        $.post('./scripts/handlers/formHandler.php', {
            editByProfile: event.target.id,
            UserId: $('#uID'.concat(id)).text(),
            UserFirstName: $('#uFName'.concat(id)).val(),
            UserLastName: $('#uLName'.concat(id)).val(),
            UserDOB: $('#uDOB'.concat(id)).val(),
            UserEmail: $('#uEmail'.concat(id)).val(),
            UserPhoneNo: $('#uPhoneNo'.concat(id)).val(),
        }, function (data) {
            // bugs where input successfully submitted, button doesnt work
            $('#searchResult').html(data);
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
