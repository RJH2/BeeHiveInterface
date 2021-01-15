

import sys
import os
from PIL import Image

# Determine if the images that are to be used to make the combination image exist.
# If the image exist set the variable to their location.
# If the image does not exist set the variable to the location of the placeholder image.
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_one.jpg"):
	hive_one = Image.open('/var/www/html/BeeHiveInterface/images/hive_one.jpg')
else:
	hive_one = Image.open('/var/www/html/BeeHiveInterface/images/no_image_available/no_image_available.jpg')

if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_two.jpg"):
	hive_two = Image.open('/var/www/html/BeeHiveInterface/images/hive_two.jpg')
else:
	hive_two = Image.open('/var/www/html/BeeHiveInterface/images/no_image_available/no_image_available.jpg')

if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_three.jpg"):
	hive_three =Image.open('/var/www/html/BeeHiveInterface/images/hive_three.jpg')
else:
	hive_three = Image.open('/var/www/html/BeeHiveInterface/images/no_image_available/no_image_available.jpg')

if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_four.jpg"):
	hive_four =Image.open('/var/www/html/BeeHiveInterface/images/hive_four.jpg')
else:
	hive_four = Image.open('/var/www/html/BeeHiveInterface/images/no_image_available/no_image_available.jpg')

if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_five.jpg"):
	hive_five =Image.open('/var/www/html/BeeHiveInterface/images/hive_five.jpg')
else:
	hive_five = Image.open('/var/www/html/BeeHiveInterface/images/no_image_available/no_image_available.jpg')

if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_six.jpg"):
	hive_six =Image.open('/var/www/html/BeeHiveInterface/images/hive_six.jpg')
else:
	hive_six = Image.open('/var/www/html/BeeHiveInterface/images/no_image_available/no_image_available.jpg')
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_seven.jpg"):
	hive_seven =Image.open('/var/www/html/BeeHiveInterface/images/hive_seven.jpg')
else:
	hive_seven = Image.open('/var/www/html/BeeHiveInterface/images/no_image_available/no_image_available.jpg')
if os.path.exists("/var/www/html/BeeHiveInterface/images/apiary_camera.jpg"):
	apiary_camera =Image.open('/var/www/html/BeeHiveInterface/images/apiary_camera.jpg')
else:
	apiary_camera = Image.open('/var/www/html/BeeHiveInterface/images/no_image_available/no_image_available.jpg')

# Function to generate the combination image.
def generate_hive_image(hive_one, hive_two, hive_three, hive_four, hive_five, hive_six, hive_seven, apiary_camera): 
    dst = Image.new('RGB', (hive_one.width * 4, hive_one.height * 2))
    dst.paste(hive_one, (0, 0))
    dst.paste(hive_two, (hive_one.width, 0))
    dst.paste(hive_three, (hive_one.width * 2, 0))
    dst.paste(hive_four, (hive_one.width * 3, 0))
    dst.paste(hive_five, (0, hive_one.height))
    dst.paste(hive_six, (hive_one.width, hive_one.height))
    dst.paste(hive_seven, (hive_one.width * 2, hive_one.height))
    dst.paste(apiary_camera, (hive_one.width * 3, hive_one.height))
    return dst

# Store the time value sent from the command.
time_value = sys.argv[1]
print time_value

# Generate the combination image.
generate_hive_image(hive_one, hive_two, hive_three, hive_four, hive_five, hive_six, hive_seven, apiary_camera).save('/var/www/html/BeeHiveInterface/images/hive_image_total/hive_image_total_' + time_value + '.jpg')


# Delete image files once the combination image has been generated (Check to see if the files exist before removing files).
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_one.jpg") :
	os.remove("/var/www/html/BeeHiveInterface/images/hive_one.jpg")
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_two.jpg") :
	os.remove("/var/www/html/BeeHiveInterface/images/hive_two.jpg")
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_three.jpg") :
	os.remove("/var/www/html/BeeHiveInterface/images/hive_three.jpg")
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_four.jpg") :
	os.remove("/var/www/html/BeeHiveInterface/images/hive_four.jpg")
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_five.jpg") :
	os.remove("/var/www/html/BeeHiveInterface/images/hive_five.jpg")
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_six.jpg") :
	os.remove("/var/www/html/BeeHiveInterface/images/hive_six.jpg")
if os.path.exists("/var/www/html/BeeHiveInterface/images/hive_seven.jpg") :
	os.remove("/var/www/html/BeeHiveInterface/images/hive_seven.jpg")
if os.path.exists("/var/www/html/BeeHiveInterface/images/apiary_camera.jpg") :
	os.remove("/var/www/html/BeeHiveInterface/images/apiary_camera.jpg")





