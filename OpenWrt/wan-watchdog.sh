#!/bin/sh
# run by cron every 15'
# */15 * * * * /root/wan-watchdog.sh
tries=0
while [[ $tries -lt 5 ]]
do
    if /bin/ping -c 1 www.euse.de >/dev/null
    then
#	echo $?
#        echo "online"
	exit 0
    fi
#    echo $?
    tries=$((tries+1))
done
#echo "offline. going to restart..."
(ifdown wwan ; sleep 2) ; (killall openvpn ; sleep 3) ; (ifdown wan ; sleep 3) ; (ifup wwan ; sleep 10) ; ifup wan && openvpn --config /etc/openvpn/in-berlin-vpn.conf
# (ifdown congstar ; sleep 2) ; (killall openvpn ; sleep 3) ; (ifdown wan1 ; sleep 3) ; (ifup congstar ; sleep 10) ; ifup wan1 && openvpn --config /etc/openvpn/in-berlin-vpn.conf
# /etc/init.d/network restart
