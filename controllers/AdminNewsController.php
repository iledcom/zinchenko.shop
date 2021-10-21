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
      $newsList = News::getNewsListAdmin();

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

      // Обработка формы
      if (isset($_POST['save'])) {
          // Если форма отправлена
          // Получаем данные из формы
          $options['id'] = $_POST['title'];
          $options['title'] = $_POST['title'];
          $options['short_content'] = $_POST['title'];
          $options['content'] = $_POST['title'];
          $options['writing_date'] = $_POST['title'];
          $options['status'] = $_POST['title'];

          // Флаг ошибок в форме
          $errors = false;

          // При необходимости можно валидировать значения нужным образом
          if (!isset($options['title']) || empty($options['title'])) {
              $errors[] = 'Заполните поля';
          }


          if ($errors == false) {
              // Если ошибок нет
              // Добавляем новую категорию
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
                header("Location: /admin/product");
          }
      }

      require_once(ROOT . '/views/admin_category/create.php');
      return true;
  }

  /**
   * Action для страницы "Редактировать категорию"
   */
  public function actionUpdate($id) {
      // Проверка доступа
      self::checkAdmin();

      // Получаем данные о конкретной категории
      $category = Category::getCategoryById($id);

      // Обработка формы
      if (isset($_POST['submit'])) {
          // Если форма отправлена   
          // Получаем данные из формы
          $name = $_POST['name'];
          $sortOrder = $_POST['sort_order'];
          $status = $_POST['status'];

          // Сохраняем изменения
          Category::updateCategoryById($id, $name, $sortOrder, $status);

          // Перенаправляем пользователя на страницу управлениями категориями
          header("Location: /admin/category");
      }

      // Подключаем вид
      require_once(ROOT . '/views/admin_category/update.php');
      return true;
  }

  /**
   * Action для страницы "Удалить категорию"
   */
  public function actionDelete($id) {
      // Проверка доступа
      self::checkAdmin();

      // Обработка формы
      if (isset($_POST['submit'])) {
          // Если форма отправлена
          // Удаляем категорию
          Category::deleteCategoryById($id);

          // Перенаправляем пользователя на страницу управлениями товарами
          header("Location: /admin/category");
      }

      // Подключаем вид
      require_once(ROOT . '/views/admin_category/delete.php');
      return true;
  }

}