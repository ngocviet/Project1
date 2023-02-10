<?php
    $conn = new mysqli('localhost','root','','soundblast');
    session_start();

    if(isset($_GET['removeUser'])){
        $idadmin = $_GET['id'];
        $id = $_GET['iduser'];
        $sql = "DELETE FROM user where id = $id";
        $viet = $conn->query($sql);
        if($viet){
            header('location: index_backend.php?id='.$idadmin.'&removeUser_success');
        }else{
            header('location: index_backend.php?id='.$idadmin.'&removeUser_unsuccess');
        }
    }
    if(isset($_GET['removeArtist'])){
        $idadmin = $_GET['id'];
        $id = $_GET['idartist'];
        $sql = "SELECT * FROM main_content where artist_id = '$id'";
        $viet = $conn->query($sql);
        if($viet -> num_rows == 0){
            $sql = "DELETE FROM artists where id = $id";
            $viet = $conn->query($sql);
            if($viet){
                header('location: index_backend.php?id='.$idadmin.'&removeArtist_success');
            }else{
                header('location: index_backend.php?id='.$idadmin.'&removeArtist_unsuccess');
            }
        }else{
            header('location: index_backend.php?id='.$idadmin.'&removeArtist_unsuccessbecau');
        }
    }
    if(isset($_GET['removeTheSong'])){
        $idadmin = $_GET['id'];
        $id = $_GET['idsong'];
        $sql = "DELETE FROM the_song where id = $id";
        $viet = $conn->query($sql);
        if($viet){
            header('location: index_backend.php?id='.$idadmin.'&removeTheSong_success');
        }else{
            header('location: index_backend.php?id='.$idadmin.'&removeTheSong_unsuccess');
        }
    }
    if(isset($_GET['removeCategory'])){
        $idadmin = $_GET['id'];
        $id = $_GET['idcategory'];
        $sql = "SELECT * FROM main_content where category_id = '$id'";
        $sql1 = "SELECT * FROM artists where category_id = '$id'";
        $viet = $conn->query($sql);
        $viet1 = $conn->query($sql1);
        if($viet -> num_rows == 0 || $viet1 -> num_rows == 0){
            $sql = "DELETE FROM category where id = $id";
            $viet = $conn->query($sql);
            if($viet){
                header('location: index_backend.php?id='.$idadmin.'&removeCategory_success');
            }else{
                header('location: index_backend.php?id='.$idadmin.'&removeCategory_unsuccess');
            }
        }else{
            header('location: index_backend.php?id='.$idadmin.'&removeCategory_unsuccessbecau');
        }
    }
    if(isset($_GET['removePost'])){
        $idadmin = $_GET['id'];
        $id = $_GET['idpost'];
        $sql = "DELETE FROM main_content where id = $id";
        $viet = $conn->query($sql);
        if($viet){
            header('location: index_backend.php?id='.$idadmin.'&removePost_success');
        }else{
            header('location: index_backend.php?id='.$idadmin.'&removePost_unsuccess');
        }
    }
    if(isset($_GET['removeContact'])){
        $idadmin = $_GET['id'];
        $id = $_GET['idcontact'];
        $sql = "DELETE FROM contact where id = $id";
        $viet = $conn->query($sql);
        if($viet){
            header('location: index_backend.php?id='.$idadmin.'&removeContact_success');
        }else{
            header('location: index_backend.php?id='.$idadmin.'&removeContact_unsuccess');
        }
    }
    if(isset($_GET['removeRelease'])){
        $idadmin = $_GET['id'];
        $id = $_GET['idrelease'];
        $sql = "DELETE FROM new_release where id = $id";
        $viet = $conn->query($sql);
        if($viet){
            header('location: index_backend.php?id='.$idadmin.'&removeRelease_success');
        }else{
            header('location: index_backend.php?id='.$idadmin.'&removeRelease_unsuccess');
        }
    }
    if(isset($_GET['signOut'])){
        unset($_SESSION['admin']);
        header('location: Login.php');
    }
    if(isset($_GET['signOutUser'])){
        unset($_SESSION['user']);
        header('location: SignIn.php');
    }
?>

<td><img src="../image/'.$item['thumbnail'].'"style="max-width:100px"></td>