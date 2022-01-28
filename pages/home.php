<?php
//page d'accueil
//chargement des paramètres de la BD et connexion
include('./utils/db.php');

try {
    $stmt = $pdo->prepare("SELECT materiels.id_mat, materiels.libelle_mat, 
    CONCAT(types_materiel.id_type_mat, ' : ', types_materiel.LIBELLE_TYPE_MAT) AS libTypeMat 
    FROM materiels 
    INNER JOIN types_materiel ON materiels.id_type_mat = types_materiel.id_type_mat LIMIT 10");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class=\"container mt-3\"><table class=\"table\">
    <thead class=\"thead-light\">
        <tr>
            <th>Num mat</th>
            <th>nom mat</th>
            <th>catégorie</th>
        </tr>
    </thead>
    <tbody>";
    foreach($results AS $result){
        echo "<tr>";
        echo "<td>" . $result['id_mat'] . "</td>";
        echo "<td>" . $result['libelle_mat'] . "</td>";
        echo "<td>" . $result['libTypeMat'] . "</td>";
        echo "<tr>";
    }
    echo "</tbody>
    </table>
    </div>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>