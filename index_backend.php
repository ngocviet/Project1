<?php
     $conn = new mysqli('localhost','root','','soundblast');
    session_start();
    if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="./assets/css/index_backend.css">
    <link rel="icon" href="./assets/img/Logo-Background/logonew1-removebg-preview.png" type="image/x-icon" class="iconnn" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <script src="./assets/js/main.js"></script>
</head>
<body>
    <div class="signout">
        <button class="btn_signout" onclick="signOut();">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </button>
    </div>
    <header id="header__column">
                <?php
                    if(!isset($_GET['id']) || $_GET['id']==''){
                        header('location: Login.php');
                    }
                    $idadmin = $_GET['id'];
                    $sql = "SELECT * FROM admin where id = '$idadmin'";
                    $viet = $conn ->query($sql);
                    $rows = $viet->fetch_assoc();
                ?>
        <a href="/soundblast/index_backend.php?id=<?php echo$idadmin?>" class="logo">
            <img src="./assets/img/Logo-Background/logonew1.png" alt="">
            <div class="logo__name">Admin</div>
        </a>
        <div class="admin">
            <div class="admin__name">
                <i class="fa-solid fa-user"></i>
                <span><?php echo $rows['fullnamee'] ?></span>
            </div>
        </div>
        <div id="controller">
            <div class="home">
                <div>
                    <i class="fa-solid fa-wrench"></i>
                    Manage
                </div>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <ul class="controller__list">
                <li class="controller__item" id="User" onclick="manageUser();">
                    <i class="fa-solid fa-user"></i>
                    <span>User</span>
                </li>
                <div id="manage__user">
                    <div class="hearding"><h1>MANAGE USER</h1></div>
                    <div class="manage" id="btn__add--user">
                        <button class="btn__manage" onclick="addFormUser();">
                            <i class="fa-solid fa-plus"></i>
                            Add User
                        </button>
                    </div>
                    <div id="add__user">
                        <?php
                            $erradd = '';
                            $errname = '';
                            $errpass = '';
                            $erremaill = '';
                            $errphonee = '';
                            $errimg = '';
                            $statuss = 'true';
                            $success = '';
                            if(isset($_POST['add--user'])):
                                $username = htmlspecialchars($_POST['user_name']);
                                $password = htmlspecialchars($_POST['user_pass']);
                                $emaill = htmlspecialchars($_POST['user_email']);
                                $phonee = htmlspecialchars($_POST['user_phone']);
                                $img = basename($_FILES['img_user']['name']);
                                if($img == ''){
                                    goto next_user;
                                }
                                $target_dir = 'assets/img/Avatar/';
                                $target_file = $target_dir . $img;
                                $imagefileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                if($imagefileType == 'jpg' || $imagefileType == 'png'){
                                    move_uploaded_file($_FILES['img_user']['tmp_name'], $target_file);
                                }else {
                                    $errimg = 'The file must be an image';
                                    $statuss = 'false';
                                }
                                $img = 'Avatar/'.$img;

                                next_user:
                                if($username == '' || empty($username)){
                                    $errname = 'Username is required';
                                    $statuss = 'false';
                                }
                                if($password == '' || empty($password)){
                                    $errpass = 'Password is required';
                                    $statuss = 'false';
                                }else if(strlen($password) < 6){
                                    $errpass = 'Password minlength is 6 character';
                                    $statuss = 'false';
                                }
                                $passwordhash = sha1($password);
                                if($emaill == '' || empty($emaill)){
                                    $erremaill = 'Emaill is required';
                                    $statuss = 'false';
                                }
                                if($phonee == '' || empty($phonee)){ 
                                    $errphonee = 'Phone number is required';
                                    $statuss = 'false';
                                }

                                if($statuss == 'true'){
                                    $sql = sprintf("SELECT * FROM user where namee = '%s'",mysqli_real_escape_string($conn,$username));
                                    $viet = $conn -> query($sql);
                                    if($viet -> num_rows > 0){
                                        $erradd = 'Username exists!<br>';
                                        $erradd .= 'Add fail!';
                                    }else{
                                        $sql =  sprintf("INSERT into user(namee,passwordd,passworddhash,email,phone,avatar) value('%s','%s','%s','%s','%s','%s')",$username,$password,$passwordhash,$emaill,$phonee,$img);
                                        $viet = $conn->query($sql);
                                        $success = "<span style='color:green'>Thanh cong</span>";
                                    }
                                }
                            endif;
                        ?>
                        <div class="formheading"><h3>Form Add User</h3></div>
                        <form action="" method="post" class="form__add" enctype="multipart/form-data">
                            <div><label class="add__label">Name:</label><input type="text" name="user_name" required></div>
                            <div class="err"> <?php echo($errname); ?></div>
                            <div><label class="add__label">Password:</label><input type="pass" name="user_pass" required></div>
                            <div class="err"> <?php echo($errpass); ?></div>
                            <div><label class="add__label">Email:</label><input type="email" name="user_email" required></div>
                            <div class="err"> <?php echo($erremaill); ?></div>
                            <div><label class="add__label">Phone:</label><input type="number" name="user_phone" required></div>
                            <div class="err"> <?php echo($errphonee); ?></div>
                            <div><label class="add__label">Avatar:</label><input type="file" name="img_user"></div>
                            <div class="err"> <?php echo($errimg); ?></div>
                            <div><button class="btn__add" type="submit" name="add--user">ADD</button></div>
                            <div class="err">
                                <?php
                                    echo($erradd);echo($success);
                                ?>
                            </div>
                        </form>
                    </div>
                    <table border="1" id="table__user">
                        <div class="err">
                            <?php
                                if(isset($_GET['removeUser_success'])){
                                    echo "<span style='color:green'>Remove Success</span>";
                                }
                                if(isset($_GET['removeUser_unsuccess'])){
                                    echo "Remove unSuccess";
                                }
                                if(isset($_GET['updateUser_success'])){
                                    echo "<span style='color:green'>Update Success</span>";
                                }
                                if(isset($_GET['updateUser_unsuccess'])){
                                    echo "Update unSuccess";
                                }
                            ?>
                        </div>
                        <thead>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Password Hash</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Avatar</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM user";
                                $viet = $conn -> query($sql);
                                while($rows = $viet->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo($rows['id']) ?></td>
                                <td><?php echo($rows['namee']) ?></td>
                                <td><?php echo($rows['passwordd']) ?></td>
                                <td><?php echo($rows['passworddhash']) ?></td>
                                <td><?php echo($rows['email']) ?></td>
                                <td><?php echo($rows['phone']) ?></td>
                                <td>
                                    <?php
                                        if($rows['avatar'] != ''){
                                    ?>
                                    <img src="./assets/img/<?php echo($rows['avatar']) ?>" alt="no avatar">
                                    <?php } ?>
                                </td>
                                <td>
                                    <button class="btn__option" onclick="updateUser(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-wrench"></i></button>
                                    <button class="btn__option" onclick="removeUser(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <li class="controller__item" id="Artist" onclick="manageArtists();">
                    <i class="fa-solid fa-user"></i>
                    <span>Artists</span>
                </li>
                <div id="manage__artists">
                    <div class="hearding"><h1>MANAGE ARTISTS</h1></div>
                    <div class="manage" id="btn__add--artists">
                        <button class="btn__manage" onclick="addFormArtists();">
                            <i class="fa-solid fa-plus"></i>
                            Add Aritst
                        </button>
                    </div>
                    <div id="add__artists">
                        <?php
                            $sql = "SELECT * FROM artists where top_artist <> 'null'";
                            $viet = $conn-> query($sql);
                            $araytop_artist = [];
                            $araytop_lastweek = [];
                            while($rows = $viet->fetch_assoc()){
                                array_push($araytop_artist, $rows['top_artist']);
                            }
                            $sql = "SELECT * FROM artists where top_last_week <> 'null'";
                            $viet = $conn-> query($sql);
                            while($rows = $viet->fetch_assoc()){
                                array_push($araytop_lastweek, $rows['top_last_week']);
                            }

                            $erradd = '';
                            $errname = '';
                            $errtopartist = '';
                            $errtoplassweek = '';
                            $errimg = '';
                            $statuss = 'true';
                            $success = '';
                            if(isset($_POST['add--artists'])):
                                $artistsname = htmlspecialchars($_POST['artists_name']);
                                $category_id = htmlspecialchars($_POST['category_id']);
                                $top_artists = htmlspecialchars($_POST['artists_top']);
                                $top_lastweek = htmlspecialchars($_POST['artists_toplastweek']);
                                $top_max = htmlspecialchars($_POST['artists_topmax']);
                                $img = basename($_FILES['img_artist']['name']);
                                if($img == ''){
                                    goto next_artist;
                                }
                                $target_dir = 'assets/img/Topartist/';
                                $target_file = $target_dir . $img;
                                $imagefileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                if($imagefileType == 'jpg' || $imagefileType == 'png'){
                                    move_uploaded_file($_FILES['img_artist']['tmp_name'], $target_file);
                                }else {
                                    $errimg = 'The file must be an image';
                                    $statuss = 'false';
                                }
                                $img = 'Topartist/'.$img;

                                next_artist:
                                $sql = sprintf("SELECT * FROM artists where namee = '%s'",$artistsname);
                                $viet = $conn ->query($sql);
                                if($viet -> num_rows > 0){
                                    $errname = 'Artist name  already exist!';
                                    $statuss = 'false';
                                }
                                if($artistsname == '' || empty($artistsname)){
                                    $errname = 'Artist name is required';
                                    $statuss = 'false';
                                }
                                for($i=0;$i<count($araytop_artist);$i++){
                                    if($top_artists == $araytop_artist[$i]){
                                        $errtopartist = 'Top '.$top_artists.' is the only one';
                                        $statuss = 'false';
                                    }
                                }
                                for($i=0;$i<count($araytop_lastweek);$i++){
                                    if($top_lastweek == $araytop_lastweek[$i]){
                                        $errtoplassweek = 'Top '.$top_lastweek.' is the only one';
                                        $statuss = 'false';
                                    }
                                }

                                if($statuss == 'true'){
                                        $sql =  sprintf("INSERT into artists(namee,img,category_id,top_artist,top_last_week,top_max) value('%s','%s','%s','%s','%s','%s')",$artistsname,$img,$category_id,$top_artists,$top_lastweek,$top_max);
                                        $viet = $conn->query($sql);
                                        $success = "<span style='color:green'>Thanh cong</span>";
                                }
                            endif;
                        ?>
                        <div class="formheading"><h3>Form Add Artists</h3></div>
                        <form action="" method="post" class="form__add" enctype="multipart/form-data">
                            <div><label class="add__label">Name:</label><input type="text" name="artists_name" required></div>
                            <div class="err"> <?php echo($errname); ?></div>
                            <div><label class="add__label">Top Artists:</label><input type="number" name="artists_top" ></div>
                            <div class="err"> <?php echo($errtopartist); ?></div>
                            <div><label class="add__label">Top Last Week:</label><input type="number" name="artists_toplastweek" ></div>
                            <div class="err"> <?php echo($errtoplassweek); ?></div>
                            <div><label class="add__label">Top Max:</label><input type="number" name="artists_topmax" ></div>
                            <div>
                                <label class="add__label">Category:</label>
                                <select name="category_id">
                                    <?php 
                                        $sql = "SELECT * FROM category";
                                        $viet = $conn -> query($sql);
                                        while($rows = $viet->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo($rows['id']) ?>"><?php echo($rows['namee']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div><label class="add__label">Img:</label><input type="file" name="img_artist"></div>
                            <div class="err"> <?php echo($errimg); ?></div>
                            <div><button class="btn__add" type="submit" name="add--artists">ADD</button></div>
                            <div class="err">
                                <?php
                                    echo($erradd);echo($success);
                                ?>
                            </div>
                        </form>
                    </div>
                    <table border="1" id="table__artists">
                        <div class="err">
                            <?php
                                if(isset($_GET['removeArtist_success'])){
                                    echo "<span style='color:green'>Remove Success</span>";
                                }
                                if(isset($_GET['removeArtist_unsuccess'])){
                                    echo "Remove unSuccess";
                                }
                                if(isset($_GET['updateArtist_success'])){
                                    echo "<span style='color:green'>Update Success</span>";
                                }
                                if(isset($_GET['updateArtist_unsuccess'])){
                                    echo "Update unSuccess";
                                }
                                if(isset($_GET['removeArtist_unsuccessbecau'])){
                                    echo "Remove Unsuccess Because in The Post there is an article about the artist";
                                    echo"<a href='/soundblast/index_backend.php?id=".$idadmin."' class='btn_ok'>OK</a>";
                                }
                            ?>
                        </div>
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Top Artist</th>
                            <th>Top Last Week</th>
                            <th>Top Max</th>
                            <th>Category</th>
                            <th>Img</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT a.id,a.namee as namee_artist,a.top_artist,a.top_last_week,a.top_max,a.img,b.namee as namee_cate FROM artists a join category b on a.category_id = b.id order by a.id";
                                $viet = $conn -> query($sql);
                                while($rows = $viet->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo($rows['id']) ?></td>
                                <td><?php echo($rows['namee_artist']) ?></td>
                                <td><?php echo($rows['top_artist']) ?></td>
                                <td><?php echo($rows['top_last_week']) ?></td>
                                <td><?php echo($rows['top_max']) ?></td>
                                <td><?php echo $rows['namee_cate'] ?></td>
                                <td><img src="./assets/img/<?php echo($rows['img']) ?>" alt=""></td>
                                <td>
                                    <button class="btn__option" onclick="updateArtist(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-wrench"></i></button>
                                    <button class="btn__option" onclick="removeArtist(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <li class="controller__item" id="Song" onclick="manageSong();">
                    <i class="fa-solid fa-music"></i>
                    <span>The Song</span>
                </li>
                <div id="manage__song">
                    <div class="hearding"><h1>MANAGE THE SONG</h1></div>
                    <div class="manage" id="btn__add--song">
                        <button class="btn__manage" onclick="addFormSong();">
                            <i class="fa-solid fa-plus"></i>
                            Add The Song
                        </button>
                    </div>
                    <div id="add__song">
                        <?php
                            $araytop_charts = [];
                            $araytop_lastweek_charts = [];
                            $araytop_lastweek_search = [];
                            $araytop_lastweek_trending = [];
                            $araytop_search = [];
                            $araytop_trending = [];

                            $sql = "SELECT * FROM the_song where top_charts <> 'null'";
                            $viet = $conn-> query($sql);
                            while($rows = $viet->fetch_assoc()){
                                array_push($araytop_charts, $rows['top_charts']);
                            }
                            $sql = "SELECT * FROM the_song where top_last_week_charts <> 'null'";
                            $viet = $conn-> query($sql);
                            while($rows = $viet->fetch_assoc()){
                                array_push($araytop_lastweek_charts, $rows['top_last_week_charts']);
                            }
                            $sql = "SELECT * FROM the_song where top_last_week_search <> 'null'";
                            $viet = $conn-> query($sql);
                            while($rows = $viet->fetch_assoc()){
                                array_push($araytop_lastweek_search, $rows['top_last_week_search']);
                            }
                            $sql = "SELECT * FROM the_song where top_last_week_trending <> 'null'";
                            $viet = $conn-> query($sql);
                            while($rows = $viet->fetch_assoc()){
                                array_push($araytop_lastweek_trending, $rows['top_last_week_trending']);
                            }
                            $sql = "SELECT * FROM the_song where top_search <> 'null'";
                            $viet = $conn-> query($sql);
                            while($rows = $viet->fetch_assoc()){
                                array_push($araytop_lastweek, $rows['top_search']);
                            }
                            $sql = "SELECT * FROM the_song where top_trending <> 'null'";
                            $viet = $conn-> query($sql);
                            while($rows = $viet->fetch_assoc()){
                                array_push($araytop_lastweek, $rows['top_trending']);
                            }

                            $erradd = '';
                            $errname = '';
                            $errauthor = '';
                            $errtopcharts = '';
                            $errtoplastweek_charts = '';
                            $errtoplastweek_search = '';
                            $errtoplastweek_trending = '';
                            $errtopsearch = '';
                            $errtoptrending = '';
                            $errimg = '';
                            $erraudio = '';
                            $statuss = 'true';
                            $success = '';
                            if(isset($_POST['add--song'])):
                                $songname = htmlspecialchars($_POST['song_name']);
                                $author = htmlspecialchars($_POST['author']);
                                $top_charts = htmlspecialchars($_POST['top_charts']);
                                $top_lastweek_charts = htmlspecialchars($_POST['top_lassweek_song_charts']);
                                $top_lastweek_search = htmlspecialchars($_POST['top_lassweek_song_search']);
                                $top_lastweek_trending = htmlspecialchars($_POST['top_lassweek_song_trending']);
                                $top_max = htmlspecialchars($_POST['top_max_song']);
                                $top_search = htmlspecialchars($_POST['top_search']);
                                $top_trending = htmlspecialchars($_POST['top_trending']);

                                $img = basename($_FILES['img_song']['name']);
                                if($img == ''){
                                    goto next_theSong;
                                }
                                $target_dir_img = 'assets/img/Topcharts/';
                                $target_file_img = $target_dir_img . $img;
                                $imagefileType = strtolower(pathinfo($target_file_img, PATHINFO_EXTENSION));
                                if($imagefileType == 'jpg' || $imagefileType == 'png'){
                                    move_uploaded_file($_FILES['img_song']['tmp_name'], $target_file_img);
                                }else {
                                    $errimg = 'The file must be an image';
                                    $statuss = 'false';
                                }
                                $img = 'Topcharts/'.$img;
    
                                next_theSong:

                                $audio = basename($_FILES['audio_song']['name']);
                                if($audio == ''){
                                    goto next_the_song;
                                }
                                $target_dir_audio = 'assets/audio/';
                                $target_file_audio = $target_dir_audio . $audio;
                                $imagefileType = strtolower(pathinfo($target_file_audio, PATHINFO_EXTENSION));
                                if($imagefileType == 'mp3' || $imagefileType == 'audio'){
                                    move_uploaded_file($_FILES['audio_song']['tmp_name'], $target_file_audio);
                                }else {
                                    $erraudio = 'The file must be an audio';
                                    $statuss = 'false';
                                }

                                next_the_song:
                                if($songname == '' || empty($songname)){
                                    $errname = 'Name Song is required';
                                    $statuss = 'false';
                                }
                                if($author == '' || empty($author)){
                                    $errauthor = 'Name Author is required';
                                    $statuss = 'false';
                                }
                                if($top_charts == '' || empty($top_charts)){
                                    $top_charts = 'NULL';
                                }
                                for($i=0;$i<count($araytop_charts);$i++){
                                    if($top_charts == $araytop_charts[$i]){
                                        $errtopcharts = 'Top '.$top_charts.' is the only one';
                                        $statuss = 'false';
                                    }
                                }
                                for($i=0;$i<count($araytop_lastweek_charts);$i++){
                                    if($top_lastweek_charts == $araytop_lastweek_charts[$i]){
                                        $errtoplastweek_charts = 'Top '.$top_lastweek_charts.' is the only one';
                                        $statuss = 'false';
                                    }
                                }
                                for($i=0;$i<count($araytop_lastweek_search);$i++){
                                    if($top_lastweek_search == $araytop_lastweek_search[$i]){
                                        $errtoplastweek_search = 'Top '.$top_lastweek_search.' is the only one';
                                        $statuss = 'false';
                                    }
                                }
                                for($i=0;$i<count($araytop_lastweek_trending);$i++){
                                    if($top_lastweek_trending == $araytop_lastweek_trending[$i]){
                                        $errtoplastweek_trending = 'Top '.$top_lastweek_trending.' is the only one';
                                        $statuss = 'false';
                                    }
                                }
                                for($i=0;$i<count($araytop_search);$i++){
                                    if($top_search == $araytop_search[$i]){
                                        $errtopsearch = 'Top '.$top_search.' is the only one';
                                        $statuss = 'false';
                                    }
                                } 
                                for($i=0;$i<count($araytop_trending);$i++){
                                    if($top_trending == $araytop_trending[$i]){
                                        $errtoptrending = 'Top '.$top_trending.' is the only one';
                                        $statuss = 'false';
                                    }
                                }

                                if($statuss == 'true'){
                                        $sql =  sprintf("INSERT into the_song(namee,author,top_charts,top_last_week_charts,top_last_week_search,top_last_week_trending,top_max,top_search,top_trending,img,audio) value('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$songname,$author,$top_charts,$top_lastweek_charts,$top_lastweek_search,$top_lastweek_trending,$top_max,$top_search,$top_trending,$img,$audio);
                                        $viet = $conn->query($sql);
                                        $success = "<span style='color:green'>Thanh cong</span>";
                                }else {
                                    $erradd = 'ADD failed';
                                }
                            endif;
                        ?>
                        <div class="formheading"><h3>Form Add The Song</h3></div>
                        <form action="" method="post" class="form__add" enctype="multipart/form-data">
                            <div><label class="add__label">Name:</label><input type="text" name="song_name" required></div>
                            <div class="err"> <?php echo($errname); ?></div>
                            <div><label class="add__label">Author:</label><input type="text" name="author" required></div>
                            <div class="err"> <?php echo($errauthor); ?></div>
                            <div><label class="add__label">Top Charts:</label><input type="number" name="top_charts"></div>
                            <div class="err"> <?php echo($errtopcharts); ?></div>
                            <div><label class="add__label">Top Last Week Charts:</label><input type="number" name="top_lassweek_song_charts"></div>
                            <div class="err"> <?php echo($errtoplastweek_charts); ?></div>
                            <div><label class="add__label">Top Search:</label><input type="number" name="top_search"></div>
                            <div class="err"> <?php echo($errtopsearch); ?></div>
                            <div><label class="add__label">Top Last Week Search:</label><input type="number" name="top_lassweek_song_search"></div>
                            <div class="err"> <?php echo($errtoplastweek_search); ?></div>
                            <div><label class="add__label">Top Trending:</label><input type="number" name="top_trending"></div>
                            <div class="err"> <?php echo($errtoptrending); ?></div>
                            <div><label class="add__label">Top Last Week Trending:</label><input type="number" name="top_lassweek_song_trending"></div>
                            <div class="err"> <?php echo($errtoplastweek_trending); ?></div>
                            <div><label class="add__label">Top Max:</label><input type="number" name="top_max_song"></div>
                            <div><label class="add__label">Audio:</label><input type="file" name="audio_song"></div>
                            <div class="err"> <?php echo($erraudio); ?></div>
                            <div><label class="add__label">Img:</label><input type="file" name="img_song"></div>
                            <div class="err"> <?php echo($errimg); ?></div>
                            <div><button class="btn__add" type="submit" name="add--song">ADD</button></div>
                            <div class="err">
                                <?php
                                    echo($erradd);echo($success);
                                ?>
                            </div>
                        </form>
                    </div>
                    <table border="1" id="table__song">
                        <div class="err">
                            <?php
                                if(isset($_GET['removeTheSong_success'])){
                                    echo "<span style='color:green'>Remove Success</span>";
                                }
                                if(isset($_GET['removeTheSong_unsuccess'])){
                                    echo "Remove un Success";
                                }
                                if(isset($_GET['updateSong_success'])){
                                    echo "<span style='color:green'>Update Success</span>";
                                }
                                if(isset($_GET['updateSong_unsuccess'])){
                                    echo "Update un Success";
                                }
                            ?>
                        </div>
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Img</th>
                            <th>Top Charts</th>
                            <th>Top Search</th>
                            <th>Top Trending</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM the_song";
                                $viet = $conn -> query($sql);
                                while($rows = $viet->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo($rows['id']) ?></td>
                                <td><?php echo($rows['namee']) ?></td>
                                <td><?php echo($rows['author']) ?></td>
                                <td><img src="./assets/img/<?php echo($rows['img']) ?>" /></td>
                                <td><?php echo($rows['top_charts']) ?></td>
                                <td><?php echo($rows['top_search']) ?></td>
                                <td><?php echo($rows['top_trending']) ?></td>
                                <td>
                                    <button class="btn__option" onclick="updateTheSong(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-wrench"></i></button>
                                    <button class="btn__option" onclick="removeTheSong(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <li class="controller__item" id="Release" onclick="manageRelease();">
                    <i class="fa-solid fa-music"></i>
                    <span>New Release</span>
                </li>
                <div id="manage__release">
                    <div class="hearding"><h1>MANAGE RELEASE</h1></div>
                    <div class="manage" id="btn__add--release">
                        <button class="btn__manage" onclick="addFormRelease();">
                            <i class="fa-solid fa-plus"></i>
                            Add Release
                        </button>
                    </div>
                    <div id="add__release">
                        <?php
                            $erradd = '';
                            $errname = '';
                            $errlink = '';
                            $errtopic = '';
                            $statuss = 'true';
                            $success = '';
                            if(isset($_POST['add--release'])):
                                $name = htmlspecialchars($_POST['release_name']);
                                $link = htmlspecialchars($_POST['release_link']);
                                $describe = htmlspecialchars($_POST['release_describe']);
                                $topic = htmlspecialchars($_POST['release_topic']);
                                
                                if($name == '' || empty($name)){
                                    $errname = 'Name is required';
                                    $statuss = 'false';
                                }
                                if($link == '' || empty($link)){
                                    $errlink = 'Link Youtube is required';
                                    $statuss = 'false';
                                }
                                if($topic == '' || empty($topic)){
                                    $errtopic = 'Topic is required';
                                    $statuss = 'false';
                                }

                                if($statuss == 'true'){
                                    $sql = sprintf("INSERT into new_release(namee,link,describe,topic) values('%s','%s','%s','%s')",$name,$link,$describe,$topic);
                                    $viet = $conn->query($sql);
                                    if($viet){
                                        $success = "<span style='color:green'>Thanh cong</span>";
                                    }
                                }
                            endif;
                        ?>
                        <div class="formheading"><h3>Form Add New Release</h3></div>
                        <form action="" method="post" class="form__add" enctype="multipart/form-data">
                            <div><label class="add__label">Name:</label><input type="text" name="release_name" required></div>
                            <div class="err"> <?php echo($errname); ?></div>
                            <div><label class="add__label">Link :</label><input type="text" name="release_link" required></div>
                            <div class="err"> <?php echo($errlink); ?></div>
                            <div class="label__textarea"><label class="add__label">Decrible:</label><textarea class="textarea" rows="8" name="release_describe"></textarea></div>
                            <div>
                                <label class="add__label">Topic:</label>
                                <select name="release_topic">
                                    <option value="newrelease">New Release</option>
                                    <option value="oldsong">Old Song</option>
                                    <option value="newalbum">New Albums</option>
                                </select>
                            </div>
                            <div class="err"> <?php echo($errtopic); ?></div>
                            <div><button class="btn__add" type="submit" name="add--release">ADD</button></div>
                            <div class="err">
                                <?php
                                    echo($erradd);echo($success);
                                ?>
                            </div>
                        </form>
                    </div>
                    <table border="1" id="table__release">
                        <div class="err">
                            <?php
                                if(isset($_GET['removeRelease_success'])){
                                    echo "<span style='color:green'>Remove Success</span>";
                                }
                                if(isset($_GET['removeRelease_unsuccess'])){
                                    echo "Remove unSuccess";
                                }
                                if(isset($_GET['updateRelease_success'])){
                                    echo "<span style='color:green'>Update Success</span>";
                                }
                                if(isset($_GET['updateRelease_unsuccess'])){
                                    echo "Update unSuccess";
                                }
                            ?>
                        </div>
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Topic</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM new_release";
                                $viet = $conn -> query($sql);
                                while($rows = $viet->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo($rows['id']) ?></td>
                                <td><?php echo($rows['namee']) ?></td>
                                <td><?php echo($rows['link']) ?></td>
                                <td><?php echo($rows['topic']) ?></td>
                                <td>
                                    <button class="btn__option" onclick="updateRelease(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-wrench"></i></button>
                                    <button class="btn__option" onclick="removeRelease(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <li class="controller__item" id="Category" onclick="manageCategory();">
                    <i class="fa-solid fa-bars"></i>
                    <span>Category</span>
                </li>
                <div id="manage__category">
                    <div class="hearding"><h1>MANAGE THE Category</h1></div>
                    <div class="manage" id="btn__add--cate">
                        <button class="btn__manage" onclick="addFormCate();">
                            <i class="fa-solid fa-plus"></i>
                            Add Category
                        </button>
                    </div>
                    <div id="add__cate">
                        <?php
                            $erradd = '';
                            $errname = '';
                            $statuss = 'true';
                            $success = '';
                            if(isset($_POST['add--cate'])):
                                $name = htmlspecialchars($_POST['cate_name']);
                                if($name == '' || empty($name)){
                                    $errname = 'Name is required';
                                    $statuss = 'false';
                                }
                                $sql = sprintf("SELECT * FROM category where namee = '%s'",$name);
                                $viet = $conn->query($sql);
                                if($viet->num_rows > 0 ){
                                    $errname = 'Name is exists';
                                    $statuss = 'false';
                                }

                                if($statuss == 'true'){
                                    $sql =  sprintf("INSERT into category(namee) value('%s')",$name);
                                    $viet = $conn->query($sql);
                                    $success = "<span style='color:green'>Thanh cong</span>";
                                }
                            endif;
                        ?>
                        <div class="formheading"><h3>Form Add Category</h3></div>
                        <form action="" method="post" class="form__add">
                            <div><label class="add__label">Name:</label><input type="text" name="cate_name" required></div>
                            <div class="err"> <?php echo($errname); ?></div>
                            <div><button class="btn__add" type="submit" name="add--cate">ADD</button></div>
                            <div class="err">
                                <?php echo($erradd);echo($success); ?>
                            </div>
                        </form>
                    </div>
                    <table border="1" id="table__category">
                        <div class="err">
                            <?php
                                if(isset($_GET['removeCategory_success'])){
                                    echo "<span style='color:green'>Remove Success</span>";
                                }
                                if(isset($_GET['removeCategory_unsuccess'])){
                                    echo"Remove unSuccess";
                                }
                                if(isset($_GET['updateCategory_success'])){
                                    echo "<span style='color:green'>Update Success</span>";
                                }
                                if(isset($_GET['updateCategory_unsuccess'])){
                                    echo"Update unSuccess";
                                }
                                if(isset($_GET['removeCategory_unsuccessbecau'])){
                                    echo"Update Unsuccess Because in The Post and in The Artist there is an article about The Category";
                                    echo"<a href='/soundblast/index_backend.php?id=".$idadmin."' class='btn_ok'>OK</a>";
                                }
                            ?>
                        </div>
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM category";
                                $viet = $conn -> query($sql);
                                while($rows = $viet->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo($rows['id']) ?></td>
                                <td><?php echo($rows['namee']) ?></td>
                                <td>
                                    <button class="btn__option" onclick="updateCategory(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-wrench"></i></button>
                                    <button class="btn__option" onclick="removeCategory(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <li class="controller__item" id="Posts" onclick="managePosts();">
                    <i class="fa-solid fa-file-pen"></i>
                    <span>Posts</span>
                </li>
                
                <div id="manage__posts">
                    <div class="hearding"><h1>MANAGE Posts</h1></div>
                    <div class="manage" id="btn__add--post">
                        <button class="btn__manage" onclick="addFormPost();">
                            <i class="fa-solid fa-plus"></i>
                            Add Posts
                        </button>
                    </div>
                    <div id="add__post">
                        <?php
                            $erradd = '';
                            $errpostname = '';
                            $errtitle = '';
                            $errcontent = '';
                            $statuss = 'true';
                            $success = '';
                            if(isset($_POST['add--post'])):
                                $category = htmlspecialchars($_POST['category']);
                                $artist = htmlspecialchars($_POST['artists_id']);
                                $title = htmlspecialchars($_POST['title_post']);
                                $content = $_POST['content_post'];
                                $dob = htmlspecialchars($_POST['date_post']);
                                
                                $sql = "SELECT * FROM category where id = $category";
                                $viet = $conn->query($sql);
                                $category_name = $viet->fetch_assoc();
                                $category_name = $category_name['namee'];

                                $img = basename($_FILES['img_post']['name']);
                                if($img == ''){
                                    goto next_post;
                                }
                                $target_dir = 'assets/img/'.$category_name.'/';
                                $target_file = $target_dir . $img;
                                $imagefileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                if($imagefileType == 'jpg' || $imagefileType == 'png'){
                                    move_uploaded_file($_FILES['img_post']['tmp_name'], $target_file);
                                }else {
                                    $errimg = 'The file must be an image';
                                    $statuss = 'false';
                                }
                                $img = $category_name . '/' . $img;

                                next_post:
                                if($title == '' || empty($title)){
                                    $errtitle = 'Title is required';
                                    $statuss = 'false';
                                }
                                if($content == '' || empty($content)){
                                    $errcontent = 'Content is required';
                                    $statuss = 'false';
                                }

                                if($statuss == 'true'){
                                        $sql =  sprintf("INSERT into main_content(category_id,artist_id,title,content,date,img) value('%s','%s','%s','%s','%s','%s')",$category,$artist,$title,$content,$dob,$img);
                                        $viet = $conn->query($sql);
                                        $success = "<span style='color:green'>Thanh cong</span>";
                                }
                            endif;
                        ?>
                        <div class="formheading"><h3>Form Add Post</h3></div>
                        <form action="" method="post" class="form__add" enctype="multipart/form-data">
                            <div><label class="add__label">Category:</label>
                                <select name="category">
                                    <?php 
                                        $sql = "SELECT * FROM category";
                                        $viet = $conn -> query($sql);
                                        while($rows = $viet->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo($rows['id']) ?>"><?php echo($rows['namee']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div><label class="add__label">Artist:</label>
                                <select name="artists_id">
                                    <?php 
                                        $sql = "SELECT * FROM artists";
                                        $viet = $conn -> query($sql);
                                        while($rows = $viet->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo($rows['id']) ?>"><?php echo($rows['namee']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div><label class="add_label">Title:</label><input type="text" name="title_post" required></div>
                            <div class=" label__textarea"><label class="add_label">Content:</label><textarea class="textarea" rows="5" name="content_post"></textarea></div>
                            <div><label class="add_label">Img:</label><input type="file" name="img_post" required></div>
                            <div><label class="add_label">Date:</label><input type="date" name="date_post" required></div>
                            <div><button class="btn__add" type="submit" name="add--post">ADD</button></div>
                            <div class="err">
                                <?php
                                    echo($erradd);echo($success);
                                ?>
                            </div>
                        </form>
                    </div>
                    <table border="1" id="table__posts">
                        <div class="err">
                            <?php
                                if(isset($_GET['removePost_success'])){
                                    echo "<span style='color:green'>Remove Success</span>";
                                }
                                if(isset($_GET['removePost_unsuccess'])){
                                    echo"Remove unSuccess";
                                }
                                if(isset($_GET['updatePost_success'])){
                                    echo "<span style='color:green'>Update Success</span>";
                                }
                                if(isset($_GET['updatePost_unsuccess'])){
                                    echo"Update unSuccess";
                                }
                            ?>
                        </div>
                        <thead>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Artist</th>
                            <th>Title</th>
                            <th>Img</th>
                            <th>Date</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT a.id,b.namee as namee_artist,c.namee as name_cate,a.title,a.img,a.content,a.date FROM main_content a join artists b on a.artist_id = b.id join category c on a.category_id = c.id";
                                $viet = $conn -> query($sql);
                                while($rows = $viet->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo($rows['id']) ?></td>
                                <td><?php echo($rows['name_cate']) ?></td>
                                <td><?php echo($rows['namee_artist']) ?></td>
                                <td class="posts__title"><?php echo($rows['title']) ?></td>
                                <td> <img src="./assets/img/<?php echo($rows['img']) ?>"></td>
                                <td><?php echo($rows['date']) ?></td>
                                <td>
                                    <button class="btn__option" onclick="updatePost(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-wrench"></i></button>
                                    <button class="btn__option" onclick="removePost(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <li class="controller__item" id="Contact" onclick="manageContact();">
                    <i class="fa-solid fa-address-card"></i>
                    <span>Contact</span>
                </li>
                <div id="manage__contact">
                    <div class="hearding"><h1>MANAGE Contact</h1></div>
                    
                    <table border="1" id="table__contact">
                        <div class="err">
                            <?php 
                                if(isset($_GET['removeContact_success'])){
                                    echo "<span style='color:green'>Remove Success</span>";
                                }
                                if(isset($_GET['removeContact_unsuccess'])){
                                    echo"Remove unSuccess";
                                }
                            ?>
                        </div>
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Content</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM contact";
                                $viet = $conn -> query($sql);
                                while($rows = $viet->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo($rows['id']) ?></td>
                                <td><?php echo($rows['namee']) ?></td>
                                <td><?php echo($rows['email']) ?></td>
                                <td><?php echo($rows['content']) ?></td>
                                <td>
                                    <button class="btn__option" onclick="removeContact(<?php echo($rows['id']);echo', ';echo $idadmin ?>);"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </ul>
        </div>
    </header>
    <script src="./assets/js/main.js"></script>
</body>
</html>
<?php
    }else{
        header('location: Login.php');
    }
?>