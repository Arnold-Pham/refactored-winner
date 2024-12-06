<?php
$servername = "db";
$username = "root";
$password = "rootpassword";
$dbname = "utilisateurs";

try {
    // Créer une connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ajouter un utilisateur
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];

        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, age) VALUES (:nom, :prenom, :age)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':age', $age);
        $stmt->execute();
    }

    // Supprimer un utilisateur
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Récupérer les utilisateurs
    $stmt = $conn->prepare("SELECT id, nom, prenom, age FROM utilisateurs");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau d'utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>

    <!-- Formulaire pour ajouter un utilisateur -->
    <h2>Ajouter un utilisateur</h2>
    <form method="POST" action="">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" required><br><br>

        <button type="submit" name="add_user">Ajouter</button>
    </form>

    <h2>Liste des utilisateurs</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Âge</th>
            <th>Actions</th>
        </tr>
        <?php
        // Afficher les utilisateurs avec un bouton de suppression
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['age']) . "</td>";
            echo "<td><a href='?delete_id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\");'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
