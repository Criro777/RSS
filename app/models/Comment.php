<?php

namespace app\models;

use vendor\core\Db;


class Comment
{
    
    protected $db;
    protected $username;
    protected $text;
    protected $article_id;


    /**
     * Comment constructor.
     * @param $username
     * @param $text
     * @param $article_id
     */
    public function __construct($username, $text, $article_alias)
    {

        $this->db = Db::instance();
        $this->username = $username;
        $this->text = $text;
        $this->article_alias = $article_alias;
    }

    /**
     * Счётчик омментариев к выбранной статье
     * @param $id <p>Идентификатор статьи</p>
     * @return string <p>Количество найденных комментариев</p>
     */

    public static function getCountComments($alias)
    {

        $sql = "SELECT COUNT(id) AS count FROM  comments WHERE article_alias = '$alias'";

        $result = Db::instance()->query($sql);

        return $result[0]->count;
    }

    /**
     * Сохранение комментария в базу данных
     */
    public function saveComment()
    {


        $sql = "INSERT INTO comments (username, text, article_alias) 
                          VALUES (:username, :text, :article_id)";

        $this->db->execute($sql, [':username' => $this->username,
            ':text' => $this->text,
            'article_id' => $this->article_alias]);


    }

}