<?php

function getOS($userAgent) {
    // Create list of operating systems with operating system name as array key 
    $oses = array (
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
    );
    
    // Loop through $oses array
    foreach($oses as $os => $preg_pattern) {
        // Use regular expressions to check operating system type
        if ( preg_match('@' . $preg_pattern . '@', $userAgent) ) {
            // Operating system was matched so return $oses key
            return $oses[$os];
        }
    }
    
    // Cannot find operating system so return Unknown
    
    return 'n/a';
}

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function getBrowser(){

$agent = $_SERVER['HTTP_USER_AGENT'];
$name = 'NA';


if (preg_match('/MSIE/i', $agent) && !preg_match('/Opera/i', $agent)) {
    $name = 'Internet Explorer';
} elseif (preg_match('/Firefox/i', $agent)) {
    $name = 'Mozilla Firefox';
} elseif (preg_match('/Chrome/i', $agent)) {
    $name = 'Google Chrome';
} elseif (preg_match('/Safari/i', $agent)) {
    $name = 'Apple Safari';
} elseif (preg_match('/Opera/i', $agent)) {
    $name = 'Opera';
} elseif (preg_match('/Netscape/i', $agent)) {
    $name = 'Netscape';
}

return $name;
}
function Sec(){
    
    $os = getOS($_SERVER['HTTP_USER_AGENT']);
    $Browser =getBrowser();
    $Ip=getUserIpAddr();
    $U_sername=gethostname();
  

/*$conn = pg_connect("host='localhost' port='5432' dbname='Chaine_hotel' user='postgres' password='root'");*/
include('dbConne.php');
   $conn=  connexion(); if (!$conn) {
  echo "Connexion echouée\n";
  exit;
}
    
$result=pg_query($conn, "insert into securite (adresse_ip,navigateur, os,nom_poste)values('$Ip','$Browser','$os','$U_sername')");
if (!$result){
    echo 'rien ne vas !';
}
}

?>