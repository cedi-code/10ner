<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class BildRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'Bild';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($pfad, $istProfilBild, $inhaber_id, $kategorie_id) //funktioniert!
    {
        $query = "INSERT INTO {$this->tableName} (pfad, istProfilBild, inhaber_id, kategorie_id) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('siii', $pfad, $istProfilBild, $inhaber_id, $kategorie_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function getEveryImage($uid) //fertig
    {
        $query = "select * from bild as bi join benutzer as be
                on bi.inhaber_id = be.ID_Ben where be.ID_Ben = ?;";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $uid);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        return $result;
    }

    public function getProfilBild($uid) //fertig
    {
        $query = 'select * from bild as bi join benutzer as be
                on bi.inhaber_id = be.ID_Ben
                where be.ID_Ben = ?
                and bi.istProfilBild = true;';
        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('i', $uid);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $user = $result->fetch_object();

        return $user->pfad;
    }
    public function getProfilBildId($uid) //fertig
    {
        $query = 'select * from bild as bi join benutzer as be
                on bi.inhaber_id = be.ID_Ben
                where be.ID_Ben = ?
                and bi.istProfilBild = true;';
        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('i', $uid);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $user = $result->fetch_object();

        return $user->ID_Ben;
    }


    public function uploadImage($file, $email)
    {
        //Bild im Bilder ordner speichern
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $timestamp = time();
        $file_destination = "images/" . $email . $timestamp . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $file_destination)) {
        }
        return $file_destination;
    }

    public function update($uid, $file)
    {
        //Bild in der datenbank tauschen
        $query = "update bild
                    SET pfad = ?
                    WHERE inhaber_id = ?
                    and istProfilBild = 1;";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si',$file, $uid);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function addImage($uid, $file)
    {
        $query = "insert into bild (pfad, istProfilBild, inhaber_id)
            VALUES (?, 0, ?);";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si',$file, $uid);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function deleteImage($bild_id)
    {
        /*
        // in der Server-Ordnerstrucktur löschen

        //Zuesrt bild pfad holen:
        $query = 'select pfad from bild where ID_Bild = ?;';
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i',$bild_id);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $bild = $result->fetch_object();
        $pfad = $bild->pfad; //Pfad vom Bild

        //Bild im Image Ordner löschen
        $dir = "images";
        $dirHandle = opendir($dir);
        while ($file = readdir($dirHandle)) {
            if($file==$data) {
                unlink($file);
            }
        }
        */

        //Alle bewertungen zum bild löschen:
        $query = 'Delete from bewertung where Bild_id = ?;';
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i',$bild_id);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        // in der datenbank löschen
        $query = 'delete FROM bild WHERE ID_Bild = ?;';
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i',$bild_id);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function getAverageRate($uid)
    {
        $query = 'select cast(avg(bew.bewertung) as decimal(6, 1)) as durchschnitt from bild as bi join benutzer as ben
        on bi.inhaber_id = ben.ID_Ben
        join bewertung as bew
        on bew.Bild_id = bi.ID_Bild
        where ben.ID_Ben = ?;';
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $uid);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        
        $ersteZeile = $result->fetch_object();
        $average = $ersteZeile->durchschnitt;
        return $average;
    }
}
