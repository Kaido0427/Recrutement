<?php

//Au lieu d'include j'opte pour un require
require 'connexion.php';

if (isset($_GET['id'])) {
    //aqui ici tu as recuperer l'id du cv depuis le lien modifier de la page precedente c'est ok!
    $id = $_GET['id'];

    $query = "SELECT * FROM cvs WHERE id = ?";
    $traitement = $connexion->prepare($query);
    $traitement->bind_param('s', $id);
    $traitement->execute();
    $resultat = $traitement->get_result();

    //Jusqu'ici tu fais un bonne requete preparé pour recuperer toutes les colonnes de la table cvs ca va
    if ($resultat->num_rows > 0) {
        $candidat = $resultat->fetch_assoc();

        // Yo aqui une fois recuperer tu les a passer dans une variable ce qui est inutile donc je les ai enlever 
        //parce que si tu regarde ceest pas mauvais de le faire mais quand tu as fais ca tu as un peu plus passer encore dans ces 
        //meme variables ce que tu saisi dans le formulaire donc ca va créer des ambiguité et PHP et ne saurais pas quoi choisi a modifier 
        //dans la base de donnés!
        //De plus tu les passais dans un var_dump surement pour verifer si il afiche je l'ai enlever 

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //ici c'est bon mais pour eviter tout prbleme d'engocade utilise un fonction real_escape_string
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $niveau_etude = $_POST['niveau_etude'];

    $nom = $connexion->real_escape_string($nom);
    $prenom = $connexion->real_escape_string($prenom);
    $email = $connexion->real_escape_string($email);
    $telephone = $connexion->real_escape_string($telephone);
    $niveau_etude = $connexion->real_escape_string($niveau_etude);


    //==================================================================
    //tu recuperais encore le fichier du formulaire mais je l'ai enlever et remoduler en focntion de if inbriqué
    //si tu observe bien ......

    ///D'abord je verifie si le fichier est selectionner dans le formulaire si il n'est pas fais j'envois un message qui dis que le fichier n'est
    //pas selectionner
    if (isset($_FILES['fichier'])) {

        //Ensuite je veirifie si a l'envoie du formulaire le fichier a eté bel et bien telecharger sur le server 
        if (is_uploaded_file($_FILES['fichier']['tmp_name'])) {
            //par la suite je recup le nom original du fichier que je passe dans a variable $nomDestination
            $filename = $_FILES['fichier']['name'];
            $nomdestination = './cvs/' . $filename;

            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $nomdestination)) {
                //Une fois que c'est verifié et telechargé maintenant je fais le deplacerment vers le dossier et la requete pour modifier s'execute
                $query1 = "UPDATE cvs SET nom = '$nom', prenom = '$prenom', email = '$email', telephone = '$telephone', niveau_etude = '$niveau_etude',fichier='$filename' WHERE id = '$id'";
                $trtm = $connexion->query($query1);
                if ($trtm) {
                    header("Location: /index.php");
                    exit();
                } else {
                    echo 'Une erreur est survenue lors de la mise à jour du CV : ' . $connexion->error;
                }
            } else {
                echo 'Une erreur est survenue lors du déplacement du fichier téléchargé.';
            }
        } else {
            echo 'Une erreur est survenue lors du téléchargement du fichier.';
        }
    } else {
        echo 'Le champ de fichier est vide ou incorrect.';
    }

    $trtm->close();
}

$connexion->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MISE A JOUR</title>
    <link rel="stylesheet" href="css\bootstrap.css">
</head>

<body>
    <div class="container"><br><br>
        <h2 class="text-center">MISE A JOUR</h2>
        <hr>
        <form method="POST" action="" enctype="multipart/form-data">

            <!--Dans ton formulaire utilise la foction htmlspecialcharacters pour que ca accepete facilment tout type d'encodage pour 
        l'enregistrement dans la base de donnés -->

            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" name="nom" id="nom" value="<?= htmlspecialchars($candidat['nom']) ?>">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" name="prenom" id="prenom" value="<?= htmlspecialchars($candidat['prenom']) ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($candidat['email']) ?>">
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone:</label>
                <input type="text" class="form-control" name="telephone" id="telephone" value="<?= htmlspecialchars($candidat['telephone']) ?>">
            </div>
            <div class="form-group">
                <label for="niveau_etude">Niveau d'étude:</label>
                <input type="text" class="form-control" name="niveau_etude" id="niveau_etude" value="<?= htmlspecialchars($candidat['niveau_etude']) ?>">
            </div>
            <div class="form-group">
                <label for="fichier">Fichier:</label>
                <input type="file" class="form-control" accept=".pdf,.doc,.docx" name="fichier" id="fichier">
            </div><br>
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>
</body>

</html>