<?php
  session_start();

  require ('../../common/database.php');
  require ('../../common/validation.php');
  require ('../../common/auth.php');

  $photo_size = $_FILES['photo']['size'];
  $comment = $_POST['comment'];
  $_SESSION['errors'] = [];

  emptyImgCheck($_SESSION['errors'], $photo_size, "画像を選択してください。");
  emptyCheck($_SESSION['errors'], $comment, "投稿者コメントを入力してください。");
  stringMaxSizeCheck($_SESSION['errors'], $comment, "投稿者コメントは255文字以下で入力してください。");

  if($_SESSION['errors']) {
    header('Location: ../../create/');
    exit;
  }

  $image_name = date('YmdHis') . $_FILES['photo']['name'];
  move_uploaded_file($_FILES['photo']['tmp_name'],'../../photoImg/' . $image_name);

  $database_handler = getDatabaseConnection();

  $user_id = getLoginUserId();

  try {
    if ($statement = $database_handler->prepare('INSERT INTO photos (user_id, filename, comment, created_at) VALUES (:user_id, :filename, :comment, :created_at)')) {
        $password = password_hash($user_password, PASSWORD_DEFAULT);

        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':filename', $image_name);
        $statement->bindParam(':comment', $comment);
        $statement->bindParam(':created_at', date('Y-m-d H:i:s'));
        $statement->execute();
    }
  } catch (Throwable $e) {
      echo $e->getMessage();
      exit;
  }

  header('Location: ../../');
  exit;

?>