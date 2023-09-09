#!/bin/bash

# Gehe zum Verzeichnis mit den Bildern
cd /home/ftp-bee/ftp/upload

# Füge in den Bildern der D-Link-Cam Zeitstempel ein
./insert-timestamp.sh

# Benenne Bilder von b-cam[1|2] um
rename 's/^b-cam1_([0-9]{8})([0-9]{6})([0-9]{2})\.jpg/b-cam1_$1-$2.jpg/' b-cam1_*.jpg
rename 's/^snapshot-([0-9]{4})-([0-9]{2})-([0-9]{2})-([0-9]{2})-([0-9]{2})-([0-9]{2})\.jpg/b-cam2_$1$2$3-$4$5$6.jpg/' snapshot-*.jpg

# Aktualisiere latest*.jpg mit der neuesten Datei
bc1=$(ls -t b-cam1* | head -n1)
cp -p -f -- "$bc1" latest_b-cam1.jpg
bc2=$(ls -t b-cam2* | head -n1)
cp -p -f -- "$bc2" latest_b-cam2.jpg

# push latest jpgs to the webserver
scp latest*.jpg wbk_b-upload:/home/user/wbk/websites/euse.de/honig/beescale/

# rsync weewx-files from b-wetterbot
rsync -a -e 'ssh -p 22444 -i /path/to/privat/key' pi@localhost:/var/weewx/reports/ /home/me/tmp/weewx/
# rsync weewx-files with webserver
rsync -a -e 'ssh -i /path/to/privat/key' /home/me/tmp/weewx/ wbk@kudu.in-berlin.de:/home/user/wbk/websites/euse.de/weewx/

# Lösche Bilder, die älter als zwei Tage sind
find . -type f -name '*.jpg' -atime +2 -delete
