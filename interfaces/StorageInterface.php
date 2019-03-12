<?php

namespace Interfaces;

interface StorageInterface
{
    public function load();
    public function save(array $items);
}