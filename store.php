<?php
require './connexion.php';

$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$tel = $_POST['telephone'];
$mail = $_POST['Email'];
$level = $_POST['Level'];

if (isset($_FILES['fichier'])) {
    if (is_uploaded_file($_FILES['fichier']['tmp_name'])) {
        $filename = $_FILES['fichier']['name'];
        $nomdestination = './cvs/' . $filename;
  
        if (move_uploaded_file($_FILES['fichier']['tmp_name'], $nomdestination)) {
            $requete = "INSERT INTO cvs (nom, prenom, email, telephone, niveau_etude, fichier)
            VALUES ('$nom', '$prenom', '$mail', '$tel', '$level', '$filename')";
            $resultat = $connexion->query($requete);

            if ($resultat) {
                header('Location: /index.php');
            } else {
                echo 'Une erreur est survenue lors de l\'enregistrement du CV';
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


if (isset($resultat)) {
    $resultat->close();
}
