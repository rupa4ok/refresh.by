<?php

//Подключение к бд
require "../config.php";

$object = R::dispense('object');

$object->name = 'Тестовый объект';
$object->year = '2018';

$people = R::dispense('people');
$people->fio = 'Суворов Александр Петрович';

$object->sharedPeopleList[] = $people;

R::store($object);