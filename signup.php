<?PHP
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="book.css">
    <title>Signup</title>
</head>
<body>
    <div class="nav">
        <div class="wrapper">
            <div class="navbar">
                <div class="left">
                    <h1 class="logo"><a href="index.php">Hanoi</a></h1>
                </div>
                <div class="right">
                    <ul class="nav-links">
                        <li class="nav-link"><a href="index.php#login">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="wrapper">
            <div class="content">
               <div class="left-content">
                    <img src="images/baggage.png" alt="">
               </div>
               <div class="right-content">
                    <div class="book-form">
                        <h1 class="signup-heading">Signup</h1>
                        <form action="includes/signup.inc.php" onsubmit="return valsignup()" method="POST">
                            <input class="signup-inp signup-box" type="text" id="uid" name="uid" placeholder="Username"><br>
                            <input class="signup-inp signup-box" type="password" id="pass" name="pass" placeholder="Password"><br>
                            <input class="signup-inp signup-box" type="password" id="confirmpass" name="confirmpass" placeholder="confirm password"><br>
                            <?php
                                if(isset($_GET["error"])){
                                    $error = $_GET["error"];
                                    if($error == "sqlerror"){
                                        echo '<span class="incorrect">SQL error!</span>';
                                    }else if($error == "usertaken"){
                                        echo '<span class="incorrect">Username already exists</span>';
                                    }
                                }else if(isset($_GET["signup"])){
                                    if($_GET["signup"]=="success"){
                                        echo '<span class="correct">Account created</span>';
                                    }
                                }
                            ?>
                            <input class="signup-inp signup-box" type="submit" name="signup-submit" id="signup-submit" value="Signup">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
            <p>&copy;2019 Smit Patel</p>
    </div>
    <script>
        var uid_flag=0;
        var pass_flag=0;
        var confirm_flag=0;
        function valsignup(){
            const uid = document.getElementById("uid");
            const pass = document.getElementById("pass");
            const confirm = document.getElementById("confirmpass");
            const submit = document.getElementById("signup-submit");
            var regx = /^[a-zA-Z0-9_]{4,16}$/;
            if(!regx.test(uid.value)){
                if(uid_flag==0){
                    const errorUid = document.createElement("span");
                    errorUid.textContent = "Username can only contain alphabets, numbers or underscore and length between (4,16).";
                    errorUid.classList.add("incorrect");
                    pass.before(errorUid);
                    uid_flag=1;
                }
                return false;
            }
            if(!regx.test(pass.value)){
                if(pass_flag==0){
                    const errorPass = document.createElement("span");
                    errorPass.textContent = "Password can only contain alphabets, numbers or underscore and length between (4,16).";
                    errorPass.classList.add("incorrect");
                    confirm.before(errorPass);
                    pass_flag=1;
                }
                return false;
            }
            if(pass.value != confirm.value){
                if(confirm_flag==0){
                    const errorConfirm = document.createElement("span");
                    errorConfirm.innerHTML = "Password not matching<br>";
                    errorConfirm.classList.add("incorrect");
                    submit.before(errorConfirm);
                    confirm_flag=1;
                }
                return false;
            }
            return true;
        }
    </script>
</body>
</html>