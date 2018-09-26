<?

//Подключение к бд
require "../config.php";

$data = $_POST; //получаем данные из массива

echo '<pre>';
print_r($data);

$user = R::dispense('people');

$user->id = $data['id'];
$user->fio = $data['fio'];

R::store($user);

