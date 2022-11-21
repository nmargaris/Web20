$(document).ready(function () {
    $("#box1").mouseenter(function () {
        $.ajax({
            type:'POST',
            url: 'eco_score.php',
            dataType: 'JSON',
            success: function (data) {
                var response = JSON.parse(JSON.stringify(data));
                if (response[0].message === "You don't have any location history the current month"){
                    document.getElementById("eco").innerText = response[0].message;
                }
                else {
                    document.getElementById("eco").innerText = response[0].message;
                    $("#eco").text = response[0].message;
                }
            }


        })

    })




})