<?php
/**
 * Created by PhpStorm.
 * User: rupak
 * Date: 14.01.2019
 * Time: 4:56
 */

namespace Models;

class Pagination
{
    public $delta;
    
    public function __construct()
    {
    
    }
    
    public function delta()
    {
        return abs($_GET['month'] - $_SESSION['month']);
    }
    
    public function getPrevPage()
    {
        if ($_GET['month'] == 01) {
            return 12;
        } else {
            $month = $_GET['month'] - 1;
            if ($month < 10) {
                return '0'.$month;
            } else {
                return $month;
            }
        }
    }
    
    public function getNextPage()
    {
        if ($_GET['month'] == 12) {
            return 01;
        } else {
            $month = $_GET['month'] + 1;
            if ($month < 10) {
                return '0'.$month;
            } else {
                return $month;
            }
        }
    }
    
    public function getPrevYear($prevPage)
    {
        if ($prevPage == 12) {
            return $_GET['year'] - 1;
        } else {
            return $_GET['year'];
        }
    }
    
    public function getNextYear($nextPage)
    {
        if ($nextPage == 01) {
            return $_GET['year'] + 1;
        } else {
            return $_GET['year'];
        }
    }
    
}