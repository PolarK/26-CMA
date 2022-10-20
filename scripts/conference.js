// similar to import function but jQuery style 
$.getScript("./scripts/toast.js");
$.getScript("./scripts/button.js");

function enableConferenceButtonClicks() {
    $("button").click(function (conference) {
        var rawID = conference.target.id;
        var tableID = "#field-".concat(rawID);

        if (rawID.includes('edit')) {
            editConferenceData(rawID, tableID);
        }

        if (rawID.includes('disable')) {
            disableConferenceData(rawID, tableID, "disable", "0");
        }

        if (rawID.includes('enable')) {
            disableConferenceData(rawID, tableID, "enable", "1");
        }
    });
};


function editConferenceData(rawID, tableID) {
    let editBox = "#box-".concat(rawID);

    // create buttons inside 'editBox' element's id
    $(editBox).append(
        createButton(['accept', rawID, 'success', 'check'], rawID, tableID),
        createButton(['cancel', rawID, 'danger', 'times'], rawID, tableID),
    );

    // when '✓' is clicked, update the table, show message, and revert button to original state 
    $("#accept-".concat(rawID)).click(function () {
        let id = rawID.replace('edit-', '-');

        $.post('./scripts/handlers/formHandler.php', {
            editByConference: conference.target.id,
            ConferenceId: $('#cID'.concat(id)).text(),
            ConferenceTitle: $('#cTitle'.concat(id)).val(),
            ConferenceSDate: $('#cSDate'.concat(id)).val(), 
            ConferenceSTime: $('#cSTime'.concat(id)).val(),
            ConferenceEDate: $('#cEDate'.concat(id)).val(), 
            ConferenceETime: $('#cETime'.concat(id)).val(),
            ConferenceLocation: $('#cLocation'.concat(id)).val(),
            ConferenceStatus: $('#cStatus'.concat(id)).text()
        }, function (data) {

            $('#error_container').html(data);

            if (!$('#err').text()) {      
                var err_contents = $("#error_container").children();
                err_contents.remove();       
                
                $('#searchCResult').html(data); 
                enableConferenceButtonClicks();

                userToast([
                    'Action Completed!',
                    'Conference with the ID of ' + id.replace('-', '') + ' was successfully changed.',
                    'success'
                ]);
            }        
            
        });
    });

    // when 'X' is clicked, show message, and revert back to original state
    $("#cancel-".concat(rawID)).click(function () {
        let id = rawID.replace('edit-', '-');
        userToast([
            'Action Canceled!',
            'Conference with the ID of ' + id.replace('-', '') + ' was <b>not</b> changed.',
            'info'
        ], rawID);

        removeButton("#accept-", rawID, tableID);
        removeButton("#cancel-", rawID, tableID);
    });
}

function disableConferenceData(rawID, tableID, action, status) {
    var disableBox = "#box-".concat(rawID);    
    editTableID = tableID.replace(action, "edit"); 

    $(disableBox).append(
        createButton(['accept', rawID, 'success', 'check'], rawID, tableID),
        createButton(['cancel', rawID, 'danger', 'times'], rawID, tableID),
    );    

    // when '✓' is clicked, update the table, show message, and revert button to original state 
    $("#accept-".concat(rawID)).click(function () {        
        let id = rawID.replace(action + "-", '-');

        $.post('./scripts/handlers/formHandler.php', {
            editConferenceStatus: conference.target.id,
            ConferenceId: $('#cID'.concat(id)).text(),
            ConferenceSDate: $('#cSDate'.concat(id)).val(), 
            ConferenceSTime: $('#cSTime'.concat(id)).val(),
            ConferenceEDate: $('#cEDate'.concat(id)).val(), 
            ConferenceETime: $('#cETime'.concat(id)).val(),
            ConferenceStatus: status
        }, function (data) {

            $('#error_container').html(data);

            if (!$('#err').text()) {      
                var err_contents = $("#error_container").children();
                err_contents.remove();       
                
                $('#searchCResult').html(data); 
                enableConferenceButtonClicks();

                userToast([
                    'Action Completed!',
                    'Conference with the ID of ' + id.replace('-', '') + ' was successfully ' + action + 'd. ',
                    'success'
                ]);
            } 
            else { 
                $(editTableID).prop("disabled", false);                 

                $('#cTitle' + id).attr("disabled", true); 
                $('#cLocation' + id).attr("disabled", true);                 
            }            
            
        });

    });

    // when 'X' is clicked, show message, and revert back to original state
    $("#cancel-".concat(rawID)).click(function () {
        let id = rawID.replace(action + "-", '-');
        userToast([
            'Action Canceled!',
            'Conference with the ID of ' + id.replace('-', '') + ' was <b>not</b> changed.',
            'info'
        ], rawID);

        $(editTableID).prop("disabled", true); 

        removeButton("#accept-", rawID, tableID);
        removeButton("#cancel-", rawID, tableID);
    });
}

function dynamicConferenceSearch() {

    $("#searchCOption").on('change', function() {
        var searchOption = $('#searchCOption').val();
        if (searchOption == "StartDate" || searchOption == "EndDate") {
            $('#searchCParam').get(0).type = 'date';
        }
        else if (searchOption == "StartTime" || searchOption == "EndTime") {
            $('#searchCParam').get(0).type = 'time';
        }
        else {
            $('#searchCParam').get(0).type = 'text';
        }      
    });

    $('#searchCParam').on("keyup change", function () {
        var searchParam = $('#searchCParam').val();
        var searchOption = $('#searchCOption').val();
 
        if (searchOption == "StartDate" || searchOption == "StartTime") {
            searchOption = "StartTimestamp"; 
        }
        if (searchOption == "EndDate" || searchOption == "EndTime") {
            searchOption = "EndTimestamp"; 
        }

        $.post('./scripts/handlers/searchHandler.php', { searchByCParam: searchParam, searchByCOption: searchOption }, function (data) {
            $('div #searchCResult').html(data);
            enableConferenceButtonClicks();           
        });
    }); 
}
