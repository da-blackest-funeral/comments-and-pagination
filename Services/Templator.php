<?php
    declare(strict_types = 1);

    class Templator
    {
        /**
         * @var int
         */
        private int $commentsPerPage = 4;
        private int $page = 1;
        private CommentsModel $db;

        public function __construct(CommentsModel $db) {
            $this->db = $db;
        }

        // TODO разбить Templator и Paginator на два класса

        /**
         * @param array $comment
         */
        private static function showComment(array $comment): void { ?>
          <div class="alert-info comment">
            <span class="date"><?= $comment['updated_at'] ?></span>
            <p>
              <span class="name"><?= htmlspecialchars($comment['name']); ?></span>
            </p>
            <p>
                <?= htmlspecialchars($comment['message']); ?>
            </p>
          </div>
        <?php }

        public static function successMessage() { ?>
          <div class="info alert alert-info">
            Запись успешно сохранена!
          </div>
        <?php }

        private function checkPageIsCorrect(int $maxPage) {
            if (!isset($_GET['page']) || (int)$_GET['page'] < 1) {
                $this->page = 1;
                header("location:http://192.168.56.10/?page=1");
            } elseif ((int)$_GET['page'] > $maxPage) {
                $this->page = $maxPage;
                header("location:http://192.168.56.10/?page=$this->page");
            } else {
                $this->page = (int)$_GET['page'];
            }
        }

        /**
         * Метод, показывающий все комментарии
         */
        public function showAll() {
            $maxPage = (int)ceil($this->db->count() / $this->commentsPerPage);
            if ($maxPage == 0) {
                $maxPage++;
            }
            $this->checkPageIsCorrect($maxPage);
            $paginated = $this->db->paginate($this->commentsPerPage, $this->page);

            foreach ($paginated as $comment) {
                static::showComment($comment);
            }
        }
    }