$(document).ready(function () {
    $("#uploadedfile").change(function () {
        $("#file-name").text(this.files[0].name);
    })

    $("#uploadedfile").fileupload({
        url: 'upload.php',
        dataType: 'json',
        autoUpload: false,
        formData: {
            squares: savedsquares
        }
        // add: function (e, data) {
        //     $("#submitupload").off('click').on('click', function () {
        //         data.submit();
        //     })
        //
        // }
    }).on('fileuploadadd', function (e, data) {
        var fileTypeAllowed = /.\.(json)$/i;
        var fileName = data.originalFiles[0]['name'];
        var fileSize = data.originalFiles[0]['size'];
        $("#submitupload").off('click').on('click', function () {
            if (!fileTypeAllowed.test(fileName)) {
                $("#error").html('Only json files are allowed');
            } else {
                $("#error").html('');
                data.submit();
            }
        })

    }).on('fileuploaddone', function (e, data) {
        var msg = data.jqXHR.responseJSON.msg;
        $("#error").html(msg);
    }).on('fileuploadprogress', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $("#progress").html("Completed: " + progress + "%");
    })
})