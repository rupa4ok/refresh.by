<?php
/**
 * Created by PhpStorm.
 * UserInfo: Admin
 * Date: 26.09.2018
 * Time: 11:34
 */

namespace App\Models;

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
