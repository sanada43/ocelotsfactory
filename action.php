<?php
$team_id = $_POST['name']

//クライアントに返す検索結果はこいつに入れます
$response = array();

//DBからチームIDに合致する選手名を取得します


$row = $team_id
array_push($response, $row);


//JSON形式で値を返します
echo(json_encode($response));
?>