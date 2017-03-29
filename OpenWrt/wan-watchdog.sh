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
(ifdown congstar ; sleep 2) ; (killall openvpn ; sleep 3) ; (ifdown wan1 ; sleep 3) ; (ifup congstar ; sleep 10) ; ifup wan1 && openvpn --config /etc/openvpn/in-berlin-vpn.conf
# ifdown wan1 ; (ifdown congstar ; sleep 2) ; (ifup congstar ; sleep 10) ; (killall openvpn ; sleep 3) ; openvpn --config /etc/openvpn/in-berlin-vpn.conf & ifup wan1
# /etc/init.d/network restart
