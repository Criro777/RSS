<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <?php if (isset($_SESSION['success'])): ?>
                <div style="width:550px;text-align: center;" class="alert alert-success">Регистрация прошла успешно!
                    Войдите под своими данными!
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['errors'])): ?>
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="login-form"><!--login form-->
                <h2>Вход</h2>
                <form id="account" action="/user/login" method="post" data-toggle="validator">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="E-мэйл" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Пароль" required>
                    </div>

                    <button type="submit" name="login" class="btn btn-success">Войти</button>

                </form>
                <!--/sign up form-->
                <div class="signup-form"><!-sign up form->
                    <hr>
                    <form action="/user/register/" method="post">
                        <button class="btn btn-info" type="submit">Создать новую учетную запись</button>
                    </form>
                </div>
            </div>

            <div class="container" style="margin-top:40px;margin-bottom: 40px;"><a id="back" href="/article/list"><i
                        class="fa fa-arrow-left"></i> Назад</a></div>
        </div>
        </div>
    </div>
