<?php
  session_start();
  require ('../common/auth.php');
  require ('../common/database.php');

  if (!isLogin()) {
    header('Location: ../login/');
    exit;
  }

?>

<?php
  require('../layout/header.php');
?>

<div class="contentsArea">
  <section class="section-01">
    <div class="heading02Wrap">
      <h2 class="heading02">写真投稿</h2>
    </div>

    <div class="formArea">

      <?php
        if (isset($_SESSION['errors'])) {
            echo '<div class="alert alert-danger" role="alert">';
            foreach ($_SESSION['errors'] as $error) {
                echo "<div>{$error}</div>";
            }
            echo '</div>';
            unset($_SESSION['errors']);
        }
      ?>

      <form method="post" action="./action/create.php" enctype="multipart/form-data">

        <div class="form-group">
          <p class="mb-3 fw-bold"><label class="col-form-label fw-b">投稿画像<span class="icon_required">必須</span></label></p>
          <input type="file" name="photo" value="" accept="image/*" onChange="imgPreView(event)">
        </div>

        <div class="form-group">
          <p class="mb-3 fw-bold"><label class="col-form-label fw-b">投稿者コメント<span class="icon_required">必須</span></label></p>
          <textarea name="comment" id="" cols="30" rows="6" maxlength="255" class="input-01"></textarea>
        </div>
        <div class="form-group">
          <p class="mb-3 fw-bold"><label class="col-form-label fw-b">選択画像プレビュー</label></p>
          <div id="preview"></div>
        </div>
        <div class="btnWrap mt-5"><input class="btn-01" type="submit" value="投稿する"></div>

      </form>

    </div>
  </section>
</div>

<?php
  require('../layout/footer.php');
?>
