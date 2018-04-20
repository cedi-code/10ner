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

    /**
     * @param $bildId
     * @param $bewerterId ist die id des Users der die Bewertung macht
     * @param $bewertung
     * @return int die Bewertung id
     * @throws Exception
     */
    public function addBewertung($bildId, $bewerterId, $bewertung) {

        $query = "INSERT INTO {$this->tableName} ( Bild_id, bewerter_id, bewertung) VALUES (?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('iii', $bildId,$bewerterId, $bewertung);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    /**
     * @param $bildID
     * @return bool|mysqli_result gibt alle Daten
     * @throws Exception
     */
    public function getBewertungFromBid($bildID) {{
            $query = "select * from {$this->tableName}  WHERE Bild_id = ?";
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('i', $bildID);
            if (!$statement->execute()) {
                throw new Exception($statement->error);
            }
            $result = $statement->get_result();

            return $result;
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