<html>
<head>
<title>Bienenstockwaage - Bee Hive Scale</title> 
<style> 
	body {margin: 1em;} 
	header {background: #eee; padding: 0.5em;} 
	article {margin: 0.5em; padding: 0.5em;} 
</style>
<script type="text/javascript"
  src="dygraph-combined.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
<!--meta http-equiv="refresh" content="120"; URL=""-->
<style type="text/css">
      /*
      NOTE: dygraphs does set some properties on the built-in legend, e.g.
      background-color and left. If you wish to override these, you can add
      "!important" to your CSS styles, as below.

      The full list of styles for which this is necessary are listed in
      plugins/legend.js. They are:
      o position
      o font-size
      o z-index
      o width
      o top
      o left
      o background
      o line-height
      o text-align
      o overflow
      */
      #div_g2 .dygraph-legend {
        width: 200px;
        background-color: transparent !important;
        left: 80px !important;
        }
	.dygraph-axis-label.dygraph-axis-label-y { color:green; }
	.dygraph-axis-label.dygraph-axis-label-y.dygraph-axis-label-y2 { color:purple; }
</style>
</head>
<body>
<header> 
	<a href="https://www.euse.de/wp/wp-content/uploads/2017/02/p1080858.jpeg"><image src="https://www.euse.de/wp/wp-content/uploads/2017/02/p1080858-150x150.jpeg" align="left" width="110" border="1"></a>
	<a href="http://www.euse.de/honig/beescale/latest.jpg"><image src="http://www.euse.de/honig/beescale/latest.jpg" align="right" height="107" border="1" alt="reload after a couple minutes" title="latest image from beecam"></a>
	<h3>Bienenstockwaage - Bee Hive Scale  ** Probebetrieb indoor mit Testgewicht **</h3>
	<small><?php
  $intervall = 2;  # aktueller wert des cronjobs zur datenerfassung (in minuten)
  #datei mit datenreihe oeffnen
  $datei = fopen("sensorik.csv","r") or die("Kann die Datei nicht aufmachen.");	
  // zeilen einlesen
  $oldlines = @file("sensorik.csv");
  $oldline = (count($oldlines)) ? $oldlines[count($oldlines)-1] : NULL;
  $status = substr($oldline, 0, 16);  			#zeitstempel letzte messung	
  $status_minute = substr($oldline, 14, 2);  		#minute letzte messung	
  $date = date('Y/m/d H:i'); 				#serverzeitstempel abgreifen
  $date_minute  = date('i'); 				#serverminute
  if(abs($date_minute-$status_minute) > $intervall)	# Messreihe unterbrochen?
    { 	echo "Der Datensammler scheint seit ",$status," UTC+1 <span style=\"color:red\"><b>offline</b></span>.<br>";
    	echo "Data collection seems <span style=\"color:red\"><b>offline</b></span> since ",$status," UTC+1."; }			
    else
    {	echo "Letzter Datenstand: <span style=\"color:green\"><b>",$status,"</b></span> UTC+1<br>";
    	echo "Last valid data: <span style=\"color:green\"><b>",$status,"</b></span> UTC+1";
    }			
  fclose($datei);
?></small>
</header>
<article>
<table><tr><td>
<!-- <div id="div_g2" style="width:1500px; height:400px; position:relative;"> -->
<div id="div_g2" style="position:absolute; left:10px; right:220px; top:170px; height:400px;">  
</td><td valign=top>
<!-- <div id="status" style="width:200px; font-size:1em; padding-top:5px;"></div> -->
<div id="status" style="width:200px; font-size:1em; padding-top:5px; position:absolute; align:right; right:0; top:170;"></div>
</td>
</tr>
</table>	

