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
    <div class="back__backend">
        <a href="index_backend.php?id=1" class="back_back--end"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <?php
    $conn = new mysqli('localhost','root','','soundblast');
        if(isset($_GET['iduser'])){
    ?>
    <div id="form__update">
        <div class="formheading"><h3>Form Update User</h3></div>
        <form action="" method="post" class="form__add" enctype="multipart/form-data">
            <?php
                $idadmin = $_GET['id'];
                $id = $_GET['iduser'];
                $erradd = '';
                $errname = '';
                $errpass = '';
                $erremaill = '';
                $errphonee = '';
                $errimg = '';
                $statuss = 'true';
                $success = '';
                if(isset($_POST['update--user'])):
                    $username = htmlspecialchars($_POST['user_name']);
                    $password = htmlspecialchars($_POST['user_pass']);
                    $emaill = htmlspecialchars($_POST['user_email']);
                    $phonee = htmlspecialchars($_POST['user_phone']);

                    $img = basename($_FILES['img_user']['name']);
                    if($img == ''){
                        goto next;
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

                    next:
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
                        $sql =  sprintf("UPDATE user SET namee = '%s', passwordd = '%s',passworddhash = '%s',email = '%s',phone = '%s',avatar = '%s' where id = '$id'",$username,$password,$passwordhash,$emaill,$phonee,$img);
                        $viet = $conn->query($sql);
                        if($viet){
                            header('location: index_backend.php?id='.$idadmin.'&updateUser_success');
                        }else{
                            header('location: index_backend.php?id='.$idadmin.'&updateUser_unsuccess');
                        }
                    }
                endif;
                $sql = sprintf("SELECT * FROM user where id = '$id'");
                $viet = $conn->query($sql);
                $rows = $viet ->fetch_assoc();
            ?>
            <div><label class="add__label">Name:</label><input required type="text" name="user_name" value="<?php echo $rows['namee']; ?>"></div>
            <div class="err"> <?php echo($errname); ?></div>
            <div><label class="add__label">Password:</label><input required type="text" name="user_pass" value="<?php echo $rows['passwordd']; ?>"></div>
            <div class="err"> <?php echo($errpass); ?></div>
            <div><label class="add__label">Email:</label><input required type="email" name="user_email" value="<?php echo $rows['email']; ?>"></div>
            <div class="err"> <?php echo($erremaill); ?></div>
            <div><label class="add__label">Phone:</label><input required type="number" minlength="6" name="user_phone" value="<?php echo $rows['phone']; ?>"></div>
            <div class="err"> <?php echo($errphonee); ?></div>
            <div><label class="add__label">Avatar:</label><input type="file" name="img_user"></div>
            <div class="err"> <?php echo($errimg); ?></div>
            <div><button class="btn__add" type="submit" name="update--user">UPDATE</button></div>
        </form>
    </div>
    <?php } ?>
    <?php
        if(isset($_GET['idartist'])){
    ?>
    <div id="form__update">
        <div class="formheading"><h3>Form Update Artist</h3></div>
        <form action="" method="post" class="form__add" enctype="multipart/form-data">
            <?php
                $idadmin = $_GET['id'];
                $id = $_GET['idartist'];
                $sql = sprintf("SELECT * FROM artists where id = '$id'"); 
                $viet = $conn->query($sql);
                $rows = $viet ->fetch_assoc();
                $top_artists_old = $rows['top_artist'];
                $top_lastweek_old = $rows['top_last_week'];

                $erradd = '';
                $errname = '';
                $errtopartist = '';
                $errtoplassweek = '';
                $errimg = '';
                $statuss = 'true';
                $success = '';
                if(isset($_POST['update--artist'])):
                    $artistsname = htmlspecialchars($_POST['artist_name']);
                    $category_id = htmlspecialchars($_POST['artist_category']);
                    $top_artists = htmlspecialchars($_POST['aritst_top_artist']);
                    $top_lastweek = htmlspecialchars($_POST['artist_top_lastweek']);
                    $top_max = htmlspecialchars($_POST['artist_topmax']);
                    
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
                    $sql = "SELECT * FROM artists where top_artist <> 'null' and top_artist <> '$top_artists_old'";
                    $viet = $conn-> query($sql);
                    $araytop_artist = [];
                    $araytop_lastweek = [];
                    while($rows = $viet->fetch_assoc()){
                        array_push($araytop_artist, $rows['top_artist']);
                    }
                    $sql = "SELECT * FROM artists where top_last_week <> 'null' and top_last_week <> '$top_lastweek_old'";
                    $viet = $conn-> query($sql);
                    while($rows = $viet->fetch_assoc()){
                        array_push($araytop_lastweek, $rows['top_last_week']);
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
                        $sql =  sprintf("UPDATE artists SET namee = '%s', category_id = '%s', top_artist = '%s', top_last_week = '%s', top_max = '%s', promotion = '%s', img = '%s'  where id = '$id'",$artistsname,$category_id,$top_artists,$top_lastweek,$top_max,$promotion,$img);
                        $viet = $conn->query($sql);
                        if($viet){
                            header('location: index_backend.php?id='.$idadmin.'&updateArtist_success');
                        }else{
                            header('location: index_backend.php?id='.$idadmin.'&updateArtist_unsuccess');
                        }
                    }
                endif;
                $sql = sprintf("SELECT * FROM artists where id = '$id'");
                $viet = $conn->query($sql);
                $rows = $viet ->fetch_assoc();
                $category_old_artist = $rows['category_id']
            ?>
            <div><label class="add__label">Name:</label><input required type="text" name="artist_name" value="<?php echo $rows['namee']; ?>"></div>
            <div class="err"> <?php echo($errname); ?></div>
            <div>
                <label class="add__label">Category:</label>
                <select name="artist_category">
                    <?php 
                        $sql = "SELECT * FROM category";
                        $viet = $conn -> query($sql);
                        while($rows = $viet->fetch_assoc()){
                    ?>
                    <option value="<?php echo($rows['id']) ?>"<?php if($rows['id']==$category_old_artist){echo'selected="selected"';} ?>><?php echo($rows['namee']) ?></option>
                    <?php
                        }
                        $sql = sprintf("SELECT * FROM artists where id = '$id'");
                        $viet = $conn->query($sql);
                        $rows = $viet ->fetch_assoc();
                    ?>
                </select>
            </div>
            <div><label class="add__label">Top Artist:</label><input type="text" name="aritst_top_artist" value="<?php echo $rows['top_artist']; ?>"></div>
            <div class="err"> <?php echo($errtopartist); ?></div>
            <div><label class="add__label">Top Last Week:</label><input type="text" name="artist_top_lastweek" value="<?php echo $rows['top_last_week']; ?>"></div>
            <div class="err"> <?php echo($errtoplassweek); ?></div>
            <div><label class="add__label">Top Max:</label><input type="text" name="artist_topmax" value="<?php echo $rows['top_max']; ?>"></div>
            <div><label class="add__label">Img:</label><input type="file" name="img_artist"></div>
            <div class="err"> <?php echo($errimg); ?></div>
            <div><button class="btn__add" type="submit" name="update--artist">UPDATE</button></div>
            <div class="err"> <?php echo($erradd); ?></div>
        </form>
    </div>
    <?php } ?>
    <?php
        if(isset($_GET['idsong'])){
    ?>
    <div id="form__update">
        <div class="formheading"><h3>Form Update The Song</h3></div>
        <form action="" method="post" class="form__add" enctype="multipart/form-data">
            <?php
                $idadmin = $_GET['id'];
                $id = $_GET['idsong'];
                $sql = sprintf("SELECT * FROM the_song where id = '$id'");
                $viet = $conn->query($sql);
                $rows = $viet ->fetch_assoc();
                $topcharts_old = $rows['top_charts'];
                $toplastweek_old_charts = $rows['top_last_week_charts'];
                $toplastweek_old_search = $rows['top_last_week_search'];
                $toplastweek_old_trending = $rows['top_last_week_trending'];
                $topsearch_old = $rows['top_search'];
                $toptrending_old = $rows['top_trending'];

                $araytop_charts = [];
                $araytop_lastweek_charts = [];
                $araytop_lastweek_search = [];
                $araytop_lastweek_trending = [];
                $araytop_search = [];
                $araytop_trending = [];

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
                if(isset($_POST['update--song'])):
                    $songname = htmlspecialchars($_POST['song_name']);
                    $author = htmlspecialchars($_POST['author']);
                    $top_charts = htmlspecialchars($_POST['top_charts']);
                    $top_lastweek_charts = htmlspecialchars($_POST['top_lassweek_song_charts']);
                    $top_lastweek_search = htmlspecialchars($_POST['top_lassweek_song_search']);
                    $top_lastweek_trending = htmlspecialchars($_POST['top_lassweek_song_trending']);
                    $top_max = htmlspecialchars($_POST['top_max_song']);
                    $top_search = htmlspecialchars($_POST['top_search']);
                    $top_trending = htmlspecialchars($_POST['top_trending']);

                    $sql = "SELECT * FROM the_song where top_charts <> 'null' and top_charts <> '$topcharts_old'";
                    $viet = $conn-> query($sql);
                    while($rows = $viet->fetch_assoc()){
                        array_push($araytop_charts, $rows['top_charts']);
                    }
                    $sql = "SELECT * FROM the_song where top_last_week_charts <> 'null' and top_last_week_charts <> '$toplastweek_old_charts'";
                    $viet = $conn-> query($sql);
                    while($rows = $viet->fetch_assoc()){
                        array_push($araytop_lastweek_charts, $rows['top_last_week_charts']);
                    }
                    $sql = "SELECT * FROM the_song where top_last_week_search <> 'null' and top_last_week_search <> '$toplastweek_old_search'";
                    $viet = $conn-> query($sql);
                    while($rows = $viet->fetch_assoc()){
                        array_push($araytop_lastweek_search, $rows['top_last_week_search']);
                    }
                    $sql = "SELECT * FROM the_song where top_last_week_trending <> 'null' and top_last_week_trending <> '$toplastweek_old_trending'";
                    $viet = $conn-> query($sql);
                    while($rows = $viet->fetch_assoc()){
                        array_push($araytop_lastweek_trending, $rows['top_last_week_trending']);
                    }
                    $sql = "SELECT * FROM the_song where top_search <> 'null' and top_search <> '$topsearch_old'";
                    $viet = $conn-> query($sql);
                    while($rows = $viet->fetch_assoc()){
                        array_push($araytop_search, $rows['top_search']);
                    }
                    $sql = "SELECT * FROM the_song where top_trending <> 'null' and top_trending <> '$toptrending_old'";
                    $viet = $conn-> query($sql);
                    while($rows = $viet->fetch_assoc()){
                        array_push($araytop_trending, $rows['top_trending']);
                    }

                    $img = basename($_FILES['img_song']['name']);
                    if($img == ''){
                        goto nextthesong;
                    }
                    $target_dir = 'assets/img/Topcharts/';
                    $target_file = $target_dir . $img;
                    $imagefileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if($imagefileType == 'jpg' || $imagefileType == 'png'){
                        move_uploaded_file($_FILES['img_song']['tmp_name'], $target_file);
                    }else {
                        $errimg = 'The file must be an image';
                        $statuss = 'false';
                    }
                    $img = 'Topcharts/'.$img;

                    nextthesong:

                    $audio = basename($_FILES['audio_song']['name']);
                    if($audio == ''){
                        goto nextthesongg;
                    }
                    $target_dir = 'assets/audio/';
                    $target_file = $target_dir . $audio;
                    $imagefileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if($imagefileType == 'mp3' || $imagefileType == 'audio'){
                        move_uploaded_file($_FILES['audio_song']['tmp_name'], $target_file);
                    }else {
                        $erraudio = 'The file must be an audio';
                        $statuss = 'false';
                    }
                    $audio = $audio;

                    nextthesongg:
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
                            $errtopcharts = 'Top '.$topcharts.' is the only one';
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
                            $sql =  sprintf("UPDATE the_song SET namee = '%s', author = '%s', top_charts = '%s', top_last_week_charts = '%s', top_last_week_search = '%s', top_last_week_trending = '%s', top_max = '%s', top_search = '%s', top_trending = '%s', img = '%s', audio = '%s' where id = '$id'",$songname,$author,$top_charts,$top_lastweek_charts,$top_lastweek_search,$top_lastweek_trending,$top_max,$top_search,$top_trending,$img,$audio);
                            $viet = $conn->query($sql);
                            if($viet){
                                header('location: index_backend.php?id='.$idadmin.'&updateSong_success');
                            }else{
                                header('location: index_backend.php?id='.$idadmin.'&updateSong_unsuccess');
                            }
                    }
                endif;
                $sql = sprintf("SELECT * FROM the_song where id = '$id'");
                $viet = $conn->query($sql);
                $rows = $viet ->fetch_assoc();
            ?>
            <div><label class="add__label">Name:</label><input type="text" name="song_name" value="<?php echo$rows['namee'] ?>" required></div>
            <div class="err"> <?php echo($errname); ?></div>
            <div><label class="add__label">Author:</label><input type="text" name="author" value="<?php echo$rows['author'] ?>" required></div>
            <div class="err"> <?php echo($errauthor); ?></div>
            <div><label class="add__label">Top Charts:</label><input type="number" name="top_charts" value="<?php echo$rows['top_charts'] ?>"></div>
            <div class="err"> <?php echo($errtopcharts); ?></div>
            <div><label class="add__label">Top Last Week Charts:</label><input type="number" name="top_lassweek_song_charts" value="<?php echo$rows['top_last_week_charts'] ?>"></div>
            <div class="err"> <?php echo($errtoplastweek_charts); ?></div>
            <div><label class="add__label">Top Search:</label><input type="number" name="top_search" value="<?php echo$rows['top_search'] ?>"></div>
            <div class="err"> <?php echo($errtopsearch); ?></div>
            <div><label class="add__label">Top Last Week Search:</label><input type="number" name="top_lassweek_song_search" value="<?php echo$rows['top_last_week_search'] ?>"></div>
            <div class="err"> <?php echo($errtoplastweek_search); ?></div>
            <div><label class="add__label">Top Trending:</label><input type="number" name="top_trending" value="<?php echo $rows['top_trending'] ?>"></div>
            <div class="err"> <?php echo($errtoptrending); ?></div>
            <div><label class="add__label">Top Last Week Trending:</label><input type="number" name="top_lassweek_song_trending" value="<?php echo$rows['top_last_week_trending'] ?>"></div>
            <div class="err"> <?php echo($errtoplastweek_trending); ?></div>
            <div><label class="add__label">Top Max:</label><input type="number" name="top_max_song" value="<?php echo$rows['top_max'] ?>"></div>
            <div><label class="add__label">Audio:</label><input type="file" name="audio_song"></div>
            <div class="err"> <?php echo($erraudio); ?></div>
            <div><label class="add__label">Img:</label><input type="file" name="img_song"></div>
            <div class="err"> <?php echo($errimg); ?></div>
            <div><button class="btn__add" type="submit" name="update--song">UPDATE</button></div>
            <div class="err">
                <?php
                    echo($erradd);echo($success);
                ?>
            </div>
        </form>
    </div>
    <?php } ?>
    <?php
        if(isset($_GET['idcategory'])){
    ?>
    <div id="form__update">
        <div class="formheading"><h3>Form Update Category</h3></div>
        <form action="" method="post" class="form__add" enctype="multipart/form-data">
            <?php
                $idadmin = $_GET['id'];
                $id = $_GET['idcategory'];
                $erradd = '';
                $errname = '';
                $statuss = 'true';
                $success = '';
                if(isset($_POST['update--cate'])):
                    $name = htmlspecialchars($_POST['cate_name']);
                    if($name == '' || empty($name)){
                        $errname = 'Name is required';
                        $statuss = 'false';
                    }

                    if($statuss == 'true'){
                            $sql =  sprintf("UPDATE category SET namee='%s' where id = '$id'",$name);
                            $viet = $conn->query($sql);
                            if($viet){
                                header('location: index_backend.php?id='.$idadmin.'&updateCategory_success');
                            }else{
                                header('location: index_backend.php?id='.$idadmin.'&updateCategory_unsuccess');
                            }
                    }
                endif;
                $sql = sprintf("SELECT * FROM category where id = '$id'");
                $viet = $conn->query($sql);
                $rows = $viet ->fetch_assoc();
            ?>
            <div><label class="add__label">Name:</label><input type="text" name="cate_name" required value="<?php echo $rows['namee'] ?>"></div>
            <div class="err"> <?php echo($errname); ?></div>
            <div><button class="btn__add" type="submit" name="update--cate">UPDATE</button></div>
            <div class="err"><?php echo($erradd)?></div>
        </form>
    </div>
    <?php } ?>
    <?php
        if(isset($_GET['idpost'])){
    ?>
    <div id="form__update">
        <div class="formheading"><h3>Form Update Post</h3></div>
        <form action="" method="post" class="form__add" enctype="multipart/form-data">
            <?php
                $idadmin = $_GET['id'];
                $id = $_GET['idpost'];
                $erradd = '';
                $errpostname = '';
                $errtitle = '';
                $errcontent = '';
                $errimg = '';
                $statuss = 'true';
                $success = '';
                if(isset($_POST['update--post'])):
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
                        goto next__post;
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

                    next__post:
                    if($title == '' || empty($title)){
                        $errtitle = 'Title is required';
                        $statuss = 'false';
                    }
                    if($content == '' || empty($content)){
                        $errcontent = 'Content is required';
                        $statuss = 'false';
                    }

                    if($statuss == 'true'){
                            $sql =  sprintf("UPDATE main_content SET category_id = '%s', artist_id = '%s', title = '%s', content = '%s', date = '%s', img = '%s' where id = '$id'",$category,$artist,$title,$content,$dob,$img);
                            $viet = $conn->query($sql);
                            if($viet){
                                header('location: index_backend.php?id='.$idadmin.'&updatePost_success');
                            }else{
                                header('location: index_backend.php?id='.$idadmin.'&updatePost_unsuccess');
                            }
                    }
                endif;
                $sql = sprintf("SELECT * FROM main_content where id = '$id'");
                $viet = $conn->query($sql);
                $rows = $viet ->fetch_assoc();
                $artist_old = $rows['artist_id'];
                $category_old = $rows['category_id'];
            ?>
            <div><label class="add__label">Category:</label>
                <select name="category">
                    <?php 
                        $sql = "SELECT * FROM category";
                        $viet = $conn -> query($sql);
                        while($rows = $viet->fetch_assoc()){
                    ?>
                    <option value="<?php echo($rows['id']) ?>"<?php if($rows['id']==$category_old){echo'selected="selected"';} ?>><?php echo($rows['namee']) ?></option>
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
                    <option value="<?php echo($rows['id']) ?>" <?php if($rows['id']==$artist_old){echo'selected="selected"';} ?>>
                        <?php echo($rows['namee']) ?>
                    </option>
                    <?php
                        } 
                        $sql = sprintf("SELECT * FROM main_content where id = '$id'");
                        $viet = $conn->query($sql);
                        $rows = $viet ->fetch_assoc();                    
                    ?>
                </select>
            </div>
            <div><label class="add_label">Title:</label><input type="text" name="title_post" required value="<?php echo $rows['title'] ?>"></div>
            <div class="err"><?php echo($errtitle) ?></div>
            <div style="display: none;"><span id="post_content"><?php echo$rows['content'] ?></span></div>
            <div class=" label__textarea"><label class="add_label">Content:</label><textarea id="textarea__post" class="textarea" rows="8" name="content_post" required></textarea></div>
            <div class="err"><?php echo($errcontent) ?></div>
            <div><label class="add_label">Img:</label><input type="file" name="img_post" required></div>
            <div class="err"><?php echo($errimg) ?></div>
            <div><label class="add_label">Date:</label><input type="date" name="date_post" required value="<?php echo $rows['date'] ?>"></div>
            <div><button class="btn__add" type="submit" name="update--post">ADD</button></div>
            <div class="err"><?php echo($erradd);echo($success); ?></div>
        </form>
    </div>
    <?php } ?>
    <?php
        if(isset($_GET['idrelease'])){
    ?>
    <div id="form__update">
        <div class="formheading"><h3>Form Update Release</h3></div>
        <form action="" method="post" class="form__add" enctype="multipart/form-data">
            <?php
                $idadmin = $_GET['id'];
                $id = $_GET['idrelease'];
                $erradd = '';
                $errname = '';
                $errlink = '';
                $errtopic = '';
                $statuss = 'true';
                $success = '';
                if(isset($_POST['update--release'])):
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
                            $sql =  sprintf("UPDATE new_Release SET namee = '%s', link = '%s', describe = '%s', topic = '%s' where id = '$id'",$name,$link,$describe,$topic);
                            $viet = $conn->query($sql);
                            if($viet){
                                header('location: index_backend.php?id='.$idadmin.'&updateRelease_success');
                            }else{
                                header('location: index_backend.php?id='.$idadmin.'&updateRelease_unsuccess');
                            }
                    }
                endif;
                $sql = sprintf("SELECT * FROM new_release where id = '$id'");
                $viet = $conn->query($sql);
                $rows = $viet ->fetch_assoc();
            ?>
            <div><label class="add__label">Name:</label><input type="text" name="release_name" required value="<?php echo $rows['namee'] ?>"></div>
            <div class="err"> <?php echo($errname); ?></div>
            <div><label class="add__label">Link :</label><input type="text" name="release_link" required value="<?php echo $rows['link'] ?>"></div>
            <div class="err"> <?php echo($errlink); ?></div>
            <div style="display: none;"><span id="release_content"><?php echo$rows['describe'] ?></span></div>
            <div class=" label__textarea"><label class="add__label">Decrible:</label><textarea id="textarea__release" class="textarea" rows="8" name="release_describe"><?php echo $rows['describe'] ?></textarea></div>
            <div>
                <label class="add__label">Topic:</label>
                <select name="release_topic">
                    <option value="newrelease" <?php if($rows['topic']=='newrelease'){echo'selected="selected"';} ?>>New Release</option>
                    <option value="oldsong" <?php if($rows['topic']=='oldsong'){echo'selected="selected"';} ?>>Old Song</option>
                    <option value="newalbum" <?php if($rows['topic']=='newalbums'){echo'selected="selected"';} ?>>New Albums</option>
                </select>
            </div>
            <div class="err"> <?php echo($errtopic); ?></div>
            <div><button class="btn__add" type="submit" name="update--release">UPDATE</button></div>
            <div class="err">
                <?php
                    echo($erradd);echo($success);
                ?>
            </div>
        </form>
    </div>
    <?php } ?>
   <script src="./assets/js/main.js"></script>
   <script>
        let text_post = document.getElementById('post_content').innerHTML;
        document.getElementById('textarea__post').innerHTML = text_post;
        
        let text_release = document.getElementById('release_content').innerText;
        document.getElementById('textarea__release').innerText = text_release;
   </script>
</body>
</html>