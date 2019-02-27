<?php
//$team_id = $_POST['selectname']
$params = json_decode(file_get_contents('php://input'), true);  // NOTE 第2引数に true を指定しているのは連想配列にするため
echo $params['selectname'];

//クライアントに返す検索結果はこいつに入れます
//$response = array();


//$row = "test"
//array_push($response, $row);


//JSON形式で値を返します
//echo(json_encode($response));

//$result = 'こんにちは、';
//echo $result;
?>