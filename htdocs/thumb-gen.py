#! python
#! usr/bin/python
from PIL import Image
import sys
import os
import re

path = ''
SIZE = (128, 128)

regex = re.compile('.*\.png|.*\.jpg|.*\.jpeg', re.I)
if len(sys.argv) >= 2:
	path = sys.argv[1]

	

def main():
	
	list = []
	
	if path == '':
		
		list = [ f for f in os.listdir() if os.path.isfile(f) and regex.match(f)]
		for f in list:
			createThumb(f)
	else:
		if path != '' and not os.path.exists(path):
			exit("Directory:" + path + " could not be found")
		list = [ f for f in os.listdir(path) if os.path.isfile(path + f) and regex.match(f)]
		for f in list:
			createThumb(f, path)
	
def createThumb(name, dir = ''):
	p = dir + "thumb/" 
	try:
		im = Image.open(dir + name)
	except:
		exit("Unable to load file " + dir + name)
	print("Generating thumbnail " + name + "...")
	im.thumbnail(SIZE)	
	print(name + "created")
	if not os.path.exists(p):
		os.mkdir(p)
	im.save(p + name)
	
main()	