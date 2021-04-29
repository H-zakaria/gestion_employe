<?php
   
    include_once 'header.php';
    
    if(!isset($_SESSION['user_id'])){
        
        header("Location: signup&login_form.php");
        
    }
        $sql = "SELECT * FROM emp WHERE noemp = $_GET[noemp];";
        $result = mysqli_query($conn, $sql);
        $datas = mysqli_fetch_all($result, MYSQLI_ASSOC);  
       
        
    ?>
            <div>
                <form class="formu" action="./includes/modifier.php" method="POST">
                    <input type="number"  name="noemp"  value=<?php echo $datas[0]['noemp'];?> placeholder="Entrez le noemp">
                    <input type="text"  name="nom" value=<?php echo $datas[0]['nom'];?> placeholder="Entrez le nom">
                    <input type="text"  name="prenom" value=<?php echo $datas[0]['prenom'];?> placeholder="Entrez le prenom">
                    <input type="text"  name="emploi" value=<?php echo $datas[0]['emploi'];?> placeholder="Entrez l'emploi'">
                    <input type="number"  name="sup" value=<?php echo $datas[0]['sup'];?> placeholder="Numero du suprérieur">
                    <input type="date" c name="embauche" value=<?php echo $datas[0]['embauche'];?> placeholder="Entrez la date d'embauche">
                    <input type="number" step="any" name="sal" value=<?php echo $datas[0]['sal'];?> placeholder="Entrez le salaire">
                    <input type="number" step="any" name="comm" value=<?php echo $datas[0]['comm'];?> placeholder="commission">
                    <input type="number"  name="noserv" value=<?php echo $datas[0]['noserv'];?> placeholder="Entrez le numero de service">
                    <input type="number"  name="noproj" value=<?php echo $datas[0]['noproj'];?> placeholder="Entrez le numero projet">             
                    <input type="submit"  value="Soumettre">    
                </form>
                <a href="tableau-connecte.php"><button>TABLEAU</button></a>
            </div>
    
    
</body>
</html>