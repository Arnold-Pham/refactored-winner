CREATE DATABASE IF NOT EXISTS utilisateurs;

USE utilisateurs;

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    age INT NOT NULL
);

INSERT INTO utilisateurs (nom, prenom, age) VALUES 
('Dupont', 'Jean', 25),
('Martin', 'Marie', 30),
('Durand', 'Pierre', 35);
