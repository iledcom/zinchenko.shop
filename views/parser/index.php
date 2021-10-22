<?php include ROOT . '/views/layouts/header.php'; ?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="#" method="post" enctype="multipart/form-data">
          <input type="submit" name="parsing" class="btn btn-default" value="Парсить">
        </form>
      </div>
    </div>
  </div>
  <hr>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php
        $i = 1;
         foreach ($this->posts as $post) { ?>
            <p><?php print '(' . $i++ . ') ' . $post['title']?></p>
          
        <?php }?>
      </div>
      <hr>
      <div class="col-md-12">
        <form action="#" method="post" enctype="multipart/form-data">
          <input type="submit" name="save" class="btn btn-default" value="Сохранить">
        </form>
      </div>
    </div>
  </div>

</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>

