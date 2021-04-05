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
        $placeholder = [];
        $insert_key = [];
        $placeUpdate = [];

        $arrModel = $model -> getProperties();

        if ($model -> getId() === null){
            foreach ($arrModel as $key => $value){
                $insert_key[] = $key;
                array_push($placeholder, ':'.$key);
            }
            $strKeyIns = implode(', ', $insert_key);
            $strPlaceholder = implode(', ', $placeholder);
            $sql_insert = "INSERT INTO $this->table ({$strKeyIns}) VALUES ({$strPlaceholder})";
            $obj_insert = Database::getBdd()->prepare( $sql_insert);
            
            return $obj_insert->execute($arrModel);
        }else{
            foreach ($arrModel as $k=>$item){
                array_push($placeUpdate, $k.' = :'.$k);
            }
            
            $strPlaceUpdate=implode(', ',$placeUpdate);
            $sql_update="UPDATE {$this->table} SET $strPlaceUpdate WHERE id = :id";
            $obj_update=Database::getBdd()->prepare($sql_update);

            return $obj_update->execute($arrModel);
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

