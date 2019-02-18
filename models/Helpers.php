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
    
    public function dayColor($table, $day)
    {
        $weekCheck = $this->dayCheck($table, $day);
        if ($weekCheck['tip'] == 1) {
            return 'sat';
        }
    
        if ($weekCheck['tip'] == 2) {
            return 'sun';
        }
    }
    
    public function getRealWork()
    {
        return R::findAll('object_people');
    }
    
    public function getTrashWork($workId)
    {
        return R::findAll('time', 'nraboti = ?', 772);
    }
}