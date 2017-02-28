<?php


namespace app\models;


use vendor\core\Db;


class Article
{
    protected $alias;
    protected $title;
    protected $description;
    protected $image_url;
    protected $link;
    protected $pub_date;
    protected $db;

    /**
     * Article constructor.
     * @param string $title
     * @param string $description
     * @param string $image_url
     * @param string $link
     * @param string $pub_date
     */

    public function __construct($alias = '', $title = '', $description = '', $image_url = '', $link = '', $pub_date = '')
    {
        $this->db = Db::instance();
        $this->alias = $alias;
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


        $sql = "INSERT INTO articles (alias, title,description, image_url,link,PubDate,UploadDate) 
                          VALUES (:alias, :title, :description, :image_url, :link, :pub_date, NOW())";

        $this->db->execute($sql, [':alias' => $this->alias,
                                  ':title' => $this->title,
                                  ':description' => $this->description,
                                  'image_url' => $this->image_url,
                                  'link' => $this->link,
                                  'pub_date' => $this->pub_date]);

    }

    /**
     * Обновление контента в базе данных
     * @param $id <p>Идентификатор записи</p>
     */

    public function update($alias)
    {
        $sql = "UPDATE articles SET title = :title, description = :description WHERE alias = '$alias'";
        $this->db->execute($sql, [':title' => $this->title, ':description' => $this->description]);

    }

    /**
     * Удаление контента из базе данных
     * @param $id <p>Идентификатор записи</p>
     */

    public function delete($alias)
    {

        $count_comments = Comment::getCountComments($alias);

        if ($count_comments != 0) {

            $sql = "DELETE articles, comments FROM articles  LEFT JOIN comments ON articles.alias = comments.article_alias WHERE articles.alias = '$alias'  ";

        } else {

            $sql = "DELETE FROM  articles WHERE alias = '$alias'";
        }

        $this->db->execute($sql);

    }

    /**
     * Извлечение контента из базы данных
     * @return array <p>Массив объектов из базы данных</p>
     * @throws \Exception <p>Объект исключения</p>
     */
    public static function findAll($start_pos)
    {
        
        $pdo = Db::instance();

        $sql = "SELECT * FROM  articles ORDER BY PubDate DESC LIMIT 5 OFFSET {$start_pos} ";
        $result = $pdo->query($sql);

        return $result;

    }

    public static function getCountItems()
    {

        $pdo = Db::instance();

        $sql = 'SELECT COUNT(id) AS count FROM  articles';
        $result = $pdo->query($sql);

        return $result[0]->count;

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
            $sql = "SELECT * FROM articles JOIN comments ON  articles.{$field} = comments.article_alias WHERE articles.{$field} = ?";

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