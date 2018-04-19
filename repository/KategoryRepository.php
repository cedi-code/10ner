<?php
/**
 * Created by PhpStorm.
 * User: bgirac
 * Date: 19.04.2018
 * Time: 14:12
 */

require_once '../lib/Repository.php';
class KategoryRepository
{
    protected $tableName = 'kategorie';

    public function getKategorie() {
        $query = "select * from {$this->tableName}  WHERE ID_Kat = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $bildID);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $kategorie = $result->fetch_object();

        return $kategorie->kategore;
    }
    public function getAllKategorie() {
        $query = "select kategorie from {$this->tableName} ";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();

        // TODO weiss nicht ob das es array Zrück git oder nid :(
        $kategorien = $result->fetch_object();
        return $kategorien;
    }
}