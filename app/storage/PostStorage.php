<?php
/**
 * Created by PhpStorm.
 * UserRole: rupak
 * Date: 12.03.2019
 * Time: 1:14
 */

namespace App\Storage;

use App\Interfaces\StorageInterface;

/**
 * Class PostStorage
 * @package App\Storage
 */
class PostStorage implements StorageInterface
{
    /**
     * @return array
     */
    public function load()
    {
        return isset($_POST) ? $_POST : [];
    }
    
    /**
     * @param array $items
     */
    public function save(array $items)
    {
    }
}