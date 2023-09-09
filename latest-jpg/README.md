Three files on noho.st to get pictures from two local webcams to the web server:
/etc/systemd/system/latest-jpg.service
    /home/ftp-bee/ftp/latest-jpg.sh
        /home/ftp-bee/ftp/upload/insert-timestamp.sh

also needed:
apt install rename
systemctl enable latest-jpg.service
systemctl start latest-jpg.service
crontab -e      # remove old crontab from latest.sh
sudo crontab -e # start service only in daylight
    30 4 * * * systemctl start latest-jpg.service  # start 4.30
    30 20 * * * systemctl stop latest-jpg.service  # stop 20.30
