<?php
    $conn = new mysqli('localhost','root','');
    $sql = "CREATE DATABASE if not exists soundblast";
    $viet = $conn->query($sql);
    $sql = "use soundblast";
    $conn -> query($sql);

    // table user
    $sql = "CREATE TABLE if not exists user(
        id int(11) not null primary key AUTO_INCREMENT,
        namee varchar(50),
        passwordd varchar(40),
        passworddhash varchar(40),
        email varchar(50),
        phone char(15),
        avatar varchar(100) ,
        create_at timestamp DEFAULT CURRENT_TIMESTAMP,
        update_at timestamp DEFAULT CURRENT_TIMESTAMP
    )";
    $conn -> query($sql);

    // table admin
    $sql = "CREATE TABLE if not exists admin(
        id int(11) not null primary key AUTO_INCREMENT,
        usernamee varchar(50),
        fullnamee varchar(50),
        passwordd varchar(40),
        passworddhash varchar(40),
        email varchar(50),
        phone char(15),
        avatar varchar(100),
        create_at timestamp  DEFAULT CURRENT_TIMESTAMP,
        update_at timestamp  DEFAULT CURRENT_TIMESTAMP
    )";
    $conn -> query($sql);
    
    // table category
    $sql = "CREATE TABLE if not exists category(
        id int(11) not null primary key AUTO_INCREMENT,
        namee varchar(50),
        create_at timestamp  DEFAULT CURRENT_TIMESTAMP,
        update_at timestamp  DEFAULT CURRENT_TIMESTAMP
    )";
    $conn -> query($sql);
    
    // table contact
    $sql = "CREATE TABLE if not exists contact(
        id int(11) not null primary key AUTO_INCREMENT,
        namee varchar(50),
        email varchar(50),
        content text,
        create_at timestamp  DEFAULT CURRENT_TIMESTAMP,
        update_at timestamp  DEFAULT CURRENT_TIMESTAMP
    )";
    $conn -> query($sql);
    
    // table main_content
    $sql = "CREATE TABLE if not exists main_content(
        id int(11) not null primary key AUTO_INCREMENT,
        category_id int(11),
        artist_id int(11),
        img varchar(100),
        title varchar(50),
        content text ,
        status varchar(20),
        date varchar(10),
        create_at timestamp  DEFAULT CURRENT_TIMESTAMP,
        update_at timestamp  DEFAULT CURRENT_TIMESTAMP
    )";
    $conn -> query($sql);
    
    // table artist
    $sql = "CREATE TABLE if not exists artists(
        id int(11) not null primary key AUTO_INCREMENT,
        namee varchar(50),
        img varchar(100),
        category_id int(11),
        top_artist int(11),
        top_last_week int(11),
        top_max int(11),
        promotion varchar(100),
        create_at timestamp  DEFAULT CURRENT_TIMESTAMP,
        update_at timestamp  DEFAULT CURRENT_TIMESTAMP
    )";
    $conn -> query($sql);
    
    // table the_song
    $sql = "CREATE TABLE if not exists the_song(
        id int(11) not null primary key AUTO_INCREMENT,
        namee varchar(50),
        author varchar(50),
        img varchar(100),
        audio varchar(100),
        top_last_weeek_charts int(11),
        top_last_weeek_search int(11),
        top_last_weeek_trending int(11),
        top_max int(11),
        top_charts int(11),
        top_trending int(11),
        top_search int(11),
        create_at timestamp  DEFAULT CURRENT_TIMESTAMP,
        update_at timestamp  DEFAULT CURRENT_TIMESTAMP
    )";
    $conn -> query($sql);

    // table new_release
    $sql = "CREATE TABLE if not exists new_release(
        id int(11) not null primary key AUTO_INCREMENT,
        namee varchar(70),
        link varchar(50),
        decrible text,
        topic varchar(20),
        create_at timestamp  DEFAULT CURRENT_TIMESTAMP,
        update_at timestamp  DEFAULT CURRENT_TIMESTAMP
    )";

    // INSERT VALUES

        // insert table category 
    // $sql = "INSERT into category(namee) VALUES ('Rook'),('Rap'),('Pop'),('Electronic'),('Other');";
    // $conn -> query($sql);

        // insert table admin
    // $sql = "INSERT into admin(username,fullname,passwordd,passworddhash,email,phone,avatar) VALUES ('Viet','Le Ngoc Viet','123123','601f1889667efaebb33b8c12572835da3f027f78','viet@gmail.com','123123','');";
    // $conn -> query($sql);

        //insert table artist
    // $sql = "INSERT into artists(namee,img,category_id,top_artist,top_last_week,top_max) VALUES
    //     ('Lil Wayne','',4,0,0,0),
    //     ('Travis Scoott','',4,0,0,0),
    //     ('Rihanna Fenty','',4,0,0,0),
    //     ('Kanye Omari West','',4,0,0,0),
    //     ('Chris Brown','Topartist/chris-brown-cte-344x344.jpg',4,8,2,1),

    //     ('No Age','',1,0,0,0),
    //     ('Soccer Mommy','',1,0,0,0),
    //     ('Nnamdi Ogbonnaya','',1,0,0,0),
    //     ('Alvways','',1,0,0,0),
    //     ('Travis Barker','',1,0,0,0),
    //     ('Snail Mail','',1,0,0,0),

    //     ('Christine and The Queens','',8,0,0,0),
    //     ('The 1975','',8,0,0,0),
    //     ('Beyonce','',8,0,0,0),
    //     ('Sampa the Greate','',8,0,0,0),
    //     ('Micael Jackson','',8,0,0,0),

    //     ('Lapsley','',3,0,0,0),
    //     ('Oneohtrix Point Never','',3,0,0,0),
    //     ('SG Lewis','',3,0,0,0),
    //     ('Kero Kero Bonito','',3,0,0,0),
    //     ('Caribou','',3,0,0,0)
        
    //     ('Luke Combs','Topartist/luke-combs-9dm-artist-chart-501-344x344.jpg',9,1,5,1),
    //     ('Harry Styles','Topartist/harry-styles-psx-artist-chart-rzg-344x344.jpg',9,2,4,1);
    //     ('Drake','Topartist/drake-04g-344x344.jpg',9,3,1,1);
    //     ('Bad Bunny','Topartist/bad-bunny-c3m-artist-chart-2ep-344x344.jpg',9,4,3,2);
    //     ('Nayeon','Topartist/nayeon-5h9-artist-chart-f3y-344x344.jpg',9,5,6,3);
    //     ('Morgan Wallen','Topartist/morgan-wallen-nlu-artist-chart-zuy-344x344.jpg',9,6,9,3);
    //     ('Doja cat','Topartist/doja-cat-lm6-artist-chart-b90-344x344.jpg',9,7,13,1);
    //     ('Tyler, The Creator','Topartist/tyler-the-creator-556-344x344.jpg',9,9,24,1);
    //     ('The Weeknd','Topartist/the-weeknd-xmx-artist-chart-uxt-344x344.jpg',9,10,7,1);
    // ";
    // $conn -> query($sql);

        // insert table the_song
    // $sql = "INSERT into the_song(namee,author,img,audio,top_last_week_charts,top_last_week_search,top_last_week_trending,top_max,top_charts,top_trending,top_search) VALUES 
    //     ('As It Was','Harry Styles','Topcharts/as-it-was.jpg','as-it-was-lyrics.mp3',2,0,0,0,1,0,0),
    //     ('First Class','Jack Harlow','Topcharts/Jack-Harlow-First-Class.jpg','first-class-official-visualizer.mp3',3,0,0,1,2,0,0),
    //     ('About Damn Time','Lizzo','Topcharts/maxresdefault.jpg','about-damn-time-lyrics.mp3',5,0,0,3,3,0,0),
    //     ('Wait For U','Future Featuring Drake and Tems','Topcharts/future-f8b-344x344.jpg','wait-for-u-official-audio-ft-drake-tems.mp3',4,0,0,1,4,0,0),
    //     ('Jimmy Cooks','Drake Featuring 21 Savage','Topcharts/drake-04g-180x180.jpg','jimmy-cooks.mp3',1,0,0,1,5,0,0),
    //     ('Running Up That  Hill(A Deal With God)','Kate Bush','Topcharts/kate-bush-qv2-running-up-that-hill-1cx-344x344.jpg','rungning-up-that-hill.mp3',9,0,0,4,6,0,0),
    //     ('Break Soul','Beyonce','Topcharts/beyonce-0na-break-my-soul-kqf-344x344.jpg','breake-my-soul.mp3',15,0,0,7,7,0,0),
    //     ('Me Porto Bonito','Bad Bunny & Chencho Corleone','Topcharts/bad-bunny-c3m-me-porto-bonito-kug-344x344.jpg','me-porto-bonnito.mp3',11,0,0,7,8,0,0),
    //     ('Heat Waves','Glass Animals','Topcharts/glass-animals-rtd-heat-waves-o3i-180x180.jpg','heat-waves.mp3',10,0,0,1,9,0,0),
    //     ('Glimpse Of Us','Joji','Topcharts/joji-77h-glimpse-of-us-gt3-344x344.jpg','glimpse-of-sou.mp3',8,0,0,8,10,0,0),
    //     ('Big Energy','Latto','Topcharts/latto-80q-big-energy-89t-344x344.jpg','big-energy.mp3',12,0,0,3,11,0,0),

    //     ('Drives license','Olivia Rodrigo','Topcharts/1.-drivers-license-by-Olivia-Rodrigo.jpg','driver-license.mp3',0,3,0,1,0,0,1),
    //     ('Montero(Call Me by Your Name)','Lil Nas X','Topcharts/2.-MONTERO-Call-Me-By-Your-Name-by-Lil-Nas-X.jpg','montero.mp3',0,1,0,2,0,0,2),
    //     ('Industry Baby','Lil Nas X feat Jack Harlow','Topcharts/INDUSTRYBABY.jpg','industry-baby.mp3',0,4,0,2,0,0,3),
    //     ('Fancy Like','Walker Hayes','Topcharts/top-songs-of-2021-walker-hayes.jpg','fancy-like.mp3',0,12,0,2,0,0,4),
    //     ('Mapa','SB19','Topcharts/SB19-top-song-2021.jpg','mapa.mp3',0,5,0,6,0,0,5),
    //     ('Good 4 u','Olivia Rodrigo','Topcharts/t02-16226033525811137251098.jpg','good-4-u.mp3',0,6,0,3,0,0,6),
    //     ('Butter','BTS','Topcharts/bts-hop-bao_htsq.jpg','butter.mp3',0,2,0,3,0,0,7),
    //     ('Jalebi Baby','Tesher','Topcharts/tesher-song-2021.jpg','jalebi-baby.mp3',0,18,0,4,0,0,8),
    //     ('Wellerman','Nathan Evans','Topcharts/nathan-evans-wellerman-top-song-2021.jpg','wellerman.mp3',0,8,0,3,0,0,9),
    //     ('Good Days','SZA','Topcharts/sza-top-song-2021.jpg','good-day.mp3',0,7,0,5,0,0,10);
    // ";

    // insert table new_release
    // $sql = "INSERT into new_release(namee,link,decrible,topic) VALUES
    //     ('“Happy New Year,” Let's Eat Grandma','auoMMlWSli0','Let's Eat Grandma knows the power of a straightforward lyric. That's the key to “Happy New Year,” the thrilling opening cut off new album Two Ribbons, which details changes in the duo's dynamic as best friends. The song is colored by vignettes from the pair's shared history, recounted over synths that pop like fireworks. The emotional punches, though, come from single lines: “There's no one else who gets me quite like you,” Rosa Walton declares to Jenny Hollingsworth, who she's known since age 4. Other songs on Two Ribbons chart the ways the two have had to reconfigure their friendship, but the end of each “Happy New Year” chorus centers the project: “Because you know you'll always be my best friend / And look at what I have with you.” What more do they need to say? — Justin Curto','newrelease'),
    //     ('“You Will Never Work in Television Again,” the Smile','-EB5NhI2RQQ','','newrelease'),
    //     ('“Easier Than Lying,” Halsey','t1EJvmjLG8Y','','oldsong'),
    //     ('“The Other Side,” Jazmine Sullivan','ES_ZaIoZPiE','','oldsong'),
    //     ('“Wild,” Spoon','eDPhsByCL_o','','newrelease'),
    //     ('“Surround Sound,” JID featuring 21 Savage and Baby Tate','Y19q-7VN2WI','','newrelease'),
    //     ('“Bliss,” Amber Mark','YL97fi1Mhik','','newrelease'),
    //     ('“YEET,” Yung Kayo featuring Yeat','WiMCjqZK6t8','','newrelease'),
    //     ('“Jealousy,” FKA twigs','BFrp8gPLObQ','','newrelease'),
    //     ('“One Way, or Every N - - - - With a Budget,” Saba','d-MVN1PSY7o','','newrelease'),
    //     ('“Bites on My Neck,” yeule','wsKWJrYdbi8','','newrelease'),
    //     ('“Porta,” Sharon Van Etten','BjD1dr1_iMs','','newrelease'),
    //     ('“Kind of Girl,” Muna','JDOiWGAaT8E','','newrelease'),
    //     ('Twice, &#039;The Feels&#039;','f5_wn8mexmM','','oldsong'),
    //     ('MO3 and Morray, &#039;In My Blood&#039;','F-trG2hjaQk','','oldsong'),
    //     ('The Kid Laroi feat. Miley Cyrus, &#039;Without You&#039;','LvB4GUTWDcIA','','oldsong'),
    //     ('Parquet Courts, &#039;Walking at a Downtown Pace&#039;','0R7wpcw1Z4A','','oldsong'),
    //     ('Mitski, &#039;The Only Heartbreaker&#039;','LmXFF_whkVk','','oldsong'),
    //     ('Pop Smoke feat. Dua Lipa, &#039;Demeanor&#039;','UBjTdLGV8L0','','oldsong'),
    //     ('Valerie June, &#039;Why the Bright Stars Glow&#039;','__2dXB1Nyxk','','oldsong'),
    //     ('Magdalena Bay, &#039;You Lose!&#039;','FQPXX_eZZAk','','oldsong'),
    //     ('Westside Gunn feat. Jadakiss and Stove God Cooks, &#039;Right Now&#039','JzRkEu7d1d0','','oldsong'),
    //     ('Anitta, &#039;Versions of Me&#039;','AnittaVersionsOfMe.jpg','','newalbum'),
    //     ('Omar Apollo, &#039;Ivory&#039;','OmarApolloIvory.jpg','','newalbum'),
    //     ('Aṣa, &#039;V&#039;','AsaV.jpg','','newalbum'),
    //     ('Bad Bunny, &#039;Un Verano Sin Ti&#039;','un-verano-sin-ti.jpg','','newalbum'),
    //     ('Becky G, &#039;Esquemas&#039;','becky-g-Esquemas.jpg','','newalbum'),
    //     ('Big Thief, &#039;Dragon New Warm Mountain I Believe in You&#039;','BigThiefNewDragonMountainIBelieveInYou.jpg','','newalbum'),
    //     ('The Black Keys, &#039;Dropout Boogie&#039;','TheBlackKeysDropoutBoogie.jpg','','newalbum'),
    //     ('Black Star, &#039;No Fear of Time&#039;','BlackStarNoFearOfTime.jpg','','newalbum'),
    //     ('Mary J. Blige, &#039;Good Morning Gorgeous&#039;','MaryJBligeGoodMorningGorgeous.jpg','','newalbum'),
    //     ('BTS, &#039;Proof&#039;','BTS_Proof-Credit_BIGHIT-MUSIC.jpg','','newalbum');
    // ";

    // ALTER TABLE
    // $sql = ""
    // echo('hi');
?>