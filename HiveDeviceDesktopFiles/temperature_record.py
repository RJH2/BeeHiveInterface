import os
import time
import requests

os.system('modprobe w1-gpio')
os.system('modprobe w1-therm')

hive_id = ENTER_HIVE_ID

base_dir = '/sys/bus/w1/devices/'
sensor_value = '28-01191be67995'
device_file = base_dir + sensor_value + '/w1_slave'

def read_temp_raw():
    f = open(device_file, 'r')
    lines = f.readlines()
    f.close()
    return lines

def read_temp():
    lines = read_temp_raw()
    while lines[0].strip()[-3:] != 'YES':
        time.sleep(0.2)
        lines = read_temp_raw()
    equals_pos = lines[1].find('t=')
    if equals_pos != -1:
        temp_string = lines[1][equals_pos+2:]
        temp_c = float(temp_string) / 1000.0
        temp_f = temp_c * 9.0 / 5.0 + 32.0
        return temp_f
    
temperature = read_temp()
url = 'http://your.server.device.ipAddress/BeeHiveInterface/record_temperature.php'	
myobject = {'hive_id':hive_id, 'temperature_value':temperature}
requests.post(url, data = myobject)




