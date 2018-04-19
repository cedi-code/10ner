-- Unsere 10ner
CREATE DATABASE 10ner_DB;
USE 10ner_DB;
DROP TABLE IF EXISTS Benutzer;
CREATE TABLE Benutzer (
    ID_Ben integer primary key AUTO_INCREMENT,
    benutzername varchar(50),
    email varchar(50),
    passwort varchar(255),
    profilbild varchar(255)
);
DROP TABLE IF EXISTS Kategorie;
CREATE TABLE Kategorie (
    ID_Kat integer primary key AUTO_INCREMENT,
    kategorie varchar(50)
);
DROP TABLE IF EXISTS Bild;
CREATE TABLE Bild (
   	ID_Bild integer primary key AUTO_INCREMENT,
    pfad varchar(50),
    inhaber_id integer,
    kategorie_id integer,
    FOREIGN KEY (Inhaber_id) REFERENCES Benutzer(ID_Ben),
    FOREIGN KEY (Kategorie_id) REFERENCES Kategorie(ID_Kat)
);
DROP TABLE IF EXISTS Bewertung;
CREATE TABLE Bewertung (
	ID_Bew integer primary key AUTO_INCREMENT,
    Bild_id integer,
    bewerter_id integer,
    bewertung integer(10),
    FOREIGN KEY (Bild_id) REFERENCES Bild(ID_Bild),
    FOREIGN KEY (Bewerter_id) REFERENCES Benutzer(ID_Ben)
);