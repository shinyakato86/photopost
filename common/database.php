<?php

function getDatabaseConnection() {
  try
  {
    $database_handler = new PDO('mysql:dbname=photo;host=localhost;charset=utf8','root','root');
    //$database_handler = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=shinyakato_minibbs;charset=utf8', 'shinyakato_root', 'xfree2000');
  }
  catch (PDOException $e)
  {
    echo "DB接続に失敗しました。<br />";
    echo $e->getMessage();
    exit;
  }

  return $database_handler;
}

?>
