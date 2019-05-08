<?php
    session_start();
    if(isset($_SESSION["userId"])){
        if(isset($_POST["book-submit"])){
            require 'dbh.inc.php';
            $user = $_SESSION["userUid"];
            $package = $_POST["bookPackage"];
            $checkIn = $_POST["checkIn"];
            $checkOut = $_POST["checkOut"];
            if($checkIn < $checkOut){
                $sql = "INSERT INTO bookings (userBookings, packageBookings, checkInBookings, checkOutBookings) VALUES (?,?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../book.php?error=sqlerror");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt,"ssss",$user,$package,$checkIn,$checkOut);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../book.php?booking=success");
                    exit();
                }
                
            }else{
                header("Location: ../book.php?error=dateerror");
                exit();
            }
        }else{
            header("Location: ../book.php");
            exit();
        }
    }else{
        header("Location: ../index.php#login");
        exit();
    }
