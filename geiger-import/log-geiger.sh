#!/bin/sh
export PYTHONPATH="/home/me/.local/lib/python3.9/site-packages:/home/me/beescale"
while :
do
  curl -X 'GET' 'https://data.sensor.community/airrohr/v1/sensor/70795/' -H 'accept: */*' -s  | jq '.' > datadump.json
  cpm=`cat datadump.json | jq -r '.[0].sensordatavalues[0].value'`
  time=`cat datadump.json | jq -r '.[0].timestamp'`
  time=`date --date=@$(date -u "+%s" --date="$time") '+%Y-%m-%dT%H:%M:%S'`
  sv=`echo "$cpm/60*0.081438" | bc -l | awk '{printf("%.3f \n",$1)}'`
  python -c "from log_geiger import send_measurement; send_measurement('yun', '$time', '$cpm', '$sv')"
  echo $time': Sending CountsPerMinute='$cpm', GammaRadiation='$sv'µSv/h ...'
  sleep 130
done
