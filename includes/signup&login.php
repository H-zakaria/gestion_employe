<?php

include_once 'includes_header.php';


if(isset($_POST['submit_signup'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        header("Location: ../signup&login_form.php?error=emptyfields&username=".$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup&login_form.php?error=invalidusername");
        exit();
    }
    else{
        $sql = "SELECT count(nom) as noms FROM users WHERE nom='$username'";
        $result = mysqli_query($conn, $sql);
        $usernames = mysqli_fetch_all($result, MYSQLI_ASSOC);
     
        if($usernames[0]['noms'] > 0){
            header("Location: ../signup&login_form.php?error=usernametaken");
            exit();
        }
        else{
            $hash_mdp = password_hash($password, PASSWORD_DEFAULT);
            $sql ="INSERT INTO users (nom, mdp) VALUES ('$username', '$hash_mdp');";
            $result = mysqli_query($conn, $sql);
            header("Location: ../signup&login_form.php?signup=success");
         
        }
    }
}
else if(isset($_POST['submit_login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password))
    {
        header("Location: ../signup&login_form.php?error=emptyfields&username=".$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup&login_form.php?error=invalidusername");
        exit();
    }
    else
    {   //voir si le nom existe 

        $sql = "SELECT count(nom) as nom FROM users WHERE nom='$username'";
        $result = mysqli_query($conn, $sql);
        $usernames = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($usernames[0]['nom'] == 1)
        {                               //si oui voir si le mdp est correct

            $sql = "SELECT * FROM users WHERE nom='$username';";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            $pswrd_check = password_verify($password, $user[0]['mdp']);
            if($pswrd_check == false)
            {
                header("Location: ../signup&login_form.php?error=wrongpassword");
                exit();
            }
            else        //si oui ouvrir une session
            {
                session_start();
                $_SESSION['user_id'] = $user[0]['user_id'];
                $_SESSION['nom'] = $user[0]['nom'];
                $_SESSION['profil'] = $user[0]['profil'];

                header("Location: ../tableau-connecte.php?login=success");
                exit();
            }
        }
        else
        {
            header("Location: ../signup&login_form.php?error=wrongusername");
            exit();
        }
        



        
    }
}
else{
    header("Location: ../signup&login_form.php");
}


?>
</body>
</html>
