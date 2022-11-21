<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<title>log in screen</title>

<head>
    <title>LogInPage</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html, charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginpage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="login.js"></script>
    <script type="text/javascript" src="loginuser.js"></script>
    <script type="text/javascript" src="register.js" ></script>
</head>



<body background="images/patras.jpg">
<header>
    <nav>
        <a class="welcomemsg">Welcome to our site</a>
<!--        <div class="loginformu" >-->

        <form id="login_formu" name="login_form" method="POST" action="loginvaluser.php" style="display: inline">
            <label>Username:</label>
            <input id="usernameu" type="text" name="username" placeholder="username" >
            <label>Password:</label>
            <input style="margin-left: 4px" id="passwordu" type="password" name="password" placeholder="password">
            <input type="submit" id="submitloginu" name="submitlogin" value="Login">
            <p id="login_msguser">Logging in as a User</p>
        </form>
<!--        </div>-->
<!--        <div class="loginforma" >-->
        <form id="login_form" name="login_form" method="POST" action="loginval.php" style="display: none">
            <label>Username:</label>
            <input id="username" type="text" name="username" placeholder="username" >
            <label>Password:</label>
            <input style="margin-left: 4px" id="password" type="password" name="password" placeholder="password" >
            <input type="submit" id="submitlogin" name="submitlogin" value="Login">
            <p id="login_msg">Logging in as Admin</p>
        </form>
        <button id="logadmbtn" onclick="showhide()">Log in as Admin</button><br>
        <script>
            function showhide() {
                let x = document.getElementById("login_form");
                let y = document.getElementById("login_formu");
                if(x.style.display === 'none'){
                    x.style.display = 'inline';
                    y.style.display = 'none';
                    document.getElementById('logadmbtn').innerHTML = 'Log in as User';
                    document.getElementById('login_msguser').innerHTML = 'Logging in as a User';
                }else{
                    x.style.display = 'none';
                    y.style.display = 'inline';
                    document.getElementById('logadmbtn').innerHTML = 'Log in as Admin';
                    document.getElementById('login_msg').innerHTML = 'Logging in as Admin';
                }

            }
        </script>



<!--        </div>-->

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
                <a>Sing in for free if you don' t have an account</a>
                <form id="register_form" action="register.php" method="POST" >
                    <label>First name:</label>
                    <input class="inputregister" type="text" name="fname" placeholder="Enter your first name" id="userfname">
                    <br>
                    <label>Last name:</label>
                    <input class="inputregister" type="text" name="lname" placeholder="Enter your last last name" id="userlname">
                    <label>Username:</label>
                    <input class="inputregister" type="text" name="username" placeholder="Enter your desired username" id="usernamereg">
                    <label>Password:</label>
                    <input  class="inputregister"  type="password" name="password" placeholder="Choose a password with at least 8 characters one number and one symbol" id="passwordreg">
                    <br>
                    <label>Email:</label>
                    <input class="inputregister"  type="email" name="email" placeholder="Enter Your Email" id="useremail">
                    <br>
                    <input class="inputregister" id="submitregister"  type="submit" value="Sign Up">
                    <div id="ack"></div>

                </form>
                <p id="dasdasd"></p>
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
