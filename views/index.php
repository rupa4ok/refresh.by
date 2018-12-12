<?php include "header.php"; ?>
    
    <body>
<header>
    <img src="template/img/logo.png"/>
</header>
<section class="main login">
    <div class="container">
        <div class="row login-row">
            <div class="col-md-4 col-md-offset-4 login-form">
                <div class="results1" style="color: red"></div>
                <form method="POST" id="form2">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Почта"
                               class="form-control" value="<?php echo @$data['email']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Пароль"
                               class="form-control" value="<?php echo @$data['password']; ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary col-md-12" type="submit"
                                name="do_login">Вход
                        </button>
                    </div>
                </form>
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