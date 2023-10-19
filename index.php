<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <title>Liste des candidats</title>
</head>

<body>
    <h2 class="text-center">LISTE DES CANDIDATS</h2><br><br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">E-mail</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Niveau d'étude</th>
                <th scope="col">Fichier</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require '../Recrutement/connexion.php';

            $req = "SELECT * FROM cvs";
            $resultat = $connexion->query($req);

            if (!$resultat) {
                echo 'Une erreur est survenue lors de l\'affichage des candidats';
            } else {
                while ($row = $resultat->fetch_assoc()) {
                    echo '<tr>';
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['prenom'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['telephone'] . "</td>";
                    echo "<td>" . $row['niveau_etude'] . "</td>";
                    echo "<td>" . $row['fichier'] . "</td>";
                    echo "<td class=\"d-flex\">
                    <a class=\"btn btn-primary\" style=\"margin-right: 15px;\" href=\"./cvs/" . $row['fichier'] . "\" target=\"_blank\">Ouvrir le fichier</a>
                    <iframe id=\"file-frame\" name=\"file-frame\" style=\"display: none;\"></iframe>
                 <a href=\"./update.php?id=" . $row['id'] . "\" class=\"btn btn-warning\">Modifier</a>
                    <form action=\"./delete.php\" method=\"post\" onsubmit=\"return confirm('Etes-vous sur de vouloir supprimer cet candidat?');\">
                    <input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\">
                    <button type=\"submit\" class=\"btn btn-danger\" style=\"margin-left: 15px;\">Supprimer</button>
                    </form>
                    </td>";
                    echo '</tr>'; // Fermez la ligne
                }
            }
            ?>
        </tbody>

    </table><br><br><br>
    <a href="/create.php" style="margin-left: 25%;" class="col-lg-6 btn btn-success">Ajouter un nouveau candidat</a>
</body>

</html>