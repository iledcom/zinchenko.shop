<?php

/**
 * Контроллер ParserController
 * Парсер
 */
class ParserController {
  private $url_auth;
  private $url;
  private $auth_data = [];

   /*   
  public function __construct(array $auth_data, $url_auth = false, $url) {
    $this->auth_data = $auth_data;
    $this->url_auth = $url_auth;
    $url->url = $url;
  }
*/
    
  public function actionIndex() {
    // Подключаем вид
    require_once(ROOT . '/views/parser/index.php');
    return true;
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

  public function setParams($url) {
    $parser = new Parser();

    $parser->set(CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Safari/537.36')
          ->set(CURLOPT_FOLLOWLOCATION, 1)
          ->set(CURLOPT_SSL_VERIFYHOST, 0)
          ->set(CURLOPT_SSL_VERIFYPEER, 0)
          ->set(CURLOPT_HEADER, 0);

    return $parser->exec($url);
  }

}