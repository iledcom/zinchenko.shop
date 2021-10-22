<?php

class ParserNewsController {

    public $posts = [];

    public function actionIndex() {
        if(isset($_POST['parsing'])) {
            $this->startParser();
        } elseif(isset($_POST['save'])) {
            $this->startParser();
            $this->actionCreate();
        }
        
        require_once(ROOT . '/views/news/index.php');
        return true;
    }

    public function actionCreate() {
        News::addNews($this->posts);
        return true;
    }

    public function startParser() {
        require_once "./components/simple_html_dom.php";
        $page = $this->setParams('https://senior.ua/news/');
        $html = str_get_html($page);
        $pagenavi = $html->find('.pagination', 0);
        $pageCount = intval($pagenavi->find('li', 11)->plaintext);

        for ($i = 1; $i <= $pageCount; $i++) {
          $page = $this->setParams('https://senior.ua/news?page=' . $i . '/');
          $html = str_get_html($page);

          foreach($html->find('div[itemprop="itemListElement"]') as $element) {
            $img = $element->find('img', 0);
            $title = $element->find('h3', 0);
            $link = $element->find('a', 0);
            $short_content = $element->find('p', 1);

            $this->posts[] = [
                'title' => trim($title->plaintext),
                'short_content' => trim($short_content->plaintext),
                'img' => $img->src,
                'link' => $link->href,
                'writing_date' => $date = date('Y-m-d'),
                'category_id' => 1,
                'is_new' => 1,
                'is_recommended' => 0,
                'status' => 1
            ]; 

          }
          usleep(1000000);
          if($i > 0) {
            break;
          }
        }
    }

    public function setParams($url) {
        $parser = new Parser();
        $parser->set(CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Safari/537.36')
              ->set(CURLOPT_FOLLOWLOCATION, 1)
              ->set(CURLOPT_SSL_VERIFYHOST, 0)
              ->set(CURLOPT_SSL_VERIFYPEER, 0)
              ->set(CURLOPT_HEADER, 0);

        return $parser->exec($url);
    }

    public function setParamsWithReg($url_auth, $url) {
        // дописать метод, добавить параметры в $parser->set
        $parser = new Parser();

        $parser->set(CURLOPT_POST, true)
        ->set(CURLOPT_POSTFIELDS, http_build_query($auth_data))
        ->set(CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt')
        ->set(CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');

        $data = $parser->exec($url_auth);
        $data = $parser->exec($url);

        return $data;
    }




}