<script type="text/javascript">
  	  g2 = new Dygraph(
    	document.getElementById("div_g2"),
    	"sensorik.csv", // path to CSV file
	    	{			// options
    			visibility: [true, true, false, true, true, true, true, true, false, false],
				rollPeriod: 1,
                showRoller: true,
				colors: ['green', 'purple', 'grey', 'orange', 'brown', 'red', 'lime', 'olive', 'maroon', 'salmon'],
				strokeWidth: 2,
    			highlightCircleSize: 5,
    			labels: [ 'Date', 'Gewicht/Weight(kg) Hive1', 'Temperatur/e outside', 'Vin', 'Licht/Light', 'Gewicht/Weight(kg) Hive2', 'Temperatur/e inside', 'Humidity Hive1', 'Temperature Hive1', 'Humidity Hive2', 'Temperature Hive2' ],
    			labelsSeparateLines: true,
    			labelsDiv: document.getElementById('status'),
    			hideOverlayOnMouseOut: false,
    			yAxisLabelWidth: 60,
    			ylabel: '<small><span style="color:green">Gewicht/Weight (kg)</span> <span style="color:lime">Humidity (%)</span><br><span style="color:orange">Licht/Light</span></small>',
    			// valueRange: [0, 90],	//festeinstellung des wertebereichs
    			y2label: '<small><span style="color:red">Temperatur/e (°C)</span></small>',
    			showRangeSelector: true,
				rangeSelectorPlotFillColor: 'green',
				rangeSelectorPlotStrokeColor: 'green',
				series : {
             	 'Gewicht/Weight(kg) Hive1': {
               		 showInRangeSelector: true
            	  },
				 'Temperatur/e outside': {
               		 strokeWidth: 1,
               		 highlightCircleSize: 2.5,
               		 axis: 'y2'
            	  },
				 'Temperatur/e inside': {
               		 strokeWidth: 1,
               		 highlightCircleSize: 2.5,
               		 axis: 'y2'
            	  },
            	  'Vin': {
               		 strokeWidth: 1,
               		 highlightCircleSize: 2.5,
               		 axis: 'y2'
            	  },
		  		  'Licht/Light': {
               		 strokeWidth: 1,
               		 highlightCircleSize: 2.5,
            	  },
				  'Gewicht/Weight(kg) Hive2': {
               		 showInRangeSelector: true
            	  },
				  'Humidity Hive1': {
               		 strokeWidth: 1,
               		 highlightCircleSize: 2.5,
            	  },
				  'Temperature Hive1': {
               		 strokeWidth: 1,
               		 highlightCircleSize: 2.5,
               		 axis: 'y2'
            	  },
				  'Humidity Hive2': {
               		 strokeWidth: 1,
               		 highlightCircleSize: 2.5,
            	  },
				  'Temperature Hive2': {
               		 strokeWidth: 1,
               		 highlightCircleSize: 2.5,
               		 axis: 'y2'
            	  },
          	    },
          	    axes: {
				  y2: {
                	// set axis-related properties here
                	labelsKMB: true,
                	drawGrid: true,
                	independentTicks: true,
                	valueRange: [-11, 40],
                	gridLinePattern: [2,2]
              	  }
            	},
    			xlabel: 'Datum+Uhrzeit/Date+Time',
    			digitsAfterDecimal: '3',
				zoomCallback: function(minDate, maxDate, yRange) {
                	showDimensions(minDate, maxDate, yRange);
              	},
	    	} 
		);
		
	  g2.setAnnotations([			// Ab hier folgen die Anmerkungen
	      { series: 'Gewicht/Weight(kg) Hive1',
          x: Date.parse('2017/02/28 23:50:42'),
          shortText: '01',
          text: 'Erster per GSM/UMTS gesendeter Wert.' },
          { series: 'Gewicht/Weight(kg) Hive1',
          x: Date.parse('2015/10/16 09:50:14'),
          shortText: '20',
          text: 'Kontrollgewicht: 1.063kg' }
        ]);

    setStatus();					//fuer ein-/ausblenden von kurven
      function setStatus() {
        document.getElementById("visibility").innerHTML =
          g2.visibility().toString();
      }
      function change(el) {
        g2.setVisibility(parseInt(el.id), el.checked);
        setStatus();
      }
	  
      var minDate = g2.xAxisRange()[0];     //zoombuttons anfang
      var maxDate = g2.xAxisRange()[1];
      var minValue = g2.yAxisRange()[0];
      var maxValue = g2.yAxisRange()[1];
	  
      showDimensions(minDate, maxDate, [minValue, maxValue]);

      function showDimensions(minDate, maxDate, yRanges) {
        showXDimensions(minDate, maxDate);
        showYDimensions(yRanges);
      }
      function showXDimensions(first, second) {
        var elem = document.getElementById("xdimensions");
        elem.innerHTML = "dateWindow : [" + first + ", "+ second + "]";
      }
      function showYDimensions(ranges) {
        var elem = document.getElementById("ydimensions");
        elem.innerHTML = "valueRange : [" + ranges + "]";
      }
      function zoomGraphX(minDate, maxDate) {
        g2.updateOptions({
          dateWindow: [minDate, maxDate]
        });
        showXDimensions(minDate, maxDate);
      }
      function zoomGraphY(minValue, maxValue) {
        g2.updateOptions({
          valueRange: [minValue, maxValue]
        });
        showYDimensions(g2.yAxisRanges());
      }
      function unzoomGraph() {
        g2.updateOptions({
          dateWindow: null,
          valueRange: null
        });
      }
      function panEdgeFraction(value) {
        g2.updateOptions({ panEdgeFraction : value });
      }
      function zoomLastMonth() {
		g2.updateOptions({ dateWindow: null });
		var day = 86400000;  // milliseconds 
		var maxDate = g2.xAxisRange()[1];
		var last = maxDate-(30*day);
        g2.updateOptions({
          dateWindow: [last, maxDate]
        });
        showXDimensions(last, maxDate);
      }
	  function zoomLastWeek() {
		g2.updateOptions({ dateWindow: null });
		var day = 86400000;
		var maxDate = g2.xAxisRange()[1];
		var last = maxDate-(7*day);
        g2.updateOptions({
          dateWindow: [last, maxDate]
        });
        showXDimensions(last, maxDate);
      }
      function zoomLastDay() {
		g2.updateOptions({ dateWindow: null });
		var day = 86400000;
		var maxDate = g2.xAxisRange()[1];
		var last = maxDate-day;
        g2.updateOptions({
          dateWindow: [last, maxDate]
        });
        showXDimensions(last, maxDate);
      }
	  function zoomLast48() {
		g2.updateOptions({ dateWindow: null });
		var day = 86400000;
		var maxDate = g2.xAxisRange()[1];
		var last = maxDate-(2*day);
        g2.updateOptions({
          dateWindow: [last, maxDate]
        });
        showXDimensions(last, maxDate);
      }
	  function zoomLastMonth() {
		g2.updateOptions({ dateWindow: null });
		var day = 86400000;  // milliseconds 
		var maxDate = g2.xAxisRange()[1];
		var last = maxDate-(30*day);
        g2.updateOptions({
          dateWindow: [last, maxDate]
        });
        showXDimensions(last, maxDate);
      }										//zoombuttons ende
      
