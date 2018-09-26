
    <body>
    
    <script>
        $.fn.editable.defaults.mode = 'popup';
        $(document).ready(function() {
            $('.people-editable').editable();
            $('.people-phone-editable').editable({
                type: 'text',
                tpl:'   <input type="text" class="form-control people-phone">'

            }).on('shown',function(){
                $("input.people-phone-editable").mask("(999) 999-9999");
            });
            $('.people-status-editable').editable({
                value: '',
                source: [
                    {value: 'Активный', text: 'Активный'},
                    {value: 'Сдан', text: 'Сдан'}
                ]
            });
            $('.people-mounth-editable').editable({
                value: 'Месяц',
                source: [
                    {value: 'Январь', text: 'Январь'},
                    {value: 'Февраль', text: 'Февраль'},
                    {value: 'Март', text: 'Март'},
                    {value: 'Апрель', text: 'Апрель'},
                    {value: 'Май', text: 'Май'},
                    {value: 'Июнь', text: 'Июнь'},
                    {value: 'Июль', text: 'Июль'},
                    {value: 'Август', text: 'Август'},
                    {value: 'Сентябрь', text: 'Сентябрь'},
                    {value: 'Октябрь', text: 'Октябрь'},
                    {value: 'Ноябрь', text: 'Ноябрь'},
                    {value: 'Декабрь', text: 'Декабрь'}
                ]
            });
            $('.people-year-editable').editable({
                value: 'Год',
                source: [

                    {value: '2017', text: '2017'},
                    {value: '2018', text: '2018'},
                    {value: '2019', text: '2019'},
                    {value: '2020', text: '2020'}

                ]
            });
            $('.people-start-editable').editable({
                format: 'dd.mm.yyyy',
                defaultDate: '01/26/2018',
                viewformat: 'dd.mm.yyyy',
                datepicker: {
                    weekStart: 1,
                    autoclose: true
                }

            });

            $('#country').editable({
                format: 'dd.mm.yyyy',
                defaultDate: '01/26/2018',
                viewformat: 'dd.mm.yyyy',
                source: [
                    {value: '2017', text: '2017'},
                    {value: '2018', text: '2018'},
                    {value: '2019', text: '2019'},
                    {value: '2020', text: '2020'}
                ]
            });

            $('#users').editable({
                source: [
                    {value: 'Сергееня Александр Петрович', text: 'Сергееня Александр Петрович'},
                    {value: 'Афанасьев Денис Викторович', text: 'Афанасьев Денис Викторович'},
                    {value: 'Гавриленя Вадим Петрович', text: 'Гавриленя Вадим Петрович'},
                    {value: 'Давыдов Данила Петрович', text: 'Давыдов Данила Петрович'}
                ]
            });

            $('.people-finish-editable').editable({
                format: 'dd.mm.yyyy',
                defaultDate: '01/26/2018',
                viewformat: 'dd.mm.yyyy',
                datepicker: {
                    weekStart: 1,
                    autoclose: true
                }

            });
            $('.people-email-editable').editable({
                validate: function(value) {
                    if(isEmail(value)) {

                    } else {
                        return 'Введите настоящий e-mail';
                    }
                }
            });
            $('#reset-btn').click(function() {
                $('.myeditable').editable('setValue', null)
                    .editable('option', 'pk', null)
                    .removeClass('editable-unsaved');

                $('#save-btn').show();
                $('#msg').hide();
            });
            $('.people-address-editable').editable({
                value: {
                }
            });
            //init editables
            $('.myeditable').editable({
                url: '/post' //this url will not be used for creating new user, it is only for update
            });

//make username required
            $('#new_username').editable('option', 'validate', function(v) {
                if(!v) return 'Required field!';
            });

//automatically show next editable
            $('.myeditable').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    $(that).closest('tr').next().find('.myeditable').editable('show');
                }, 200);
            });
            $('#save-btn').click(function() {
                $('.myeditable').editable('submit', {
                    url: 'controller/newuser.php',
                    ajaxOptions: {
                        dataType: 'json' //assuming json response
                    },
                    success: function(data, config) {
                        if(data && data.id) {  //record created, response like {"id": 2}
                            //set pk
                            $(this).editable('option', 'pk', data.id);
                            //remove unsaved class
                            $(this).removeClass('editable-unsaved');
                            //Сообщение об успешной регистрации
                            var msg = 'Объект успешно создан';
                            $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
                            $('#save-btn').hide();
                            $(this).off('save.newuser');
                        } else if(data && data.errors){
                            //server-side validation error, response like {"errors": {"username": "username already exist"} }
                            config.error.call(this, data.errors);
                        }
                    },
                    error: function(errors) {
                        var msg = '';
                        if(errors && errors.responseText) { //ajax error, errors = xhr object
                            msg = errors.responseText;
                        } else { //validation error (client-side or server-side)
                            $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
                        }
                        $('#msg').removeClass('alert-success').addClass('alert-error').html(msg).show();
                    }
                });
            });

        });

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        $('#username').editable({
            type: 'select2',
            url: '/post',
            pk: 1,
            onblur: 'submit',
            emptytext: 'None',
            select2: {
                placeholder: 'Select a Requester',
                allowClear: true,
                width: '230px',
                minimumInputLength: 3,
                id: function (e) {
                    return e.EmployeeId;
                },
                ajax: {
                    url: '/EmployeeSearch',
                    dataType: 'json',
                    data: function (term, page) {
                        return { query: term };
                    },
                    results: function (data, page) {
                        return { results: data };
                    }
                },
                formatResult: function (employee) {
                    return employee.EmployeeName;
                },
                formatSelection: function (employee) {
                    return employee.EmployeeName;
                },
                initSelection: function (element, callback) {
                    return $.get('/EmployeeLookupById', { query: element.val() }, function (data) {
                        callback(data);
                    }, 'json'); //added dataType
                }
            }
            /* suucess not needed
             ,
                   success: function(response) {
                        $('#RequestUser').text(response.newVal);
                    }
                    */
        });


        $.mockjax({
            url: '/EmployeeLookupById',
            responseTime: 100,
            responseText: {
                EmployeeId: 1,
                EmployeeName: 'found by ID'
            }
        });

        $.mockjax({
            url: '/EmployeeSearch',
            responseTime: 400,
            response: function(settings) {
                var res = [];
                for(var i=1; i<5;i++) {
                    res.push({
                        EmployeeId: i,
                        EmployeeName: settings.data.query+'_'+i
                    });
                }
                this.responseText = res;
            }
        });

        //ajax emulation. Type "err" to see error message
        $.mockjax({
            url: '/post',
            responseTime: 400,
            response: function(settings) {
                if(settings.data.value == 'err') {
                    this.status = 500;
                    this.responseText = 'Validation error!';
                } else {
                    this.responseText = '';
                }
            }
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $(function(){
            $("#event-list").select2({
                placeholder: 'Выберите событие'
            })
            //Добавление и удаление в value=""
                .on('select2:select select2:unselect', function (evt) {
                    $('#event').val($(this).val());
                })

        });
    
    </script>
    
    <header>
        <img src="/template/img/logo.png" />
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
        <h1>Личный кабинет</h1>
    </div>
    <div class="row">
    <div class="col-md-3">
        <h3>Меню</h3>
        <ul>
            <li><a href="/admin1.php">Объекты</a></li>
            <li><a href="">Табель</a></li>
            <li><a href="">Прорабы</a></li>
            <li><a href="">Работники</a></li>
        </ul>
    </div>
    <div class="col-md-9 content-block">
        <h4>Объекты</h4>
        
        <?php
        
        $id = $_POST['id'];
        
        if ($result = R::loadAll('object', array($id))) {
            
            foreach ($result as $res) {
                echo '<h1>' . $res->name . '</h1>';
            }
            
            echo '<table class="table">' .
                '<thead>' .
                '<tr>' .
                '<th>Название объекта</th>' .
                '<th>Месяц</th>' .
                '<th>Год</th>' .
                '<th>Дата начала</th>' .
                '<th>Дата сдачи</th>' .
                '<th>Статус</th>' .
                '</tr>' .
                '</thead>';
            
            foreach ($result as $res) {
                echo '<tr>' .
                    '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->name . '</a></td>' .
                    '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->mounth . '</a></td>' .
                    '<td><a href="#" class="people-year-editable" data-name="year" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->year . '</a></td>' .
                    '<td><a href="#" class="people-start-editable" data-name="start" data-type="date" data-pk="' . $res->id . '" data-url="ajax1.php" >' . date('d.m.Y', $res->start) . '</a></td>' .
                    '<td><a href="#" class="people-finish-editable" data-name="finish" data-type="date" data-pk="' . $res->id . '" data-url="ajax1.php" >' . date('d.m.Y', $res->finish) . '</a></td>' .
                    '<td><a href="#" class="people-status-editable" data-name="status" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->status . '</a></td>' .
                    '<td><a href="#" class="people-delete-editable" data-name="delete" id="delete' . $res->id . '" data-type="select" data-pk="' . $res->id . '" >Удалить</a></td>' .
                    '<td><form action="admin3.php" method="POST"><input type="text" name="' . $res->id . '" value="' . $res->id . '" hidden> <button>Редактировать</button></form></td>' .
                    '<td><form action="admin3.php" method="POST"><input type="text" name="' . $res->id . '" value="' . $res->id . '" hidden> <button>Копировать</button></form></td>' .
                    '</tr>';
            }
            
            echo '</table>';
        }
        
        $list = R::findAll('people', 'id > ?', [0]);
        
        echo '
        <form method="POST" id="form3" class="dataspan">
        <select class="js-example-basic-single" id="event-list">';
        foreach ($list as $lis) {
            echo '<option>'.$lis->fio.'</option>';
        }
        echo '</select>

        <input name="tagger-1" id="event" value="" hidden>
        <input name="tagger-2" id="event1" value="'. $id .'" hidden>
        
        <button type="submit">Добавить работника</button>
        </form>

        ';
        
        $object = R::load('object', $id);
        
        $object->sharedPeopleList;
        $peoples = $object->with('ORDER BY `fio` DESC')->sharedPeopleList;
        
        $date1 = date('Y-m-d', $object->start);
        $date2 = date('Y-m-d', $object->finish);
        $date3 = date('d-m-Y', $object->start);
        $date4 = date('d-m-Y', $object->finish);
        $day = (strtotime($date2) - strtotime($date1))/3600/24;
        
        echo 'Срок реализации проекта: ' . $day . ' дней';
        
        foreach ($peoples as $people) {
            echo '<br> <h4>' . $people->fio .'</h4>' . '<a href="#" class="people-status-editable" data-name="koef" data-type="text" data-pk="' . $people->id . '" data-url="ajax1.php" >' . $people->koef . '</a>';
            $i = 0;
            $date3 = date('d-m-Y', $object->start);
            echo '<table id="user" class="table table-bordered table-striped">
                            <tbody><tr>';
            while ($i < 10) {
                $i++;
                
                echo '<td><p>' . $date3 . '</p>
                <a href="#" class="myeditable editable editable-click" id="new_username" data-type="text" data-name="name" data-original-title="Введите название объекта">Пусто</a></td>
                
                ';
            }
            echo '</tr>';
            echo '</tbody>
                        </table>';
        }
        
        $time = R::dispense('time');
        
        $time->date = $date3;
        
        R::store($time);
        
        ?>
    </div>
