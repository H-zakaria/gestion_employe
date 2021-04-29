<?php 
    include_once 'connexion_db.php';

    if(isset($_POST['noemp'])){

        $noemp = $_POST['noemp'];
        
        $sql = "SELECT * FROM emp WHERE noemp = $noemp;";
        $result = mysqli_query($conn, $sql);
        $previous = mysqli_fetch_all($result, MYSQLI_ASSOC);  
        $previous= $previous[0];
        
        $query = [];
        $modif=array_diff($_POST,$previous);
        foreach($modif as $k => $v){
            $query []= $k.": ".$previous[$k]." => ".$v;
        }
       
        echo "<br>";
        echo "<br>";
        foreach($query as $q){ echo $q;}
        echo "<br>";
        echo "<br>";
        print_r($query);
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $emploi = $_POST['emploi'];
        $sup = $_POST['sup'];
        $embauche = $_POST['embauche'];
        $sal = $_POST['sal'];
        $comm = $_POST['comm'];
        $noserv = $_POST['noserv'];
        $noproj = $_POST['noproj'];

        $sql = "UPDATE emp SET nom = '$nom', prenom = '$prenom', emploi = '$emploi', sup = '$sup', embauche = '$embauche', sal = '$sal', comm = '$comm', noserv = '$noserv', noproj = '$noproj' WHERE noemp = '$noemp';";
        mysqli_query($conn, $sql);



        foreach($query as $q){
            $modification = "INSERT INTO date_modif (noemp, modification, DateTime, Date, Time, Year) VALUE($noemp, '$q', NOW(), NOW(), NOW(), NOW());"; 
            mysqli_query($conn, $modification);
        } 
        // header("Location: ../tableau-connecte.php?Modification=succes");
    }
?> 
</body>
</html>


