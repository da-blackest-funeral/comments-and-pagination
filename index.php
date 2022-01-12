<?php
  require_once __DIR__ . '/CommentController.php';
  require_once __DIR__ . '/Templator.php';

  $commentsController = new CommentController();
  if ($commentsController->haveComment()) {
    $success = $commentsController->make();
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Гостевая книга</title>
  <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="wrapper">
  <h1>Гостевая книга</h1>

  <button class="show" id="<?= isset($_GET['page']) ? $_GET['page'] + 1 : '1'; ?>"> Показать следующие записи</button>

    <?php if (isset($success) && $success) {
      Templator::successMessage();
    } ?>

  <div id="comments">
      <?php $commentsController->all(); ?>
  </div>

  <div id="form">
    <form action="" method="POST">
      <p><input class="form-control" placeholder="Ваше имя" name="name" required></p>
      <p><textarea class="form-control" placeholder="Ваш отзыв" name="comment" required></textarea></p>
      <p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="main.js"></script>

</div>
</body>
</html>