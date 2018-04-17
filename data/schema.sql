DROP TABLE IF EXISTS user;
CREATE TABLE  user (
  id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(64)  NOT NULL,
  lastName  VARCHAR(64)  NOT NULL,
  email     VARCHAR(128) NOT NULL,
  password  VARCHAR(40)  NOT NULL,
  PRIMARY KEY  (id)
);

INSERT INTO user (firstName, lastName, email, password) VALUES ('Ramon',  'Binz',  'ramon.binz@bbcag.ch',   sha1('ramon'));
INSERT INTO user (firstName, lastName, email, password) VALUES ('Samuel', 'Wicky', 'samuel.wicky@bbcag.ch', sha1('samuel'));

//Unsere Datenbank
DROP DATABASE 10ner_DB;
CREATE DATABASE 10ner_DB;
USE 10ner_DB;
CREATE TABLE Benutzer (
    ID_Ben integer primary key AUTO_INCREMENT,
    Benutzername varchar(50),
    Email varchar(50),
    Passwort varchar(50)
);
CREATE TABLE Kategorie (
    ID_Kat integer primary key AUTO_INCREMENT,
    kategorie varchar(50)
);
CREATE TABLE Bild (
   	ID_Bild integer primary key AUTO_INCREMENT,
    Pfad varchar(50),
    Inhaber_id integer,
    Kategorie_id integer,
    FOREIGN KEY (Inhaber_id) REFERENCES Benutzer(ID_Ben),
    FOREIGN KEY (Kategorie_id) REFERENCES Kategorie(ID_Kat)
);
CREATE TABLE Bewertung (
	ID_Bew integer primary key AUTO_INCREMENT,
    Bild_id integer,
    Bewerter_id integer,
    Bewertung integer(10),
    FOREIGN KEY (Bild_id) REFERENCES Bild(ID_Bild),
    FOREIGN KEY (Bewerter_id) REFERENCES Benutzer(ID_Ben)
);