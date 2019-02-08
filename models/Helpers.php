<?php
/**
 * Created by PhpStorm.
 * User: rupack
 * Date: 8.2.19
 * Time: 17.43
 */

namespace Models;

use R;

class Helpers
{
    
    public function dayCheck($table, $day)
    {
        $data = $_SESSION['year']. '-' . $_SESSION['month'] . '-' .$day;
        return R::getRow("SELECT * FROM {$table} WHERE data = ?", [$data]);
    }
}