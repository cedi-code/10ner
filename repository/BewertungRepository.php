<?php
/**
 * Created by PhpStorm.
 * User: bgirac
 * Date: 19.04.2018
 * Time: 13:32
 */
require_once '../lib/Repository.php';

class BewertungRepository extends Repository
{

    protected $tableName = 'bewertung';

    public function addBewertung($bildId, $bewerterId, $bewertung) {

        $query = "INSERT INTO {$this->tableName} ( Bild_id, bewerter_id, bewertung) VALUES (?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('iii', $bildId,$bewerterId, $bewertung);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }
    public function getBewertungFromBid($bildID) {{
            $query = "select * from {$this->tableName}  WHERE Bild_id = ?";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('i', $bildID);
            if (!$statement->execute()) {
                throw new Exception($statement->error);
            }
            $result = $statement->get_result();
            $user = $result->fetch_object();

            return $user->bewertung;
        }
    }
    public function checkBewerterBild($bewerterId,$bildId) {
        $query = "select * from {$this->tableName}  WHERE Bild_id = ? AND bewerter_id = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $bildId,$bewerterId);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $resultCheck = $result->num_rows;
        return $resultCheck;

    }
}