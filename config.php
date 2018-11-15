<?php

define('HOST','localhost');
define('DB','help_desk');
define('USER','root');
define('PASS','');
define('PORT',3306);
define('CHARSET','utf8');
define('OPTIONS',[
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "utf8"',
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
