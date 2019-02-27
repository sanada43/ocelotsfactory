<?php
	require("input_form.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>音声文字起こしＷＥＢ</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="base.css" type="text/css" media="screen" />
<script src="./jquery-3.2.1.min.js"></script>
<script>
    function file_upload()
    {
        // フォームデータを取得
        var formdata = new FormData($('#my_form').get(0));

        // POSTでアップロード
        $.ajax({
            url  : "upload.php",
            type : "POST",
            data : formdata,
            cache       : false,
            contentType : false,
            processData : false,
            dataType    : "html"
        })
        .done(function(data, textStatus, jqXHR){
            var filename = data;
            alert("upload OK");
            $("#name").append("<option value='1'>+"filename"+</option>");
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            alert("fail");
        });
    }
    
</script>
<!-- base layout css.design sample -->
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="header-inner">
<!-- キーワード -->
<h1>音声文字起こしＷＥＢ</h1>
<!-- ページの概要 -->
<p class="description">ＩＣレコーダーで録音した音声ファイルをアップロードすると</br>文字に変換して表示します。</br>アップロードできる音声ファイルは以下の通りです。</br>・Wav ・FLAC</br>文字に起こす際に音声を９分ごとに分割します。</p>
<!-- 企業名｜ショップ名｜タイトル -->
<p class="logo"><a href="index.html">大崎コンピュータエンヂニアリング</a></p>
</div></div>
<!-- // header end -->

<div id="container">
<div id="contents">
<!-- コンテンツここから -->

<h2>アップローダー</h2>
    <form id="my_form">
        <input type="file" name="file_1">
        <button type="button" onclick="file_upload()">アップロード</button>
    </form>
<p>説明</p>
<p>説明</p>

<h2>変換ファイルの選択</h2>
    <form action="#" method="GET">
      <select id="name">
        <option value="who">--- どのファイルを選択しますか? ---</option>
      </select>
      <input type="submit" name="submit" value="送信" />
    </form>

<p>説明</p>
<p>説明</p>

<h3>*** 見出し ***</h3>
<p>テキスト</p>
<p>テキスト</p>

<!-- コンテンツここまで -->
</div><!-- // contents end -->

<div id="left-sidebar">
<!-- 左サイドバーここから -->

<p class="side-title">*** タイトル ***</p>
<ul class="localnavi">
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
</ul>
<p class="side-title">*** タイトル ***</p>
<ul class="localnavi">
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
</ul>

<!-- 左サイドバーここまで -->
</div>
<!-- // left-sidebar end -->
</div>

<div id="right-sidebar">
<!-- 右サイドバーここから -->

<p class="side-title">*** タイトル ***</p>
<p>テキスト</p>
<p>テキスト</p>
<p>テキスト</p>
<p>テキスト</p>

<!-- 右サイドバーここまで -->
</div>
<!-- // right-sidebar end -->
<!-- CSSデザインサンプル著作権表示 削除不可-->
<p id="cds">Designed by <a href="http://www.css-designsample.com/">CSS.Design Sample</a></p>
<div id="footer">
<!-- コピーライト / 著作権表示 -->
<p>Copyright &copy; *** 大崎コンピュータエンヂニアリング ***. All Rights Reserved.</p>
</div>
</div>
</body>
</html>
