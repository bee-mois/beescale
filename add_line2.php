<?php
# Bee Hive Scale add_line2.php von mois ist lizenziert unter einer Creative Commons 
# Namensnennung - Nicht-kommerziell - Weitergabe unter gleichen Bedingungen 4.0 International Lizenz.
# Bee Hive Scale add_line2.php by mois is licensed under a Creative Commons 
# Attribution-NonCommercial-ShareAlike 4.0 International License.
#
include("hiveeyes.php");
use Hiveeyes\HiveeyesNode;
# Create a "Node API" telemetry client object
$telemetry = new HiveeyesNode(
    array(
        "network"   => "27041c2a-8afd-4a1e-b3ae-44233fa1f06b",
        "gateway"   => "mois",
        "node"      => "yun",
    )
);
# lokale datei mit datenreihe oeffnen
$datei = fopen("sensorik.csv","a+") or die("Kann die Datei nicht aufmachen.");	
$datei_pure = fopen("sensorik_pure.csv","a+") or die("Kann die Datei nicht aufmachen.");	
# letzte zeile einlesen:
	$oldlines = @file("sensorik.csv");
	$oldline = (count($oldlines)) ? $oldlines[count($oldlines)-1] : NULL;
	$array_oldline = explode(",",$oldline);	# letzte datenzeile am komma auftrennen und in array speichern
	$oldlux = $array_oldline[4];		# letzte helligkeit einlesen
$date = date('Y/m/d H:i:s'); 			# serverzeitstempel abgreifen
$kiste1 = round($_GET["weight1"], 2);		# variable aus der url einlesen
$temp = round($_GET["temp1"], 1);		# outside
$vcc = $_GET["vcc"];
$v = $vcc/1000;
$l = $_GET["lux"];
if ($l > 65509 && $l < 65546)			# auf ausreißer prüfen
	{  $l = $oldlux;	}
//	   $lux = $l * 0.1;			# darstellungsgruende: lux-kurve um faktor 10 gestaucht
$lux = 0.5 * round(sqrt($l), 2);		# darstellungsgruende: lux-kurve in quadratwurzel gestaucht und halbiert
$kiste2 = round($_GET["weight2"], 2);
$temp01 = round($_GET["temp2"], 1);		# inside
$h1 = $_GET["h1"];
$t1 = $_GET["t1"];
$h2 = $_GET["h2"];
$t2 = $_GET["t2"];
$line = "\n".$date.",".$kiste1.",".$temp.",".$v.",".$lux.",".$kiste2.",".$temp01.",".$h1.",".$t1.",".$h2.",".$t2;	#datensatz zusammenstellen
$line_pure = "\n".$date.",".$kiste1.",".$temp.",".$v.",".$l.",".$kiste2.",".$temp01.",".$h1.",".$t1.",".$h2.",".$t2;
fwrite($datei_pure, $line_pure);		# unbereinigte daten in sensorik_pure.csv schreiben
fwrite($datei, $line);	
echo $date,": addline2.php returns: OK\r\n";	# ...und gespeichert.
fclose($datei);					# datei mit datenreihe schliessen
fclose($datei_pure);
# Transmit dataset to hiveeyes
$data = array("weight hive1" => $kiste1, "temperature hive1" => $t1, "humidity hive1" => $h1, "weight hive2" => $kiste2, "temperature hive2" => $t2, "humidity hive2" => $h2, "temperature outside" => $temp, "temperature inside" => $temp01, "brightness" => $lux);
$telemetry->transmit($data);
# fetch latest image from beecam
exec("wget https://wbk.in-vpn.de/sd/webcam/latest.jpg -O latest.jpg");
echo "latest.jpg downloaded.\r\n";
?>
