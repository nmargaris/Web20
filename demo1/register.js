//call the submit button me to id #submitregister
    $("#submitregister").click(function () {
        //use the id of the form (#register form) and atrr('action') in order to connect the register.php and register.js
        $.post($("#register_form").attr("action"),
            //.SerializeArray an Ajax jQuery:Encodes a set of form elements as an array of names and values
            $("#register_form :input").serializeArray(),

            function (info) {
                $("#ack").empty();
                $("#ack").html(info);
                // if($("#ack").text() === 'Inserted Successfully'){
                //     clear();
                // }


            });
            $("#register_form").submit(function () {
                return false;

            });


    });

    function clear() {

        $("#register_form :input").each(function () {
            $(this).val("");
        })
    }
