$(document).ready(function () {
    $("#login_form").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "loginval.php",
            data: {
                username: $("#username").val(),
                password: $("#password").val(),
                submit: $("#submitlogin").val()

            },
            success: function(data) {
                if(data === 'success as admin') {
                    window.location.replace("indexadmin.php");
                }else
                {
                    $("#username, #password").removeClass("inputerror");
                    $("#login_msg").html(data);
                    if($("#login_msg").html(data).text() === "Fill in all fields") {
                        $("#username, #password").addClass("inputerror");
                    }
                    if($("#login_msg").html(data).text() === "Username is wrong") {
                        $("#username").addClass("inputerror");
                    }
                    if($("#login_msg").html(data).text() === "Password is wrong") {
                        $("#password").addClass("inputerror");
                    }
                }

            }
        })

    })

})