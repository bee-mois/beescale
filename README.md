# beescale

This is the place to collect my scripts for the <a href="http://www.euse.de/honig/beescale/graph.php">beescale</a>, that are not (yet) incorporatet into <a href="https://github.com/hiveeyes/arduino">hiveeyes</a>. For more prose about the beescale <a href="http://www.euse.de/wp/blog/series/bienenwaage2/">see the blog</a> (only in German language).

<h3>Content</h3>
<ul>
<li>Folder OpenWrt: config and other custom beescale files of <a href="http://www.dragino.com/products/yunshield/item/105-yun-shield-v2-4.html">dragino yun shield's</a> linux component running openwrt.
    <ul>
    <li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/latest.sh">latest.sh</a>: shell script that produces latest.jpg from most recent date-stamp-named-snapshot of usb webcam driven by mjpg_streamer. 
    <li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/wan-watchdog.sh">wan-watchdog.sh</a>: shell script that checks connection from yun to web server and restarts connections if necessary. run by yun's cron.
    </ul>
<li><a href="https://github.com/bee-mois/beescale/blob/master/beescale-yun-ds18b20-two_load_cells-dht22-switch-sd-lux-lite">beescale-yun-ds18b20-two_load_cells-dht22-switch-sd-lux-lite</a>: arduino yun firmware/"sketch").
<li><a href="https://github.com/bee-mois/beescale/blob/master/add_line2.php">add_line2.php</a>: collects data and writes to databases.
<li><a href="https://github.com/bee-mois/beescale/blob/master/graph.php">graph.php</a>: creates visible representations (charts) based on <a href="http://dygraphs.com/">dygraphs</a> js-framework.
<li><a href="https://github.com/bee-mois/beescale/blob/master/graph_pure.php">graph_pure.php</a>: creates visible representation (charts) with the raw data, no spikes eliminated, based on <a href="http://dygraphs.com/">dygraphs</a> js-framework.
<li><a href="https://github.com/bee-mois/beescale/blob/master/latest.sh">latest.sh</a>: shell script that downloads beecam-image from arduino yun's sd-card, processes it with a timestamp of creation date (imagemagick) and saves it on web-server as <a href="http://www.euse.de/honig/beescale/latest.jpg">latest.jpg</a> for display on web page.
<li><a href="https://github.com/bee-mois/beescale/blob/master/sensorik.csv">sensorik.csv</a>: example flat file database file.
<li><a href="https://github.com/bee-mois/beescale/blob/master/sensorik_pure.csv">sensorik_pure.csv</a>: example flat file database file with uncorrected raw data.
</ul>
