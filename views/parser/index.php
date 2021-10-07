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

      //News::addNews($posts);
    }

  usleep(1000000);

    if($i > 1) {
      break;
    }
  }

  print_r($posts);

 
 