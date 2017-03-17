<html>
<head>
<title>Bienenstockwaage (unbereinigte Messwerte) - Bee Hive Scale (unadjusted data)</title> 
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
	<h3>Bienenstockwaage (unbereinigte Messwerte) - Bee Hive Scale (unadjusted data)</h3> 
	<small><?php
  $intervall = 2;  # aktueller wert des cronjobs zur datenerfassung (in minuten)
  #datei mit datenreihe oeffnen
  $datei = fopen("sensorik_pure.csv","r") or die("Kann die Datei nicht aufmachen.");	
  // zeilen einlesen
  $oldlines = @file("sensorik_pure.csv");
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
    <div id="div_g2" style="width:1000px; height:400px; position:relative;">    
    </td><td valign=top>
    <div id="status" style="width:200px; font-size:1em; padding-top:5px;"></div>
    </td>
    </tr>
</table>	

<script type="text/javascript">
  	  g2 = new Dygraph(
    	document.getElementById("div_g2"),
    	"sensorik_pure.csv", // path to CSV file
	    	{			// options
    			visibility: [true, true, false, true, true, true],
    			rollPeriod: 1,
                showRoller: true,
    			colors: ['green', 'purple', 'grey', 'orange', 'brown', 'red'],
    			strokeWidth: 2,
    			highlightCircleSize: 5,
    			labels: [ 'Date', 'Gewicht/Weight(kg) Hive1', 'Temperatur/e outside', 'Vin', 'Licht/Light', 'Gewicht/Weight(kg) Hive2', 'Temperatur/e inside' ],
    			labelsSeparateLines: true,
    			labelsDiv: document.getElementById('status'),
    			hideOverlayOnMouseOut: false,
    			yAxisLabelWidth: 60,
    			ylabel: '<span style="color:green">Gewicht/Weight (kg)</span>',
    			// valueRange: [0, 80],	//festeinstellung des wertebereichs
    			y2label: '<span style="color:red">Temperatur/e (°C)</span><br><span style="color:orange">Licht/Light</span><br><span style="color:grey">Voltage Vin (V)</span>',
    			series : {
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
               		 axis: 'y2'
            	  },
          	    },
          	    axes: {
				  y2: {
                	// set axis-related properties here
                	labelsKMB: true,
                	drawGrid: true,
                	independentTicks: true,
                	// valueRange: [-15, 35],
                	gridLinePattern: [2,2]
              	  }
            	},
    			xlabel: 'Datum+Uhrzeit/Date+Time',
    			digitsAfterDecimal: '3',
	    	} 
		);
		
	  g2.setAnnotations([			// Ab hier folgen die Anmerkungen
	    { series: 'Temperatur/e',
          x: Date.parse('2014/07/20 18:55:47'),
          shortText: '01',
          text: 'Temperatursensor ist jetzt nicht mehr in der Tupperdose beim Arduino, sondern an der frischen Luft über dem Flugloch.' },
          { series: 'Gewicht/Weight(kg)',
          x: Date.parse('2014/07/20 18:44:48'),
          shortText: '02',
          text: 'Einmaliger Messtest mit zusätzlichen 1100,4g Testgewicht.' },
          { series: 'Gewicht/Weight(kg)',
          x: Date.parse('2014/07/24 22:55:12'),
          shortText: '03',
          text: 'Zwei Tage mit viel Regen.' },
          { series: 'Gewicht/Weight(kg)',
          x: Date.parse('2014/08/04 08:56:39'),
          shortText: '04',
          text: 'Honigernte: etwa 15,4kg Honig und Wachs.' },
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
      
</script>
<p><b>Kurven anzeigen/Show Series:</b><br>
      <input type=checkbox id="0" checked onClick="change(this)">
      <label for="0"> <span style="color:green">Gewicht/Weight Hive1</span></label>
	  <input type=checkbox id="4" checked onClick="change(this)">
      <label for="4"> <span style="color:brown">Gewicht/Weight Hive2</span></label><br>
      <input type=checkbox id="1" checked onClick="change(this)">
      <label for="1"> <span style="color:purple">Temperatur/e outside</span></label><br> 
      <input type=checkbox id="5" checked onClick="change(this)">
      <label for="5"> <span style="color:red">Temperatur/e inside</span></label> <br>
      <input type=checkbox id="3" checked onClick="change(this)">
      <label for="3"> <span style="color:orange">Licht/Light</span></label><br>
      <input type=checkbox id="2" unchecked onClick="change(this)">
      <label for="2"> <span style="color:grey">Eingangsspannung/Voltage Vin</span></label><br/>
<br/>

<p><b>Bedienung:</b> Zoom: Klicken-Halten-Ziehen, Schieben: SHIFT-Klick-Ziehen, Reset: Doppelklick, gleitender Mittelwert: Anzahl der Punkte zur Berechnung links unten eintragen
	<br>
<b>Usage:</b> Zoom: click-drag, Pan: shift-click-drag, Restore: double-click, Rolling Average: Change count of rolling points in the box on the lower left
<p><b>Aktualisierung:</b> In der Regel kommt alle 2 Minuten ein aktueller Wert automatisch zur <a href="sensorik_pure.csv">Datenbasis</a> hinzu. Zum Aktualisieren der Kurve den Reload-Button des Browsers klicken oder die Tastenkombination Strg/Cmd+"r"!<br>
<b>Update:</b> The <a href="sensorik_pure.csv">database</a> is automatically updated every 2 minutes. To update the chart, click the update button of your browser or the reload hotkey, commonly string/cmd+r!
	<br>	
	<p><a href="http://wbk.in-berlin.de/wp/blog/2014/06/bienenwaage-testbetrieb/">Wie das im einzelnen funktioniert</a> und mehr im Projektblog unter <a href="http://wbk.in-berlin.de/wp/blog/series/bienenwaage/">"Bienenwaage"</a>.
	<br>Find out <a href="http://wbk.in-berlin.de/wp/blog/2014/06/bienenwaage-testbetrieb/">how this is done</a> and more in the bee scale's project blog filed under <a href="http://wbk.in-berlin.de/wp/blog/series/bienenwaage/">"Bienenwaage"</a> (sorry, only in German).
	<p><br><br><center><small><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons Lizenzvertrag" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Bienenstockwaage graph.php</span> von <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.euse.de" property="cc:attributionName" rel="cc:attributionURL">mois</a> ist lizenziert unter einer <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Namensnennung-<br>Nicht-kommerziell-Weitergabe unter gleichen Bedingungen 4.0 International Lizenz</a>.<br>
<span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Bee Hive Scale graph.php</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.euse.de" property="cc:attributionName" rel="cc:attributionURL">mois</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-<br>NonCommercial-ShareAlike 4.0 International License</a>.
<p>Kurvendarstellung durch <a href="http://dygraphs.com/">dygraphs</a> Javascript-Charting-Bibliothek.<br>Chart rendered by <a href="http://dygraphs.com/">dygraphs</a> javascript charting library.
<p>Dank an Clemens, Finn, Uli, Achim, Manu, Katinka.<br>Credit is due to Clemens, Finn, Uli, Achim, Manu, Katinka.</small><br><br>
<a href="http://wbk.in-berlin.de/wp/about/piwik-deaktivieren/"><img src="piwik_10640.png"></a><br>
<iframe style="border: 0; height: 100px; width: 320px;" src="http://www.euse.de/ignore.html"></iframe></center>
</article>
<!-- Piwik Image Tracker-->
<img src="http://wbk.in-berlin.de/piwik/piwik.php?idsite=1&rec=1&action_name=Beescale+unadjusted" style="border:0" alt="" />
<!-- End Piwik -->
</body>
</html>
