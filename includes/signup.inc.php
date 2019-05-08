<?php
    if(isset($_POST["signup-submit"])){
        require 'dbh.inc.php';

        $username = $_POST["uid"];
        $password = $_POST["pass"];

        $sql1 = "SELECT uidUsers FROM users WHERE uidUsers = ?;";
        $stmt1 = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt1,$sql1)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt1,"s",$username);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_store_result($stmt1);
            $resultCheck = mysqli_stmt_num_rows($stmt1);
            if($resultCheck>>0){
                header("Location: ../signup.php?error=usertaken");
                exit();
            }
        }

        $sql2 = "INSERT INTO users (uidUsers,pwdUsers) VALUES (?,?);";
        $stmt2 = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt2,$sql2)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }else{
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt2,"ss",$username,$hashedPwd);
            mysqli_stmt_execute($stmt2);
            header("Location: ../signup.php?signup=success");
            exit();
        }
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);
        mysqli_close($conn);
    }else{
        header("Location: ../signup.php");
        exit();
    }