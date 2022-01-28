<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $Voiture1=new Voiture();
    $Voiture1->marque="5";
    //$Voiture1->modele="6";
    //$Voiture1->annee="7";
    echo '<p>vous avez réservé une voiture de la marque : '.$Voiture1->getMarque().', modèle : '.$Voiture1->getModele().' de l&#39année '.$Voiture1->getAnnee().'</p>';
    ?>
</body>
</html>