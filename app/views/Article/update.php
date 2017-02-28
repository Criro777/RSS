<div class="panel panel-default">

    <div class="panel-heading"><h3>Редактирование статьи</h3></div>
    <div class="panel-body">


        <form action="/article/update/<?php echo $articles[0]->alias ?>" method="post">

            <fieldset>
                <label for='title'><h4>Title:</h4></label>
                <hr>
                <input style="width:500px;" type="text" name="title" class="form-control"
                       value="<?php echo $articles[0]->title; ?>">
                <br><br>

                <label for='description'><h4>Description:</h4></label>
                <hr>
                <textarea style="width:500px;" rows='10' name='description'
                          class="form-control"><?php echo $articles[0]->description; ?></textarea><br><br>
                <input type='submit' name='update' value='Сохранить изменения'>
            </fieldset>

        </form>

        <hr>

        <br>
        <div class="container" style="margin-bottom: 40px;"><a href="/article/list" class="btn btn-default back"><i
                    class="fa fa-arrow-left"></i>Назад</a></div>

    </div>
</div>
