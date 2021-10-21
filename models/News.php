<?php

class News {
    const SHOW_BY_DEFAULT = 10;
    /**
     * Returns single news item with specified id
     * @param integer $id
     */
    public static function getNewsItemById($id) {
        // Запрос к БД        
    }

    /**
     * Returns an array of news items
     */
    public static function getNewsList($count = self::SHOW_BY_DEFAULT) {
 
        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'SELECT id, title, short_content, content, writing_date, status  FROM news WHERE status = "1" ORDER BY writing_date DESC LIMIT :count';
        
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
            $newsList[$i]['short_content'] = $row['short_content'];
            $newsList[$i]['content'] = $row['content'];
            $newsList[$i]['writing_date'] = $row['writing_date'];
            $newsList[$i]['status'] = $row['status'];
            $i++;
        }

        return $newsList;
    }

    public static function createNews($options) {
        
    }



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
        //$result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $result->bindParam(':writing_date', $options['writing_date'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        /*
        $sql = 'INSERT INTO news (title, short_content, img, link, writing_date, status)'
                . 'VALUES (?, ?, ?, ?, ?, ?)';
        
        $result = $db->prepare($sql);

        $result->bindParam(1, $options['title']);
        $result->bindParam(2, $options['short_content']);
        $result->bindParam(3, $options['img']);
        $result->bindParam(4, $options['link']);
        $result->bindParam(5, $options['writing_date']);
        $result->bindParam(6, $options['status']);

        */
        $result->execute();
        $error = $result->errorInfo();
        if($error[1]) {
          print_r($error);  
        }

    }
}
