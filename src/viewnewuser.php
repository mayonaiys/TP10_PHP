<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>S'inscrire</h2>
            <hr>
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Pseudonyme</label>
                    <input type="text" class="form-control" name="login" placeholder="Entrez votre pseudonyme">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Entrez votre adresse mail">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe">
                    <br>
                    <input type="password" class="form-control" name="passwordrepeat" placeholder="Entrez de nouveau votre mot de passe">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nom</label>
                    <input type="text" class="form-control" name="name" placeholder="Entrez votre nom">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Prénom</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Entrez votre prénom">
                </div>
                <small id="emailHelp" class="form-text text-muted">Vos informations restent confidentielles.</small>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
            <?php
            include 'controller.php';
            addUser();
            ?>
        </div>
    </div>
</div>
</body>
</html>
<?php
