from picamera import PiCamera
from picamera import Color
import time
import datetime as dt
import requests
import os

camera = PiCamera()
camera.resolution = (1000, 770)

camera.annotate_text_size = 55
camera.annotate_foreground = Color('black')
camera.annotate_background = Color('White')
camera.annotate_text = " Hive One " + dt.datetime.now().strftime('%Y-%m-%d %H:%M:%S') + " "
time.sleep(5)
camera.capture('/home/pi/Desktop/hive_one.jpg')


url = 'http://your.server.device.ipAddress/BeeHiveInterface/add_image.php'
path = '/home/pi/Desktop/hive_one.jpg'
with open(path, 'rb') as img:
  name_img= os.path.basename(path)
  files= {'file': ('hive_one.jpg',img,'multipart/form-data',{'Expires': '0'}) }
  with requests.Session() as s:
    r = s.post(url,files=files)
    print(r.content)


