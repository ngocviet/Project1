<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundBlast - SignIn</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="./assets/img/Logo-Background/logonew1-removebg-preview.png" type="image/x-icon" class="iconnn" />
</head>

<?php
    require_once('connec.php');
    session_start();
    $errSignIn = '';
    $errname = '';
    $errpass = '';
    $status = true;
    if(isset($_POST['SignIn'])):
        $username = htmlentities($_POST['user']);
        $password = htmlentities($_POST['pass']);

        if($username == '' || empty($username)){
            $errname = 'Username is required';
            $status = false;
        }
        if($password == '' || empty($password)){
            $errpass = 'Password is required';
            $status = false;
        }else if(strlen($password) < 6){
            $errpass = 'Password minlength is 6 character';
            $status = false;
        }

        if($status == true){
            $sql = sprintf("SELECT * FROM user where namee = '%s' and passwordd = '%s'",mysqli_real_escape_string($conn,$username),mysqli_real_escape_string($conn,$password));
            $viet = $conn -> query($sql);
            if($viet -> num_rows > 0){
                $_SESSION['user'] = true;
            }else{
                $errSignIn = '<div class="err">Sign In fail!!</div>';
            }
        }
    endif;
    if(isset($_SESSION['user'])){
        header('location: index.php');
    }
?>
<body>
    <div class="main__signin">
        <a class="signin__logo" href="http://localhost/soundblast/index.php">
            <img src="assets/img/Logo-Background/logonew1.png" alt="logo" class="sign__logo--img">
        </a>
        <div class="signin__form">
            <form action="" method="post" enctype="multipart/form-data">
                <h2 class="sign__form--heading">sign in to soundblast</h2>
                <div class="sign__form--content">Please provide username or verified email with credentials</div>
                <input type="text" class="sign__form--input" placeholder="Username or verified email" name="user" autocomplete="off" >
                <div class="err"><?php echo($errname); ?></div>
                <input type="password" class="sign__form--input" placeholder="Password" name="pass"  >
                <div class="err"><?php echo($errpass); ?></div>
                <div class="sign__form--forgotpass">forgot your password?</div>
                <button class="btn btn__sign" name="SignIn">Sign In</button>
                <div class="err"><?php echo($errSignIn); ?></div>
                    <div class="sign__form--register">
                        <a href="SignUp.php">
                            new here? create an account
                        </a>
                    </div>
                    <div class="sign__form--registerr">
                        <a href="Login.php">
                            ADMIN
                        </a>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
?>