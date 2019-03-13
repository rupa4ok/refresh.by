<?php
/**
 * Created by PhpStorm.
 * User: rupack
 * Date: 13.3.19
 * Time: 12.00
 */

namespace Tests;

use App\Models\UserRole;
use App\Storage\TestStorage;
use PHPUnit\Framework\TestCase;

class UserRoleTest extends TestCase
{
    public $storage;
    public $user;
    
    public function setUp(): void
    {
        $this->storage = new TestStorage();
        $this->user = new UserRole($this->storage);
        parent::setUp();
    }
    
    public function testGetName()
    {
        $this->assertEquals('Админ', $this->user->getName());
    }
    
    public function testGetId()
    {
        $this->assertEquals(100, $this->user->getId());
    }
    
    public function testGetRole()
    {
        $this->assertEquals('admin', $this->user->getRole());
    }
}