</script>

<script>									//zoom voreinstellung
	window.addEventListener("load", StartWithLastMonth);
	function StartWithLastMonth() {
		var day = 86400000;  // milliseconds 
		var maxDate = g2.xAxisRange()[1];
		var last = maxDate-(30*day);
        g2.updateOptions({
          dateWindow: [last, maxDate]
        });
        showXDimensions(last, maxDate);
      }
</script>

<div style="position:absolute; top:600;">
	  <table width=80%><tr><td>2016: <input type="button" value="Jan" onclick="zoomGraphX()">
      <input type="button" value="Feb" onclick="zoomGraphX()">
      <input type="button" value="Mar" onclick="zoomGraphX()">
      <input type="button" value="Apr" onclick="zoomGraphX()">
	  <input type="button" value="Mai" onclick="zoomGraphX()">
      <input type="button" value="Jun" onclick="zoomGraphX()">
      <input type="button" value="Jul" onclick="zoomGraphX()">
      <input type="button" value="Aug" onclick="zoomGraphX()">
	  <input type="button" value="Sep" onclick="zoomGraphX()">
	  <input type="button" value="Okt" onclick="zoomGraphX()">
	  <input type="button" value="Nov" onclick="zoomGraphX()">
	  <input type="button" value="Dez" onclick="zoomGraphX()"><br>
	  <input type="button" value="Letzter Monat/Past Month" onclick="zoomLastMonth()">&nbsp;
	  <input type="button" value="Letzte Woche/Past Week" onclick="zoomLastWeek()">&nbsp;
	  <input type="button" value="Letzte 48 Stunden/Past 48 Hours" onclick="zoomLast48()">&nbsp;
	  <input type="button" value="Letzte 24 Stunden/Past 24 Hours" onclick="zoomLastDay()">&nbsp;<br>
	  <input type="button" value="Feste Gewichtswerte-Skala/Fixed Weight Range: 40-70kg" onclick="zoomGraphY(40,70)">&nbsp;<br>
	  <input type="button" value="Unzoom" onclick="unzoomGraph()">&nbsp;</td>
      <td align=right><small><div id="xdimensions" style="color:grey;"></div> <div id="ydimensions" style="color:grey;"></div></small></td></tr>
