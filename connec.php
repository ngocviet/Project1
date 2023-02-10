<?php 
    $conn = new mysqli('localhost','root','');
    $sql = "CREATE DATABASE if not exists soundblast";
    $viet = $conn->query($sql);
    $sql = "use soundblast";
    $conn -> query($sql);
    $conn = new mysqli('localhost','root','','soundblast');

?>