function createButton(data, rawID, tableID = 0) {
    $("#".concat(rawID)).hide();
    $(tableID).prop("disabled", false);

    return $(document.createElement('button')).prop({
        type: 'button',
        id: data[0].concat('-'.concat(data[1])),
        class: 'btn btn-sm btn-'.concat(data[2].concat(' fa fa-'.concat(data[3].concat(' m-1')))),
    });
}

function removeButton(data, rawID, tableID = 0) {
    $(tableID).prop("disabled", true);

    $("#".concat(rawID)).show();
    $(data.concat(rawID)).remove();
}