<?php
/**
 * Контроллер NewsController
 * Вывод новостей на сайт
 */
class NewsController {

	/**
   * Action для страницы "Управление новостями"
   */
  public function actionIndex() {
      // Получаем список новостей
      $newsList = News::getNewsList();
      // Подключаем вид
      require_once(ROOT . '/views/news/index.php');
      return true;
  }

	/**
	* Action для страницы просмотра новостей
	* @param integer $newsId <p>id новости</p>
	*/
	public function actionView($newsId) {
	  // Список категорий для меню
	  $categories = News::getCategoriesList();

	  // Получаем инфомрацию о товаре
	  $news = News::getNewsById($newsId);

	  // Подключаем вид
	  require_once(ROOT . '/views/news/view.php');
	  return true;
	}

}