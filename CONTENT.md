## Content of the repository

- deprecated: Folder OpenWrt: config and other custom beescale files of <a href="http://www.dragino.com/products/yunshield/item/105-yun-shield-v2-4.html">dragino yun shield's</a> linux component running openwrt.
    - <a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/latest.sh">latest.sh</a>: shell script that produces latest.jpg from most recent date-stamp-named-snapshot of usb webcam driven by mjpg_streamer.
    - <a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/wan-watchdog.sh">wan-watchdog.sh</a>: shell script that checks connection from yun to web server and restarts connections if necessary. run by yun's cron.
- beescale-yun-2022: arduino yun firmware/"sketch". Better get it from the hiveeyes repo: <a href="https://github.com/hiveeyes/arduino/tree/master/node-yun-http">node-yun-http.ino</a>
- beescale-yun-ds18b20-two_load_cells-dht22-switch-sd-lux-lite: old arduino yun firmware/"sketch" with DHT22 and an ugly hardware workaround based on a relay to reset a sensor pin if that blocks the sketch. kept only for historical reasons (as with the corresponding <a href="https://community.hiveeyes.org/uploads/default/original/2X/8/81da7e7071ffde2d9376e43f5deede5134a74c82.jpeg">wiring hand sketch</a>).
- <a href="https://github.com/bee-mois/beescale/blob/master/add_line2.php">add_line2.php</a>: collects data and writes to databases.
- <a href="https://github.com/bee-mois/beescale/blob/master/graph.php">graph.php</a>: creates visible representations (charts) based on <a href="http://dygraphs.com/">dygraphs</a> js-framework.
- <a href="https://github.com/bee-mois/beescale/blob/master/graph_pure.php">graph_pure.php</a>: creates visible representation (charts) with the raw data, no spikes eliminated, based on <a href="http://dygraphs.com/">dygraphs</a> js-framework.
- deprecated: [<a href="https://github.com/bee-mois/beescale/blob/master/latest.sh">latest.sh</a>: shell script that downloads beecam-image from arduino yun's sd-card, processes it with a timestamp of creation date (imagemagick) and saves it on web-server as <a href="http://www.euse.de/honig/beescale/latest.jpg">latest.jpg</a> for display on web page.] this right now is implemented by a retail ip camera, that uploads images to an ftp-server and a bash-script there that gets them to the right directory on the web server.
- <a href="https://github.com/bee-mois/beescale/blob/master/sensorik.csv">sensorik.csv</a>: example flat file database file.
- <a href="https://github.com/bee-mois/beescale/blob/master/sensorik_pure.csv">sensorik_pure.csv</a>: example flat file database file with uncorrected raw data.