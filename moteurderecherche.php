<?php
$bdd = new PDO('mysql:host=localhost;dbname=voiture;', 'root','');
$query = 'SELECT * FROM voiture NATURAL JOIN prix NATURAL JOIN images';
$allvoiture = $bdd->query($query);

if(isset($_GET['s']) or isset($_GET['prix']) or isset($_GET['couleur'])){
    $recherche = htmlspecialchars($_GET['s']);
    $prix = htmlspecialchars($_GET['prix']);
    $couleur = htmlspecialchars($_GET['couleur']);
    $conditions = array();

    if(!empty($recherche))
    {
        $conditions[] = 'Marques like "%'.$recherche.'%"';
        
    }

    if(!empty($prix))
    {
        $conditions[] = 'Montant like "%'.$prix.'%"';
        
    }

    if(!empty($couleur))
    {
        $conditions[] = "couleur='$couleur'";
        
    }

    $sql =$query;
    if(count($conditions) > 0) {
        $sql .= " WHERE " .implode(' AND ', $conditions);
    }

    $allvoiture = $bdd->query($sql);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container"></div>
    <form class="formulaire" method="GET">
        <label for="marque"> Filtre par marque </label>
        <input type="search" name="s" placeholder="Rechercher une voiture">

        <label for="prix"> Filtre par prix </label>
        <input type="search" name="prix" placeholder="Rechercher le prix">

        <label for="couleur"> Filtre par couleur </label>
        <input type="search" name="couleur" placeholder="Rechercher la couleur">

        <input type="submit" name="envoyer">

    </form>


    <?php 
    if($allvoiture->rowCount() > 0) {
         while($user = $allvoiture->fetch()) {
            ?>
            <div class="afficher_vehicule">
            <div class="image"><img src="<?= $user['url_image'] ?> " width="300px" height="250px";></div>
            <p>Marques :<?= $user['Marques']; ?></p>
            <p>Montant :<?= $user['Montant']; ?></p>
            <p>Couleurs  :<?= $user['couleur']; ?></p>
         </div>


            <?php
         }

    }
    
    else {
        ?>
        <p>Aucun utilisateur trouvé</p>
        <?php
        }
        ?>

</body>
</html>