<tr><td><p><b>Kurven anzeigen/Show Series:</b><br>
      Beute1/Hive1: <input type=checkbox id="0" checked onClick="change(this)">
      <label for="0"> <span style="color:green">Gewicht/Weight</span></label>
	  <input type=checkbox id="6" checked onClick="change(this)">
      <label for="6"> <span style="color:lime">Humidity</span></label>
      <input type=checkbox id="7" checked onClick="change(this)">
      <label for="6"> <span style="color:olive">Temperatur/e</span></label><br/>
	  Beute2/Hive2: <input type=checkbox id="4" checked onClick="change(this)">
      <label for="4"> <span style="color:brown">Gewicht/Weight</span></label>
      <input type=checkbox id="8" unchecked onClick="change(this)">
      <label for="8"> <span style="color:maroon">Humidity</span></label>
      <input type=checkbox id="9" unchecked onClick="change(this)">
      <label for="9"> <span style="color:salmon">Temperatur/e</span></label><br/>
	  <input type=checkbox id="1" checked onClick="change(this)">
      <label for="1"> <span style="color:purple">Temperatur/e outside</span></label><br> 
      <input type=checkbox id="5" checked onClick="change(this)">
      <label for="5"> <span style="color:red">Temperatur/e inside Arduino box</span></label><br>
	  <input type=checkbox id="3" checked onClick="change(this)">
      <label for="3"> <span style="color:orange">Licht/Light</span></label><br>
<!--  <input type=checkbox id="2" unchecked onClick="change(this)">
      <label for="2"> <span style="color:grey">Eingangsspannung/Voltage Vin</span></label><br/>-->
	  <br/></td>
<td><p><b>vergangene Jahre/past years:</b> <a href="http://wbk.in-berlin.de/wp/blog/2012/05/bienengewicht/#2012">2012</a> . <a href="http://wbk.in-berlin.de/wp/blog/2012/05/bienengewicht/#2013">2013</a> . <a href="http://www.euse.de/honig/beescale/graph2014-h.php">2014</a> . <a href="http://www.euse.de/honig/beescale/graph2015.php">2015</a> . <a href="http://www.euse.de/honig/beescale/graph2016.php">2016</a><br>
<b>unbereinigte Messwerte/unadjusted data:</b> <a href="http://www.euse.de/honig/beescale/graph2015_pure.php">2015</a> . <a href="http://www.euse.de/honig/beescale/graph2016_pure.php">2016</a> . <a href="http://www.euse.de/honig/beescale/graph_pure.php">2017</a><br>
<b><a href="#remarks">Anmerkungen/Remarks</a></b></p></td></tr></table>

<!--  <p><b>Bedienung:</b> Zoom: Klicken-Halten-Ziehen, Schieben: SHIFT-Klick-Ziehen, Reset: Doppelklick, gleitender Mittelwert: Anzahl der Punkte zur Berechnung links unten eintragen
	<br>
