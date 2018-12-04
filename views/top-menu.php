<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <ul>
                    <li><a href="/logout.php">Выйти</a></li>
<?php if ($_SESSION['role'] == 'admin') {
    echo '<li><a href="/admin7">Экспорт отчетов</a></li>';
} ?>
                    
                    <li>
                        <?php

                        if (isset($_SESSION['month'])) {
                            echo '<span class="results3">' . 'Отчетный месяц: ' . $_SESSION['month'] . ' - ' . $_SESSION['year']
                                . '<form method="post" class="refresh">
                        <input type="text" value="257" name="id" hidden="">
                        <button type="submit" onclick="return refresh();">Сбросить</button></form></span>';
                        } else {
                            echo '<li>

<span class="results3 inline">
<form method="post">
    <select id="month" name="month">
        <option selected disabled>Выберете месяц</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select>
    <select id="year" name="year">
        <option selected disabled>Выберете год</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2019">2020</option>
        <option value="2019">2021</option>
        <option value="2019">2022</option>
    </select>
    <button type="submit">Сохранить</button>
</form>
</span>
</li>';
                        }
                        ?>
                    </li>
                </ul>
            
            </div>
        </div>
    </div>
</section>