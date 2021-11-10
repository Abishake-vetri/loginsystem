<?php 
    $title = 'Login';
    include 'header.php';
?>
<main>
    <h1>Login</h1>
    <form action="snippets/login.snip.php" method="POST">
    <?php 
        if(isset($_GET['error'])){
            echo 'Username: <input type="text" name="username" placeholder="Username" value= "'.$_GET['name'].'">';
        }
        else{
            echo  'Username: <input type="text" name="username" placeholder="Username">';
        }
     ?>
    <br>
    Password: <input type="password" name="password" placeholder="Password">
    <br>
    <button type="submit" name="loginbutton" >Login</button>
    </form>
  
    <p>if you are a new user?</p>
    <form action="signup.php" method="POST">
        <button type="submit" >SignUp</button>
    </form>
</main> 
<?php 
         if(isset($_GET['error'])){
            $Error=$_GET['error'];
            if($Error=='emptyfields'){
                echo '<p>Please fillup all fields</p>';
                exit();
            }
            else if($Error=='sqlerror'){
                echo '<p>SQL Connection Failed!</p>';
                exit();
            }
            else if($Error=='wrngpwd'){
                echo '<p>Password is Incorrect!</p>';
                exit();
            }
        }
    ?>
    <br>   

<?php include 'footer.php' ?>