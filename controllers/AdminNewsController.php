<?php

/**
 * Контроллер AdminCategoryController
 * Управление категориями товаров в админпанели
 */
class AdminNewsController extends AdminBase {
  /**
   * Action для страницы "Управление категориями"
   */
  public function actionIndex() {
      // Проверка доступа
      self::checkAdmin();

      // Получаем список новостей
      $newsList = News::getNewsList();

      // Подключаем вид
      require_once(ROOT . '/views/admin_news/index.php');
      return true;
  }

  /**
   * Action для страницы "Добавить новость"
   */
  public function actionCreate() {
    // Проверка доступа
    self::checkAdmin();
    
    // Получаем список категорий для выпадающего списка
    $newsCategoriesList = News::getCategoriesListAdmin();

    // Обработка формы
    if (isset($_POST['submit'])) {
      // Если форма отправлена
      // Получаем данные из формы
      $options['title'] = $_POST['title'];
      $options['short_content'] = $_POST['short_content'];
      $options['content'] = $_POST['content'];
      $options['category_id'] = $_POST['category_id'];
      $options['writing_date'] = date('Y-m-d');
      $options['is_new'] = $_POST['is_new'];
      $options['is_recommended'] = $_POST['is_recommended'];
      $options['status'] = $_POST['status'];

      // Флаг ошибок в форме
      $errors = false;

      // При необходимости можно валидировать значения нужным образом
      if (!isset($options['title']) || empty($options['title'])) {
          $errors[] = 'Заполните поля';
      }

      if ($errors == false) {
        // Если ошибок нет
        // Добавляем новую новость
        $id = News::createNews($options);

          // Если запись добавлена
          if ($id) {
            // Проверим, загружалось ли через форму изображение
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                // Если загружалось, переместим его в нужную папке, дадим новое имя
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
            }
          };

          // Перенаправляем пользователя на страницу управлениями товарами
          header("Location: /admin/news");
      }
    }

      require_once(ROOT . '/views/admin_news/create.php');
      return true;
  }

  /**
   * Action для страницы "Редактировать новость"
   */
  public function actionUpdate($id) {
      // Проверка доступа
      self::checkAdmin();

      $newsCategoriesList = News::getCategoriesListAdmin();

      // Получаем данные о конкретной новости
      $news = News::getNewsById($id);

     // Обработка формы
      if (isset($_POST['submit'])) {
        // Если форма отправлена
        // Получаем данные из формы редактирования. При необходимости можно валидировать значения
        $options['title'] = $_POST['title'];
        $options['short_content'] = $_POST['short_content'];
        $options['content'] = $_POST['content'];
        $options['category_id'] = $_POST['category_id'];
        $options['writing_date'] = $_POST['writing_date'];
        $options['is_new'] = $_POST['is_new'];
        $options['is_recommended'] = $_POST['is_recommended'];
        $options['status'] = $_POST['status'];

        // Сохраняем изменения
        if (News::updateNewsById($id, $options)) {


            // Если запись сохранена
            // Проверим, загружалось ли через форму изображение
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                // Если загружалось, переместим его в нужную папке, дадим новое имя
               move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
            }
        }

        // Перенаправляем пользователя на страницу управлениями новостями
        header("Location: /admin/news");
      }

      // Подключаем вид
      require_once(ROOT . '/views/admin_news/update.php');
      return true;
  }

  /**
   * Action для страницы "Удалить новость"
   */
  public function actionDelete($id) {
      // Проверка доступа
      self::checkAdmin();

      // Обработка формы
      if (isset($_POST['submit'])) {
          // Если форма отправлена
          // Удаляем новость
          News::deleteNewsById($id);

          // Перенаправляем пользователя на страницу управлениями новостями
          header("Location: /admin/news");
      }

      // Подключаем вид
      require_once(ROOT . '/views/admin_news/delete.php');
      return true;
  }

}