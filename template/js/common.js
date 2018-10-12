$(function(){
    $.fn.editable.defaults.mode = 'inline';

    $('.people-editable').editable();
    $('.people-phone-editable').editable({
        type: 'text',
        tpl: '   <input type="text" class="form-control people-phone">'

    }).on('shown', function () {
        $("input.people-phone-editable").mask("(999) 999-9999");
    });
    $('.people-status-editable').editable({
        value: 'Активный',
        mode: 'popup',
        source: [
            {value: 'Активный', text: 'Активный'},
            {value: 'Сдан', text: 'Сдан'}
        ]
    });

    $('.people-mounth-editable').editable({
        value: 'Месяц',
        mode: 'popup',
        source: [
            {value: '1', text: '1'},
            {value: '2', text: '2'},
            {value: '3', text: '3'},
            {value: '4', text: '4'},
            {value: '5', text: '5'},
            {value: '6', text: '6'},
            {value: '7', text: '7'},
            {value: '8', text: '8'},
            {value: '9', text: '9'},
            {value: '10', text: '10'},
            {value: '11', text: '11'},
            {value: '12', text: '12'}
        ]
    });
    $('.people-year-editable').editable({
        value: 'Год',
        mode: 'popup',
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
            {value: '2020', text: '2020'},
            {value: '2021', text: '2021'}
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
        validate: function (value) {
            if (isEmail(value)) {

            } else {
                return 'Введите настоящий e-mail';
            }
        }
    });
    $('#reset-btn').click(function () {
        $('.myeditable').editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');

        $('#save-btn').show();
        $('#msg').hide();
    });
    $('.people-address-editable').editable({
        value: {}
    });
    //init editables
    $('.myeditable1').editable({
        url: '/post',
        showbuttons: false,
        clear: false,
        escape: false
    });

    $('.myeditable').on('save.newuser', function(){
        var that = this;
        setTimeout(function() {
            $(that).closest('td').next().find('.myeditable').editable('show');
        }, 200);
    });

//make username required
    $('#new_username').editable('option', 'validate', function (v) {
        if (!v) return 'Required field!';
    });

//automatically show next editable
    $('.myeditable').on('save.newuser', function () {
        var that = this;
        setTimeout(function () {
            $(that).closest('tr').next().find('.myeditable').editable('show');
        }, 200);
    });
    $('#save-btn').click(function () {
        $('.myeditable').editable('submit', {
            url: 'components/newobject.php',
            ajaxOptions: {
                dataType: 'json' //assuming json response
            },
            success: function (data, config) {
                if (data && data.id) {  //record created, response like {"id": 2}
                    //set pk
                    $(this).editable('option', 'pk', data.id);
                    //remove unsaved class
                    $(this).removeClass('editable-unsaved');
                    //Сообщение об успешной регистрации
                    var msg = 'Объект успешно создан';
                    $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
                    $('#save-btn').hide();
                    $(this).off('save.newuser');
                } else if (data && data.errors) {
                    //server-side validation error, response like {"errors": {"username": "username already exist"} }
                    config.error.call(this, data.errors);
                }
            },
            error: function (errors) {
                var msg = '';
                if (errors && errors.responseText) { //ajax error, errors = xhr object
                    msg = errors.responseText;
                } else { //validation error (client-side or server-side)
                    $.each(errors, function (k, v) {
                        msg += k + ": " + v + "<br>";
                    });
                }
                $('#msg').removeClass('alert-success').addClass('alert-error').html(msg).show();
            }
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

    $('.js-example-basic-single').select2();

$(function(){
    $("#event-list").select2({
        placeholder: 'Выберите событие'
    })
    //Добавление и удаление в value=""
        .on('select2:select select2:unselect', function (evt) {
            $('#event').val($(this).val());
        })

});

function proverka() {
    if (confirm("Подтвердите удаление объекта")) {
        return true;
    } else {
        return false;
    }
}

//autofocus on worktime
    $('.myeditable').editable({
        showbuttons: false,
        clear: false,
        mode: 'inline'
    }).on('shown', function(ev, editable) {
        setTimeout(function() {
            editable.input.$input.select();
        },0);
    });

});


