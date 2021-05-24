<?php
  session_start();

  require './common/database.php';

  $photos = [];

  if(isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $database_handler = getDatabaseConnection();

  if($page == '') {
    $page = 1;
  }

  $page = max($page, 1);

  $counts = $database_handler->query('SELECT COUNT(*) AS cnt FROM photos');
  $cnt = $counts->fetch();
  $maxPage = ceil($cnt['cnt'] / 9);
  $page = min($page, $maxPage);

  $start = ($page - 1) * 9;

  if ($statement = $database_handler->prepare('SELECT id,filename FROM photos ORDER BY created_at DESC LIMIT ?,9')) {
      $statement->bindParam(1, $start, PDO::PARAM_INT);
      $statement->execute();

      while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
        array_push($photos, $result);
      }
  }

?>

<?php
  require('./layout/header.php');
?>

<div class="contentsArea">

  <div class="block01">

    <?php foreach($photos as $photo): ?>

    <a href="./detail/photo.php?id=<?php echo htmlspecialchars($photo['id']); ?>" class="block01_item">
      <img src="/photo/photoImg/<?php echo htmlspecialchars($photo['filename']); ?>" alt="">
    </a>

    <?php endforeach; ?>

  </div>

  <ul class="pagingArea">

    <?php if($page >  1): ?>
    <li class="pagingArea_item"><a href="index.php?page=<?php echo $page - 1 ?>" class="prev">前のページへ</a></li>
    <?php else: ?>
      <li class="pagingArea_item">前のページへ</li>
    <?php endif; ?>

    <?php if($page <  $maxPage): ?>
    <li class="pagingArea_item"><a href="index.php?page=<?php echo $page + 1 ?>" class="next">次のページへ</a></li>
    <?php else: ?>
      <li class="pagingArea_item">次のページへ</li>
    <?php endif; ?>

</ul>

</div>

<?php
  require('./layout/footer.php');
?>