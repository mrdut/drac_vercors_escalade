#!/usr/bin/python

from PIL import Image, ImageOps
import glob, os


thumbnailSize = (400, 200)
webSize = (1000, 800)

for infile in glob.glob("*.jpg"):
    file, ext = os.path.splitext(infile)
    img = Image.open(infile)
    thumb = ImageOps.fit(img, thumbnailSize, Image.ANTIALIAS, (0.5, 0.5))
    thumb.save("thumbnails/" + file + ".jpg", "JPEG")

    # resize original images for web display
    width = img.size[0]
    height = img.size[1]
    portrait = img.size[0] > img.size[1]
    ratio = width / float(height)
    if (portrait):
        width = min(webSize[0], img.size[0])
        height = int(width / float(ratio))
    else:
        height = min(webSize[1],  img.size[1])
        width = int(ratio * height)

    print file + " : resize from " + str(img.size) + " to " + str((width, height))

    dst = img.resize((width, height), Image.ANTIALIAS)
    dst.save("resized/" + file + ".jpg", "JPEG")
