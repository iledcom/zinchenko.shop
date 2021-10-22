<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <h3>Кабинет пользователя</h3>
            
            <h4>Привет, <?php echo $user['name'];?>!</h4>
            <ul>
                <li><a href="/cabinet/edit">Редактировать данные</a></li>
                <!--<li><a href="/cabinet/history">Список покупок</a></li>-->
            </ul>
            <?php
            // Если роль текущего пользователя "admin", пускаем его в админпанель
            if ($user['role'] == 'admin') { ?>
                <ul>
                    <li><a href="/admin">Панель администратора</a></li>
                </ul>
            <?php } ?>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>