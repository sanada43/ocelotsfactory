<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>OCELOTS FACTORY View</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="base1.css" type="text/css" media="screen" />
<!-- base layout css.design sample -->
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="header-inner">
<!-- キーワード -->
<h1>OCELOTS FACTORY View</h1>
<!-- ページの概要 -->
<p class="description">ＩｏＴ監視機器から取得した情報を表示します。</p>
<!-- 企業名｜ショップ名｜タイトル -->
<p class="logo"><a href="index.html">表示画面</a></p>
</div></div>
<!-- // header end -->

<div id="container">
<div id="contents">
<div id="contents-inner">
<!-- コンテンツここから -->

<h2 id="temp">温度グラフ</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiMjUwZmMxNjctMmNjNC00Mjg0LWI4ZTQtYTgyYjUxMzAxMTVkIiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>テキスト</p>

<h2 id="hum">湿度グラフ</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiYjlmMmMwOTItMmQwNS00MTdhLThjYzAtZTk1MTlmMGIxMGY3IiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>テキスト</p>

<h2 id="pres">気圧グラフ</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiMDkxYWQ3YjQtMWIzOC00MDc5LTlhNTYtZWQ1ZmIwNTgyMjEzIiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>テキスト</p>

<h2 id="amp">電流グラフ</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiNDExNmNiZWMtMWZmYS00ODlhLTg0NWMtNjBjYzA5Yzg5NmEyIiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>テキスト</p>

<h2 id="co2">ＣＯ２グラフ</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiYWNiMzE2ZTktOTc3Yi00YmEwLWE4ZWQtMjc4ODFkMDNlYTkxIiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>テキスト</p>

<h3>表</h3>
<h2 id="card">カードレポート</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiYWY5NTEyMzQtZjZiNC00MGJlLTkxM2ItNTQzZDE4ZjFkNjI1IiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>テキスト</p>
<p>テキスト</p>
<h2 id="card">写真</h2>
<img src="https://ocelotsfactorysakurada.blob.core.windows.net/ocelotsfactoryuploader/raspberrypi00/001.png">

<?php
require_once 'vendor\autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\ServiceException;

// Create blob REST proxy.
$connectionString = "DefaultEndpointsProtocol=http;AccountName=ocelotsfactorysakurada;AccountKey=LKv3jMfWWYSWeneGQFMm7FglcRZXGAjtScGrxuXqP2sXqzM+yTa5wdNhb4fujTS/s4x0VtZ6Rovqr/oxA1BWlg==";
$blobRestProxy = BlobRestProxy::createBlobService($connectionString);


try {
    // List blobs.
    $blob_list = $blobRestProxy->listBlobs("ocelotsfactory-view");
    $blobs = $blob_list->getBlobs();

    foreach($blobs as $blob)
    {
        $replace = str_replace('_', ' ', $blob->getName());
        $replace = str_replace('.jpg', '', $replace);
        //$from = strtotime("-3600 second");
        //$to   = strtotime("now");
        //$dif = $to - $from;
        echo date('Y-m-d H:i:s' , strtotime('+1 hour'));
        //echo $replace;
        if (strtotime($replace) <= date('Y-m-d H:i:s' , strtotime('-1 hour')){
            echo $blob->getName().": ".$blob->getUrl()."<br />";
            echo "<img src='".$blob->getUrl()."'><br />";
        }

    }
}
catch(ServiceException $e){
    // Handle exception based on error codes and messages.
    // Error codes and messages are here: 
    // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $code.": ".$error_message."<br />";
}
?>

<!-- コンテンツここまで -->
</div><!-- // contents-inner end -->
</div><!-- // contents end -->

<div id="left-sidebar">
<!-- 左サイドバーここから -->

<p class="side-title">データ</p>
<ul class="localnavi">
<li><a href="#temp">温度グラフ</a></li>
<li><a href="#pres">気圧グラフ</a></li>
<li><a href="#hum">湿度グラフ</a></li>
<li><a href="#amp">電流グラフ</a></li>
<li><a href="#co2">CO2グラフ</a></li>

</ul>
<p class="side-title">*** タイトル ***</p>
<ul class="localnavi">
<li><a href="#card">カードリーダー</a></li>
<li><a href="#picture">写真一覧</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
</ul>

<dl class="sidebar-dl">
<dt>*** タイトル ***</dt>
<dd>
<p>サンプル更新。</p>
<p>サンプル更新。</p>
<p>サンプル更新。</p>
<p>サンプル更新。</p>
<p>サンプル更新。</p>
<p>サンプル更新。</p>
</dd>
</dl>
<!--左サイドバーここまで-->
</div><!-- // left-sidebar end -->
</div><!-- // container end -->

<div id="right-sidebar">
<!--右サイドバーここから-->


<div class="sticky">
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
</div>

<!--右サイドバーここまで-->
</div><!-- // right-sidebar end -->
<!-- ↓削除不可 -->
<p id="cds">Designed by <a href="http://www.css-designsample.com/">CSS.Design Sample</a></p>
<div id="footer">
<!-- コピーライト / 著作権表示 -->
<p>Copyright &copy; *** 企業名｜ショップ名｜タイトルなど ***. All Rights Reserved.</p>
</div>
</div>
</body>
</html>