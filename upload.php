<?php

require("input_form.php");

// 一時アップロード先ファイルパス
$file_tmp  = $_FILES["file_1"]["tmp_name"];

// 正式保存先ファイルパス
$file_save = "./file/" . $_FILES["file_1"]["name"];

// ファイル移動
$result = @move_uploaded_file($file_tmp, $file_save);
if ( $result === true ) {
    echo "".$_FILES["file_1"]["name"];
} else {
    echo "NULL";
    //echo $file_save;
}

?>