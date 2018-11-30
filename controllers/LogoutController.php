<?php



class LogoutController {

    public function actionExit()
    {
        $_SESSION = array();

        header('Location: /',true, 301); //редирект на главную

        return true;
    }


}

