<?php 
    $title='signup';
    include 'header.php';
?>
<div >
<form action="snippets/signup.snip.php" method= "POST">

    <h1>Signup</h1>
    <?php 
        if(isset($_GET['error'])){
            echo  'Username: <input type="text" name="username" value="'.$_GET['name'].'" placeholder="Username"><br>';
        }
        else{
            echo  'Username: <input type="text" name="username" placeholder="Username"><br>';
        }
    ?>  
    <?php 
        if(isset($_GET['error'])){
            echo  'E-mail: <input type="text" name="email" value="'.$_GET['email'].'" placeholder="E-mail"><br>';
        }
        else{
            echo  'E-mail: <input type="text" name="email" placeholder="E-mail"><br>';
        }
    
    ?>
    <?php 
        if(isset($_GET['error'])){
            echo  'Phone: <input type="text" name="phone" value="'.$_GET['phone'].'" placeholder="Phone"><br>';
        }
        else{
            echo  'Phone:  <input type="text" name="phone" placeholder="phone"><br>';
        }
    
    ?>  

    Password: <input type="password" name="password1" placeholder="Password" id="pwd" ><br>
   
    Re-type Password: <input type="password" name="password2" placeholder="Re-Password" id="pwd"><br>
    
    <button type="submit" name="signinbutton">signup</button>
    
    
    
</form>
<?php 

    if(isset($_GET['error'])){
        $Error=$_GET['error'];
        if($Error=='emptyfields'){
            echo "<p>Please Fill Up all Fields</P>";
            exit();
        }else if($Error=='invalidname'){
            echo "<p>Enter Valid Username!</P>";
            exit();
        }
        else if($Error=='invalidemail'){
            echo "<p>Enter Valid Email!</P>";
            exit();
        }
        else if($Error=='mismatchedpwd'){
            echo "<p>Password Doesn't Match!</P>";
            exit();
        }else if($Error=='sqlerror'){
            echo "<p>SQL Connection Failed!</P>";
            exit();
        }else if($Error=='usernameExists'){
            echo "<p>Username Already Exists!</P>";
            exit();
        }else{
            echo "<p>Signed Up!</P>";
            exit();
        }
    }
    include 'footer.php' ?>;