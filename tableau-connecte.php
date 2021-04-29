<?php 
include_once 'header.php';

    if (isset($_SESSION['user_id']))
    {

        echo "<p class='msg_acc'>vous êtes connecté, bienvenue ".$_SESSION['nom']."</p>";
        echo "<button><a href='./includes/logout.php'>deconnexion</a></button>";

?>

    
    <div>
    <?php 
     $sql = "SELECT count(*) from emp where date_ajout = DATE(NOW());";
     $result = mysqli_query($conn, $sql);
     $datas = mysqli_fetch_all($result, MYSQLI_ASSOC);
     
    
    ?>
    <a href='form.php?'><button class='btn btn-warning'>ajouter employé</button></a>
        <table>
            <thead>
                <tr>
                    <th>No employé</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>emploi</th>
                    <th>Nom du superieur</th>
                    <th>Embauche</th>
                    <th>Salaire</th>
                    <th>Commission</th>
                    <th>service</th>
                    <th>Projet</th>
                    <th colspan="2">Ajouts du jour => </th>
                    <th><?php echo $datas[0]['count(*)'];?></th>

                </tr>
            </thead>
            <tbody>
            <?php 

            $sql = "SELECT e.*, s.service, p.nomproj, e2.nom as nsup FROM emp e
            INNER JOIN serv s on s.noserv = e.noserv
            INNER JOIN proj p on p.noproj = e.noproj
            LEFT JOIN emp e2 on e.sup = e2.noemp;";
            
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            $datas = mysqli_fetch_all($result, MYSQLI_ASSOC);
            

            
            $sql = "SELECT DISTINCT e.noemp FROM emp e
            INNER JOIN emp e2 on e.noemp = e2.sup;";

            $result2 = mysqli_query($conn, $sql);
            $sups = mysqli_fetch_all($result2, MYSQLI_NUM);
            $sups_1d = [];
            $count = 0;
            foreach($sups as $s){
                $count++;
            }
            for( $i =0; $i < $count; $i++){
                $sups_1d[$i] = $sups[$i][0];
            }

            if($resultCheck > 0){
                foreach($datas as $data){  
                    if(in_array($data['noemp'], $sups_1d))
                    {
                        echo "<tr class='sup'>";
                    }else{
                        echo "<tr>";
                    }
                    echo "<td>".$data['noemp']."</td>"; 
                    echo "<td>".$data['nom']."</td>"; 
                    echo "<td>".$data['prenom']."</td>"; 
                    echo "<td>".$data['emploi']."</td>"; 
                    echo "<td>".$data['nsup']."</td>"; 
                    echo "<td>".$data['embauche']."</td>"; 
                    echo "<td>".$data['sal']."</td>"; 
                    echo "<td>".$data['comm']."</td>"; 
                    echo "<td>".$data['service']."</td>"; 
                    echo "<td>".$data['nomproj']."</td>"; 

                    echo "<td><a href='details.php?noemp=$data[noemp]'><button class='btn btn-warning'>details</button></a></td>";
                    if($_SESSION['profil'] == "admin")
                    {
                        echo "<td><a href='form_modif.php?noemp=$data[noemp]'><button class='btn btn-warning'>Modifier</button></a></td>";
                    }
                    if((!in_array($data['noemp'], $sups_1d)) && ($_SESSION['profil'] == 'admin'))
                    {
                         echo "<td><a href='includes/supr.php?noemp=$data[noemp]'><button class='btn btn-warning'>supprimer</button></a></td>";
                    }
                    echo "</tr>";
                }
            }else{
                echo "La base de donnée est vide";
            }
            
            ?>
            </tbody>
        </table>
        </div>
        <div>
        <table>
            <thead>
                <tr>
                    <th>No service</th>
                    <th>Designatiion</th>
                    <th>Ville</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            echo "<br>";
            echo "<hr>";
            echo "<br>";

            

            $sql = "SELECT * FROM serv;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            $datas = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if($resultCheck > 0){
                foreach($datas as $data){  
                    
                    echo "<tr>";
                    echo "<td>".$data['noserv']."</td>"; 
                    echo "<td>".$data['service']."</td>"; 
                    echo "<td>".$data['ville']."</td>"; 
                    echo "<td><a href='details_service.php?noserv=$data[noserv]'><button class='btn btn-warning'>details</button></a></td>";
                    echo "<td><a href='form_services.php?noserv=$data[noserv]&but=modifier'><button class='btn btn-warning'>Modifier</button></a></td>";
                    echo "<td><a href='includes/supr_service.php?noserv=$data[noserv]'><button class='btn btn-warning'>supprimer</button></a></td>";
                    echo "</tr>";
                }
            }
            ?>
            <a href='form_services.php?but=ajouter'><button class='btn btn-warning'>ajouter un service</button></a>
            </tbody>
        </table>
        </div>

        <?php 
            }
            else
            {
                header("Location: signup&login_form.php");
                

            
            }
            ?>
</body>
</html>