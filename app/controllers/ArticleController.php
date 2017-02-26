<?php


namespace app\controllers;

use app\models\Article;
use app\models\Comment;
use vendor\core\engine\Controller;

class ArticleController extends Controller
{
    
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * Загрузка данных с сервера
     */

    public function actionLoad()
    {
        //Загружаем данные из источника в формате XML
        $xml = 'https://www.nasa.gov/rss/dyn/lg_image_of_the_day.rss';

        //Преобразуем XML файл в коллекцию объектов
        $rss = simplexml_load_file($xml);


        //Проходимся циклом по коллекции объектов и извлекаем данные
        foreach ($rss->channel->item as $item) {

            $title = $item->title;
            $link = $item->link;
            $description = $item->description;
            $image_url = $item->enclosure->attributes()->url;
            $pub_date = date('Y-m-d G:i:s', strtotime($item->pubDate));

            $article = new Article($title, $description, $image_url, $link, $pub_date);

            //Проверяем наличие записи в базе данных
            $result = $article->findUnique('title', $title);

            if (!$result) {

                //если совпадений нет, производим запись
                $article->save();

                //$loaded = true;

            }

        }
        echo 'success';
    }

    /**
     * Добавление комментария
     * @param $article_id <p>Идентификатор статьи</p>
     */
    public function actionAddComment($article_id)
    {

        $username = $_SESSION['user'];
        $text = $_POST['text'];

        //var_dump($article_id);

        $comment = new Comment($username, $text, $article_id);

        $comment->saveComment();

        header("Location:/article/view/$article_id");
    }

}