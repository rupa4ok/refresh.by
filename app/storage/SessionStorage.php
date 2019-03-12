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
class SessionStorage implements StorageInterface
{
    private $key;
    
    public function __construct($key)
    {
        $this->key = $key;
    }
    
    public function load()
    {
        return isset($_SESSION[$this->key]) ? unserialize($_SESSION[$this->key]) : [];
    }
    
    public function save(array $items): void
    {
        $_SESSION[$this->key] = serialize($items);
    }
    
    public function clear()
    {
        $_SESSION[$this->key] = [];
    }
}