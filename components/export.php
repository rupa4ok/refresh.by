<?php

ini_set('display_errors','Off');
session_start();

include_once"../config/config.php";
include_once"../models/Admin.php";

$admin = new Admin();

$filename = 'file.csv';
$table = 'people';
$options = array('fio','fioshort','nrabotnik');
$admin->ExportCsv($table,$options);
$admin->OpenCsv($filename);

