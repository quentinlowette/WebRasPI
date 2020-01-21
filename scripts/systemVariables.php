<?php
/***********************************************
 This script fetch all sort of system variables.
 ***********************************************/

// Uptime of the system. Since how many days it is boot up.
date_default_timezone_set('UTC');
$rawUptime = shell_exec('uptime -s');
$now = time() + 60*60;
$uptimestamp = strtotime($rawUptime);
$timeDiff = $now-$uptimestamp;
$uptime = intdiv($timeDiff, 86400) . "d " . date("G\h i\m s\s", $timeDiff);
$lastboot = date("Y-m-d G:i:s", $uptimestamp);

// Load average on the system for the past 1, 5 and 15 minutes.
$rawLoad = shell_exec('uptime');
$loadavg = explode(' ', substr($rawLoad, strpos($rawLoad, 'load average:') + 14));
$loadavg[0]=substr($loadavg[0], 0, -1);
$loadavg[1]=substr($loadavg[1], 0, -1);

// CPU temperature.
$rawTemp = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
$temp = round(($rawTemp)/1000, 1);

// Raspberry Pi IP over wifi (wlan0).
$rawIP = shell_exec('ip -br -f inet addr show wlan0');
$cleanIP = preg_replace('/\s+/', ' ',$rawIP);
$ipTokens = explode(" ", $cleanIP);
$ipMask = explode("/", $ipTokens[2]);
$ip = $ipMask[0];

// Access Point name and link quality
$rawNet = shell_exec('iwconfig wlan0 | grep -E -i \'quality|essid\'');
$cleanNet = preg_replace('/\s+/', ' ',$rawNet);
$net = explode(" ", $cleanNet);
$netName = explode(":", $net[3]);
$netName = $netName[1];
$netQualityScore = explode("=", $net[5]);
$netQuality = explode("/", $netQualityScore[1]);

// Disk usage
$rawStorage = shell_exec('df -H -x tmpfs -x devtmpfs | grep root');
$cleanStorage = preg_replace('/\s+/', ' ',$rawStorage);
$storage = explode(" ", $cleanStorage);
$storage = array_slice($storage, 2, 3);

// Server services versions
$versions = array(3);//Apache, PHP, MySQL

$rawApache = shell_exec('apachectl -v | grep version');
$apacheTokens = explode(" ", $rawApache);
$apacheVersion = explode("/", $apacheTokens[2]);
$versions[0] = $apacheVersion[1];

$rawPHP = shell_exec('php -v | head -n 1');
$PHPTokens = explode(" ", $rawPHP);
$PHPVersion = explode("-", $PHPTokens[1]);
$versions[1] = $PHPVersion[0];

$rawMySQL = shell_exec('mysql -V');
$MySQLTokens = explode(" ", $rawMySQL);
$versions[2] = $MySQLTokens[3];

// OS version name
$rawDist = shell_exec('cat /etc/os-release | grep PRETTY');
$distTokens = explode("=", $rawDist);
$distTokens[1] = trim($distTokens[1]);
$dist = substr($distTokens[1], 1, strlen($distTokens[1])-2);

// Kernel release
$rawKernel = shell_exec('uname -r');
$kernelTokens = explode("-", $rawKernel);
$kernel = $kernelTokens[0];

// System time
$rawDate = shell_exec('date');
$date = strtotime($rawDate);
$dateString = date("j M Y G:i:s e", $date);

// Hostname
$hostname = shell_exec('hostname');
