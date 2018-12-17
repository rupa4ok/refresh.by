<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.09.2018
 * Time: 11:34
 */

class Users {
    
    /**
     * @param $table
     * @param $id
     * @param $role
     * @return array
     */
    public function getObjectById($table, $id, $role)
    {
        if ($role == 'admin') {
            $result = R::findAll($table);
        } else {
            $result = R::findAll($table, ' users_id = ? ', [ $id ]);
        }
        return $result;
    }
}
