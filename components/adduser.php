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

echo '<table id="user" class="table table-bordered  table-striped results">
                            <tbody><tr>';
$aDates = array();
$newDate = '01-' . $month . '-' . $year;
$oStart = new DateTime($newDate);
$oEnd = clone $oStart;
$oEnd->add(new DateInterval("P1M"));

while ($oStart->getTimestamp() < $oEnd->getTimestamp()) {
    $aDates[] = $oStart->format('d');
    $oStart->add(new DateInterval("P1D"));
}

foreach ($aDates as $day) {
    $time = 0;
    $workstart = $object->mounth;
    
    $uri = $_SERVER['REQUEST_URI'];
    
    $options = array(
        'day' => $day,
        'mounth' => $month,
        'nraboti' => $number,
        'nrabotnik' => $peopleId,
        'nprorab' => $_SESSION['id']
    );
    
    $timedata = $admin->GetWorkId($options);
    
    $dayWeek = $day . '-' . $month . '-2018';
    $dayWeek = strftime("%a", strtotime($dayWeek));
    
    echo '<td class = "' .$dayWeek. '"><p>' . $day . '</p>
                <a href="#" class="myeditable editable inline-input" id="name" data-type="text" data-pk="' . $timedata . '" data-url="components/ajax2.php" data-name="timework" data-original-title="Введите количество часов" >' . $admin->GetData($timedata) . '</a></td>
                
                ';
}
echo '</tr>';
echo '</tbody>
                        </table>';