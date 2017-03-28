#!/bin/sh
# produces latest.jpg from most recent date-stamp-named-snapshot
# run by mjpg_streamer's -c parameter every -d milliseconds:
# mjpg_streamer -i "input_uvc.so -d /dev/video0 -r 320x240 -q 75 -y" -o "output_file.so -f /mnt/sda1/arduino/www/[path to webcam folder]/ -d 900000 -s 1000000 -c /root/latest.sh"
cd /mnt/sda1/arduino/www/webcam/
fn=$(ls -t | head -n1)
cp -f -- "$fn" latest.jpg
