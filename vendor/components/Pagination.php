<?php

/*
 * Класс для генерации постраничной навигации
 */

class Pagination
{

    /**
     * @int Число ссылок навигации на страницу
     */
    private $max = 5;

    /**
     * @var Ключ для GET, в который пишется номер страницы
     */
    private $index = 'page-';

    /**
     * @var Текущая страница
     */
    private $currentPage;

    /**
     * @var Общее количество записей
     */
    private $total;

    /**
     * @var Записей на страницу
     */
    private $limit;

    /**
     * Pagination constructor.
     * @param $total
     * @param $currentPage
     * @param $limit
     * @param $index
     */

    public function __construct($total, $currentPage, $limit)
    {
        # Устанавливаем общее количество записей
        $this->total = $total;

        # Устанавливаем количество записей на страницу
        $this->limit = $limit;

        # Устанавливаем ключ в url
        //$this->index = $index;

        # Устанавливаем количество страниц
        $this->amount = ceil($this->total / $this->limit);

        # Устанавливаем номер текущей страницы
        $this->currentPage = (int)$currentPage;

    }

    /**
     *  Выводим ссылки пагинации
     * @return HTML-код со ссылками навигации
     */
    public function get()
    {
        # Для записи ссылок
        $links = null;

        //echo $this->current_page;
        # Получаем ограничения для цикла
        $limits = $this->getInterval();

        $pagination = '<ul class="pagination">';

        # Генерируем ссылки
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            
            # Если текущая это текущая страница, ссылки нет и добавляется класс active
            if ($page == $this->currentPage) {
                
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';

            } else {
                
                # Иначе генерируем ссылку
                $links .= $this->generateLink($page);
            }
        }

        # Если ссылки создались
        if (!is_null($links)) {
            
            # Если текущая страница не первая
            if ($this->currentPage > 1) {
                
                # Создаём ссылку "На первую"
                $links = $this->generateLink(1, '&laquo;') . $links;
            }

            # Если текущая страница не последняя
            if ($this->currentPage < $this->amount) {
                
                # Создаём ссылку "На последнюю"
                $links .= $this->generateLink($this->amount, '&raquo;');
            }

        }

        $pagination .= $links . '</ul>';

        # Возвращаем html
        return $pagination;
    }

    /**
     * Для генерации HTML-кода ссылки
     * @param integer $page - номер страницы
     * @param null $text
     * @return string ссылка на эмемент списка
     */
    private function generateLink($page, $text = null)
    {
        # Если текст ссылки не указан
        if (!$text)
            # Указываем, что текст - цифра страницы
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';

        //$currentURI = preg_replace('#/[0-9]+/$#', '/', $currentURI);
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);

        # Формируем HTML код ссылки и возвращаем
        return
            '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     *  Получаем интервалы вывода ссылок пагинации
     * @return array массив с началом и концом отсчёта
     */
    private function getInterval()
    {

        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
        $left = $this->currentPage - 1;

        if ($left < floor($this->max / 2)) {

            $start = 1;

        } else {

            $start = $this->currentPage - floor($this->max / 2) ;

        }

        $end = $start + $this->max - 1;

        if ($end > $this->amount) {

            // $start -= ($end - $this->amount);
            $start = $start - ($end - $this->amount);
            $end = $this->amount;
            // if ($start < 1) $start = 1;
        }

        # Возвращаем
        return
            [$start, $end];
    }

}
