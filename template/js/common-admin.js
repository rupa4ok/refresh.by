$.fn.editable.defaults.mode = 'popup';
$(document).ready(function () {
    $('.people-editable').editable();
    $('.people-phone-editable').editable({
        type: 'text',
        tpl: '   <input type="text" class="form-control people-phone">'

    }).on('shown', function () {
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
    $('.myeditable').editable({
        url: '/post' //this url will not be used for creating new user, it is only for update
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
            url: 'controller/newuser.php',
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

});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
