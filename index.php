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
<!-- �L�[���[�h -->
<h1>OCELOTS FACTORY View</h1>
<!-- �y�[�W�̊T�v -->
<p class="description">�h���s�Ď��@�킩��擾��������\�����܂��B</p>
<!-- ��Ɩ��b�V���b�v���b�^�C�g�� -->
<p class="logo"><a href="index.html">�\�����</a></p>
</div></div>
<!-- // header end -->

<div id="container">
<div id="contents">
<div id="contents-inner">
<!-- �R���e���c�������� -->

<h2 id="temp">���x�O���t</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiMjUwZmMxNjctMmNjNC00Mjg0LWI4ZTQtYTgyYjUxMzAxMTVkIiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>�e�L�X�g</p>

<h2 id="hum">���x�O���t</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiYjlmMmMwOTItMmQwNS00MTdhLThjYzAtZTk1MTlmMGIxMGY3IiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>�e�L�X�g</p>

<h2 id="pres">�C���O���t</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiMDkxYWQ3YjQtMWIzOC00MDc5LTlhNTYtZWQ1ZmIwNTgyMjEzIiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>�e�L�X�g</p>

<h2 id="amp">�d���O���t</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiNDExNmNiZWMtMWZmYS00ODlhLTg0NWMtNjBjYzA5Yzg5NmEyIiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>�e�L�X�g</p>

<h2 id="co2">�b�n�Q�O���t</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiYWNiMzE2ZTktOTc3Yi00YmEwLWE4ZWQtMjc4ODFkMDNlYTkxIiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>�e�L�X�g</p>

<h3>�\</h3>
<h2 id="card">�J�[�h���|�[�g</h2>
<iframe width="800" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiYWY5NTEyMzQtZjZiNC00MGJlLTkxM2ItNTQzZDE4ZjFkNjI1IiwidCI6IjZlYWE4MWI0LTRjYTQtNDBhNi1iYTIxLThmMWQzYjVkYmU0NyJ9" frameborder="0" allowFullScreen="true"></iframe>
<p>�e�L�X�g</p>
<p>�e�L�X�g</p>
<h2 id="card">�ʐ^</h2>
<img src="https://ocelotsfactorysakurada.blob.core.windows.net/ocelotsfactoryuploader/raspberrypi00/001.png">

<?php
require_once 'vendor\autoload.php';

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

// Create blob REST proxy.
$connectionString = "DefaultEndpointsProtocol=http;AccountName=[ocelotsfactorysakurada];AccountKey=[LKv3jMfWWYSWeneGQFMm7FglcRZXGAjtScGrxuXqP2sXqzM+yTa5wdNhb4fujTS/s4x0VtZ6Rovqr/oxA1BWlg==]";
$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);


try {
    // List blobs.
    $blob_list = $blobRestProxy->listBlobs("ocelotsfactoryuploader");
    $blobs = $blob_list->getBlobs();

    foreach($blobs as $blob)
    {
        echo $blob->getName().": ".$blob->getUrl()."<br />";
        echo "<img src='".$blob->getUrl()."'><br />";
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

<!-- �R���e���c�����܂� -->
</div><!-- // contents-inner end -->
</div><!-- // contents end -->

<div id="left-sidebar">
<!-- ���T�C�h�o�[�������� -->

<p class="side-title">�f�[�^</p>
<ul class="localnavi">
<li><a href="#temp">���x�O���t</a></li>
<li><a href="#pres">�C���O���t</a></li>
<li><a href="#hum">���x�O���t</a></li>
<li><a href="#amp">�d���O���t</a></li>
<li><a href="#co2">CO2�O���t</a></li>

</ul>
<p class="side-title">*** �^�C�g�� ***</p>
<ul class="localnavi">
<li><a href="#card">�J�[�h���[�_�[</a></li>
<li><a href="#picture">�ʐ^�ꗗ</a></li>
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
</ul>

<dl class="sidebar-dl">
<dt>*** �^�C�g�� ***</dt>
<dd>
<p>�T���v���X�V�B</p>
<p>�T���v���X�V�B</p>
<p>�T���v���X�V�B</p>
<p>�T���v���X�V�B</p>
<p>�T���v���X�V�B</p>
<p>�T���v���X�V�B</p>
</dd>
</dl>
<!--���T�C�h�o�[�����܂�-->
</div><!-- // left-sidebar end -->
</div><!-- // container end -->

<div id="right-sidebar">
<!--�E�T�C�h�o�[��������-->


<div class="sticky">
<p class="side-title">*** �^�C�g�� ***</p>
<ul class="localnavi">
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
</ul>
<p class="side-title">*** �^�C�g�� ***</p>
<ul class="localnavi">
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
<li><a href="#">*** �����N ***</a></li>
</ul>
</div>

<!--�E�T�C�h�o�[�����܂�-->
</div><!-- // right-sidebar end -->
<!-- ���폜�s�� -->
<p id="cds">Designed by <a href="http://www.css-designsample.com/">CSS.Design Sample</a></p>
<div id="footer">
<!-- �R�s�[���C�g / ���쌠�\�� -->
<p>Copyright &copy; *** ��Ɩ��b�V���b�v���b�^�C�g���Ȃ� ***. All Rights Reserved.</p>
</div>
</div>
</body>
</html>