<?php
/**
 * Created by PhpStorm.
 * UserInfo: rupak
 * Date: 12.03.2019
 * Time: 0:24
 */

namespace Models;

use Interfaces\UserInfo;
use Storage\SessionStorage;

class UserRole implements UserInfo
{
    /**
     * @var SessionStorage
     */
    private $sessionStorage;
    
    public function __construct(SessionStorage $sessionStorage)
    {
        $this->sessionStorage = $sessionStorage;
    }
    
    public function getName()
    {
        print_r($this->sessionStorage);
    }
}