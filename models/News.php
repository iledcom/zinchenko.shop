<?php

class News {
    const SHOW_BY_DEFAULT = 10;
    /**
     * Возвращает список новостей с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком новостей</p>
     */
    public static function getNewsById($id) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM news WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();     
    }

    /**
     * Returns an array of news List
     */
    public static function getNewsList($count = self::SHOW_BY_DEFAULT) {
 
        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'SELECT id, title, writing_date  FROM news ORDER BY writing_date DESC LIMIT :count';
        
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $newsList = array();      
        $i = 0;
        while($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['writing_date'] = $row['writing_date'];
            $i++;
        }

        return $newsList;
    }

    /**
     * Возвращает массив новостей для списка в админпанели <br/>
     * (при этом в результат попадают и включенные и выключенные категории)
     * @return array <p>Массив категорий</p>
     */
    public static function getCategoriesListAdmin() {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, sort_order, status FROM news_category ORDER BY sort_order ASC');

        // Получение и возврат результатов
        $newsCategoriesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $newsCategoriesList[$i]['id'] = $row['id'];
            $newsCategoriesList[$i]['name'] = $row['name'];
            $newsCategoriesList[$i]['sort_order'] = $row['sort_order'];
            $newsCategoriesList[$i]['status'] = $row['status'];
            $i++;
        }
        return $newsCategoriesList;
    }

    /**
     * Добавляет новую новость
     * @param array $options <p>Массив с информацией о новости</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createNews($options) {
        // Соединение с БД

        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO news (title, short_content, content, category_id, writing_date, is_new, is_recommended, status)'
                . 'VALUES (:title, :short_content, :content, :category_id, :writing_date, :is_new, :is_recommended, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':writing_date', $options['writing_date'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        $error = $result->errorInfo();
        if($error[1]) {
          print_r($error);  
        }
        // Иначе возвращаем 0
        return 0;
    }

        /**
     * Редактирует новость с заданным id
     * @param integer $id <p>id новости</p>
     * @param array $options <p>Массив с информацей о новости</p>
     * @return boolean <p>Результат выполнения метода</p>
     */

    public static function updateNewsById($id, $options) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE news
            SET 
                title = :title, 
                short_content = :short_content, 
                content = :content, 
                category_id = :category_id, 
                writing_date = :writing_date, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':writing_date', $options['writing_date'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Удаляет новость с указанным id
     * @param integer $id <p>id новости</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteNewsById($id) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM news WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

     /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id) {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/news/';

        // Путь к изображению товара
        $pathToNewsImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToNewsImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToNewsImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }


    /**
    * Добавляет спарсеные новости
    */
    public static function addNews($arrayOptions) {
        // Соединение с БД
        $db = Db::getConnection();
        for ($i = 0; $i < count($arrayOptions); $i++) {
            $options = $arrayOptions[$i];
            self::newsExecute($db, $options);
        }
    }

    public static function newsExecute($db, $options) {
         $sql = 'INSERT INTO news (title, short_content, img, link, writing_date, status)'
        . 'VALUES (:title, :short_content, :img, :link, :writing_date, :status)';

        $result = $db->prepare($sql);

        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':short_content', $options['short_content'], PDO::PARAM_STR);
        $result->bindParam(':img', $options['img'], PDO::PARAM_STR);
        $result->bindParam(':link', $options['link'], PDO::PARAM_STR);
        $result->bindParam(':writing_date', $options['writing_date'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        $result->execute();
        $error = $result->errorInfo();
        if($error[1]) {
          print_r($error);  
        }

    }
}
