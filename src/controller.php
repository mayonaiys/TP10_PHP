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
            header("Location: http://localhost/PHP/TP10/src/index.php");
        } else {
            echo "Les mots de passe ne correspondent pas !";
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
                session_start();
                $_SESSION['nom']=$infos['nom'];
                $_SESSION['prenom']=$infos['prenom'];
                $_SESSION['id']=$infos['id'];
            }
        }

        if($isconnected){
            header("Location: http://localhost/PHP/TP10/src/viewadmin.php");
        } else  {
            echo '<br><section id="errors" class="container alert alert-danger">Email ou mot de passe incorrect.</section>';
        }
    }
}

function displayList(){
    session_start();
    $bdd = connexbdd('pgsql:dbname=etudiants;host=localhost;port=5432', 'postgres', 'passwordbdd');

    $recup = $bdd->prepare('SELECT * FROM etudiant WHERE user_id=?');
    $recup->execute(array($_SESSION['id']));

    echo '<table class="table">';
    echo '<thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Moyenne</th>
                </tr>
            </thead>';

    while(($data = $recup->fetch())!=0){
        echo '<tr>',
            '<td>'.$data['id'].'</td>',
            '<td>'.$data['nom'].'</td>',
            '<td>'.$data['prenom'].'</td>',
            '<td>'.$data['note'].'</td>',
            '<td><form method="post" action="vieweditetudiant.php"><button type="submit" class="btn btn-warning">Editer</button></form></td>',
            '<td><form method="post" action="controller.php?func=deleteEtudiant"><button type="submit" class="btn btn-danger">Supprimer</button></form></td>',
        '</tr>';
    }

    echo '</table>';
}

function addEtudiant(){
    session_start();
    $bdd = connexbdd('pgsql:dbname=etudiants;host=localhost;port=5432', 'postgres', 'passwordbdd');
    if(isset($_POST['name']) && isset($_POST['firstname']) &&  isset($_POST['moyenne'])){
        $query = "SELECT COUNT(*) as nb FROM etudiant";
        $result = $bdd->query($query);
        $id = $result->fetch()['nb'] + 1;
        $add = $bdd->prepare('INSERT INTO etudiant(id,user_id,nom,prenom,note) VALUES(?, ?, ?, ?, ?)');
        $add->execute(array($id,$_SESSION['id'],$_POST['name'],$_POST['firstname'],(int)$_POST['moyenne']));
        header("Location: http://localhost/PHP/TP10/src/viewadmin.php");
    } else {
        echo "Une valeur est vide ou incorrecte";
    }
}

function editEtudiant(){

}