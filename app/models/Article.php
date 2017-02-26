<?php


namespace app\models;


use vendor\core\Db;


class Article
{
    protected $title = '';
    protected $description = '';
    protected $image_url = '';
    protected $link = '';
    protected $pub_date = '';
    protected $db;

    /**
     * Article constructor.
     * @param string $title
     * @param string $description
     * @param string $image_url
     * @param string $link
     * @param string $pub_date
     */

    public function __construct($title = '', $description = '', $image_url = '', $link = '', $pub_date = '')
    {
        $this->db = Db::instance();
        $this->title = $title;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->link = $link;
        $this->pub_date = $pub_date;
    }

    /**
     * Сохранение контента в базу данных
     */
    public function save()
    {


        $sql = "INSERT INTO articles (title,description, image_url,link,PubDate,UploadDate) 
                          VALUES (:title, :description, :image_url, :link, :pub_date, NOW())";

        $this->db->execute($sql, [':title' => $this->title,
            ':description' => $this->description,
            'image_url' => $this->image_url,
            'link' => $this->link,
            'pub_date' => $this->pub_date]);


    }

    /**
     * Обновление контента в базе данных
     * @param $id <p>Идентификатор записи</p>
     */

    public function update($id)
    {
        $sql = "UPDATE articles SET title = :title, description = :description WHERE id = '$id'";
        $this->db->execute($sql, [':title' => $this->title, ':description' => $this->description]);

    }

    /**
     * Удаление контента из базе данных
     * @param $id <p>Идентификатор записи</p>
     */

    public function delete($id)
    {

        $count_comments = Comment::getCountComments($id);

        if ($count_comments != 0) {

            $sql = "DELETE articles, comments FROM articles  LEFT JOIN comments ON articles.id = comments.article_id WHERE articles.id = '$id'  ";

        } else {

            $sql = "DELETE FROM  articles WHERE id = '$id'";
        }

        $this->db->execute($sql);

    }

    /**
     * Извлечение контента из базы данных
     * @return array <p>Массив объектов из базы данных</p>
     * @throws \Exception <p>Объект исключения</p>
     */
    public static function findAll()
    {
        $pdo = Db::instance();

        $sql = 'SELECT * FROM  articles ORDER BY PubDate DESC LIMIT 15';
        $result = $pdo->query($sql);

        return $result;

    }

    /**
     * Поиск контента в базе данных по заданному полю и параметру
     * @param $field <p> Поле в теаблиц базы данных</p>
     * @param $param <p>Параметр поиска</p>
     * @return array <p>Массив объектов из базы данных</p>
     * @throws \Exception <p>Объект исключения</p>
     */
    public function findUnique($field, $param)
    {

        $sql = "SELECT * FROM articles WHERE $field = ? ";
        return $this->db->query($sql, [$param]);
    }

    public static function findOne($field, $param)
    {


        //Проверяем наличие комментариев к выбранной статье
        $count_comments = Comment::getCountComments($param);


        if ($count_comments != 0) {

            //Если комментарии присутствуют, используем сложный запрос для выборки из 2-х таблиц
            $sql = "SELECT * FROM articles JOIN comments ON  articles.{$field} = comments.article_id WHERE articles.{$field} = ?";

        } else {

            //Если комментариев нет, производим выборку из одной таблицы по заданному параметру
            $sql = "SELECT * FROM  articles WHERE $field = ?";
        }


        $result = Db::instance()->query($sql, [$param]);

        if ($result) {

        return $result;

        } else {

            throw new \Exception;
        }

    }

}