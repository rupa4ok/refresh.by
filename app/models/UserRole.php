<?php
/**
 * Created by PhpStorm.
 * UserInfo: rupak
 * Date: 12.03.2019
 * Time: 0:24
 */

namespace App\Models;

use App\Interfaces\StorageInterface;
use App\Interfaces\UserInfo;
use App\Storage\SessionStorage;

/**
 * Class UserRole
 * @package App\Models
 */
class UserRole implements UserInfo
{
    /**
     * @var SessionStorage
     */
    private $session;
    
    public function __construct(StorageInterface $sessionStorage)
    {
        $this->session = $sessionStorage;
    }
    
    public function getId()
    {
        return $this->session->load()['id'];
    }
    
    public function getName()
    {
        return $this->session->load()['name'];
    }
    
    public function getRole()
    {
        return $this->session->load()['role'] ?? null;
    }
}