<?php
    require_once __DIR__ . '/Controllers/CommentController.php';
    require_once __DIR__ . '/Services/Templator.php';

    $commentsController = new CommentController();
    if ($commentsController->haveComment()) {
        $success = $commentsController->make();
    }

    if (!isset($_GET['ajax'])) {
        require_once __DIR__ . '/Layouts/top.html';
    }
?>

  <h1>Гостевая книга</h1>

<?php
    require_once __DIR__ . '/Layouts/button.html';
    if (isset($success) && $success) {
        Templator::successMessage();
    } ?>

  <div id="comments">
      <?php $commentsController->all(); ?>
  </div>

<?php
    require_once __DIR__ . '/Layouts/form.html';
    require_once __DIR__ . '/Layouts/bottom.html';
?>