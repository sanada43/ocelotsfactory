<?php

require("input_form.php");

// 一時アップロード先ファイルパス
if (isset($_FILES["file_1"]["tmp_name"])) {
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
        //} elseif ($_FILES["file_1"]['type'] !== 'audio/wav') {
          //  echo '音声ファイルを選択してください！';
     
        // アップロードが成功した場合
        }else{
            $result = @move_uploaded_file($file_tmp, $file_save);
            if ( $result === true ) {
                echo "".$_FILES["file_1"]["name"];
            } else {
                echo "NULL";
            //echo $file_save;
            }
        }

    }else{
        echo '不正なアクセスです！';
    }
}else{
    echo 'ファイルが入ってません';
}
?>