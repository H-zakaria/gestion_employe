<?php
   
    include_once 'header.php';
    
    if(!isset($_SESSION['user_id'])){
        
        header("Location: signup&login_form.php");
        
    }
?>
        <table>
            <thead>
                <tr>
                    <th>No employé</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>emploi</th>
                    <th>No superieur</th>
                    <th>Embauche</th>
                    <th>Salaire</th>
                    <th>Commission</th>
                    <th>No service</th>
                    <th>No projet</th>  
                    <th>Date d'ajout</th>
                    <th class = "fk">Service</th>
                    <th class = "fk">Ville</th>
                    <th class = "fk">Projet</th>
                    <th class = "fk">Budget</th>
                    </tr>
            </thead>
            <tbody>
            <?php
            $noemp =$_GET['noemp'];
            
            $sql = "SELECT e.*, s.*, p.* FROM emp e 
                    INNER JOIN serv s on e.noserv = s.noserv
                    INNER JOIN proj p on e.noproj = p.noproj
                    WHERE noemp ='$noemp';";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            $datas = mysqli_fetch_all($result, MYSQLI_ASSOC);
            print_r($datas);
            if($resultCheck > 0){
                foreach($datas as $data){  
                    
                    echo "<tr>";
                    echo "<td>".$data['noemp']."</td>"; 
                    echo "<td>".$data['nom']."</td>"; 
                    echo "<td>".$data['prenom']."</td>"; 
                    echo "<td>".$data['emploi']."</td>"; 
                    echo "<td>".$data['sup']."</td>"; 
                    echo "<td>".$data['embauche']."</td>"; 
                    echo "<td>".$data['sal']."</td>"; 
                    echo "<td>".$data['comm']."</td>"; 
                    echo "<td>".$data['noserv']."</td>"; 
                    echo "<td>".$data['noproj']."</td>"; 
                    echo "<td>".$data['date_ajout']."</td>"; 
                    echo "<td class ='fk'>".$data['service']."</td>"; 
                    echo "<td class ='fk'>".$data['ville']."</td>"; 
                    echo "<td class ='fk'>".$data['nomproj']."</td>"; 
                    echo "<td class ='fk'>".$data['budget']."</td>"; 
                    echo "</tr>";
                } 
                
            }
            mysqli_free_result($result);

            ?>
            
            
            </tbody>
        </table>
            <a href="tableau-connecte.php"><button>TABLEAU</button></a>
            <br>
            <hr>
            <br>
            <h3>Superieur:</h3>
            <table>
            <thead>
                <tr>
                    <th>Numero employe</th>
                    <th>Nom</th>
                    <th class = "fk">Service</th>
                    <th>emploi</th>
                    <th>Numero du supérieur</th>
                    <th class = "fk">Projet en cours</th>
                </tr>
            </thead>
            <tbody>
            <?php
           
            
            $sql2 = "SELECT sup.noemp, sup.nom, s.service, sup.emploi, sup.sup, proj.nomproj
                    FROM emp as sup
                    INNER JOIN emp e on e.sup = sup.noemp
                    INNER JOIN serv as s on sup.noserv = s.noserv
                    INNER JOIN proj on sup.noproj = proj.noproj
                    WHERE e.noemp ='$noemp';";
            $result2 = mysqli_query($conn, $sql2);
            $datas2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
            
                foreach($datas2 as $data){  
                    
                    echo "<tr>";
                    echo "<td>".$data['noemp']."</td>"; 
                    echo "<td>".$data['nom']."</td>"; 
                    echo "<td class = 'fk'>".$data['service']."</td>"; 
                    echo "<td>".$data['emploi']."</td>"; 
                    echo "<td>".$data['sup']."</td>"; 
                    echo "<td class = 'fk'>".$data['nomproj']."</td>"; 
                    echo "</tr>";
                }

            
            
            ?>
            </tbody>
            </table>
            <br>
            <hr>
            <br>
            <h3>Historique des modifications:</h3>
            <table>
            <thead>
                <tr>
                    <th>Modifications</th>
                    <th>Date</th>
                    <th>Heure</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
           
            
            $sql3 = "SELECT m.modification, m.Date, m.Time FROM date_modif m WHERE m.noemp = '$noemp'";
            $result3 = mysqli_query($conn, $sql3);
            $datas3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
         
            
                foreach($datas3 as $data){  
                    
                    echo "<tr>";
                    echo "<td>".$data['modification']."</td>"; 
                    echo "<td>".$data['Date']."</td>";
                    echo "<td>".$data['Time']."</td>";
                    echo "</tr>";
                }            
            ?>
            </tbody>
            </table>
    </body>
</html>

                   