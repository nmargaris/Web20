<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<title>log in screen</title>

<head>
    <title>LogInPage</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginpage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
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
                        if(data === 'success as admin'){
                            window.location.replace("indexadmin.php");
                        }else if(data === 'success as user'){
                            window.location.replace("profile.php");
                        }
                        else
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
    </script>

</head>


<body background="images/patras.jpg">
<header>
    <nav>
        <a class="welcomemsg">Welcome to our site</a>
        <div class="loginform">
            <form id="login_form" name="login_form" method="POST" action="loginval.php">
                <label>Username:</label>
                <input id="username" type="text" name="username" placeholder="username" id="username">
                <label>Password:</label>
                <input style="margin-left: 4px" id="password" type="password" name="password" placeholder="password" id="password" a>
                <input type="submit" id="submitlogin" name="submitlogin" value="Login">
                <p id="login_msg"></p>
            </form>


        </div>
    </nav>
</header>

<main>

        <div class="container">
            <p class="greetingmsg">
                Η εφαρμογή αυτή κατασκευάστηκε στα πλαίσια της εργασίας του μαθήματος
                Προγραμματισμός και Συστήματα στον Παγκόσμιο Ιστό. Αναπαριστά ένα σύστημα
                Location History Visualizer.
            </p>
            <div class="registerform">
                <a>Εάν δεν έχετε λογαριασμό παρακαλώ εγγραφείτε ΕΔΩ</a>
                    <form id="register_form" action="register.php" method="POST" >
                        <label>Όνομα:</label>
                        <input class="inputregister" type="text" name="fname" placeholder="Enter your first name" id="userfname">
                        <br>
                        <label>Επώνυμο:</label>
                        <input class="inputregister" type="text" name="lname" placeholder="Enter your last last name" id="userlname">
                        <label>Username:</label>
                        <input class="inputregister" type="text" name="username" placeholder="Enter your desired username" id="usernamereg">
                        <label>Password:</label>
                        <input  class="inputregister"  type="password" name="password" placeholder="Enter your Password" id="passwordreg">
                        <br>
                        <label>Email:</label>
                        <input class="inputregister"  type="email" name="email" placeholder="Enter Your Email" id="useremail">
                        <br>
                        <input class="inputregister" id="submitregister"  type="submit" value="Sign Up">
                        <p id="signupmsg"></p>

                    </form>
                <div id="ack"></div>
                <!--connect with reigster.js (AJAX) -->
                <script type="text/javascript"  src="register.js"></script>
            </div>

        </div>
</main>


<!--<div class="log">-->
<!--    <form name="login_form" method="POST" action="login.php" >-->
<!--        Username:-->
<!--        <input type="text" name="username" placeholder="username" id="username">-->
<!--        <br><br>-->
<!--        Password:-->
<!--        <input style="margin-left: 4px" type="password" name="password" placeholder="password" id="password" a>-->
<!--        <br><br>-->
<!--        <input type="submit" value="Login">-->
<!--    </form>-->

<!--</div>-->

</body>

</html>
