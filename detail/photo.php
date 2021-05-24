<?php

  session_start();
  require('../common/database.php');
  require('../common/auth.php');

  if(empty($_REQUEST['id'])) {
    header('Location: ../index.php');
    exit();
  }

  $photos = [];
  $comments = [];
  $id = $_REQUEST['id'];

  $database_handler = getDatabaseConnection();

  //投稿取得
  if ($statement = $database_handler->prepare('SELECT * FROM photos INNER JOIN users ON photos.user_id = users.id AND photos.id = ?')) {
      $statement->bindValue(1,$id,PDO::PARAM_INT);
      $statement->execute();

    while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
      array_push($photos, $result);
    }
  }

  //コメント取得
  if ($statement = $database_handler->prepare('SELECT * FROM comments INNER JOIN users ON comments.user_id = users.id AND comments.photo_id = ?')) {
    $statement->bindValue(1,$id,PDO::PARAM_INT);
    $statement->execute();

  while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
    array_push($comments, $result);
  }
}

?>

<?php
  require('../layout/header.php');
?>

<div class="contentsArea">
  <section class="section-01">
    <div class="heading02Wrap">
      <h2 class="heading02">投稿詳細</h2>
    </div>

    <div class="block02">

      <div class="block02_img">

        <?php foreach($photos as $photo): ?>

          <p><img src="/photo/photoImg/<?php echo htmlspecialchars($photo['filename']); ?>" alt=""></p>
          <p class="d-flex align-items-center mt-3"><span class="material-icons mr-3">photo_camera</span>Posted by <?php echo htmlspecialchars($photo['name']); ?></p>

      </div>

      <div class="block02_item">

      <p class="authorComment"><?php echo htmlspecialchars($photo['comment']); ?></p>
      <?php endforeach; ?>

        <?php foreach($comments as $comment): ?>
          <div class="commentArea">
            <p><?php echo htmlspecialchars($comment['content']); ?></p>
            <p class="commentArea_name"><?php echo htmlspecialchars($comment['name']); ?></p>
          </div>
          <p></p>
        <?php endforeach; ?>

        <p class="block02_title">コメント</p>

        <form method="post" action="action/comments.php">

          <div class="form-group">
            <textarea name="other_comment" class="input-01" cols="30" rows="3" maxlength="255" placeholder="コメント入力"></textarea>
            <input type="hidden" value="<?php echo $id ?>" name="photo_id">
          </div>

          <div class="btnWrap mt-3"><input class="btn-01" type="submit" value="コメント投稿"></div>

        </form>
      </div>
    </div>
  </section>
</div>

<?php
  require('../layout/footer.php');
?>