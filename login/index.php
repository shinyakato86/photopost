<?php
  session_start();
?>

<?php
  require('../layout/header.php');
?>

<div class="contentsArea">
  <section class="section-01">

    <div class="heading02Wrap">
      <h2 class="heading02">ログイン</h2>
    </div>

      <div class="formArea">
        <p class="text-right mb-3"><a href="../register/" class="linkText-01">新規会員登録はこちら</a></p>
        <form action="action/login.php" method="post">
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
          <div class="form-group">
            <input class="input-01" placeholder="メールアドレス" type="text" name="user_email" maxlength="255" value="test@co.jp">
          </div>
          <div class="form-group">
            <input class="input-01" placeholder="パスワード" type="password" name="user_password" maxlength="255" value="password">
          </div>
          <div class="checkbox">
              <label class="d-flex align-items-center mt-3">
                <input class="input-02" name="remember" type="checkbox" value="on" name="save">次回からは自動的にログインする</label>
            </div>
            <div class="btnWrap">
              <input class="btn-02 mt-5" type="submit" value="ログイン">
            </div>
        </form>
      </div>

  </section>
</div>

<?php
  require('../layout/footer.php');
?>