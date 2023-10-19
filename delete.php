<?php 

require './connexion.php';

$cv_id = $_POST["id"];


$requeteSuppression = $connexion->prepare("DELETE FROM cvs WHERE id = ?");
$requeteSuppression->bind_param("i", $cv_id);

if ($requeteSuppression->execute()) {
    // La suppression a réussi

    header("Location: ../index.php");
    exit();
} else {
    // La suppression a échoué
    echo "Erreur lors de la suppression : " . $connexion->error;
}

$requeteSuppression->close();
$connexion->close();
