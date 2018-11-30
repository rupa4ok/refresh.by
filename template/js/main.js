$(document).ready(function() {

    $('#form1').submit(function () {
        if (!$("input").is(".error")) {
            var form = $(this);
            var data1 = form.serialize();
            $.ajax({
                type: 'POST',
                url: 'components/login.php',
                data: data1,
                success: function (data1) {
                    $('.results1').html(data1);
                },
            });
            return false;
        } else {
            alert('error');
            return false;
        }
    });

    $('#form').submit(function () {
        if (!$("input").is(".error")) {
            var form = $(this);
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: 'components/reg.php',
                data: data,
                success: function (data) {
                    $('.results').html(data);
                },
            });
            return false;
        } else {
            alert('error');
            return false;
        }
    });

    $('#form3').submit(function () {

        var form = $(this);
        var data = form.serialize();
        $.ajax({
            type: 'POST',
            url: 'components/addusers.php',
            data: data,
            success: function (data) {
                $('.results').html(data);
            },
        });
        return false;
    });

    $('#form4').submit(function () {

        var form = $(this);
        var data = form.serialize();
        $.ajax({
            type: 'POST',
            url: 'components/filter.php',
            data: data,
            success: function (data1) {
                $('.results1').html(data1);
            },
        });
        return false;
    });

    $('#form10').submit(function () {

        var form = $(this);
        var data = form.serialize();
        $.ajax({
            type: 'POST',
            url: 'components/addperiod.php',
            data: data,
            success: function (data1) {
                $('.results3').html(data1);
            },
        });
        return false;
    });

    $('.delete').submit(function () {
        if (!$("input").is(".error")) {
            var form = $(this);
            var data1 = form.serialize();
            $.ajax({
                type: 'POST',
                url: 'components/delete.php',
                data: data1,
                success: function (data1) {
                    $('.results1').html(data1);
                },
            });
            return false;
        } else {
            alert('error');
            return false;
        }
    });

    $('.refresh').submit(function () {
        if (!$("input").is(".error")) {
            var form = $(this);
            var data1 = form.serialize();
            $.ajax({
                type: 'POST',
                url: 'components/refresh.php',
                data: data1,
                success: function (data1) {
                    $('.results3').html(data1);
                },
            });
            return false;
        } else {
            alert('error');
            return false;
        }
    });

});



