This folder contains all OpenWrt files and config files that were changed to run the Yun part of the sensor node to connect via GSM, establish and connect with an OpenVPN client, provide local wireless access and send beecam images to the web server every 15 minutes.

Dragino yun firmware version is <a href="http://www.dragino.com/downloads/downloads/motherboards/ms14/Firmware/Yun/Legacy_Firmware/common-build--v2.0.7--20151124-1949/">common-build--v2.0.7--20151124-1949</a>.

<pre>:~$ cat /proc/version 
Linux version 3.3.8 (dragino@iZ28vl6w7rcZ) (gcc version 4.6.3 20120201 (prerelease) (Linaro GCC 4.6-2012.02) ) #2 Tue Nov 24 15:51:41 CST 2015</pre>
This is the auto generated list of changed configuration files:
<pre>:~$ sudo opkg list-changed-conffiles
<ol>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/avahi/avahi-daemon.conf">/etc/avahi/avahi-daemon.conf</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/avrdude.conf">/etc/avrdude.conf</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/inittab">/etc/inittab</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/group">/etc/group</a>
<li>/etc/passwd
<li>/etc/shadow
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/rc.local">/etc/rc.local</a>
<li>/etc/sysupgrade.conf
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/system">/etc/config/system</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/fstab">/etc/config/fstab</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/dbus-1/session.conf">/etc/dbus-1/session.conf</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/dbus-1/system.conf">/etc/dbus-1/system.conf</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/dhcp">/etc/config/dhcp</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/arduino">/etc/config/arduino</a>
<li>/etc/dropbear/dropbear_rsa_host_key
<li>/etc/dropbear/dropbear_dss_host_key
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/dropbear">/etc/config/dropbear</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/firewall">/etc/config/firewall</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/luci">/etc/config/luci</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/openvpn">/etc/config/openvpn</a>
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/opkg.conf">/etc/opkg.conf</a>
<li>/etc/sudoers
<li><a href="https://github.com/bee-mois/beescale/blob/master/OpenWrt/etc/config/uhttpd">/etc/config/uhttpd</a>
</pre>
Files will be added peu-a-peu. Don't bother to let me know if you are particularly interested in a file not linked yet.
