# beescale

This is the place to collect my scripts for the <a href="http://www.euse.de/honig/beescale/graph.php">beescale</a>, that are not (yet) incorporatet into <a href="https://github.com/hiveeyes/arduino">hiveeyes</a>.

<h3>Content</h3>
<ul>
<li>Folder OpenWrt: config-files of <a href="http://www.dragino.com/products/yunshield/item/105-yun-shield-v2-4.html">dragino yun shield's</a> linux component running openwrt (to come!)
<li><a href="https://github.com/bee-mois/beescale/blob/master/beescale-yun-ds18b20-two_load_cells-dht22-switch-sd-lux-lite">beescale-yun-ds18b20-two_load_cells-dht22-switch-sd-lux-lite</a>: arduino yun firmware/"sketch").
<li><a href="https://github.com/bee-mois/beescale/blob/master/add_line2.php">add_line2.php</a>: collects data and writes to databases.
<li><a href="https://github.com/bee-mois/beescale/blob/master/graph.php">graph.php</a>: creates visible representations (charts) based on <a href="http://dygraphs.com/">dygraphs</a> js-framework.
<li><a href="https://github.com/bee-mois/beescale/blob/master/graph_pure.php">graph_pure.php</a>: creates visible representation (charts) with the raw data, no spikes eliminated, based on <a href="http://dygraphs.com/">dygraphs</a> js-framework.
<li><a href="https://github.com/bee-mois/beescale/blob/master/latest.sh">latest.sh</a>: shell script that downloads beecam-image from arduino yun's sd-card, processes it with a timestamp of creation date (imagemagick) and saves it on web-server as <a href="http://www.euse.de/honig/beescale/latest.jpg">latest.jpg</a> for display on web page.
<li><a href="https://github.com/bee-mois/beescale/blob/master/sensorik.csv">sensorik.csv</a>: example flat file database file.
<li><a href="https://github.com/bee-mois/beescale/blob/master/sensorik_pure.csv">sensorik_pure.csv</a>: example flat file database file with uncorrected raw data.
</ul>
