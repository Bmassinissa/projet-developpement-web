<?php
function connexion () {
   	$dbconn=pg_connect("host='10.40.128.23' dbname='db2019l3i_mbourai' user='y2019l3i_mbourai' password='A123456*'")
    or die('Connexion impossible : ' . pg_last_error());
	return $dbconn;
}




?>