<?php include ROOT . '/views/layouts/header.php'; ?>
<section>

<div class="container">
  <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-9">
      <?php foreach ($newsList as $news) {?>
        <p><?php echo $news['title']; ?></p>
        <p><?php echo $news['short_content']; ?></p>
        <p>Дата публикации: <?php echo $news['writing_date']; ?></p>
      <?php } ?>
    </div>
  </div>
</div>
  
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>

