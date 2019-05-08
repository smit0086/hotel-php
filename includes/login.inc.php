<?php

    if(isset($_POST["n_submit"])){

        require 'dbh.inc.php';
        $username = $_POST["n_user"];
        $password = $_POST["n_pass"];

        $sql = "SELECT * FROM users where uidUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php#login?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password,$row['pwdUsers']);
                if($pwdCheck == false){
                    header("Location: ../index.php?error=wrongpwd&&n_user=$username#login");
                    exit();
                }else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    
                    header("Location: ../book.php?login=success");
                    exit();

                }else{
                    header("Location: ../index.php?error=wrongpwd#login");
                    exit();
                }
            }else{
                header("Location: ../index.php?error=nouser#login");
                exit();
            }
        }

    }else{
        header("Location: ../index.php#login");
        exit();
    }