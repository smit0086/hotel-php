<?PHP
    session_start();
    if(isset($_SESSION["userId"])){
        $date = date("Y-m-d");
        $user = $_SESSION["userUid"];
        echo "
        <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link rel='stylesheet' href='book.css'>
    <title>Book</title>
</head>
<body>
    <div class='nav'>
        <div class='wrapper'>
            <div class='navbar'>
                <div class='left'>
                    <h1 class='logo'><a href='index.php'>Hanoi</a></h1>
                </div>
                <div class='right'>
                    <ul class='nav-links'>
                        <li class='nav-link'><a href='user.php'>$user</a></li>
                                <li class='nav-link'>
                                    <form action='includes/signout.inc.php' action='GET'>
                                        <input type='submit' value='Logout' name='logout-submit' id='logout-btn'>
                                    </form>
                                </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class='section'>
        <div class='wrapper'>
            <div class='content'>
            <div class='left-content'>
                    <img src='images/baggage.png' alt=''>
            </div>
            <div class='right-content'>
                    <div class='book-form'>
                        <h1 id='signup-heading'>Book a Suite</h1>
                        <form action='includes/booking.inc.php' method='POST'>
                            Package:
                            <select  class='signup-inp signup-box' name='bookPackage' id='bookPackage'>
                                <option value='standard'>Standard</option>
                                <option value='premium'>Premium</option>
                                <option value='deluxe'>Deluxe</option>
                            </select>
                            Check-in: <input class='signup-inp signup-box' type='date' min='$date' name='checkIn' >
                            Check-out: <input type='date' class='signup-inp signup-box' name='checkOut' min='$date'>";
                            if(isset($_GET["error"])){
                                $error = $_GET["error"];
                                if($error == "sqlerror"){
                                    echo "<span class='incorrect'>Sql error!</span>";
                                }else if($error = "dateerror"){
                                    echo "<span class='incorrect'>Check In date cannot be smaller than Check out date.</span>";
                                }
                            }else if(isset($_GET["booking"])){
                                if($_GET["booking"]=="success"){
                                    echo "<span class='correct'>Suite successfully booked</span>";
                                }
                            }

                            echo "
                            <input id='signup-submit' class='signup-inp' type='submit' name='book-submit' value='Book'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='footer'>
            <p>&copy;2019 Smit Patel</p>
    </div>
</body>
</html>

        ";
    }else{
        header("Location: index.php");
        exit();
    }
?>

