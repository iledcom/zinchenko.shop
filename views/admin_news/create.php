<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/product">Управление новостями</a></li>
                    <li class="active">Редактировать новость</li>
                </ol>
            </div>


            <h4>Добавить новую новость</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Заголовок</p>
                        <input type="text" name="title" placeholder="" value="">

                        <p>Короткое содержание</p>
                        <input type="text" name="short_content" placeholder="" value="">

                        <p>Полное содержание</p>
                        <textarea name="content"></textarea>

                        <br/><br/>

                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($newsCategoriesList)): ?>
                                <?php foreach ($newsCategoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>

                        <p>Дата написания</p>
                        <input type="text" name="writing_date" placeholder="" value="">

                        <p>Изображение товара</p>
                        <input type="file" name="image" placeholder="" value="">

                        <br/><br/>

                        <p>Свежая новость</p>
                        <select name="is_new">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>

                        <br/><br/>

                        <p>Рекомендуемые новости</p>
                        <select name="is_recommended">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>

                        <br/><br/>

                        <p>В публикации или нет</p>
                        <select name="status">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

