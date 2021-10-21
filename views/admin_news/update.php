<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/product">Управление новостями</a></li>
                    <li class="active">Редактировать новости</li>
                </ol>
            </div>


            <h4>Редактировать новость #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Заголовок</p>
                        <input type="text" name="title" placeholder="" value="<?php echo $news['title']; ?>">

                        <p>Короткое содержание</p>
                        <input type="text" name="short_content" placeholder="" value="<?php echo $news['short_content']; ?>">

                        <p>Полное содержание</p>
                        <textarea name="content"><?php echo $news['content']; ?></textarea>

                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($newsCategoriesList)): ?>
                                <?php foreach ($newsCategoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" 
                                        <?php if ($news['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        
                        <br/><br/>

                        <p>Дата написание</p>
                        <input type="text" name="writing_date" placeholder="" value="<?php echo $news['writing_date']; ?>">

                        <p>Изображение товара</p>
                        <img src="<?php echo News::getImage($news['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="<?php echo $news['image']; ?>">
                        
                        <br/><br/>
                        
                        <p>Свежая новость</p>
                        <select name="is_new">
                            <option value="1" <?php if ($news['is_new'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($news['is_new'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>Рекомендуемые новости</p>
                        <select name="is_recommended">
                            <option value="1" <?php if ($news['is_recommended'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($news['is_recommended'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>В публикации или нет</p>
                        <select name="status">
                            <option value="1" <?php if ($news['status'] == 1) echo ' selected="selected"'; ?>>Опубликована</option>
                            <option value="0" <?php if ($news['status'] == 0) echo ' selected="selected"'; ?>>Скрыта</option>
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

