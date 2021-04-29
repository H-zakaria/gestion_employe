<?php
    include_once 'connexion_db.php';
    
    $sql = "INSERT INTO serv(noserv, service, ville) VALUES('".$_POST["noserv"]."','".$_POST["service"]."','".$_POST["ville"]."');";
    mysqli_query($conn, $sql);
    header("Location: ../tableau-connecte.php?Enregistrement=succes");
?> 

