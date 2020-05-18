<?php

function connexbdd($base,$user,$password){
    try {
        $bdd = new PDO($base,$user,$password);
        return $bdd;
    } catch (PDOException $exception){
        echo 'Connexion échouée : '.$exception->getMessage();
        return 0;
    }
}

function addUser(){
    $bdd = connexbdd('pgsql:dbname=etudiants;host=localhost;port=5432', 'postgres', 'passwordbdd');
    if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordrepeat'])  && isset($_POST['name']) && isset($_POST['firstname'])){
        if($_POST['password'] == $_POST['passwordrepeat']){
            $query = "SELECT COUNT(*) as nb FROM utilisateur";
            $result = $bdd->query($query);
            $id = $result->fetch()['nb'] + 1;
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $add = $bdd->prepare('INSERT INTO utilisateur(id, login, password, mail, nom, prenom) VALUES(?, ?, ?, ?, ?, ?)');
            $add->execute(array($id,$_POST['login'],$password,$_POST['email'],$_POST['name'],$_POST['firstname']));
        }
    }
}

function authentification(){
    $bdd = connexbdd('pgsql:dbname=etudiants;host=localhost;port=5432', 'postgres', 'passwordbdd');
    if(isset($_POST['email']) && isset($_POST['password'])){
        $user = $bdd->prepare('SELECT * FROM utilisateur WHERE mail=?');
        $user->execute(array($_POST['email']));
        $isconnected = false;
        while(($infos = $user->fetch())!=0 && !$isconnected){
            if(password_verify($_POST['password'],$infos['password'])){
                $isconnected = true;
            }
        }

        if($isconnected){
            header("Location: http://localhost/PHP/TP10/src/index.php");
        } else  {
            echo "Email ou mot de passe incorrect !";
        }
    }
}