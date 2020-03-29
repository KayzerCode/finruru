<?php $link = mysql_connect ("db11.hqhost.net", "uhtua_db1", "7Zf5Bwrx");
/* проверяем на провильность соединения к базе */
if (!$link) {die ('Could not connect: ' . mysql_error());}
mysql_select_db ("uhtua_db1", $link);
mysql_query("SET NAMES 'utf8'", $link);?>