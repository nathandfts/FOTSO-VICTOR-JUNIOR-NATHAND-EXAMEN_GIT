<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Employés</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Liste des Employés</h1>
        <form method="GET">
            <input type="text" name="recherche" placeholder="Rechercher par nom ou prénom">
            <button type="submit">Rechercher</button>
        </form>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
            <tr>
                <th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>Poste</th><th>Date</th><th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM employes";
            if (!empty($_GET['recherche'])) {
                $recherche = "%" . $_GET['recherche'] . "%";
                $sql .= " WHERE nom LIKE ? OR prenom LIKE ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$recherche, $recherche]);
            } else {
                $stmt = $pdo->query($sql);
            }
            foreach ($stmt as $row) {
                echo "<tr>
                        <td>{$row['nom']}</td>
                        <td>{$row['prenom']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telephone']}</td>
                        <td>{$row['poste']}</td>
                        <td>{$row['date_embauche']}</td>
                        <td>
                            <a href='?delete={$row['id']}' onclick='return confirm("Supprimer cet employé ?")'>🗑</a>
                            <a href='modifier_employe.php?id={$row['id']}'>✏️</a>
                        </td>
                    </tr>";
            }

            if (isset($_GET['delete'])) {
                $stmt = $pdo->prepare("DELETE FROM employes WHERE id = ?");
                $stmt->execute([$_GET['delete']]);
                echo "<script>location.href='liste_employes.php';</script>";
            }
            ?>
        </table>
    </div>
</body>
</html>