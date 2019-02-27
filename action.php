<?php
//$team_id = $_POST['selectname']
$params = json_decode(file_get_contents('php://input'), true);  // NOTE 第2引数に true を指定しているのは連想配列にするため


class WavCtrl {

    var $_d     = '';   // データ

    var $datasize   = 0;    // データサイズ
    var $fmtid  = 0;    // フォーマットID
    var $chsize = 0;    // チャンネル数
    var $freq   = 0;    // サンプリング周波数

    function LoadFile($fn) {

        $this->_d = file_get_contents($fn);

        // 先頭4バイトが、RIFF でなければ、WAV ファイルではない。
        if (substr($this->_d, 0, 4) != 'RIFF') {
            return false;
        }

        // chunk 識別コード WAVE が存在するかどうか調査
        if (substr($this->_d, 8, 4) != 'WAVE') {
            return false;
        }

        // chunk 識別コード fmt が存在するかどうか調査
        if (substr($this->_d, 12, 4) != 'fmt ') {
            return false;
        }

        // chunk 識別コード data が存在するかどうか調査
        if (substr($this->_d, 36, 4) != 'data') {
            return false;
        }

        // フォーマットID を取得します
        // リニアPCMだけを対象にするので、それ以外はエラー
        $d = unpack('v', substr($this->_d, 20, 2));
        $this->fmtid = $d[1];

        if ($this->fmtid != 1) {
            return false;
        }

        // チャンネル数を取得
        // モノラルチャンネルだけを対象にします
        $d = unpack('v', substr($this->_d, 22, 2));
        $this->chsize = $d[1];

        if ($this->fmtid != 1) {
            return false;
        }

        // サンプリング周波数を取得
        // 44100hz のみを対象とします
        $d = unpack('V', substr($this->_d, 24, 4));
        $this->freq = $d[1];

        // データサイズを取得
        $d = unpack('V', substr($this->_d, 40, 4));
        $this->datasize = $d[1];

    }

}

$fn = './file/' . $params['selectname'];


echo $fn;

?>