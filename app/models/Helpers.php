<?php
/**
 * Created by PhpStorm.
 * UserInfo: rupack
 * Date: 8.2.19
 * Time: 17.43
 */

namespace App\Models;

use R;

class Helpers
{
    public function redirect($uri, $response)
    {
        header("Location: $uri", true, $response);
    }
    
    
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
    
    public function getRealWork($workId)
    {
        return R::getRow("SELECT * FROM object_people WHERE id = ?", [$workId]);
    }
    
    public function getTrashWork()
    {
        return R::findAll('time', 'GROUP BY nraboti');
    }
    
}