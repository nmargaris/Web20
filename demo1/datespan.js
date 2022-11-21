$(document).ready(function () {
    $("#box2").mouseenter(function () {
        $.ajax({
            type: 'POST',
            url: 'datespan.php',
            dataType: 'JSON',
            success: function (data) {
                var response = JSON.parse(JSON.stringify(data));
                if (response[0].lastupdt === 'You have not uploaded data yet'){
                    document.getElementById("lastupload").innerText = response[0].lastupdt;
                }
                else {
                    document.getElementById("lastupload").innerText = response[0].lastupdt;
                    document.getElementById("startdate").innerText = " Your data cover from: " + response[0].startdt;
                    document.getElementById("enddate").innerText = " To: " + response[0].lastdt;
                    $("#lastupload").text = response[0].lastupdt;
                }
            }
        })
    })
})