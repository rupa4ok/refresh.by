<?php
/**
 * Created by PhpStorm.
 * UserRole: rupak
 * Date: 12.03.2019
 * Time: 1:14
 */

namespace Storage;

use Interfaces\StorageInterface;

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
    
    public function save(array $items)
    {
        $_SESSION[$this->key] = serialize($items);
    }
}