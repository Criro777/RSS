
<table class="table-bordered table-striped table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Publication Date</th>
            <th>Upload date</th>
            <th>Comments</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?php echo $article->id; ?></td>
                <td><a id= "list"href="/article/view/<?php echo $article->id; ?>"><?php echo $article->title; ?></a></td>
                <td><a  href="<?php echo $article->link; ?>"><?php echo $article->PubDate; ?></a></td>
                <td><?php echo $article->UploadDate; ?></td>
                <td><?php echo \app\models\Comment::getCountComments($article->id);?></td>
                <td><a href="/article/update/<?php echo $article->id; ?>" title="Редактировать"><i
                            class="fa fa-pencil-square-o"></i></a></td>
                <td><a href="#" data-toggle="modal" data-target="#<?php echo $article->id; ?>"><i
                            class="fa fa-trash-o"></i></a>
                    <div class="modal fade" id="<?php echo $article->id; ?>" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h3>Вы действительно хотите удалить эту новость ?</h3>
                                </div>
                                <div class="modal-footer">
                                    <a href="/article/delete/<?php echo $article->id; ?>"
                                       class="btn btn-default  btn-success">Удалить</a>
                                    <a class="btn btn-default btn-danger" data-dismiss="modal">Отмена</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<div class="container" style="margin-top:40px;margin-bottom: 40px;"><a id ="back" href="/" ><i
            class="fa fa-arrow-left"></i>
        На Главную</a></div>
