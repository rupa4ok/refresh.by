<?php
    /**
     * Created by PhpStorm.
     * User: 12
     * Date: 23.09.2018
     * Time: 15:48
     */
    
    class Admin
    {
        public function GetTable($table)
        {
            $result = R::findAll($table);
            return $result;
        }
    }