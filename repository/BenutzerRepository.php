<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class BenutzerRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'benutzer';


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
    public function create($benutzername, $email, $passwort)
    {
        $passwort = password_hash($passwort, PASSWORD_DEFAULT);

        $query = "INSERT INTO {$this->tableName} (benutzername, email, passwort) VALUES (?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sss', $benutzername, $email, $passwort);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    /**
     * überprüft ob die Email schon in der Datenbank ist
     * @param $email die Email des User
     * @return int  anzahl der zurückgegebenen rows des SQL query
     * @throws Exception
     */
    public function checkEmail($email) {
        $queryMail = "SELECT * FROM $this->tableName WHERE  email = ?";
        $statement = ConnectionHandler::getConnection()->prepare($queryMail);
        $statement->bind_param('s', $email);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();

        $resultCheck = $result->num_rows;

        return $resultCheck;

    }

    /**
     * @param $pw das eingegebene Passwort
     * @param $email die eingegeben Email
     * @return bool|object|stdClass wenn das Passwort falsch ist, gibt es False zurück, wenn richtig, die Userdaten
     * @throws Exception
     */
    public function checkPW($pw,$email) {
        $queryMail = "SELECT * FROM $this->tableName WHERE  email = ?";
        $statement = ConnectionHandler::getConnection()->prepare($queryMail);
        $statement->bind_param('s', $email);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();


        $row = $result->fetch_object();

        $hashedPwdCheck = password_verify($pw, $row->passwort);


        if($hashedPwdCheck === true) {
            return $row;

        }else {
            return false;
        }
    }

    /**
     * @return object|stdClass gibt Random Userdaten zurück;
     * @throws Exception
     */
    public function getRandomId() {
        $query = "SELECT ID_Ben FROM {$this->tableName} ORDER BY RAND() LIMIT 1";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $row = $result->fetch_object();
        return $row;
    }

    /**
     * @param $benutzername
     * @param $passwort
     * @throws Exception
     * aktuallisiert den User je nach parameter
     */
    public function update($benutzername, $passwort)
    {
        $passwort = password_hash($passwort, PASSWORD_DEFAULT);
        $_SESSION['benutzername'] = $benutzername;
        $query = "update benutzer
            SET benutzername = ?,
            passwort = ?
            WHERE ID_Ben = ?;";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sss', $benutzername, $passwort, $_SESSION['uid']);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}
