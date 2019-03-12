<?php
/**
 * Created by PhpStorm.
 * User: rupack
 * Date: 12.3.19
 * Time: 10.46
 */

namespace Storage;

use App\interfaces\StorageInterface;

/**
 * Class GetStorage
 * @package Storage
 */
class GetStorage implements StorageInterface
{
    public function load()
    {
        return $_POST;
    }
    
    public function save(array $items)
    {
        // TODO: Implement save() method.
    }
}