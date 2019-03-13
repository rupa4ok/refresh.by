<?php
/**
 * Created by PhpStorm.
 * User: rupack
 * Date: 13.3.19
 * Time: 10.42
 */

namespace Tests\Auth;

use App\Models\UserRole;
use App\Storage\TestStorage;
use PHPUnit\Framework\TestCase;
use R as Red;

/**
 * Class AuthTest
 * @package Tests\Auth
 */
class AuthTest extends TestCase
{
    public $storage;
    public $user;
    
    public function setUp(): void
    {
        $this->storage = new TestStorage();
        $this->user = new UserRole($this->storage);
        parent::setUp();
    }
    
    public function testUser()
    {
        $user = Red::findOne('users', 'email = ?', array($this->storage['email']));
        $this->assertTrue($user);
    }
}
