<?php 
    include_once 'connexion_db.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<br>
<?php 
   
    if(isset($_POST['noserv'])){
        $noserv = $_POST['noserv'];
        $service = $_POST['service'];
        $ville = $_POST['ville'];
        $sql = "UPDATE serv SET noserv = '$noserv', service = '$service', ville = '$ville' WHERE noserv = '$noserv'  or  service = '$service';";
        mysqli_query($conn, $sql);
        header("Location: ../tableau-connecte.php?Modification=succes");
    }
    ?> 

</body>
</html>

