<?php


namespace app\controllers;

use app\models\Article;
use app\models\Comment;
use vendor\components\Translit;
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
            $alias = Translit::str2url($title);
            $link = $item->link;
            $description = $item->description;
            $image_url = $item->enclosure->attributes()->url;
            $pub_date = date('Y-m-d G:i:s', strtotime($item->pubDate));

            $article = new Article($alias, $title, $description, $image_url, $link, $pub_date);

            //Проверяем наличие записи в базе данных
            $result = $article->findUnique('title', $title);

            if (!$result) {

                //если совпадений нет, производим запись
                $article->save();

            }

        }
        echo 'success';
    }

    /**
     * Добавление комментария
     * @param $article_id <p>Идентификатор статьи</p>
     */
    public function actionAddComment($article_alias)
    {

        $username = $_SESSION['user'];
        $text = $_POST['text'];

        //var_dump($article_id);

        $comment = new Comment($username, $text, $article_alias);

        $comment->saveComment();

        header("Location:/article/view/$article_alias");
    }

    /**
     * Отображение списка статей
     */
    public function actionList($page)
    {

        if (!isset($page) or $page == 0) {
            
            $page = 1;
        }

        //Количество товаров на странице
        $page_items = 5;

        //общее количество статей
        $total_items = Article::getCountItems();

        //необходимое количество страниц
        $count_pages = ceil($total_items / $page_items);

        if ($count_pages == 0) {

            $count_pages = 1;
        }
        
        if ($page > $count_pages) {

            $page = $count_pages;
        }

        $start_pos = ($page - 1) * $page_items;


        $articles = Article::findAll($start_pos);

        $p = new \Pagination($total_items, $page, $page_items);
        $pagination = $p->get();

        //$pagination = Article::pagination($page, $count_pages);

        $this->render('list', ['articles' => $articles, 'pagination' => $pagination]);
    }

    /**
     * Отображение статьи с заданным алиасом
     * @param $alias
     */

    public function actionView($alias)
    {


        $articles = Article::findOne('alias', $alias);

        $this->render('view', ['articles' => $articles]);

    }

    /**
     * Обновление статьи с заданным алиасом
     * @param $alias
     */
    public function actionUpdate($alias)
    {


        try {


            $articles = Article::findOne('alias', $alias);

            if (isset($_POST['update'])) {

                $title = $_POST['title'];
                $description = $_POST['description'];

                $update_article = new Article('',$title, $description);

                $update_article->update($alias);

                header("Location:/article/list");

            }

            $this->render('update', ['articles' => $articles]);
            
        } catch (\Exception $e) {

            header("Location:/public/404.html");

        }
    }

    /**
     * Удаление статьи с заданным алиасом
     * @param $alias
     */
    public function actionDelete($alias)
    {

        $article = new Article();

        $article->delete($alias);

        header("Location:/article/list");
    }

}