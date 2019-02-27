<?php


    foreach(glob('./file/{*.gif,*.zip,*.pdf}',GLOB_BRACE) as $file){
        if(is_file($file)){
            echo htmlspecialchars($file);
        }
    }


?>