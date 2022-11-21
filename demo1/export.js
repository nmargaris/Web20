$(document).ready(function () {
    $("#export").click(function () {
        $.ajax({
            method: 'POST',
            url: 'export.php',
            dataType: 'json',
            data: {
                datetimefilter: $("#datetimefilter").val(),
                type: $("#type").val(),
                submit: $("#submithmadmin").val()
            },
            success: function (data) {
                console.log(data);
            }
        })

    })
})