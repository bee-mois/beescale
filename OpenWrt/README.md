dragino yun firmware version: <a href="http://www.dragino.com/downloads/downloads/motherboards/ms14/Firmware/Yun/Legacy_Firmware/common-build--v2.0.7--20151124-1949/">common-build--v2.0.7--20151124-1949</a>

<pre>:~$ cat /proc/version 
Linux version 3.3.8 (dragino@iZ28vl6w7rcZ) (gcc version 4.6.3 20120201 (prerelease) (Linaro GCC 4.6-2012.02) ) #2 Tue Nov 24 15:51:41 CST 2015</pre>
List of changed configuration files:
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
<li>/etc/config/dhcp
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
