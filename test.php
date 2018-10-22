<html>
<head></head>
<body>
    <select id="country" name="country">
    <option selected disabled>Выберете Страну</option>
    <option value="0">Україна</option>
    <option value="1">Беларусь</option>
    </select>
    <select id="region" name="region" style="display: none;">
    </select>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script type="text/javascript">
    $('#country').change(function(){
        var val = $(this).val();
        $('#region').show();
        $('#region').html('');
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {'country': val},
            success: function(data) {
            var obj = JSON.parse(data);
            $.each(obj, function( index, value ) {
                $('#region').append($("<option></option>").attr("value",value).text(index));
            });
        }
            });
        });
    </script>
</body>
</html>