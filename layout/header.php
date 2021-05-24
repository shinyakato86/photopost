<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Photo Post</title>
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/photo/js/script.js" defer></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="/photo/css/style.css" rel="stylesheet">
</head>

<header class="header">
  <div class="header_inner">
    <a href="/photo/" class="headerLogo"><img src="/photo/img/headerLogo.png" alt=""></a>
      <div class="header_nav">
        <a href="/photo/create/" class="btn-01 mr-3">写真投稿</a>
        <?php if(isset($_SESSION['user'])): ?>
          <a href="/photo/logout/logout.php" class="btn-02">ログアウト</a>
        <?php else: ?>
          <a href="/photo/login/" class="btn-02">ログイン</a>
        <?php endif; ?>
      </div>
      <p id="js-headerSpMenuBtn" class="headerSpMenuBtn">
        <button class="headerSpMenuBtn_lines">
        <span class="headerSpMenuBtn_line"></span>
        <span class="headerSpMenuBtn_line"></span>
        <span class="headerSpMenuBtn_line"></span>
        </button>
      </p>
  </div>
</header>