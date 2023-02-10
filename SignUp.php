<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundBlast - SignUp</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="./assets/img/Logo-Background/logonew1-removebg-preview.png" type="image/x-icon" class="iconnn" />
    <script src="main.js"></script>
</head>

<?php
    require_once('connec.php');
    session_start();
    $errSignUp = '';
    $errname = '';
    $errpass = '';
    $errconfirmpassword = '';
    $erremaill = '';
    $errphonee = '';
    $statuss = true;
    $success = '';
    if(isset($_POST['SignUp'])):
        $username = htmlspecialchars($_POST['user']);
        $password = htmlspecialchars($_POST['pass']);
        $confirmpassword = htmlspecialchars($_POST['confirmpass']);
        if(!($password === $confirmpassword)){
            $errconfirmpassword = 'Password must match';
            $statuss = false;
        }
        $emaill = htmlspecialchars($_POST['email']);
        $phonee = htmlspecialchars($_POST['phone']);

        if($username == '' || empty($username)){
            $errname = 'Username is required';
            $statuss = false;
        }
        if($password == '' || empty($password)){
            $errpass = 'Password is required';
            $statuss = false;
        }else if(strlen($password) < 6){
            $errpass = 'Password minlength is 6 character';
            $statuss = false;
        }
        if($confirmpassword == '' || empty($confirmpassword)){
            $errconfirmpassword = 'Confirmpassword is required';
            $statuss = false;
        }
        if(!($password === $confirmpassword)){
            $errconfirmpassword = 'Password must match';
            $statuss = false;
        }
        $passwordhash = sha1($password);
        if($emaill == '' || empty($emaill)){
            $erremaill = 'Emaill is required';
            $statuss = false;
        }
        if($phonee == '' || empty($phonee)){ 
            $errphonee = 'Phone number is required';
            $statuss = false;
        }else if(strlen($phonee) != 10){
            $errphonee = 'Phone number is 10 character';
            $statuss = false;
        }

        if($statuss == true){
            $sql = sprintf("SELECT * FROM user where namee = '%s'",mysqli_real_escape_string($conn,$username));
            $viet = $conn -> query($sql);
            if($viet -> num_rows > 0){
                $errSignUp = 'Username exists!<br>';
                $errSignUp .= 'Sign Up fail!';
            }else{
                $sql =  sprintf("INSERT into user(namee,passwordd,passworddhash,email,phone) value('%s','%s','%s','%s','%s')",$username,$password,$passwordhash,$emaill,$phonee);
                $viet = $conn->query($sql);
                $success = "<span style='color:green'>Thanh cong</span>";
            }
        }
    endif;
?>
<body>
    <div class="main__signin">
        <a class="signin__logo" href="http://localhost/soundblast/index.php">
            <img src="assets/img/Logo-Background/logonew1.PNG" alt="logo" class="sign__logo--img">
        </a>
        <div class="signup__form"> 
            <form action="" method="post">
                <h2 class="sign__form--heading">sign up with soundblast</h2>
                <div class="sign__form--content">Read up on talented artists, make submissions and more!</div>
                <input type="text" class="sign__form--input" placeholder="Username or verified email" name="user" autocomplete="off"><br>
                <div class="err"> <?php echo($errname); ?> </div>
                <input type="password" class="sign__form--input" pattern="(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="6" placeholder="Password" name="pass">
                <div class="err"> <?php echo($errpass); ?> </div>
                <div class="sign__passrequi">
                    <span class="sign__passrequi--header">Password Requirement:</span>
                    <ul class="sign__passrequi--list">
                        <li class="sign__passrequi--item">At least 8 characters</li>
                        <li class="sign__passrequi--item">1 lowercase letter</li>
                        <li class="sign__passrequi--item">1 uppercase letter</li>
                        <li class="sign__passrequi--item">1 number</li>
                        <li class="sign__passrequi--item">Not guessable</li>
                    </ul>
                </div>
                <input type="password" class="sign__form--input" placeholder="Confirm Password" name="confirmpass">
                <div class="err"> <?php echo($errconfirmpassword); ?></div>
                <input type="email" class="sign__form--input" placeholder="Email" name="email" autocomplete="off">
                <div class="err"> <?php echo($erremaill); ?> </div>
                <input type="number" class="sign__form--input" minlength="10" placeholder="Phone number" name="phone" autocomplete="off">
                <div class="err"> <?php echo($errphonee); ?> </div>
                <button class="btn btn__sign" name="SignUp">Sign Up</button>
                <div class="err"> <?php echo($errSignUp);echo($success);?> </div>

                    <div class="sign__form--register">
                        <a href="SignIn.php">ALREADY HAVE AN ACCOUNT? SIGN IN</a>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>