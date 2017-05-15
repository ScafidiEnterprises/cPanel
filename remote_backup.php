<?php
$cpaneluser = 'scaffhiz';
$cpaneluserpass = '!PJ-Z%T~2bDV6V$1';
$theme = 'paper_lantern';
$ftp = true;
$ftpserver = '71.229.186.83';
$ftpusername = 'backups';
$ftppassword = 'aPagEuGXbVgUEn2w';
$ftpport = '21098';
$ftpdirectory = '/mnt/ext/Backups/TKMSP_Remote_Backups';

#$notifyemail = admin@turnkeymsp.net

// DO NOT EDIT BELOW THIS LINE

$domain = '127.0.0.1';
$secure = true;
$auth = base64_encode($cpaneluser . ":" . $cpaneluserpass);
if ($secure) { 
    $url = "ssl://" . $domain; 
    $port = 2083; 
    } else {  
    $url = $domain;  
    $port = 2082;
}
$socket = fsockopen('127.0.0.1', 2082);
if (!$socket) {  
    exit("Failed to open socket connection.");
}
if ($ftp) {
$params = "dest=scp&server=$ftpserver&user=$ftpusername&pass=$ftppassword&port=$ftpport&rdir=$ftpdirectory&submit=Generate Backup";
} else {
   $params = "submit=Generate Backup";
}
fputs($socket, "POST /frontend/" . $theme . "/backup/dofullbackup.html?" . $params . " HTTP/1.0\r\n");
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
