<?php
    require_once __DIR__ . '/Controllers/CommentController.php';
    require_once __DIR__ . '/Services/Templator.php';

    $commentsController = new CommentController();
    if ($commentsController->haveComment()) {
        $success = $commentsController->make();
    }

    // if request made with js, not needed to load header
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        require_once __DIR__ . '/Layouts/top.html';
    }
?>

    <h1 class="header">Гостевая книга</h1>

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