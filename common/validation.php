<?php

// 空チェック
function emptyCheck(&$errors, $check_value, $message){
  if (empty(trim($check_value))) {
    array_push($errors, $message);
  }
}

// 画像空チェック
function emptyImgCheck(&$errors, $check_value, $message){
  if ($check_value === 0) {
    array_push($errors, $message);
  }
}

// 最小文字数チェック
function stringMinSizeCheck(&$errors, $check_value, $message, $min_size = 6){
  if (mb_strlen($check_value) < $min_size) {
    array_push($errors, $message);
  }
}

// 最大文字数チェック
function stringMaxSizeCheck(&$errors, $check_value, $message, $max_size = 255) {
  if ($max_size < mb_strlen($check_value)) {
    array_push($errors, $message);
  }
}

// メールアドレスチェック
function mailAddressCheck(&$errors, $check_value, $message) {
    if (filter_var($check_value, FILTER_VALIDATE_EMAIL) == false) {
        array_push($errors, $message);
    }
}

// 半角英数字チェック
function halfAlphanumericCheck(&$errors, $check_value, $message) {
  if (preg_match("/^[a-zA-Z0-9]+$/", $check_value) == false) {
    array_push($errors, $message);
  }
}

?>
