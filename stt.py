# -*- coding: utf-8 -*-
import sys
import wave
import struct
import math
import os
from scipy import fromstring, int16

from google.cloud import speech
from google.cloud.speech import enums
from google.cloud import storage 
from mutagen.flac import FLAC
from pydub import AudioSegment
import magic

os.environ["GOOGLE_APPLICATION_CREDENTIALS"]='/home/site/wwwroot/My_Project-a2abf9b82b9a.json'
bucketname = 'trancestorage'

def transcript_wav(file):  # WAVファイルを刈り奪る　形をしてるだろ？ 
    
    client = storage.Client()
    bucket = client.get_bucket(bucketname)

    filename = file
    blob = bucket.blob(filename)
    blob.upload_from_filename(filename='./'+filename)
    content = blob.download_as_string()
    #ダウンロードした音声データからencoding、rate、lengthの情報を取得
    mime = magic.Magic(mime=True).from_buffer(content)
    if mime == 'audio/x-wav' and '.wav' in filename:
        encoding = 'LINEAR16'
        sound = AudioSegment(content)
        if sound.channels != 1:
            #print('Must use single channel (mono) audio')
            sys.exit()
        rate = sound.frame_rate
        length = sound.duration_seconds
    elif mime == 'audio/x-flac' and '.flac' in filename:
        encoding = 'FLAC'
        with open(filename, 'wb') as f:
            f.write(content)
            f.close()
        sound = FLAC(filename).info
        if sound.channels != 1:
            #print('Must use single channel (mono) audio')
            sys.exit()
        rate = sound.sample_rate
        length = sound.length
    else:
        #print('Acceptable type is only "wav" or "flac".')
        sys.exit()
    """
    print('\n-*- audio info -*-')
    print('filename   : ' + filename)
    print('mimetype   : ' + mime)
    print('sampleRate : ' + str(rate))
    print('playtime   : ' + str(length) + 's')
    print('\nWaiting for operation to complete...')
    """

    client = speech.SpeechClient()

    audio = {'uri':'gs://' + bucketname + '/' + filename}
    config = {'encoding':encoding,'sample_rate_hertz':rate,'language_code':'ja-JP'}

    if length < 60:
    #再生時間が1分未満の場合
        response = client.recognize(config, audio)
    else:
    #再生時間が1分以上の場合
        operation = client.long_running_recognize(config, audio)
        response = operation.result(timeout=length)

    #print('\n-*- transcribe result -*-')
    f = open("./result.txt","wb")

    for result in response.results:
    #結果をコンソール出力
        #print('Transcript: {}'.format(result.alternatives[0].transcript.encode("sjis")))
        f.write(result.alternatives[0].transcript.encode("sjis"))
        pass

    f.close()
    

def cut_wav(filename,time):  # WAVファイルを刈り奪る　形をしてるだろ？ 
    # timeの単位は[sec]

    # ファイルを読み出し
    wavf = filename
    wr = wave.open(wavf, 'r')

    # waveファイルが持つ性質を取得
    ch = wr.getnchannels()
    width = wr.getsampwidth()
    fr = wr.getframerate()
    fn = wr.getnframes()
    total_time = 1.0 * fn / fr
    integer = math.floor(total_time) # 小数点以下切り捨て
    t = int(time)  # 秒数[sec]
    frames = int(ch * fr * t)
    num_cut = int(integer//t)

    #　確認用
    """
    print("Channel: ", ch)
    print("Sample width: ", width)
    print("Frame Rate: ", fr)
    print("Frame num: ", fn)
    print("Params: ", wr.getparams())
    print("Total time: ", total_time)
    print("Total time(integer)",integer)
    print("Time: ", t) 
    print("Frames: ", frames) 
    print("Number of cut: ",num_cut)
    """

    # waveの実データを取得し、数値化
    data = wr.readframes(wr.getnframes())
    wr.close()
    X = fromstring(data, dtype=int16)
    #print(X)

    namelist = []
    for i in range(num_cut):
        #print(i)
        # 出力データを生成
        outf = 'output/' + str(i) + '.wav' 
        namelist.append(outf)
        start_cut = i*frames
        end_cut = i*frames + frames
        #print(start_cut)
        #print(end_cut)
        Y = X[start_cut:end_cut]
        outd = struct.pack("h" * len(Y), *Y)

        # 書き出し
        ww = wave.open(outf, 'w')
        ww.setnchannels(ch)
        ww.setsampwidth(width)
        ww.setframerate(fr)
        ww.writeframes(outd)
        ww.close()
    return namelist
        
if __name__ == '__main__':
    args = sys.argv
    filelist = cut_wav(args[1],args[2])
    
    for file in filelist:
        transcript_wav(file)
        
    print("cut OK")