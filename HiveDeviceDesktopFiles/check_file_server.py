import requests

url = 'http://your.server.device.ipAddress/BeeHiveInterface/check_hive_image.php'
with requests.Session() as s:
	parameters = {'hive_name': 'hive_x'}
	r = s.get(url, params=parameters)
	file_value = r.content

	if file_value == 'yes':
		print('yes')
	else:
		print('no')
		exec(open('get_image.py').read())