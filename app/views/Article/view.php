<section>
    <br/>
    <br/>

    <div class="panel panel-default">

        <div class="panel-heading"><h3>Просмотр статьи</h3></div>
        <div class="panel-body">

            <h4>Заголовок:</h4>
            <hr>
            <p style="font-size: 12pt;"><?php echo $articles[0]->title; ?></p>
            <br>
            <h4>Изображение:</h4>
            <hr>
            <img style="width:950px; height: 600px;" src="<?php echo $articles[0]->image_url; ?>"/>
            <br><br>
            <h4>Описание:</h4>
            <hr>
            <p style="font-size: medium;"><?php echo $articles[0]->description; ?></p>
            <br>
            <h4>Оригинал статьи:</h4>
            <hr>
            <a href="<?php echo $articles[0]->link; ?>"><?php echo $articles[0]->link; ?></a>
            <hr>
            <br>

            <h4>Комментарии: <?php echo \app\models\Comment::getCountComments($articles[0]->article_id); ?></h4>
            <br>


            <?php if (isset($_SESSION['user'])) : ?>
                <form class="contact-form"
                      action="/article/add-comment/<?php echo $id = (\app\models\Comment::getCountComments($articles[0]->article_id)) ? $articles[0]->article_id : $articles[0]->id ?>"
                      method="post">

                    <div class="form-group">
                        <textarea placeholder="Ваш комментарий" name="text" rows="8" style="width:500px;"
                                  class="form-control"></textarea>
                    </div>


                    <button style="margin-top: 15px;" type="submit" class="btn btn-success" name="Submit">Комментировать
                    </button>
                </form>
            <?php else: ?>

                <p style="text-align: center;font-size: 12pt;"><i>Комментари могут оставлять только зарегестрированные
                        пользователи</i></p>
                <p style="text-align: center; font-size: 14pt;"><a href="/user/register">Зарегестрироваться</a></p>
            <?php endif; ?>
            <hr>
            <?php if (\app\models\Comment::getCountComments($articles[0]->article_id)): ?></h4>
            <div class="comments">
                <?php foreach ($articles as $article): ?>
                    <div style="width:500px;" class="alert alert-info">
                        <h4><?php echo $article->username; ?></h4>

                        <p style="color: #0f0f0f;"><?php echo $article->text; ?></div></p>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <br>
            <div class="container" style="margin-bottom: 40px;"><a href="/article/list" class="btn btn-default back"><i
                        class="fa fa-arrow-left"></i>
                    Назад</a></div>

        </div>
    </div>

</section>