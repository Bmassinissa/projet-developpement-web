<?php
session_start();
if(isset($_POST['hotel'])&&isset($_POST['arrive'])&&isset($_POST['depart'])&&isset($_POST['adultes'])&&isset($_POST['enfants'])){
   
    $hotel = $_POST['hotel'];
    $date_arrivee = $_POST['arrive'];
    $date_depart =$_POST['depart'];
    $NbAdultes = $_POST['adultes'];
   $NbEnfants = $_POST['enfants'];
   $NbChambres = $_POST['chambres'];
    
                                                            
    
    setcookie("hotel", $_POST['hotel'], time()+3600);  
    setcookie("arrive", $_POST['arrive'], time()+3600);  
    setcookie("depart", $_POST['depart'], time()+3600); 
    setcookie("adultes", $_POST['adultes'], time()+3600);  
    setcookie("enfants", $_POST['enfants'], time()+3600); 
    setcookie("chambres", $_POST['chambres'], time()+3600);  
    

}


include('dbConne.php');
   $conn=  connexion(); 
if (!$conn) {
  echo "Connexion echouée\n";
  
}

if (isset($_COOKIE['FilterChoice'])){
  
    if ($_COOKIE['FilterChoice']=='Par pays'){
        
   $result=pg_query($conn, "select nom_hotel,id_hotel from hotel where id_pays IN (select id_pays from pays where nom_pays='$hotel')");
        
}

else if ($_COOKIE['FilterChoice']=='Par hotel'){
    
              header('Location: Chambres.php');
}

else if ($_COOKIE['FilterChoice']=='Par ville'){
    
            $result=pg_query($conn, "select nom_hotel,id_hotel from hotel where id_pays IN (select id_pays from ville where nom_ville='$hotel')");
            $result1= pg_query($conn,"select min(prix_nuit) from chambre where id_hotel IN (select id_hotel from hotel where id_pays=(select id_pays from ville where nom_ville='$hotel'))");
      $result2=pg_query($conn, "select nom_service from services where id_hotel IN (select id_hotel from hotel where id_pays=(select id_pays from ville where nom_ville='$hotel'))");
}
}

   if (!$result  ) {
  echo "requete echouée\n";
}

include('Headers.php');
normale_header();


echo'
<div class="jumbotron">
  <div class="container text-center">
    <h1>Hotels '.$hotel.'</h1>      
    <p>Reservez aux meilleures prix avec nos hotels</p>
  </div>
</div>';

echo'<div class="container">    
  <div class="row">';

 while($row = pg_fetch_assoc($result)){
      $id_hote= $row['id_hotel'];
      $nom_hotel = $row['nom_hotel'];
     echo'
     <div class="col-sm-4">
      <div class="panel panel-danger">';
        echo '<div class="panel-heading">'.$nom_hotel.'</div>';
     
     
     
     $resimg = pg_query($conn,"select chemin from Images where id_image ='$nom_hotel'");
    $img = pg_fetch_row($resimg);
        echo'
        <div class="panel-body"><img src="'.$img[0].'" height="200" width="330"></div>';

 echo' <div class="panel-footer" style="text-align : center;">';
 echo' <strong>Services: </strong><br>';
     
 $result2=pg_query($conn, "select nom_service from services where id_hotel='$id_hote'");
while ($row2 = pg_fetch_row($result2)){
      echo $row2[0].'<br>';
     
}
echo '</div>';
     $result3= pg_query($conn,"select adresse_hotel from hotel where id_hotel='$id_hote'");
        $row3 = pg_fetch_row($result3);
      echo' <div class="panel-footer" style="text-align : center;"> Adresse :  '.$row3[0].'</div>';
     $result1= pg_query($conn,"select min(prix_nuit) from chambre where id_hotel='$id_hote'");
        $row1 = pg_fetch_row($result1);
      echo' <div class="panel-footer" style="text-align : center;"> A partir de '.$row1[0].' €/Nuit</div>';
       
       
      echo'<div class="panel-footer" style="text-align : center;">
      <button type="submit"  class="btn btn-default"><a href="Chambres.php">Chambres</a></button>
      </div>
      </div>
      </div>';
    }
echo'
    
    </div>
    </div>
   <br><br>
</body>';
echo'   
<footer class="container-fluid text-center">
   <p>Inscription aux alertes</p>    
  <form class="form-inline" action="mail.php" method="post">
    <input type="email" class="form-control" size="30" placeholder="Email Address" name="AdresseMail">
    <button type="submit" class="btn btn-danger">Inscription</button>
  </form>
</footer>

</html>';
?>


