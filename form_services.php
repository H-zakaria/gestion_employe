<?php
    include_once 'includes/connexion_db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Formulaire Service</title>
</head>
<body>
    <?php
    if($_GET['but'] == 'ajouter'){ 
    ?>
    </div>
        <form class="formu" action="includes/ajouter_service.php" target="tableau-connecte.php" method="POST">
        <input type="number" name="noserv" placeholder="Entrez le numero du service">
        <input type="text" name="service" placeholder="Entrez le nom du service">
        <input type="text" name="ville" placeholder="Entrez le nom de la ville">
        <input type="submit" value="Soumettre">
        </form>
        <a href="tableau-connecte.php"><button>TABLEAU</button></a>
    </div>
    <?php
    }else if($_GET["but"] == 'modifier')
    {
        $sql = "SELECT * FROM serv WHERE noserv = $_GET[noserv];";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        $datas = mysqli_fetch_all($result, MYSQLI_ASSOC);
        print_r($datas);
            if($resultCheck > 0)
            { 
                

    ?>
            <div>
                <form class="formu" action="includes/modifier_service.php" method="POST">
                    <input type="number"  name="noserv"  value=<?php echo $datas[0]['noserv'];?> placeholder="Entrez le numero du service">
                    <input type="text"  name="service" value=<?php echo $datas[0]['service'];?> placeholder="Entrez le nom du service">
                    <input type="text"  name="ville" value=<?php echo $datas[0]['ville'];?> placeholder="Entrez le nom de la ville">
                    <input type="submit"  value="Soumettre">    
                </form>
                <a href="tableau-connecte.php"><button>TABLEAU</button></a>
            </div>
    <?php     
            }       
    }else
    {
        echo "l'employé n'existe pas.";
    }
    ?>
    
    
    
    
</body>
</html>