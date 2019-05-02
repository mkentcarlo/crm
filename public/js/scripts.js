/**
 * display sweet alert success message
 * @param  string msg Title to be displayed
 * @return sweet alert success message
 */
function successMsg(msg) {
    return swal({
        type:              'success',
        title:             msg,
        showConfirmButton: false,
        timer:             1500
    })
};

/**
 * display sweet alert error message
 * @param  string msg Title to be displayed
 * @return sweet alert error message
 */
function errorMsg(msg) {
    let output = '';

    if (msg !== null && typeof msg === 'object') {
        for (let x in msg) {
            output += msg[x][0] + "\r\n";
        }
    } else {
        output = msg;
    }

    return swal({
        type:  'error',
        title: output,
    });
};

/**
 * display sweet alert success message
 * @param  string msg Title to be displayed
 * @param  object form from where data was submitted
 * @param  object table datatable table
 * @return sweet alert success message
 */
function successMsgWithButton(msg) {
    return swal({
        type:              'success',
        title:             msg,
        showConfirmButton: true
    })
}

/**
 * display sweet alert delete message confimation
 * @param  string title Title to be displayed
 * @param  string text additional decription of message
 * @return sweet alert confirmation message
 */
function deleteMessage(title, text) {

    return swal({
        title:              title,
        text:               text,
        type:               'warning',
        showCancelButton:   true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor:  '#d33',
        confirmButtonText:  'Yes, remove it!'
    });
}


//date picker
$('.datepicker').datetimepicker({
    useCurrent: false,
    icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        },
}).on('dp.show', function() {
if($(this).data("DateTimePicker").date() === null)
    $(this).data("DateTimePicker").date(moment());
});