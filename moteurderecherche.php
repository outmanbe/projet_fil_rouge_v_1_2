<?php
$bdd = new PDO('mysql:host=localhost;dbname=voiture;', 'root','');
$allvoiture = $bdd->query('SELECT * FROM voiture ORDER BY id_Voiture DESC');
if(isset($_GET['s']) AND !empty($_GET['s'])){
    $recherche = htmlspecialchars($_GET['s']);
    $allvoiture = $bdd->query('SELECT Marques, modele FROM voiture WHERE Marques LIKE "%'.$recherche.'%" ORDER BY id_Voiture DESC');

}
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
    <form method="GET">
        <input type="search" name="s" placeholder="Rechercher une voiture">
        <input type="submit" name="envoyer">

    </form>

<section class="afficher_vehicule">
    <?php 
    if($allvoiture->rowCount() > 0) {
         while($user = $allvoiture->fetch()) {
            ?>

            <p> Voitures <?= $user['Marques']; ?></p>
            <p>Modele <?= $user['modele']; ?></p>


            <?php
         }

    }else {
        ?>
        <p>Aucun utilisateur trouvé</p>
        <?php
        }
        ?>
</section>
</body>
</html>