var leftPos = 10;
var topPos = 110;

function userToast(data) {
    $.toast({
        heading: data[0],
        text: data[1],
        icon: data[2],
        position: {
            left: leftPos,
            top: topPos
        },
    });
}