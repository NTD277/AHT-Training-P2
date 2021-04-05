<?php

namespace MVC\Core;

use MVC\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{
    private $id;
    private $model;
    private $table;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        $arrModel = $model -> getProperties();
        // create
        if ($model -> getId() === null){
            $placeholder = [];
            $k = [];

            foreach ($arrModel as $key => $value){
                $k[] = $key;
                array_push($placeholder, ':' . $key);
            }
            $strKeyInsert = implode(', ', $k);
            $strPlaceholder = implode(', ', $placeholder);
            $sqlInsert = "INSERT INTO $this->table ({$strKeyInsert}) VALUES ({$strPlaceholder})";
            $insert = Database::getBdd()->prepare( $sqlInsert);
            
            return $insert->execute($arrModel);
        }else{
        // update 
            $placeUpdate = [];

            foreach ($arrModel as $key => $value){
                array_push($placeUpdate, $key . ' = :' . $key);
            }
            
            $strPlaceUpdate=implode(', ',$placeUpdate);
            $sqlUpdate="UPDATE {$this->table} SET $strPlaceUpdate WHERE id = :id";
            $Update=Database::getBdd()->prepare($sqlUpdate);

            return $Update->execute($arrModel);
        }
    }

    public function getAll()
    {
        $sqlGetAll = "SELECT * FROM $this->table";
        $getAll = Database::getBdd()->prepare($sqlGetAll);
        $getAll->execute();

        return $getAll->fetchAll();
    }

    public function find($id)
    {
        $sqlFind = "SELECT * FROM $this->table WHERE id = $id";
        $find = Database::getBdd()->prepare($sqlFind);

        $find->execute();
        return $find->fetch();
    }

    public function delete($id)
    {
        $sqlDelete = "DELETE FROM $this->table WHERE id = $id";
        $delete = Database::getBdd()->prepare($sqlDelete);

        return $delete->execute();
    }

}

