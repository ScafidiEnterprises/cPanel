<?php
    $files = glob("backup-*_scaffhiz*");
    foreach($files as $file) {
        if(is_file($file)
        && time() - filemtime($file) >= 01*04*20*00) { // 1 days old, at 24hrs,60min,60sec
            unlink($file);
        }
    }
?>
