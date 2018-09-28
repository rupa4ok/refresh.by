<?php

class IndexController
{
    
    public function action()
    {
        require_once(ROOT . '/views/index.php');
        if (isset($_SESSION['name'])) {
            if ($_SESSION['name'] == 'admin')
            {
                header('Location: /admin1',true, 301); //редирект в админку админа
            }
        }
        
        return true;
    }
    
    public function Auth()
    {
        if ($_POST) {
            $data1 = $_POST; //получаем данные из массива
    
            $errors1 = array();
    
            $user = R::findOne('users','email = ?',array($data1['email']));//Проверка правильности email
    
            if ( $user ) {
                $hash = substr( $user->password, 0, 60 );
                if (password_verify($data1['password'], $hash)) { //Проверка правильности пароля
                    //Логиним юзера
                    $_SESSION['logged_user'] = $user;
                    $_SESSION['name'] = $user->name;
                    return;
                } else {
                    echo "Пароль не верен";
                }
            }
            else {
                echo "Данный пользователь не найден";
            }
        }
    }
}