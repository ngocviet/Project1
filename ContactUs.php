<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundBlast</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="./assets/img/Logo-Background/logonew1-removebg-preview.png" type="image/x-icon" class="iconnn" />
    <link rel="stylesheet" href="./assets/fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<?php
    require_once('connec.php');
    session_start();
    $errname = '';
    $erremail = '';
    $errcontent = '';
    $status = true;
    if(isset($_POST['send'])):
        $namee = htmlspecialchars($_POST['name']);
        $emaill = htmlspecialchars($_POST['email']);
        $contentt = htmlspecialchars($_POST['help']);

        if($namee == '' || empty($namee)){
            $errname = 'Name is required';
            $statuss = false;
        }
        if($emaill == '' || empty($emaill)){
            $erremail = 'Email is required';
            $statuss = false;
        }
        if($contentt == '' || empty($contentt)){
            $errcontent = 'Content is required';
            $statuss = false;
        }

        if($status == true){
            $sql = sprintf("INSERT into contact(namee,email,content) value('%s','%s','%s')",mysqli_real_escape_string($conn,$namee),mysqli_real_escape_string($conn,$emaill),mysqli_real_escape_string($conn,$contentt));

            $conn ->query($sql);
            header('location: index.php');
        }else{
            echo('hhhhh');
        }
    endif;
?>

<body>
    <div id="main">
        <div id="header">
            <div class="grid">
                <ul id="nav">
                    <div class="nav__logo">
                        <a href="http://localhost/soundblast/index.php">
                            <img src="./assets/img/Logo-Background/logonew1.png" alt="SoundBlast" class="nav__logo--img">
                            <label class="nav__logocontent">SoundBlast</label>
                        </a>
                    </div>
                    <div class="nav__function">
                        <li>
                            <span class="nav__menu">
                                Menu
                                <ul class="nav__menu--list">
                                    <li class="nav__menu--item"><a href="Toptrending.php">Trending Now</a></li>
                                    <li class="nav__menu--item"><a href="Newrelease.php">New Releases</a></li>
                                    <li class="nav__menu--item"><a href="Newalbums.php">Latest Albums</a></li>
                                    <li class="nav__menu--item"><a href="Oldsong.php">Old Song</a></li>
                                    <li class="nav__menu--item"><a href="Topcharts.php">Top Charts</a></li>
                                    <li class="nav__menu--item"><a href="Topartist.php">Top Artists</a></li>
                                    <li class="nav__menu--item"><a href="Topsearch.php">Top Search Song</a></li>
                                </ul>
                            </span>
                        </li>
                        <li>
                            <span class="nav__menu">
                                music
                                <ul class="nav__menu--list">
                                    <li class="nav__menu--item"><a href="http://localhost/soundblast/details_topic.php?topic=pop">Pop Music</a></li>
                                    <li class="nav__menu--item"><a href="http://localhost/soundblast/details_topic.php?topic=rook">Rock Music</a></li>
                                    <li class="nav__menu--item"><a href="http://localhost/soundblast/details_topic.php?topic=electronic">Electronic</a></li>
                                    <li class="nav__menu--item"><a href="http://localhost/soundblast/details_topic.php?topic=rap">Rap</a></li>
                                </ul>
                            </span>
                        </li> 
                        <li><a href="ContactUs.php">Contact us</a></li>
                    </div>
                    <div class="nav__icon">
                        <div>
                            <a href="#" class="nav__icon--search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="https://www.facebook.com/search/top?q=aptechvietnam.com.vn">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/?lang=vi">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://www.instagram.com/">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com/c/F8VNOfficial">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                            <?php
                                if(isset($_SESSION['user'])){
                                    ?>
                                <a href="edit.php?signOutUser" class="nav__icon--user">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </a>
                                    <?php
                                }else{
                                    ?>
                            <a href="SignIn.php" class="nav__icon--user">
                                <i class="fa-solid fa-user"></i>
                            </a>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </ul>
            </div>
        </div>

        <div id="contact">
            <div class="grid">
                <div class="grid__row">
                    <div class="contact__header">
                        <span>Contact</span>
                        <div class="grid__column--8-12">
                            <h2 class="contact__heading">We're here to help you level up</h2>
                        </div>
                    </div>
                </div>
                <div class="grid__row">
                    <div class="grid__column--4-12">
                        <span>We're just one click away to help you take your brand or product from great to incredible. Fill in the form to share more details about your project. Either way, we'd love to talk.</span>
                    </div>
                    <div class="grid__column--8-12">
                        <form action="" method="post">
                            <div class="form__contact">
                                <label for="name" class="form__contact--label">What's your name?</label>
                                <input type="text" class="form__contact--input" id="name" autocomplete="off" name="name">
                                <div class="err"><?php echo($errname); ?></div>
                                <label for="email" class="form__contact--label">Your email</label>
                                <input type="text" class="form__contact--input" id="email" name="email">
                                <div class="err"><?php echo($erremail); ?></div>
                                <label for="help" class="form__contact--label">What's can we help you with?</label>
                                <textarea cols="" rows="4" class="form__contact--input" id="help" name="help"></textarea>
                                <div class="err"><?php echo($errcontent); ?></div>
                                <button class="btn__primary btn__contact" name="send">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <span class="content__map">Address</span>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9244038028505!2d105.81684051476337!3d21.03571058599463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab145bf89bd7%3A0xd94a869b494c04b6!2zMjg1IMSQ4buZaSBD4bqlbiwgVsSpbmggUGjDuiwgQmEgxJDDrG5oLCBIw6AgTuG7mWkgMTAwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1657098961521!5m2!1svi!2s" width="1535" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div id="footer">
            <div class="grid">
                <div class="grid__row">
                    <div class="grid__column--3-12">
                        <h3 class="footer__heading">terms and policy</h3>
                        <ul class="footer__list">
                            <li class="footer__item">terms of use</li>
                            <li class="footer__item">privacy</li>
                            <li class="footer__item">cookie policy</li>
                            <li class="footer__item">cookie preference</li>
                        </ul>
                    </div>
                    <div class="grid__column--6-12">
                        <h3 class="footer__heading">ask us</h3>
                        <ul class="footer__list">
                            <li class="footer__item">email SoundBlast</li>
                            <li class="footer__item">send us a tip</li>
                            <li class="footer__item">information protection</li>
                        </ul>
                    </div>
                    <div class="grid__column--3-12 footer__logo">
                        <img src="./assets/img/Logo-Background/logonew1.png" alt="" class="footer__logo--img">
                        <label class="footer__logocontent">SoundBlast</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>