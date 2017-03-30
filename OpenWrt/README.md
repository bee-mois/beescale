This folder contains all OpenWrt files and config files that were changed to run the Yun part of the sensor node to connect via GSM, establish and connect with an OpenVPN client, provide local wireless access and send beecam images to the web server every 15 minutes.

Dragino yun firmware version is <a href="http://www.dragino.com/downloads/downloads/motherboards/ms14/Firmware/Yun/Legacy_Firmware/common-build--v2.0.7--20151124-1949/">common-build--v2.0.7--20151124-1949</a>.

<pre>:~$ cat /proc/version 
Linux version 3.3.8 (dragino@iZ28vl6w7rcZ) (gcc version 4.6.3 20120201 (prerelease) (Linaro GCC 4.6-2012.02) ) #2 Tue Nov 24 15:51:41 CST 2015</pre>
This is the auto generated list of changed configuration files:
<pre>:~$ sudo opkg list-changed-conffiles
<ol>
<li>/etc/avahi/avahi-daemon.conf
<li>/etc/avrdude.conf
<li>/etc/inittab
<li>/etc/group
<li>/etc/passwd
<li>/etc/shadow
<li>/etc/profile
<li>/etc/sysctl.conf
<li>/etc/rc.local
<li>/etc/config/system
<li>/etc/config/fstab
<li>/etc/dbus-1/session.conf
<li>/etc/dbus-1/system.conf
<li>/etc/config/ddns
<li><a href="
config dnsmasq
	option domainneeded '1'
	option boguspriv '1'
	option localise_queries '1'
	option rebind_protection '1'
	option rebind_localhost '1'
	option local '/lan/'
	option domain 'lan'
	option expandhosts '1'
	option readethers '1'
	option leasefile '/tmp/dhcp.leases'
	option resolvfile '/tmp/resolv.conf.auto'
	option localservice '1'
	option authoritative '1'
        list server '192.109.42.41'
        list server '192.109.42.42'

config dhcp 'lan'
	option interface 'lan'
	option start '100'
	option leasetime '12h'
	option dhcpv6 'server'
	option ra 'server'
	option limit '200'

config dhcp 'wan'
	option interface 'wan'
	option ignore '1'

config odhcpd 'odhcpd'
	option maindhcp '0'
	option leasefile '/tmp/hosts/odhcpd'
	option leasetrigger '/usr/sbin/odhcpd-update'

config host

config host

config domain
	option name 'x200'
	option ip '192.168.4.171'

config domain
	option name 'weidenteich'
	option ip '192.168.4.169'

config dhcp
	option start '100'
	option leasetime '12h'
	option limit '150'
	option interface 'wan1'

config dhcp
	option start '100'
	option leasetime '12h'
	option limit '150'
	option interface 'ethernet_lan'

config dhcp
	option interface 'ethernet2lan'
	option start '100'
	option limit '200'
	option leasetime '12h'

">/etc/config/dhcp</a>
<li>/etc/config/arduino
<li>/etc/dropbear/dropbear_rsa_host_key
<li>/etc/dropbear/dropbear_dss_host_key
<li>/etc/config/dropbear
<li>/etc/config/firewall
<li>/etc/config/luci
<li>/etc/config/olsrd
<li>/etc/config/openvpn
<li>/etc/opkg.conf
<li>/etc/sudoers
<li>/etc/tor/torrc
<li>/etc/config/uhttpd
</pre>
