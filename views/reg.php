<?php include "header.php"; ?>
    
    <body>
<header>
    <img src="template/img/logo.png" />
</header>
<section class="main login">
    <div class="container">
        <div class="row">
            <div class="col-md-4 login-form">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Авторизация
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Регистрация</a>
                    </li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <div class="container">
                            <div class="row">
                                <div class="results1" style="color: red"></div>
                                <form method="POST" id="form1">
                                    <input type="email" name="email" placeholder="Почта" value="<? echo @$data['email']; ?>">
                                    <input type="password" name="password"  placeholder="Пароль" value="<? echo @$data['password']; ?>">
                                    <button type="submit" name="do_login">Вход</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                        <div class="container">
                            <div class="row">
                                <div class="results" style="color: red"></div>
                                
                                <form method="POST" id="form">
                                    <input type="text" name="login" placeholder="Ваше имя" value="<? $data = $_POST; echo @$data['login']; ?>" >
                                    <input type="email" name="email" placeholder="Почта" value="<? echo @$data['email']; ?>">
                                    <input type="password" name="password"  placeholder="Пароль" value="<? echo @$data['password']; ?>">
                                    <input type="password" name="password2"  placeholder="Введите пароль еще раз" value="<? echo @$data['password2']; ?>">
                                    <button type="submit" name="do_signup">Зарегистрироваться</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
        
        
        </div>
    </div>
</section>


<?php include "footer.php" ?>