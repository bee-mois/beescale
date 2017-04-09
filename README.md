# beescale

This is the place to collect my scripts for the <a href="http://www.euse.de/honig/beescale/graph.php">beescale</a>, that are not (yet) incorporatet into <a href="https://github.com/hiveeyes/arduino">hiveeyes</a>. For more prose about the beescale <a href="http://www.euse.de/wp/blog/series/bienenwaage2/">see the blog</a> (only in German language).

## Data Stream
The data source is a sensor node consisting of an [Arduino Uno](https://www.arduino.cc/en/Main/ArduinoBoardUno/) with a [Dragino Yun Shield 2.4](http://www.dragino.com/products/yunshield/item/105-yun-shield-v2-4.html) ontop running OpenWrt. OpenWrt's mjpg_streamer collects the beecam image every 15 minutes and saves it to the Yun's SD card. The [Arduino firmware](https://github.com/hiveeyes/arduino/tree/master/node-yun-http) is periodically collecting the data from all the sensors, writes it  to the Yun Shield's SD card for backup purposes and passes it via HTTP Push over an USB connected GSM dongle (no Wlan nor [Freifunk](https://berlin.freifunk.net/) nearby!) through OpenVPN to a [php-script](https://github.com/bee-mois/beescale/blob/master/add_line2.php) at in-berlin.de. A [OpenWrt watchdog](https://github.com/bee-mois/beescale/blob/master/OpenWrt/wan-watchdog.sh)  is reconnecting all network interfaces if GSM or VPN fail to connect. The script at in-berlin.de writes the data to two different databases: First a flatfile database (csv) right on the server and second [via HTTP GET](https://community.hiveeyes.org/t/daten-per-http-und-php-ans-backend-auf-swarm-hiveeyes-org-ubertragen/162) to [Kotori](https://hiveeyes.org/docs/kotori/) at swarm.hiveeyes.org. A cron job at the webserver on in-berlin.de sucks the latest image from the Yun's SD card every 15 minutes. The flatfile is [visualized](http://www.euse.de/honig/beescale/graph.php) by [graph.php](https://github.com/bee-mois/beescale/blob/master/graph.php), which is relying on dygraphs, a  js charts framework. This graph is cleaned, completed and repaired manually every once in a while. A [Raw data graph](http://www.euse.de/honig/beescale/graph_pure.php) is also available. This is the historical and stabel approach. Kotori however is administrating a source gateway and routes the data into the time series database [influxDB](https://influxdata.com/). [Grafana](http://grafana.org/) is getting the data from there and displays them in a what ever way you like. Hiveeyes is the experimental and tendsetting approach. All files at [Github](https://github.com/bee-mois/beescale/blob/master/README.md).

<h3>Content</h3>
<ul>
<li>Folder OpenWrt: config and other custom beescale files of <a href="http://www.dragino.com/products/yunshield/item/105-yun-shield-v2-4.html">dragino yun shield's</a> linux component running openwrt.
    <ul>
    <li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/latest.sh">latest.sh</a>: shell script that produces latest.jpg from most recent date-stamp-named-snapshot of usb webcam driven by mjpg_streamer. 
    <li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/wan-watchdog.sh">wan-watchdog.sh</a>: shell script that checks connection from yun to web server and restarts connections if necessary. run by yun's cron.
    </ul>
<li>beescale-yun-ds18b20-two_load_cells-dht22-switch-sd-lux-lite: arduino yun firmware/"sketch". Better get it from the hiveeyes repo: <a href="https://github.com/hiveeyes/arduino/tree/master/node-yun-http">node-yun-http.ino</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/add_line2.php">add_line2.php</a>: collects data and writes to databases.
<li><a href="https://github.com/bee-mois/beescale/blob/master/graph.php">graph.php</a>: creates visible representations (charts) based on <a href="http://dygraphs.com/">dygraphs</a> js-framework.
<li><a href="https://github.com/bee-mois/beescale/blob/master/graph_pure.php">graph_pure.php</a>: creates visible representation (charts) with the raw data, no spikes eliminated, based on <a href="http://dygraphs.com/">dygraphs</a> js-framework.
<li><a href="https://github.com/bee-mois/beescale/blob/master/latest.sh">latest.sh</a>: shell script that downloads beecam-image from arduino yun's sd-card, processes it with a timestamp of creation date (imagemagick) and saves it on web-server as <a href="http://www.euse.de/honig/beescale/latest.jpg">latest.jpg</a> for display on web page.
<li><a href="https://github.com/bee-mois/beescale/blob/master/sensorik.csv">sensorik.csv</a>: example flat file database file.
<li><a href="https://github.com/bee-mois/beescale/blob/master/sensorik_pure.csv">sensorik_pure.csv</a>: example flat file database file with uncorrected raw data.
</ul>
