import os
import sys

value = sys.argv[1]

if value == 'hourly':
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_one.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_one.jpg")
        
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_two.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_two.jpg")
        
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_three.jpg"): #I made an edit here typo "hivw" to "hive"
	os.remove("/var/www/html/BeeHiveInterface/images/hive_three.jpg")
        
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_four.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_four.jpg")
        
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_five.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_five.jpg")
        
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_six.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_six.jpg")


if value == 'daily':
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_08.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_08.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_09.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_09.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_10.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_10.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_11.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_11.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_12.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_12.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_13.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_13.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_14.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_14.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_15.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_15.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_16.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_16.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_17.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_17.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_18.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_18.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_19.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_19.jpg")
    
    if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_20.jpg"):
	os.remove("/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_20.jpg")
