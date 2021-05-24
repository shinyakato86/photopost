<?php
  session_start();
  require '../common/auth.php';
?>

<?php
  require('../layout/header.php');
?>

<div class="contentsArea">
  <section class="section-01">
    <div class="heading02Wrap">
      <h2 class="heading02">新規登録</h2>
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

      <form method="post" action="./action/register.php">

        <div class="form-group">
          <p class="mb-3 fw-bold"><label class="col-form-label fw-b">名前<span class="icon_required">必須</span></label></p>
          <input class="input-01" type="text" name="user_name" maxlength="255" value="">
        </div>

        <div class="form-group">
          <p class="mb-3 fw-bold"><label class="col-form-label fw-b">メールアドレス<span class="icon_required">必須</span></label></p>
          <input class="input-01" type="email" name="user_email" maxlength="255" value="">
        </div>

        <div class="form-group">
          <p class="mb-3 fw-bold"><label class="col-form-label fw-b">パスワード（6文字以上）<span class="icon_required">必須</span></label></p>
          <input class="input-01" type="password" name="user_password" maxlength="20" value="">
        </div>

        <div class="btnWrap mt-5"><input class="btn-02" type="submit" value="登録する"></div>

      </form>

    </div>
  </section>
</div>

<?php
  require('../layout/footer.php');
?>
