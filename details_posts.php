<?php
    require_once('connec.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAILS</title>
    <!-- <link rel="icon" href="/assets/img/logonew1 - Copy.png" type="image/x-icon" /> -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="./assets/img/Logo-Background/logonew1-removebg-preview.png" type="image/x-icon" class="iconnn" />
    <link rel="stylesheet" href="./assets/fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
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
 
        <div id="container">
            <div id="container__details">
                <div class="grid">
                    <div class="grid__row">
                        <div class="grid__column--10-12">
                            <?php
                                $id = (int)$_GET['id'];
                                $artist_idd = (int)$_GET['artist_id'];
                                $topic = $_GET['topic'];
                                $sql = "SELECT id FROM main_content where id = $id";
                                $viet = $conn -> query($sql);
                                if($viet -> num_rows == 0){
                                    echo('NOT DATA');
                                    return;
                                }
                                $sql = "SELECT * FROM main_content a join category b on a.category_id = b.id where a.id = $id and namee = '$topic'";
                                $check = $conn -> query($sql);
                                while($rows = $check->fetch_assoc()){
                            ?>
                            <div class="status"><?php echo($rows['status']) ?></div>
                            <div class="img" style="background-image: url(./assets/img/<?php echo($rows['img']) ?>);"></div>
                            <div class="title"><?php echo($rows['title']) ?></div>
                            <div class="date">BY VIET / <?php echo($rows['date']) ?></div>
                            <div class="content">
                                <span><?php echo($rows['content']) ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="grid__column--2-12">
                            <div class="other__info">
                                <div class="other__info--header">you might also like</div>
                                <?php
                                    $sql = "SELECT a.id as id_post,a.img,a.title,a.artist_id,b.namee,a.status,a.date FROM main_content a join category b on a.category_id = b.id where a.id <> $id and artist_id = $artist_idd limit 3";
                                    $check = $conn ->query($sql);
                                    while($rows = $check->fetch_assoc()){
                                ?>
                                <a href="details_posts.php?id=<?php echo($rows['id_post']) ?>&artist_id=<?php echo($rows['artist_id']) ?>&topic=<?php echo($rows['namee']) ?>" class="other__info--item">
                                        <img src="./assets/img/<?php echo($rows['img']) ?>" alt="" class="other__info--item-img">
                                    <div class="other__info--item-title"><?php echo($rows['title']) ?></div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid">
            <div class="container__content">OTHER</div>
        </div>

        <div id="container">
            <div id="container__other">
                <div class="grid">
                    <?php
                        $sql = "SELECT a.id as id_post,a.img,a.title,a.artist_id,b.namee,a.status,a.date FROM main_content a join category b on a.category_id = b.id where a.id <> $id and namee = '$topic' order by a.create_at desc limit 4";
                        $check = $conn -> query($sql);
                        while($rows = $check->fetch_assoc()){
                    ?>
                    <div class="grid__row">
                        <a href="details_posts.php?id=<?php echo($rows['id_post']) ?>&artist_id=<?php echo($rows['artist_id']) ?>&topic=<?php echo($rows['namee']) ?>" class="grid__column--5-12">
                            <img src="./assets/img/<?php echo($rows['img']) ?>" alt="">
                        </a>
                        <div class="grid__column--4-12">
                            <div class="content">
                                <div class="content__status"><?php echo($rows['status']) ?> / <?php echo($rows['namee']) ?></div>
                                <a href="details_posts.php?id=<?php echo($rows['id_post']) ?>&artist_id=<?php echo($rows['artist_id']) ?>&topic=<?php echo($rows['namee']) ?>">
                                    <div class="content__title"><?php echo($rows['title']) ?></div>
                                </a>
                                <div class="content__date"><?php echo($rows['date']) ?></div>
                            </div>
                        </div>
                        <div class="grid__column--3-12">
                        </div>
                    </div>
                    <?php } ?>
                    <div class="grid__row">
                        <div class="grid__column--9-12">
                            <a href="/soundblast/details_topic.php?topic=rook" class="link__view__more">
                                <button class="btn__viewmore btn__primary">
                                    View more
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </a>
                        </div>
                        <div class="grid__column--3-12">
    
                        </div>
                    </div>
                </div>
            </div>
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