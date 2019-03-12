<?php
/**
 * Created by PhpStorm.
 * UserInfo: rupak
 * Date: 12.03.2019
 * Time: 0:22
 */

namespace App\interfaces;

interface UserInfo
{
    public function getId();
    public function getName();
    public function getRole();
}