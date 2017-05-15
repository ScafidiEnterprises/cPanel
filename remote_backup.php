<?php
$cpaneluser = 'cPanel User';
$cpaneluserpass = 'cPanel Pass';
$theme = 'paper_lantern';
$ftp = true;
$ftpserver = 'host ip/domain';
$ftpusername = 'ftp user';
$ftppassword = 'ftp pass';
$ftpport = '21098';
$ftpdirectory = '/must/exist/first/';

#$notifyemail = admin@turnkeymsp.net (not sure about syntax)

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
