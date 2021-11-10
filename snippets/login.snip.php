<?php
    if(isset($_POST['loginbutton'])){
        include_once "dbh.snip.php";

        $mailid = $_POST['username'];
        $password = $_POST['password'];
        
        if(empty($mailid)||empty($password)){
            header("Location:../index.php?error=emptyfields&name=");
            exit();
        }
        else{
            $sql = "SELECT * FROM signupusers WHERE Username=? OR Email=?;";
            $stmt= mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location:../index.php?error=sqlerror&name=$mailid");
                exit();  
            } 
            else{
                mysqli_stmt_bind_param($stmt,"ss", $mailid,$mailuid);
                mysqli_stmt_execute($stmt);
                $dbresults = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($dbresults)){
                    $pwdcheck = password_verify($password,$row['Password']);
                        if($pwdcheck==true){
                            session_start();
                            $_SESSION['user']=$row ['Username'];
                            header("Location:../content.php?Login=success");
                            exit();
                        }
                        else{
                            header("Location:../index.php?error=wrngpwd&name=$mailid");
                            exit();   
                        }
                }
            }

        }
    }