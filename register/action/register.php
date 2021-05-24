<?php

  session_start();

  require '../../common/database.php';
  require '../../common/validation.php';

  // パラメータ取得
  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

      // バリデーション
  $_SESSION['errors'] = [];

  // - 空チェック
  emptyCheck($_SESSION['errors'], $user_name, "ユーザー名を入力してください。");
  emptyCheck($_SESSION['errors'], $user_email, "メールアドレスを入力してください。");
  emptyCheck($_SESSION['errors'], $user_password, "パスワードを入力してください。");

  // - 文字数チェック
  stringMaxSizeCheck($_SESSION['errors'], $user_name, "ユーザー名は255文字以内で入力してください。");
  stringMaxSizeCheck($_SESSION['errors'], $user_email, "メールアドレスは255文字以内で入力してください。");
  stringMaxSizeCheck($_SESSION['errors'], $user_password, "パスワードは255文字以内で入力してください。");
  stringMinSizeCheck($_SESSION['errors'], $user_password, "パスワードは6文字以上で入力してください。");

  if(!$_SESSION['errors']) {
    // - メールアドレスチェック
    mailAddressCheck($_SESSION['errors'], $user_email, "正しいメールアドレスを入力してください。");
    // - ユーザー名・パスワード半角英数チェック
    //halfAlphanumericCheck($_SESSION['errors'], $user_name, "ユーザー名は半角英数字で入力してください。");
    halfAlphanumericCheck($_SESSION['errors'], $user_password, "パスワードは半角英数字で入力してください。");
    // - メールアドレス重複チェック

  }

  if($_SESSION['errors']) {
    header('Location: ../../register/');
    exit;
  }

    $database_handler = getDatabaseConnection();

    try {
      if ($statement = $database_handler->prepare('INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, :created_at)')) {
          $password = password_hash($user_password, PASSWORD_DEFAULT);

          $statement->bindParam(':name', htmlspecialchars($user_name));
          $statement->bindParam(':email', $user_email);
          $statement->bindParam(':password', $password);
          $statement->bindParam(':created_at', date('Y-m-d H:i:s'));
          $statement->execute();

          $_SESSION['user'] = [
            'name' => $user_name,
            'id' => $database_handler->lastInsertId()
          ];
      }
    } catch (Throwable $e) {
        echo $e->getMessage();
        exit;
    }

    unset($_SESSION['errors']);
    
    header('Location: ../../');
    exit;

  ?>
