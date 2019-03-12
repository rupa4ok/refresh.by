<?php
/**
 * Created by PhpStorm.
 * UserRole: rupak
 * Date: 12.03.2019
 * Time: 1:14
 */

namespace Storage;

use Interfaces\StorageInterface;

class PostStorage implements StorageInterface
{
    
    public function __construct()
    {
    }
    
    public function load()
    {
        return $_POST;
    }
    
    public function save(array $items)
    {
    }
}