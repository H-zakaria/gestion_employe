<?php 
include_once 'header.php';
?>


<body>
    <form action="./includes/signup&login.php" class="formu" method="POST">
    <input type="text" name="username" placeholder="Nom">
    <input type="password" name="password" placeholder="mdp">
    <button type="submit" name="submit_signup">s'enregristrer</button>
    <button type="submit" name="submit_login">se connecter</button>
    </form>
</body>
</html>