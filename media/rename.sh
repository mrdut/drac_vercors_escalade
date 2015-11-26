#!/bin/sh

for file in *.JPG
do 
    count=$((count+1));
    filename="open_bloc_grenoble_$count.jpg";
    #echo "Rename [$file] to [$filename]";
    mv $file $filename;
done
