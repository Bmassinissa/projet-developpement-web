<?php
include ('security.php');
include ('Headers.php');
//include('dbConne.php');

Sec();
session_start();
/*$conn = pg_connect("host='localhost' port='5432' dbname='Chaine_hotel' user='postgres' password='root'");*/
$conn = pg_connect("host='10.40.128.23' dbname='db2019l3i_mbourai' user='y2019l3i_mbourai' password='A123456*'");
if (!$conn) {
  echo "Connexion echouée\n";
  exit;
}
//insert headers
normale_header();
half_body();
//the first attractive hotels in my first webpage
for ($j=0 ; $j<2 ;$j++){
    echo'<div class="container">    
  <div class="row">';
    
    for ($i=0 ; $i<3 ;$i++){
      $RandId=rand(1,9);
      $result1 = pg_query($conn,"select min(prix_nuit) from chambre where id_chambre ='$RandId'");
      $result2 = pg_query($conn,"select nom_pays from pays where id_pays = '$RandId'");
      $Min_Prix=pg_fetch_result($result1,0);
        $Nom_Pays=pg_fetch_result($result2,0);

   echo'
    <div class="col-sm-4">
       <div class="panel panel-info">
        <div class="panel-heading">'.$Nom_Pays.'</div>';
         $resimg = pg_query($conn,"select chemin from Images where id_image ='$Nom_Pays'");
    $img = pg_fetch_row($resimg);
        echo'
        <div class="panel-body"><img src="'.$img[0].'" height="200" width="330"></div>
        <div class="panel-footer" style="text-align : center;"> A partir de '.$Min_Prix.' €/Nuit</div>
          <div class="panel-footer" style="text-align : center;"><a href="#">Reserver</a></div>
      </div>
      </div>';
      }
   echo' </div>
        </div><br><br>';

}

echo'<footer class="container-fluid text-center">
   <p>Inscription aux alertes</p>  
  <form class="form-inline" action="mail.php" method="post">
    <input type="email" class="form-control" size="30" placeholder="Email Address" name="AdresseMail">
    <button type="submit" class="btn btn-danger">Inscription</button>
  </form>
</footer>
</body>
</html>';
?>
