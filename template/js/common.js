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
        value: 'def',
        mode: 'popup',
        source: [
            {value: 'def', text: 'Выберите статус объекта'},
            {value: 'Активный', text: 'Активный'},
            {value: 'Сдан', text: 'Сдан'}
        ]
    });

    $('.people-mounth-editable').editable({
        value: 'def',
        mode: 'popup',
        source: [
            {value: 'def', text: '12'},
            {value: '01', text: '1'},
            {value: '02', text: '2'},
            {value: '03', text: '3'},
            {value: '04', text: '4'},
            {value: '05', text: '5'},
            {value: '06', text: '6'},
            {value: '07', text: '7'},
            {value: '08', text: '8'},
            {value: '09', text: '9'},
            {value: '10', text: '10'},
            {value: '11', text: '11'},
            {value: '12', text: '12'}
        ]
    });
    $('.people-year-editable').editable({
        value: 'def',
        mode: 'popup',
        source: [
            {value: 'def', text: '2018'},
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
            success: function (data1) {
                $('.results1').html(data1);
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
        placeholder: 'Выберите работника'
    })
    //Добавление и удаление в value=""
        .on('select2:select select2:unselect', function (evt) {
            $('#event').val($(this).val());
        })

});

    $(function(){
        $("#event-list").select2({
            placeholder: 'Выберите работника'
        })
        //Добавление и удаление в value=""
            .on('select2:select select2:unselect', function (evt) {
                $('#event').val($(this).val());
            })

    });

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

function proverka() {
    if (confirm("Подтвердите удаление объекта")) {
        return true;
    } else {
        return false;
    }
}

function proverka1() {
    if (confirm("Скопировать объект?")) {
        return true;
    } else {
        return false;
    }
}

function proverka2() {
    if (confirm("Удалить работника?")) {
        return true;
    } else {
        return false;
    }
}

function proverka5() {
    if (confirm("Скопировать время работы предыдущего работника?")) {
        return true;
    } else {
        return false;
    }
}

$('#country').change(function(){
    var val = $(this).val();
    $('#region').show();
    $('#region').html('');
    $.ajax({
        type: 'POST',
        url: '/components/filter.php',
        data: {'country': val},
        success: function(data) {
            var obj = JSON.parse(data);
            $.each(obj, function( index, value ) {
                $('#region').append($("<option></option>").attr("value",value).text(index));
            });
        }
    });
});



