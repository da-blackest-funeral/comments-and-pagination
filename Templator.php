<?php
declare(strict_types=1);

class Templator
{
    /**
     * @var int
     */
    private static int $commentsPerPage = 3;
    private static int $page = 1;

    // TODO разбить Templator и Paginator на два класса
    /**
     * @param array $commentData
     */
    private static function showComment(array $commentData): void
    { ?>
      <div class="note">
        <p>
          <span class="date"><?= $commentData['updated_at'] ?></span>
        </p>
        <p>
            <?= $commentData['message']; ?>
        </p>
      </div>
    <?php }

    /**
     * Метод, возвращающий записи только для текущей страницы
     * @param array $allComments
     * @return array
     */
    private static function paginate(array $allComments): array
    {
        if (!isset($_GET['page']) || (int)$_GET['page'] < 1) {
            self::$page = 1;
            header("location:http://localhost/?page=1");
        } else {
            self::$page = (int)$_GET['page'];
        }

        return array_slice(
            $allComments,
            (self::$page - 1) * self::$commentsPerPage,
            self::$commentsPerPage
        );
    }
    // TODO сделать запрос
    /**
     * Метод, показывающий все комментарии
     * @param array $allCComments
     */
    public static function showAll(array $allCComments): void
    {
        /*
         * округление происходит таким образом,
         * что если количество записей кратно
         * количеству записей на страницу,
         * то $maxPage больше чем должна быть, из-за чего
         * создается пустая страница, которой не должно быть
         */
        $maxPage = (int)round(count($allCComments) / static::$commentsPerPage) + 2;
        /*
         * Поэтому если возникла такая ситуация, для корректности
         * необходимо уменьшить $maxPage на единицу
        */
        if (count($allCComments) % self::$commentsPerPage == 0
        || count($allCComments) % self::$commentsPerPage == 2) {
            $maxPage--;
        }

        $paginated = static::paginate($allCComments);

        /*
         * Если ввели в GET параметр несуществующее значение,
         * то вовзвращаем на последнюю страницу
        */
        if (empty($paginated) && count($allCComments) > 0) {
            self::$page = $maxPage;
            header("location:http://localhost/?page=" . self::$page - 1);
        }
        foreach ($paginated as $comment) {
            static::showComment($comment);
        }
    }
}