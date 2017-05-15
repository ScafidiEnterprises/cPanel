#!/usr/bin/env php

<?php
$cpaneluser = 'cPanel User';
$cpaneluserpass = 'cPanel Pass';
$theme = 'paper_lantern';
$ftp = false;
$ftpserver = 'localhost';
$ftpusername = 'cPanel User';
$ftppassword = 'cPanel Pass';
$ftpport = 'port protocol is running on';
$ftpdirectory = '/folder/must/exist';


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
