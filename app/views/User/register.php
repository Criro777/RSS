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

            <div class="hidden" id="#msgSubmit"></div>
            <div class="signup-form"><!--sign up form-->
                <h2>Регистрация нового пользователя</h2>
                <br>

            </div><!--/sign up form-->

            <form id="account" action="/user/register"  method="post" data-toggle="validator">

                <div class="form-group has-feedback">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" type="text" id="username" name="username" placeholder="Имя" required>
                    </div>
                    <span class="glyphicon form-control-feedback "></span>
                </div>



                    <div class="form-group has-feedback">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input class="form-control" type="email" name="email"  placeholder="E-мэйл" required>
                    </div>
                    <span class="glyphicon form-control-feedback "></span>
                </div>



                <div class="form-group has-feedback">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                        <input class="form-control" type="password" name="password" placeholder="Пароль" required>
                    </div>
                    <span class="glyphicon form-control-feedback "></span>

                </div>

                <button type="submit" name="register" class="btn btn-success">Зарегестрироваться</button>
            </form>


            <br/>
            <div class="container" style="margin-top:40px;margin-bottom: 40px;"><a id="back" href="/article/list"><i
                        class="fa fa-arrow-left"></i> Назад</a></div>
        </div>
    </div>
</div>
