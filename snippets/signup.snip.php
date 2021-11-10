<?php

  if(isset($_POST['signinbutton'])){
      require_once "dbh.snip.php";
      $Username= $_POST['username'];
      $Email= $_POST['email'];
      $Phone= $_POST['phone'];
      $Pass1= $_POST['password1'];
      $Pass2= $_POST['password2'];
    if(empty($Username) || empty($Email) || empty($Phone) || empty($Pass1) || empty($Pass2)){
        header("Location:../signup.php?&error=emptyfields&name=$Username&email=$Email&phone=$Phone");
        exit();
    }
    else if(!preg_match("/^[]a-zA-Z0-9)]*$/",$Username) && !filter_var($Email,FILTER_VALIDATE_EMAIL)){
        header("Location:../signup.php?&error=invalidname&&invalidemail");
        exit();
    }
    else if(!preg_match("/^[]a-zA-Z0-9)]*$/",$Username)){
        header("Location:../signup.php?&error=invalidname&email=$Email&phone=$Phone");
        exit();
    }
    else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
        header("Location:../signup.php?&error=invalidemail&name=$Username&phone=$Phone");
        exit();
    }
    else if($Pass1 !== $Pass2){
        header("Location:../signup.php?&error=mismatchedpwd&name=$Username&email=$Email&phone=$Phone");
        exit();
    }
    else{
        $sql="SELECT * FROM `signupusers` WHERE Username=?;";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location:../signup.php?&error=sqlerror");
            exit(); 
        }else{
           mysqli_stmt_bind_param($stmt,"s",$Username);
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt);
           $usercheck= mysqli_stmt_num_rows($stmt);
           if($usercheck > 0){
            header("Location:../signup.php?&error=usernameExists&name=&email=&phone=");
            exit(); 
           }
           else{
               $sql = "INSERT INTO `signupusers`( Username, Email, Phone, Password)
                VALUES (?,?,?,?);";
                 $stmt= mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt,$sql)){
                     header("Location:../signup.php&error=sqlerror");
                     exit(); 
                 }
                 else{
                    $Password = password_hash($Pass1,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"ssis",$Username,$Email,$Phone,$Password);
                    mysqli_stmt_execute($stmt);
                    header("Location:..\index.php?&signup = success");
                 }
           }
        } 
    }
  }