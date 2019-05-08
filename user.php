<?php
    session_start();
    if(!isset($_SESSION["userId"])){
        header("Location: index.php#login");
        exit();
    }
    require 'includes/dbh.inc.php';
    $user = $_SESSION["userUid"];
    echo "
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <link rel='stylesheet' href='main.css'>
        <link rel='stylesheet' href='user.css'>
        <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>
        <title>Hotel Hanoi</title>
    </head>
    <body>    
        <div class='wrap-wrap'>
            <div class='wrapper'>
                <div class='navbar'>
                    <div class='left' onclick='location.href='#home''>
                        <h1 class='logo'><a href='index.php'>Hanoi</a></h1>
                    </div>
                    <div class='right'>
                        <ul class='nav-links'>
                            <li class='nav-link'><a href='book.php'>Book</a></li>
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
        <div class='sections'>
            <div id='user-main' class='section'>                
                <table id='bookingTable'>
                    <caption>User bookings</caption> 
                    <tr>
                        <th>Id</th>
                        <th>Package</th>
                        <th>Check in</th>
                        <th>Check out</th>
                    </tr>
                    ";

                    
                    $sql = "SELECT idBookings, packageBookings, checkInBookings, checkOutBookings FROM bookings WHERE userBookings = '$user';";
                    $result = mysqli_query($conn,$sql);

                    $tupples = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    if(empty($tupples)){
                        echo "<tr><td colspan=4>No Bookings</td></tr>";
                    }
                    foreach($tupples as $tupple){
                        echo "<tr><td>".$tupple['idBookings']."</td><td>".$tupple['packageBookings']."</td><td>".$tupple['checkInBookings']."</td><td>".$tupple['checkOutBookings']."</td></tr>";
                    }
                    
                    /*$result = $conn-> query($sql);
                    if($result-> num_rows >0){
                        while($row= $result-> fetch_assoc()){
                            
                        }
                        echo " </table>";
                    }else{
                        echo "0 bookings";
                    }*/
                    echo "
                    </table>                                    
            </div>
        </div>
    </body>
</html>

    ";
?>

