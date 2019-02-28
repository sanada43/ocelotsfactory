#coding:utf8
import sys
from google.cloud import speech
from google.cloud.speech import enums
from google.cloud import storage 
from mutagen.flac import FLAC
from pydub import AudioSegment
import magic
#import urllib2
import urllib.request, urllib.error
import os

os.environ["GOOGLE_APPLICATION_CREDENTIALS"]='/home/site/wwwroot/My_Project-a2abf9b82b9a.json'


filename = 'record3.wav'
bucketname = 'trancestorage'

client = storage.Client()
bucket = client.get_bucket(bucketname)

blob = bucket.blob("record3.wav")

blob.upload_from_filename(filename='./file/record3.wav')

for f in bucket.list_blobs():
    print(f)


#gcsからデータをダウンロード
client = storage.Client()
bucket = client.get_bucket(bucketname)
blob = storage.Blob(filename, bucket)
content = blob.download_as_string()

#filename = 'record2.wav'
#url = 'https://ocelotswebsite00.azurewebsites.net'

#content = urllib.request.urlopen(url+'/file/record.wav').read()

#ダウンロードした音声データからencoding、rate、lengthの情報を取得
mime = magic.Magic(mime=True).from_buffer(content)
if mime == 'audio/x-wav' and '.wav' in filename:
    encoding = 'LINEAR16'
    sound = AudioSegment(content)
    if sound.channels != 1:
        print('Must use single channel (mono) audio')
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
        print('Must use single channel (mono) audio')
        sys.exit()
    rate = sound.sample_rate
    length = sound.length
else:
    print('Acceptable type is only "wav" or "flac".')
    sys.exit()

print('\n-*- audio info -*-')
print('filename   : ' + filename)
print('mimetype   : ' + mime)
print('sampleRate : ' + str(rate))
print('playtime   : ' + str(length) + 's')
print('\nWaiting for operation to complete...')

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

print('\n-*- transcribe result -*-')
f = open("./result.txt","wb")

for result in response.results:
#結果をコンソール出力
    print('Transcript: {}'.format(result.alternatives[0].transcript.encode("sjis")))
    f.write(result.alternatives[0].transcript.encode("sjis"))
    pass

f.close()