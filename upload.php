<?php

require("input_form.php");
// 一時アップロード先ファイルパス
$file_tmp  = $_FILES["file_1"]["tmp_name"];

// 正式保存先ファイルパス
$file_save = "./file/" . $_FILES["file_1"]["name"];

// ファイル移動
$result = @move_uploaded_file($file_tmp, $file_save);
if ( $result === true ) {
    echo "UPLOAD OK";
} else {
    //echo "UPLOAD NG";
    echo $file_save;
}


    foreach(glob('./file/{*.gif,*.zip,*.pdf}',GLOB_BRACE) as $file){
    if(is_file($file)){
        $input_file[] = htmlspecialchars($file);
        
    }
}
?>