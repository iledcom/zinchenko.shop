<?php

	$page = $this->setParams('https://senior.ua/news/');
  require_once "./components/simple_html_dom.php";
  $html = str_get_html($page);


 
  $pagenavi = $html->find('.pagination', 0);
  $pageCount = intval($pagenavi->find('li', 11)->plaintext);
  //echo $pageCount;
  //die();

$posts = [];
  for ($i = 1; $i <= $pageCount; $i++) {
  
    $page = $this->setParams('https://senior.ua/news?page=' . $i . '/');
    $html = str_get_html($page);

    foreach($html->find('div[itemprop="itemListElement"]') as $element) {
      $img = $element->find('img', 0);
      $title = $element->find('h3', 0);
      $link = $element->find('a', 0);
      $short_content = $element->find('p', 1);

      $posts[] = [
        'title' => trim($title->plaintext),
        'short_content' => trim($short_content->plaintext),
        'img' => $img->src,
        'link' => $link->href,
        'writing_date' => $date = date('Y-m-d'),
        'status' => 1
      ];

      //$posts[] = $post;
      //News::addNews($posts);       
    }

    usleep(1000000);

    if($i > 0) {
      break;
    }
  }



  //print_r($posts);

 $db = Db::getConnection();

      // Текст запроса к БД
      $sql = 'INSERT INTO news (title, short_content, img, link, writing_date, status)'
              . 'VALUES (:title, :short_content, :img, :link, :writing_date, :status)';

      // Получение и возврат результатов. Используется подготовленный запрос
      $result = $db->prepare($sql);
      
      /*
      $result->bindParam(':title', $posts['title'], PDO::PARAM_STR);
      $result->bindParam(':short_content', $posts['short_content'], PDO::PARAM_STR);
      $result->bindParam(':img', $posts['img'], PDO::PARAM_STR);
      $result->bindParam(':link', $posts['link'], PDO::PARAM_STR);
      //$result->bindParam(':content', $posts['content'], PDO::PARAM_STR);
      $result->bindParam(':writing_date', $posts['writing_date'], PDO::PARAM_STR);
      $result->bindParam(':status', $posts['status'], PDO::PARAM_INT);
      
      //print_r($posts);
      $result->execute();
      $result->closeCursor();
      */

    // start transaction
     $db->beginTransaction(); 
    
      for ($i = 0; $i < count($posts); $i++) {
        foreach ($posts as $post) {
      
      $result->bindParam(':title', $post['title'], PDO::PARAM_STR);
      $result->bindParam(':short_content', $post['short_content'], PDO::PARAM_STR);
      $result->bindParam(':img', $post['img'], PDO::PARAM_STR);
      $result->bindParam(':link', $post['link'], PDO::PARAM_STR);
      //$result->bindParam(':content', $post['content'], PDO::PARAM_STR);
      $result->bindParam(':writing_date', $post['writing_date'], PDO::PARAM_STR);
      $result->bindParam(':status', $post['status'], PDO::PARAM_INT);
      
        //print_r($post);
        $result->execute();
        //$result->closeCursor();
        }
    }
    // end transaction
    $db->commit();
 