<b>Usage:</b> Zoom: click-drag, Pan: shift-click-drag, Restore: double-click, Rolling Average: Change count of rolling points in the box on the lower left   -->
<p><b>Aktualisierung:</b> In der Regel kommt alle 2 Minuten ein aktueller Wert automatisch zur <a href="sensorik.csv">Datenbasis</a> hinzu. Zum Aktualisieren der Kurve den Reload-Button des Browsers klicken oder die Tastenkombination Strg/Cmd+"r"!<br>
<b>Update:</b> The <a href="sensorik.csv">database</a> is automatically updated every 2 minutes. To update the chart, click the update button of your browser or the reload hotkey, commonly string/cmd+r!
	<br>
	<p><a href="http://wbk.in-berlin.de/wp/blog/2014/06/bienenwaage-testbetrieb/">Wie das im einzelnen funktioniert</a> und mehr im Projektblog unter <a href="http://wbk.in-berlin.de/wp/blog/series/bienenwaage/">"Bienenwaage"</a>. Alle Dateien auf <a href="https://github.com/bee-mois/beescale">GitHub</a>.
	<br>Find out <a href="http://wbk.in-berlin.de/wp/blog/2014/06/bienenwaage-testbetrieb/">how this is done</a> and more in the bee scale's project blog filed under <a href="http://wbk.in-berlin.de/wp/blog/series/bienenwaage/">"Bienenwaage"</a> (sorry, only in German). All files at <a href="https://github.com/bee-mois/beescale">GitHub</a>.<br><a name="remarks">
<br>
<br>
<p><small><center><b>Links</b><br>
Die gleichen Daten auf <a href="https://swarm.hiveeyes.org/grafana/dashboard/db/mois">Grafana</a>, der Plattform von <a href="https://community.hiveeyes.org/">Hiveeyes</a>, dem Zusammenschluss von Free&OpenSource-Bienenwaagen-EntwicklerInnen<br><br>
Ganz ähnliche, zum Teil abgeleitete Projekte mit teilweise wesentlich besserer Dokumentation:<br>
<a href="https://www.imker-nettetal.de/tag/stockwaage/">Imkerverein Nettetal</a><br>
<a href="http://beelogger.de/">Arduino Datenlogger für Imker und Bienenhalter</a><br>
<a href="http://www.imker-stockwaage.de">Imker Stockwaage</a><br>
</center></small></p>
<p><br><center><small><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons Lizenzvertrag" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Bienenstockwaage graph.php</span> von <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.euse.de" property="cc:attributionName" rel="cc:attributionURL">mois</a> ist lizenziert unter einer <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Namensnennung-<br>Nicht-kommerziell-Weitergabe unter gleichen Bedingungen 4.0 International Lizenz</a>.<br>
<span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Bee Hive Scale graph.php</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.euse.de" property="cc:attributionName" rel="cc:attributionURL">mois</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-<br>NonCommercial-ShareAlike 4.0 International License</a>.
<p>Kurvendarstellung durch <a href="http://dygraphs.com/">dygraphs</a> 1.1.1 Javascript-Charting-Bibliothek.<br>Chart rendered by <a href="http://dygraphs.com/">dygraphs</a> 1.1.1 javascript charting library.
<p>Dank an Clemens, Finn, Uli, Achim, Manu, Katinka, <a href="http://www.imker-nettetal.de/tag/stockwaage/">Alex</a>.<br>Credit is due to Clemens, Finn, Uli, Achim, Manu, Katinka, <a href="http://www.imker-nettetal.de/tag/stockwaage/">Alex</a>.</small><br><br>
<a href="http://wbk.in-berlin.de/wp/about/piwik-deaktivieren/"><img src="piwik_10640.png"></a><br>
<iframe style="border: 0; height: 105px; width: 320px;" src="http://www.euse.de/ignore.html"></iframe></center>
</article>
</div>

<!-- Piwik Image Tracker-->
<img src="http://wbk.in-berlin.de/piwik/piwik.php?idsite=1&rec=1&action_name=Beescale+live" style="border:0" alt="" />
<!-- End Piwik -->
</body>
</html>
