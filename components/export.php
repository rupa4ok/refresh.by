<?php

use Models\Admin;
use Models\Csv;

ini_set('display_errors','Off');
session_start();

include_once"../config/config.php";
include_once"../models/Admin.php";

$admin = new Admin();
$csv = new Csv();

$filename = 'file.csv';
$table = 'people';
$options = array('fio','fioshort','nrabotnik');
$csv->ExportCsv($table,$options);
$csv->OpenCsv($filename);

