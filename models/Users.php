<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.09.2018
 * Time: 11:34
 */

class Users {
    
    public function GetTableById($table, $id)
    {
        $result = R::findAll($table);
        return $result;
    }

}
