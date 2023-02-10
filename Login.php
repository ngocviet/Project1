<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="icon" href="./assets/img/Logo-Background/logonew1-removebg-preview.png" type="image/x-icon" class="iconnn" />
    <link rel="stylesheet" href="./assets/css/main.css">
</head>
<?php
        require_once('connec.php');
        $erruser = '';
        $errpass = '';
        $errlogin = '';
        session_start();
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($conn,htmlspecialchars($_POST['user']));
        $password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['pass']));
        
        if($username==''){
            $erruser = 'Please enter your Name';
        }
        if($password==''){
            $errpass = 'Please enter your Password';
        }
        $password = sha1($password);
        $sql = sprintf("SELECT * FROM admin where usernamee='%s' AND passworddhash='%s'",$username,$password);
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $_SESSION['admin'] = 'true';
            $sql = sprintf("SELECT * FROM admin where usernamee='%s' AND passworddhash='%s'",$username,$password);
            $viet = $conn ->query($sql);
            $rows = $viet->fetch_assoc();
            $idadmin = $rows['id'];
        }else{
            $errlogin = 'Username or password unsuccess!';
        }
    }
    if(!isset($_SESSION['admin'])){
?>
<body>
    <div class="container">
        <h1>Login form</h1>
        <form action="" method="post">
            <div class="form__row">
                <label class="form__label">Name:</label>
                <input type="text" class="form__input" name="user" autocomplete="off">
            </div>
            <div class="form__row">
                <label class="form__label">Password:</label>
                <input type="password" class="form__input" name="pass" autocomplete="off">
            </div>
            <div class="form__err">
                <label class="form__err--label">
                    <?php
                        echo($erruser);
                    ?>
                    </label>
                    <label class="form__err--label">
                    <?php
                        echo($errpass);
                    ?>
                    </label>
                    <label class="form__err--label">
                    <?php
                        echo($errlogin);
                    ?>
                    </label>
            </div>
            <div class="form__row form__but">
                <button class="btn" name="login">Login</button>
            </div>
        </form>
    </div>
</body>
<?php
    }else{
        header('Location: /soundblast/index_backend.php?id='.$idadmin);
    }
?>
</html>