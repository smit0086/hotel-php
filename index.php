<?PHP
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Hotel Hanoi</title>
</head>
<body>    
    <div class="wrap-wrap">
        <div class="wrapper">
            <div class="navbar">
                <div class="left" onclick="location.href='#home'">
                    <h1 class="logo"><a href="#home">Hanoi</a></h1>
                </div>
                <div class="right">
                    <ul class="nav-links">
                        <li class="nav-link"><a href="#gallery">Gallery</a></li>
                        <li class="nav-link"><a href="#book">Book</a></li>
                        
                        <?php
                            if(isset($_SESSION["userId"])){
                                $user = $_SESSION["userUid"];
                                echo "
                                <li class='nav-link'><a href='user.php'>$user</a></li>
                                <li class='nav-link'>
                                    <form action='includes/signout.inc.php' action='GET'>
                                        <input type='submit' value='Logout' name='logout-submit' id='logout-btn'>
                                    </form>
                                </li>
                                ";
                            }else{
                                echo "
                                    <li class='nav-link'><a href='#login'>Login</a></li>
                                "; 
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sections">
        <div id="home" class="section">
            <video autoplay muted loop>
                <source src="images/Video Of Hotel Lounge.mp4" type="video/mp4">
            </video> 
            <div class="header">
                <h1 class="landing-text">Luxurious.</h1>
            </div>
        </div>
        <div id="gallery" class="section">
            <div class="carousel" id="carousel">
                <div class="control-container">
                    <div class="prev" id="prev">&#10094</div>
                    <div class="image-selectors">
                    <div class="circle" id="circle1" style="background-color: red;"></div>
                    <div class="circle" id="circle2"></div>
                    <div class="circle" id="circle3"></div>
                    <div class="circle" id="circle4"></div>
                    <div class="circle" id="circle5"></div>
                    </div>
                    <div class="next" id="next">&#10095</div>
                </div>
                <div class="slides" id="slides" style="margin-left:0px;">
                    <div class="slide slide1"></div>
                    <div class="slide slide2"></div>
                    <div class="slide slide3"></div>
                    <div class="slide slide4"></div>
                    <div class="slide slide5"></div>
                </div>
            </div>
        </div>
        <div id="book" class="section">
            <div class="wrapper">
                    <div class="price-wrap">
                        <div class="pricing">
                            <?php
                            if(isset($_SESSION["userId"])){
                                echo '<div class="standard" onclick="redirect_book()">';
                            }else{
                                echo '<div class="standard" onclick="redirect_login()">';
                            }
                            ?>
                                <div class="price-bg">
                                        <h2>standard</h2>
                                        <img src="./images/icons/bishop.svg" alt="">
                                        <p>Basic necessities.</p>
                                </div>
                                <ul>
                                    <li>Bed</li>
                                    <li>Air Conditioning</li>
                                    <li>HD television</li>
                                    <li>Refrigerator</li>
                                    <li>20 Mbps internet</li>
                                </ul>
                            </div>
                            <?php
                            if(isset($_SESSION["userId"])){
                                echo '<div class="premium" onclick="redirect_book()">';
                            }else{
                                echo '<div class="premium" onclick="redirect_login()">';
                            }
                            ?>
                                    <div class="premium-bg">
                                        <h2>Premium</h2>
                                        <img src="./images/icons/crown.svg" alt="">
                                        <p>Live like a king would.</p>
                                    </div>
                                    <ul>
                                        <li>Deluxe package</li>
                                        <li>Private pool</li>
                                        <li>Private Sauna</li>
                                        <li>Wine Bar</li>
                                        <li>1000 Mbps internet</li>
                                    </ul>
                            </div>
                            <?php
                            if(isset($_SESSION["userId"])){
                                echo '<div class="deluxe" onclick="redirect_book()">';
                            }else{
                                echo '<div class="deluxe" onclick="redirect_login()">';
                            }
                            ?>
                                <div class="price-bg">
                                    <h2>Deluxe</h2>
                                    <img src="./images/icons/horse.svg" alt="">
                                    <p>All basic necessities and <br>some luxury.</p>
                                </div>
                                <ul>
                                    <li>Standard package</li>
                                    <li>Free Breakfast+lunch</li>
                                    <li>Access to pool</li>
                                    <li>40 Mbps internet</li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <?php
            if(!isset($_SESSION["userId"])){
                echo '
                    <div id="login" class="section">
                        <div class="cont">
                            <div class="form">
                                <form action="includes/login.inc.php" method="POST" onsubmit="return validate()">
                                    <h1>Login</h1>
                                    <input type="text" class="user" id="user" name="n_user" placeholder="Username"';
                                    if(isset($_GET["error"])){
                                        if($_GET["error"] == "wrongpwd"){
                                            $user =$_GET['n_user'];
                                            echo " value='$user'";
                                        }
                                    }
                                    
                                    echo '/>
                                    <input type="password" class="pass" id="pass" name="n_pass" placeholder="Password"/>
                                    ';
                                    if(isset($_GET["error"])){
                                        $error = $_GET["error"];
                                        if($error == "nouser"){
                                            echo "<span class='incorrect'>User not found</span>";
                                        }else if($error == "wrongpwd"){
                                            echo "<span class='incorrect'>Incorrect password</span>";
                                        }
                                    }
                                    echo'
                                    <input type="submit" value="Login" name="n_submit" class="login">
                                    <a href="signup.php">signup</a>
                                </form>
                            </div>
                        </div>
                    </div>
                '; 
            }
        ?>
        
        <div id="footer">
            <p>&copy;2019 Smit Patel</p>
        </div>
        <script src="app.js"></script>
    </div>
</body>
</html>