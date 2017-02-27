<div class="container">
    <div class="row">
        <div class="col-sm-6">

            <?php if (isset($_SESSION['errors'])): ?>
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <?php echo '<div style="text-align: center" class="alert alert-danger">'; ?>
                    <?php echo $error; ?>

                    <?php echo ' </div>'; ?>
                <?php endforeach; ?>

            <?php endif; ?>

            <div class="signup-form"><!--sign up form-->
                <h2>Регистрация нового пользователя</h2>
                <br>

            </div><!--/sign up form-->

            <form class="account" action="/user/register" method="post">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Имя"/>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="E-мэйл"/>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Пароль"/>
                </div>

                <button type="submit" name="register" class="btn btn-success">Зарегестрироваться</button>
            </form>

            <br/>
            <div class="container" style="margin-top:40px;margin-bottom: 40px;"><a id="back" href="/article/list"><i
                        class="fa fa-arrow-left"></i> Назад</a></div>
        </div>
    </div>
</div>
