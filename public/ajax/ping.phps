<?php

$ip = '78.110.160.1';
$myip = GetHostByName($_SERVER['REMOTE_ADDR']);

// ********* Ping **************
$output = shell_exec("ping -c 4 ".$myip);
echo "<b>Pinging your IP, ".$myip."</b>:<br /><pre>$output</pre>";
$output = shell_exec("ping -c 4 ".$ip);
echo "<b>Pinging ".$ip."</b>:<br /><pre>$output</pre>";
