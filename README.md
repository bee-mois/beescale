# Mois Labs Beescale Yún

[Documentation] | [Source code] | [Licenses] | [Issues] | [Hiveeyes Project] | [Hiveeyes Community Forum]

*Please [continue reading this document on the rendered documentation], all inline
links will be working there.*


## About

The second generation [Mois Box] is a beehive monitoring system based on the [Arduino
Yún Shield]-compatible [Dragino Yun Shield v2.4], running [OpenWrt].

The article [Bienenwaage 2.0] introduces you to the hardware setup.


### Pictures

![](https://ptrace.hiveeyes.org/2017-03-21_mois-node-yun-http.jpg)
-- [Mois Box] with electronics

![](http://www.dragino.com/media/k2/galleries/105/YunShieldv2.4_10.png)
-- [Dragino Yun Shield v2.4]


## Hardware

### Board

- [Dragino Yun Shield v2.4]

### Sensors

- [ADS1231] ADC weigh scale breakout board
- [DS18B20] digital thermometer
- [SHT30] digital humidity/temperature sensor
- [TSL25911] Ambient Light Sensor aka. [Adafruit TSL2591 STEMMA QT] 
  High Dynamic Range Digital Light Sensor

## Firmware

The most recent firmware version is available at [beescale-yun.ino].

### Acquire source code

```shell
git clone https://github.com/bee-mois/beescale mois-beescale
cd mois-beescale
```

### Configure

Have a look at the source code [beescale-yun.ino] and adapt feature
flags and setting variables according to your environment.

Configure load cell calibration settings:

```c++
// Use sketches "scale-adjust-hx711.ino" or "scale-adjust-ads1231.ino" for calibration

// The raw sensor value for "0 kg"
const long loadCellZeroOffset = 38623;

// The raw sensor value for a 1 kg weight load
const long loadCellKgDivider  = 11026;
```

**Note:** Please use the corresponding [firmwares for load cell adjustment] to determine
those values.

### Build

The build system is based on [PlatformIO], which will install toolchains and build
your customized firmware without efforts. All you need is a Python installation. If
you want to use an IDE, we recommend to use the [PlatformIO IDE].

```shell
make build
```

### Upload to MCU

```shell
export MCU_PORT=/dev/ttyUSB0
make upload
```

If you need to build for different targets, or if you want to modernize
your dependencies, you may want to adjust the `platformio.ini` file, to
match your needs.

In order to make changes to the firmware, edit the `beescale-yun.ino`
file, and invoke `make build` to build it again.


## Telemetry and backend

### Overview

This flowchart will give you an idea how measurement data is acquired
and processed within the sensor domain, and how it will be converged to
the network and submitted to the backend systems.

![beehive-telemetry](https://github.com/bee-mois/beescale/assets/453543/da28b109-153e-4333-ad1e-9e7dedc9c850)

### Transport

To get the measurement data from the *sensor domain* to the *network*,
the [Bridge Library for Yún devices] enables communication between the
[ATmega328P] MCU on the [Arduino Uno], and the [AR9331], running [Linux].
The library will enable transparent HTTP communication through the venerable
Arduino [HttpClient].

```c++
#include <Bridge.h>
#include <HttpClient.h>

HttpClient client;
client.post(url);
```

Using this HTTP client (example program at [Yún HTTP Client]),
telemetry data is transmitted to a [custom PHP receiver program],
and is also stored on the SD card attached to the device.

### Reception and relay

On the backend, the PHP program receives the telemetry data record, and
stores it into two different databases. First, it adds the record to a
CSV file stored on the server's file system, and second, it emits
another HTTP request to the data acquisition server of our beekeepers
collective at <https://swarm.hiveeyes.org/>.

To learn more about how this works, please visit the documentation about
[Daten zu Hiveeyes übertragen], and the [Kotori message router and data
historian].

Other than this, for publishing the webcam image, a cron job on the web
server acquires the latest image from the Yun's SD card every 15
minutes, and stores it on its own filesystem, where HTTP clients are
able to consume it without further ado.

### Visualization

The data in the CSV file is visualized using the [graph.php] program. It uses
[dygraphs], a JavaScript charts framework, and that's it.


On the other hand, when submitting data to [Kotori] on the collaborative data
collection server at <https://swarm.hiveeyes.org/>, it will store the data into
[InfluxDB], and will populate a [Grafana] dashboard correspondingly.


## Live data

- <https://www.euse.de/honig/beescale/graph.php>
- <https://www.euse.de/honig/beescale/graph_pure.php>
- <https://swarm.hiveeyes.org/grafana/d/5NpVD1qiz/mois-2-1-hives-overview-and-bee-weather>
- <https://www.euse.de/honig/beescale/latest.jpg>

## Contributions welcome

You can run parts of this, or the whole system, on your own hardware, for yourselves, or
as a service for your local beekeepers collective. If you want to report or fix a bug or
documentation flaw, or if you would like to suggest an improvement, feel free to [create
an issue], or [submit a patch]. Thank you.

----

```bash
echo "Viel Spaß am Gerät"
cat <<ZUSE

Es hat viele Erfinder außer mir gebraucht, um den Computer, so wie wir ihn heute kennen, zu entwickeln.
Ich wünsche der nachfolgenden Generation Alles Gute im Umgang mit dem Computer. Möge dieses Instrument
Ihnen helfen, die Probleme dieser Welt zu beseitigen, die wir Alten Euch hinterlassen haben.

-- Konrad Zuse

ZUSE
```


[Adafruit TSL2591 STEMMA QT]: https://www.adafruit.com/product/1980
[ADS1231]: https://www.ti.com/product/ADS1231
[AR9331]: http://en.techinfodepot.shoutwiki.com/wiki/Atheros_AR9331
[Arduino Uno]: https://en.wikipedia.org/wiki/Arduino_Uno
[ATmega328]: https://en.wikipedia.org/wiki/ATmega328
[ATmega328P]: https://www.microchip.com/en-us/product/ATmega328P
[beescale-yun.ino]: https://github.com/bee-mois/beescale/blob/master/beescale-yun-2022.ino
[Bienenwaage 2.0]: https://www.euse.de/wp/blog/2017/03/bienenwaage-2_0/
[Bridge Library for Yún devices]: https://www.arduino.cc/en/Reference/YunBridgeLibrary
[continue reading this document on the rendered documentation]: https://hiveeyes.org/docs/arduino/firmware/moislabs/beescale-yun/README.html
[create an issue]: https://github.com/bee-mois/beescale/issues
[custom PHP receiver program]: https://github.com/bee-mois/beescale/blob/master/add_line2.php
[Daten zu Hiveeyes übertragen]: https://community.hiveeyes.org/t/daten-per-http-und-php-ans-backend-auf-swarm-hiveeyes-org-ubertragen/162
[Documentation]: https://hiveeyes.org/docs/arduino/firmware/moislabs/beescale-yun/README.html
[Dragino Yun Shield v2.4]: https://wiki1.dragino.com/index.php/Yun_Shield
[DS18B20]: https://www.maximintegrated.com/en/products/analog/sensors-and-sensor-interface/DS18B20.html
[dygraphs]: https://dygraphs.com/
[Firmwares for load cell adjustment]: https://hiveeyes.org/docs/arduino/firmware/openhive/scale-adjust/README.html
[Grafana]: https://en.wikipedia.org/wiki/Grafana
[graph.php]: https://github.com/bee-mois/beescale/blob/master/graph.php
[Hiveeyes Project]: https://hiveeyes.org/
[Hiveeyes Community Forum]: https://community.hiveeyes.org/
[HttpClient]: https://www.arduino.cc/reference/en/libraries/httpclient/
[InfluxDB]: https://en.wikipedia.org/wiki/InfluxDB
[Issues]: https://github.com/bee-mois/beescale/issues
[Kotori]: https://getkotori.org/
[Kotori message router and data historian]: https://getkotori.org/
[Licenses]: https://hiveeyes.org/docs/arduino/project/licenses.html
[Linux]: https://en.wikipedia.org/wiki/Linux
[Mois Box]: https://www.euse.de/wp/blog/2017/03/bienenwaage-2_0/
[OpenWrt]: https://en.wikipedia.org/wiki/OpenWrt
[PlatformIO]: https://platformio.org/
[PlatformIO IDE]: https://platformio.org/platformio-ide
[SHT30]: https://sensirion.com/products/catalog/SHT30-DIS-B
[Source code]: https://github.com/bee-mois/beescale
[submit a patch]: https://github.com/bee-mois/beescale/pulls
[TSL25911]: https://ams.com/tsl25911
[Yún HTTP Client]: https://www.arduino.cc/en/Tutorial/HttpClient
