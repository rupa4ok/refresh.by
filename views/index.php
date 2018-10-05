<?php include "header.php"; ?>

    //@TODO: Дописать комментарии, потом хрен что вспомнишь

<body>
    <header>
        <img src="template/img/logo.png" />
    </header>
    <section class="main login">
        <div class="container">
            <div class="row login-row">
                <div class="col-md-4 col-md-offset-4 login-form">
                                    <?php
                                    $index = new IndexController();
                                    $index->Auth(); ?>
                                    <div class="results1" style="color: red"></div>
                                    <form method="POST" id="form2">
                                        <input type="email" name="email" placeholder="Почта" value="<? echo @$data['email']; ?>">
                                        <input type="password" name="password"  placeholder="Пароль" value="<? echo @$data['password']; ?>">
                                        <button type="submit" name="do_login">Вход</button>
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