<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Employé</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Ajouter un Employé</h1>
        <form method="POST">
            <label>Nom:</label>
            <input type="text" name="nom" required>
            <label>Prénom:</label>
            <input type="text" name="prenom" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Téléphone:</label>
            <input type="text" name="telephone" required>
            <label>Poste:</label>
            <input type="text" name="poste" required>
            <label>Date d'embauche:</label>
            <input type="date" name="date_embauche" required>
            <button type="submit" name="ajouter">Ajouter</button>
        </form>
        <?php
        if (isset($_POST['ajouter'])) {
            $sql = "INSERT INTO employes (nom, prenom, email, telephone, poste, date_embauche)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['telephone'],
                $_POST['poste'],
                $_POST['date_embauche']
            ]);
            echo "<p>Employé ajouté avec succès !</p>";
        }
        ?>
    </div>
</body>
</html>