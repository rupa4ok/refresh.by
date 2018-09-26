    <header>
    <img src="/template/img/logo.png"/>
</header>

<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <ul>
                    <li><a href="/logout.php">Выйти</a></li>
                    <li><a href="/view/personal.php">Личный кабинет</a></li>
                    <li><a href="">Информация о пользователе</a></li>
                    <li><a href="">Экспорт отчета</a></li>
                </ul>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <h1>Объекты</h1>
        </div>
        <div class="row">
            <div class="col-md-3">
                <h3>Меню</h3>
                <ul>
                    <li><a href="/admin1">Объекты</a></li>
                    <li><a href="/admin2">Прорабы</a></li>
                    <li><a href="/admin3">Работники</a></li>
                    <li><a href="/admin4">Сводный табель</a></li>
                    <li><a href="/admin5">Управление объектами</a></li>
                </ul>
            </div>
            <div class="col-md-9 content-block">
                
                <?php
                
                echo '<div style="width: 50%">
                        <div id="msg" class="alert hide"></div>
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td width="40%">Название объекта</td>
                                <td><a href="#" class="myeditable editable editable-click editable-empty" id="new_username" data-type="text" data-name="name" data-original-title="Введите название объекта">Пусто</a></td>
                            </tr>
                            <tr>
                                <td>Отчетный год</td>

                                <td><a href="#" class="myeditable editable editable-click editable-empty people-year-editable" data-type="select" data-name="year" data-original-title="Выберите отчетный год">Пусто</a></td>
                            </tr>
                            <tr>
                                <td>Отчетный месяц</td>
                                <td><a href="#" class="myeditable editable editable-click editable-empty people-mounth-editable" data-type="select" data-name="mounth" data-original-title="Выберите отчетный месяц">Пусто</a></td>
                            </tr>
                            <tr>
                                <td>Статус</td>
                                <td><a href="#" class="myeditable editable editable-click editable-empty people-status-editable" data-type="select" data-name="status" data-original-title="Выберите статус объекта">Пусто</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <button id="save-btn" class="btn btn-primary">Добавить новый объект</button>
                            <button id="reset-btn" class="btn pull-right">Сбросить данные</button>
                        </div>
                    </div>';
    
                    $admin->GetObjectList()
                
                ?>
            </div>
        </div>
    </div>
    </div>
</section>