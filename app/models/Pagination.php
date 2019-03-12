<?php
/**
 * Created by PhpStorm.
 * UserInfo: rupak
 * Date: 14.01.2019
 * Time: 4:56
 */

namespace App\Models;

class Pagination
{
    public $delta;
    public $month;
    public $year;
    
    public function __construct()
    {
        if (isset($_GET['month'])) {
            $this->month = $_GET['month'];
        } else {
            $this->month = $_SESSION['month'];
        }
        if (isset($_GET['month'])) {
            $this->year = $_GET['year'];
        } else {
            $this->year = $_SESSION['year'];
        }
    }
    
    public function getMonth()
    {
        return $this->month;
    }
    
    public function getYear()
    {
        return $this->year;
    }
    
    public function delta()
    {
            return abs($this->month - $_SESSION['month']);
    }
    
    public function getPrevPage()
    {
        if ($this->month == 01) {
            return 12;
        } else {
            $month = $this->month - 1;
            if ($month < 10) {
                return '0'.$month;
            } else {
                return $month;
            }
        }
    }
    
    public function getNextPage()
    {
        if ($this->month == 12) {
            return 01;
        } else {
            $month = $this->month + 1;
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
            return $this->year - 1;
        } else {
            return $this->year;
        }
    }
    
    public function getNextYear($nextPage)
    {
        if ($nextPage == 01) {
            return $this->year + 1;
        } else {
            return $this->year;
        }
    }
    
}