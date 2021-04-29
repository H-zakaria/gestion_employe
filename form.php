<?php
   
    include_once 'header.php';
    

     
        $sql = "SELECT DISTINCT e.noemp, e.nom, e.prenom, service, e.emploi FROM emp e
        INNER JOIN serv s on e.noserv = s.noserv
        INNER JOIN emp e2 on e.noemp = e2.sup;";
        $result = mysqli_query($conn, $sql);
        $superieurs = mysqli_fetch_all($result, MYSQLI_ASSOC);

    ?>
    </div>
        <form class="formu" action="ajouter.php" method="POST">
        <input type="number" name="noemp" placeholder="Entrez le noemp">
        <input type="text" name="nom" placeholder="Entrez le nom">
        <input type="text" name="prenom" placeholder="Entrez le prenom">
        <input type="text" name="emploi" placeholder="Entrez l'emploi'">
        <label for="sup">Superieur:  </label>
        <select id="sup" name="sup">
            <option value="" selected hidden value="">Selectionner</option>
            <?php

            foreach($superieurs as $sup){
             ?>
            <option value="<?php echo $sup['noemp']?>"><?php echo $sup['nom']." ".$sup['emploi']." ".$sup['service']?> </option>;
            
            <?php
            } 
            ?>
           </select>
        
        <input type="date" name="embauche" placeholder="Entrez la date d'embauche">
        <input type="number" step="any" name="sal" placeholder="Entrez le salaire">
        <input type="number" step="any" name="comm" placeholder="Entrez la commission">
        <label for="noserv">Service:  </label>
        <select id="noserv" name="noserv">
            <option value="" selected hidden value="">Selectionner</option>
            <option value="1">1- DIRECTION</option>
            <option value="2">2- LOGISTIQUE</option>
            <option value="3">3- VENTES</option>
            <option value="4">4- FORMATION</option>
            <option value="5">5- INFORMATIQUE</option>
            <option value="6">6- COMPTABILITE</option>
            <option value="7">7- TECHNIQUE</option>
        </select>
        <input type="number" name="noproj" placeholder="Entrez le numero projet">
        <input type="submit" value="Soumettre">
        </form>
        <a href="tableau-connecte.php"><button>TABLEAU</button></a>
    </div>
</body>
</html>