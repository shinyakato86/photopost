<?php

  session_start();
  require('../../common/database.php');
  require('../../common/auth.php');

  $photo_id = $_POST['photo_id'];
  $database_handler = getDatabaseConnection();
  $user_id = getLoginUserId();
  $comment = $_POST['other_comment'];
  $date = date('Y-m-d H:i:s');

  try {
    if ($statement = $database_handler->prepare('INSERT INTO comments (photo_id, user_id, content, created_at) VALUES (:photo_id, :user_id, :content, :created_at)')) {
        $statement->bindParam(':photo_id', $photo_id);
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':content', $comment);
        $statement->bindParam(':created_at', $date);
        $statement->execute();
    }
  } catch (Throwable $e) {
      echo $e->getMessage();
      exit;
  }

  $url = '../photo.php?id=' . $photo_id;
  header('Location:' . $url);

  exit;


  ?>