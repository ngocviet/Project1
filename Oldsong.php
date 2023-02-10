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
    <title>Old Song</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="./assets/img/Logo-Background/logonew1-removebg-preview.png" type="image/x-icon" class="iconnn" />
    <link rel="stylesheet" href="./assets/fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./assets/js/main.js" ></script>
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
        
        <div id="container" class="release">
            <div class="grid">
                <div class="grid__row" id="release__header">
                    <div class="release__heading">
                        <h1>The Old Songs Of 2021</h1>
                    </div>
                    <div class="release__imgheading" style="background-image: url(./assets/img/Other/oldsong.jpg);">
                    </div>
                    <div class="release__caption">
                        <span>Things felt a little more alive in 2021. Thanks to the miracle of COVID-19 vaccines, that year became one when many people, at least in the U.S., could reconnect with old friends and feasibly make new ones. Restaurants, bars, and crucially, concerts, buzzed once again; even if you still didn't feel up to any of that, you could notice the shift in energy just walking down a city street. Maybe you noticed it in the best songs of 2021 too, which also felt like signs of new life. This year, musicians collaborated and cross-pollinated, they experimented within and outside their genres, and — especially compared to the songs that captured the unease of 2020 — many of them loosened up and had some fun. Many of the songs that resulted gave us reason to do the same, when we desperately needed it most.</span>
                    </div>
                </div>

                <?php
                    $sql = "SELECT * FROM new_release where topic = 'oldsong'";
                    $viet = $conn -> query($sql);
                    $sumPost = $viet -> num_rows;
                    $sumPage = ceil($sumPost/8);
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                    $start = ($page-1)*8;
                    $sql = "SELECT * FROM new_release where topic = 'oldsong' limit $start,8";
                    $viet = $conn->query($sql);
                    while($rows = $viet -> fetch_assoc()){
                ?>
                    <div class="grid__row release__list">
                        <div class="hr"></div>
                        <div class="grid__column--6-12">
                            <div class="release__main">
                                <div class="release__name--song"><?php echo$rows['namee'] ?></div>
                                <div class="release__iframe">
                                    <iframe src="https://youtube.com/embed/<?php echo$rows['link'] ?>" frameborder="0" width="100%" height="400px"></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="grid__column--6-12">
                            <div class="release__caption"><?php echo$rows['describe'] ?></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="grid__row">
                    <div class="grid__column--9-12">
                        <ul class="pagination home__pagination">
                            <li class="pagination__item <?php if($page == 1){echo'no__hover';} ?>" onclick="backPage(<?php echo $page?>,<?php echo $sumPage ?>);">
                                <i class="pagination__item-icon fas fa-angle-left"></i>
                            </li>
                            <!-- current page: pagination__item-page -->
                            <?php
                                for($i=0;$i<$sumPage;$i++){
                            ?>
                            <li class="pagination__item <?php if($page == $i+1){echo'pagination__item-page';} ?>" id="page<?php echo ($i+1); ?>" onclick="page(<?php echo ($i+1); ?>);"><?php echo ($i+1); ?></li>
                            <?php } ?>
                            <li class="pagination__item <?php if($page == $sumPage){echo'no__hover';} ?>" onclick="upPage(<?php echo $page?>,<?php echo $sumPage ?>);">
                                <i class="pagination__item-icon fas fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="grid__column--3-12"></div>
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
<script>
    function page(x){
        window.location.href = "Oldsong.php?page="+x;
    }
    function backPage(page,sumPage){
        if(page != 1){
            x = page-1;
            window.location.href = "Oldsong.php?page="+x;
        }
    }
    function upPage(page,sumPage){
        if(page != sumPage){
            x = page+1;
            window.location.href = "Oldsong.php?page="+x;
        }
    }
</script>
</html>