$(document).ready(function () {
    $("#login_formu").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "loginvaluser.php",
            data: {
                username: $("#usernameu").val(),
                password: $("#passwordu").val(),
                submit: $("#submitloginu").val()

            },
            success: function(data) {
                if(data === 'success as user'){
                    window.location.replace("userpage.php");
                } else
                {
                    $("#usernameu, #passwordu").removeClass("inputerror");
                    $("#login_msguser").html(data);
                    if($("#login_msguser").html(data).text() === "Fill in all fields") {
                        $("#usernameu, #passwordu").addClass("inputerror");
                    }
                    if($("#login_msguser").html(data).text() === "Username is wrong") {
                        $("#usernameu").addClass("inputerror");
                    }
                    if($("#login_msguser").html(data).text() === "Password is wrong") {
                        $("#passwordu").addClass("inputerror");
                    }
                }

            }
        })

    })

})