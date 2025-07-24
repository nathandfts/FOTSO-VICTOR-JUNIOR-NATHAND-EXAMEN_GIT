<?php include("../includes/db.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Tableau de Bord</h1>
        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
            <?php
            $total = $pdo->query("SELECT COUNT(*) FROM employes")->fetchColumn();
            $dernier = $pdo->query("SELECT nom, prenom FROM employes ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
            $par_poste = $pdo->query("SELECT poste, COUNT(*) as total FROM employes GROUP BY poste")->fetchAll();
            ?>
            <div style="flex: 1; background:#d1ecf1; padding:20px; border-radius:10px;">
                <h3>Total Employés</h3>
                <p><?= $total ?></p>
            </div>
            <div style="flex: 1; background:#d4edda; padding:20px; border-radius:10px;">
                <h3>Dernier Employé</h3>
                <p><?= $dernier['prenom'] . ' ' . $dernier['nom'] ?></p>
            </div>
            <div style="flex: 2; background:#fff3cd; padding:20px; border-radius:10px;">
                <h3>Employés par Poste</h3>
                <ul>
                    <?php foreach ($par_poste as $p): ?>
                        <li><?= $p['poste'] ?> : <?= $p['total'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <br><br>
        <a href="ajouter_employe.php">➕ Ajouter un Employé</a> | 
        <a href="liste_employes.php">📋 Liste des Employés</a>
    </div>
</body>
</html>