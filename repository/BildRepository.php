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
        $Bilder = $result->fetch_object();
        return $Bilder->pfad; 
    }

    public function getProfilBild($uid) //fertig
    {
        $query = 'select * from bild as bi join benutzer as be
                on bi.inhaber_id = be.ID_Ben
                where be.ID_Ben = ?
                and bi.istProfilBild = true;';
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $uid);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $user = $result->fetch_object();

        return $user->pfad;
    }

    public function update($uid, $file)
    {
        $query = "
            UPDATE bild
            SET pfad = ?
            WHERE inhaber_id = ?
            and istProfilBild = true;";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss',$uid , $file);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $Bilder = $result->fetch_object();
        return $Bilder->pfad; 
    }
}
