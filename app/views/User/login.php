<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <?php if (isset($_SESSION['success'])): ?>
                <div style="width:550px;text-align: center;" class="alert alert-success">Регистрация прошла успешно!
                    Войдите под своим именем!
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
                <form class="account" action="/user/login" method="post">
                    <div class="form-group">
                        <input type="email" name="email" required placeholder="E-мэйл"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required placeholder="Пароль"/>
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

        </div>
    </div>
