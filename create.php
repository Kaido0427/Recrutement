<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <title>Ajouter un candidtat</title>
</head>

<body>
    <div class="container mt-5">
        <form action="/store.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" name="Email" id="Email" placeholder="Ex:adresse@gmail.com">
            </div>
            <div class="form-group">
                <label for="Nom">Nom du candidat</label>
                <input type="text" class="form-control" name="Nom" id="Nom">
            </div>

            <div class="form-group">
                <label for="Prenom">Prénom du candidat :</label>
                <input class="form-control" name="Prenom" id="Prenom">
            </div>

            <div class="form-group">
                <label for="telephone">Télephone :</label>
                <input type="number" class="form-control" name="telephone" id="telephone">
            </div>

            <div class="form-group">
                <label for="Level">Niveau d'etude</label>
                <input type="text" class="form-control" name="Level" id="Level">
            </div>

            <div class="form-group">
                <label for="fichier">Uploader son CV</label>
                <input type="file" class="form-control" accept=".pdf,.doc,.docx" name="fichier" id="fichier">
            </div>
            <input class="btn btn-info" type="submit" value="Ajouter">
        </form>
    </div>
</body>

</html>