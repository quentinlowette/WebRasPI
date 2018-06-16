<?php
date_default_timezone_set('UTC');
$rawUptime = shell_exec('uptime -s');
$now = time();
$uptimestamp = strtotime($rawUptime);
$timeDiff = $now-$uptimestamp-86400;
$uptime = date("j\d G\h i\m s\s", $timeDiff);

$rawLoad = shell_exec('uptime');
$loadavg = explode(' ', substr($rawLoad, strpos($rawLoad, 'load average:') + 14));
$loadavg[0]=substr($loadavg[0], 0, -1);
$loadavg[1]=substr($loadavg[1], 0, -1);

$rawTemp = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
$temp = round(($rawTemp)/1000, 1);

$rawIP = shell_exec('ip -br -f inet addr show wlan0');
$cleanIP = preg_replace('/\s+/', ' ',$rawIP);
$ipTokens = explode(" ", $cleanIP);
$ipMask = explode("/", $ipTokens[2]);
$ip = $ipMask[0];

$rawNet = shell_exec('iwconfig wlan0 | grep -E -i \'quality|essid\'');
$cleanNet = preg_replace('/\s+/', ' ',$rawNet);
$net = explode(" ", $cleanNet);

$netName = explode(":", $net[3]);
$netName = $netName[1];

$netQualityScore = explode("=", $net[5]);
$netQuality = explode("/", $netQualityScore[1]);

$rawStorage = shell_exec('df -H -x tmpfs -x devtmpfs | grep root');
$cleanStorage = preg_replace('/\s+/', ' ',$rawStorage);
$storage = explode(" ", $cleanStorage);
$storage = array_slice($storage, 2, 3);

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

$rawDist = shell_exec('cat /etc/os-release | grep PRETTY');
$distTokens = explode("=", $rawDist);
$distTokens[1] = trim($distTokens[1]);
$dist = substr($distTokens[1], 1, strlen($distTokens[1])-2);

$rawKernel = shell_exec('uname -r');
$kernelTokens = explode("-", $rawKernel);
$kernel = $kernelTokens[0];

$rawDate = shell_exec('date');
$date = strtotime($rawDate);
$dateString = date("j M Y G:i:s e", $date);