#!/bin/sh
# run by cron with crontab -e entry
# */15 * * * * /home/www/wbk/euse.de/honig/beescale/latest.sh >/dev/null 2>&1
cd /home/www/wbk/euse.de/honig/beescale
wget --no-proxy wget.log http://wbk.in-vpn.de/sd/[path to webcam folder]/latest.jpg -O latest_new.jpg
if [ cmp -s latest.jpg latest_new.jpg ] ; then
        rm latest_new.jpg
else
	date=$(stat latest_new.jpg | grep Modify | cut -d ' ' -f 2,3 | cut -d ':' -f1,2)
	convert latest_new.jpg -gravity SouthEast -pointsize 11 -fill white -annotate +5+5 "$date" latest.jpg
      	rm latest_new.jpg
fi
exit 0
