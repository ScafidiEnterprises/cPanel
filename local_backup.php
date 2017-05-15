#!/usr/bin/env php

<?php
$cpaneluser = 'scaffhiz';
$cpaneluserpass = '!PJ-Z%T~2bDV6V$1';
$theme = 'paper_lantern';
$ftp = false;
$ftpserver = 'localhost';
$ftpusername = 'scaffhiz';
$ftppassword = '!PJ-Z%T~2bDV6V$1';
$ftpport = '21098';
$ftpdirectory = '/home/scaffhiz/backups';


// Do not edit below this line
$domain = 'localhost';
$secure = true;
$auth = base64_encode($cpaneluser . ":" . $cpaneluserpass);
if ($secure) { 
    $url = "ssl://" . $domain; 
    $port = 2083; 
    } else {  
    $url = $domain;  
    $port = 2082;
}
$socket = fsockopen('localhost', 2082);
if (!$socket) {  
    exit("Failed to open socket connection.");
}
if ($ftp) {
$params = 
"dest=scp&server=$ftpserver&user=$ftpusername&pass=$ftppassword&port=$ftpport&rdir=$ftpdirectory&submit=Generate 
Backup";
} else {
   $params = "submit=Generate Backup";
}
fputs($socket, "POST /frontend/" . $theme . "/backup/dofullbackup.html?" 
. $params . " HTTP/1.0\r\n");
fputs($socket, "Host: $domain\r\n");
fputs($socket, "Authorization: Basic $auth\r\n");
fputs($socket, "Connection: Close\r\n");
fputs($socket, "\r\n");
while (!feof($socket)) {
   $response = fgets($socket, 4096);
//     echo $response; //uncomment this line for debugging
}
fclose($socket);
?>
