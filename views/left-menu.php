<div class="col-md-3">
    <h3>Меню</h3>
    <ul>
        <li><a href="/admin1">Объекты</a></li>
        <li><a href="/admin2">Прорабы</a></li>
        <li><a href="/admin3">Работники</a></li>
        <?php if ($this->role == 'admin') {
            echo '<li><a href="/admin4">Сводный табель</a></li>';
        } ?>
    </ul>
</div>