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

  <button class="show" id="<?= $_GET['page'] + 1; ?>"> Показать следующие записи</button>

    <?php if (isset($_POST['name'])) { ?>
      <div class="info alert alert-info">
        Запись успешно сохранена!
      </div>
    <?php } ?>

  <div id="comments">
      <?php require_once __DIR__ . '/getComments.php'; ?>
  </div>

  <div id="form">
    <form action="" method="POST">
      <p><input class="form-control" placeholder="Ваше имя" name="name" required></p>
      <p><textarea class="form-control" placeholder="Ваш отзыв" name="comment" required></textarea></p>
      <p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function () {
          $('.show').click(function () {
              $('#wrapper').load('http://localhost/?page=' + $(this).attr('id'));
          });
      });
  </script>

</div>
</body>
</html>

<!-- <?= $_GET['page'] + 1; ?> -->