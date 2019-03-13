<?php
/**
 * Created by PhpStorm.
 * UserRole: rupak
 * Date: 12.03.2019
 * Time: 1:14
 */

namespace App\Storage;

use App\interfaces\StorageInterface;

/**
 * Class SessionStorage
 * @package App\Storage
 */
class TestStorage implements StorageInterface
{
    public function load()
    {
        return [
            'id' => 100,
            'name' => 'Админ',
            'role' => 'admin'
        ];
    }
    
    public function save(array $items)
    {
    
    }
}