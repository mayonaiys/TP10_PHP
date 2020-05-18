CREATE TABLE utilisateur (
    id INTEGER,
    login VARCHAR(64) NOT NULL,
    password VARCHAR(64) NOT NULL,
    mail VARCHAR(64) NOT NULL,
    nom VARCHAR(64) NOT NULL,
    prenom VARCHAR(64) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE etudiant (
    id INTEGER,
    uset_id INTEGER,
    nom VARCHAR(64) NOT NULL,
    prenom VARCHAR(64) NOT NULL,
    note INTEGER,
    PRIMARY KEY(id)
);