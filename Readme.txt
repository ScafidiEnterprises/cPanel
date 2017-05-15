*** TURNKEYMSP CONTRIBUTION ***

Purpose: Making and managing local and remote backups in cPanel/WHM environments

Source: Many open-sources

local_backups.php (local cPanel backup; configuration required)
remote_backups.php (remote FTP/SFTP; configuration required)
cleanbackups.php (remove old copies; configuration required)

For cPanel: The cron job should be

min hr DOM MOY DOW
* * * * * php -f /path/to/php/script

For RaspberryPi/Debian:
* * * * * /usr/bin/env php /path/to/php/script.php

- Tyler Scafidi
turnkeymsp.net
https://www.linkedin.com/in/TylerScafidi