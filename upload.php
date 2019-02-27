<?php

require("input_form.php");

// 一時アップロード先ファイルパス
$file_tmp  = $_FILES["file_1"]["tmp_name"];

// 正式保存先ファイルパス
$file_save = "./file/" . $_FILES["file_1"]["name"];
// ①POSTリクエストによるページ遷移かチェック
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ②エラーコード2だった場合（HTMLのファイル制限超過）
    if ($_FILES["file_1"]['error'] === 2) {
        echo 'ファイルサイズを小さくしてください！';
 
    // ③サイズが0だった場合（ファイルが空）
    } elseif ($_FILES["file_1"]['size'] === 0) {
        echo 'ファイルを選択してください！';
 
    // ④テキストファイルじゃなかった場合
    } elseif ($_FILES["file_1"]['type'] !== 'text/plain') {
        echo 'テキストファイルを選択してください！';
 
    // アップロードが成功した場合
    } elseif ($_FILES["file_1"]['error'] === 0) {
    // アップロードされたファイルに、パスとファイル名を設定して保存
        $result = @move_uploaded_file($file_tmp, $file_save);
        if ( $result === true ) {
            echo "".$_FILES["file_1"]["name"];
        } else {
            echo "NULL";
        //echo $file_save;
        }
    }else {
        echo 'アップロードに失敗しました！';
    }
}else{
    echo '不正なアクセスです！';
}
?>