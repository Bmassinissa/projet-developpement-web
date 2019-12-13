<?php
session_start();
if (isset ($_POST['filtre'])){
setcookie("FilterChoice", $_POST['filtre'], time()+3600); 
}
include('dbConne.php');
   $conn=  connexion(); 
if (!$conn) {
  echo "Connexion echouée\n";
  exit;
}

if (isset($_POST['filtre'])){
    
    if ($_POST['filtre']=='Par pays'){
        
            $result=pg_query($conn, "select nom_pays from pays");
}

else if ($_POST['filtre']=='Par hotel'){
            $result=pg_query($conn, "select nom_hotel from hotel ");
}

else if ($_POST['filtre']=='Par ville'){
            $result=pg_query($conn, "select nom_ville from ville");
}
}

if (!$result) {
  echo "requete echouée\n";
  exit;
}

$stop_date = new DateTime(date("Y-m-d"));
$tomorrow_date = new DateTime(date("Y-m-d"));
$year_date =new DateTime(date("Y-m-d"));
$tomorrow_date->modify('+1 day');
$year_date->modify('+1 year');



include ('Headers.php');
normale_header();
echo'
  <div class="container text-center" style ="background-color: coral;width:50%;box-shadow: 0 3px 6px 0 "> 

    <h3>Search an hotel</h3>
    <div class="row" >
      <form action="Recherche.php" method="post">
      <div class="col-xs-12">
      <label for="email">Recherche</label><br>
      <select data-live-search="true"  class="selectpicker" name="hotel">';

      while (($row = pg_fetch_row($result))) {
        echo'<option>'.$row[0].'</option>';
      }
      echo'</select>'; 
     
      echo' </div>
      <div class="col-xs-12">
      <label for="pwd">Arrivé:</label>
      <input type="date" class="form-control" name="arrive" value="'.$stop_date->format('Y-m-d').'" min="'.$stop_date->format('Y-m-d').'" max="'.$year_date->format('Y-m-d').'">
      </div>
      <div class="col-xs-12">
      <label for="email">Départ :</label>
      <input type="date" class="form-control" name="depart" value="'.$tomorrow_date->format('Y-m-d').'" min="'.$tomorrow_date->format('Y-m-d').'" max="'.$year_date->format('Y-m-d').'">
    </div> 
     
<div class="col-xs-12">
     
    <label for="email">Nombre adultes :</label>
    <select class="form-control" id="sel1"  name="adultes"> 
    <option selected>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    </select>
</div>
<div class="col-xs-12">
     
    <label for="email">Nombre enfants :</label>
    <select class="form-control" id="sel1"  name="enfants">
        <option selected>0</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    </select>
</div>

<div class="col-xs-12">
     
    <label for="email">Nombre de chambres :</label>
    <select class="form-control" id="sel1"  name="chambres">
        <option selected>0</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    </select>
</div>
 </div>

<div class="col-xs-12"> 
   <button type="submit"  class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>Search</button>
</div>
</form>
</div>
</div>

<h1 style="margin-left : 10%">Evadez vous avec nous<small>..jetez un coup oeil</small></h1><br>';

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