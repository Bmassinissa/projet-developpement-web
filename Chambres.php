<?php
session_start();
 include('dbConne.php');
   $conn=  connexion(); 

if (!$conn) {
  echo "Connexion echouée\n";
  
}
   $hotel=$_COOKIE['hotel'];
    $date_arrivee = $_COOKIE['arrive'];
    $date_depart =$_COOKIE['depart'];
    $NbAdultes =  intval($_COOKIE['adultes']);
    $NbEnfants = intval($_COOKIE['enfants']);
    $NbChambres = intval($_COOKIE['chambres']);

if (isset($_COOKIE['FilterChoice']) ){
  
    if ($_COOKIE['FilterChoice']=='Par pays'){
        
       
        if (($NbAdultes+$NbEnfants)==1){
            
        $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN (Select id_hotel from hotel where id_pays IN (Select id_pays from Pays where nom_pays='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_arrivee' INTERSECT Select id_chambre from reservation WHERE date_fin_reservation between '$date_depart' and '$date_depart'  EXCEPT (select id_chambre from chambre WHERE nombre_type<'$NbChambres')))))");
            
        }
        else if (($NbAdultes+$NbEnfants)==2){
              $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN (Select id_hotel from hotel where id_pays IN (Select id_pays from Pays where nom_pays='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_arrivee' INTERSECT Select id_chambre from reservation WHERE date_fin_reservation between '$date_depart' and '$date_depart'  EXCEPT (select id_chambre from chambre WHERE nombre_type<'$NbChambres')))) EXCEPT (select id_chambre from chambre WHERE type_chambre = 'Single'))");
        }
        else if (($NbAdultes+$NbEnfants)>2){
            $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN (Select id_hotel from hotel where id_pays IN (Select id_pays from Pays where nom_pays='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_arrivee' INTERSECT Select id_chambre from reservation WHERE date_fin_reservation between '$date_depart' and '$date_depart'  EXCEPT (select id_chambre from chambre WHERE nombre_type<'$NbChambres'  )))) EXCEPT (select id_chambre from chambre WHERE type_chambre = 'Double simple' or type_chambre = 'Double twin' or type_chambre = 'Single')) ");
        }
        
    
}

else if ($_COOKIE['FilterChoice']=='Par hotel'){
   
        if (($NbAdultes+$NbEnfants)==1){
    $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN (Select id_hotel from hotel where nom_hotel='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_depart'  INTERSECT (Select id_chambre from reservation WHERE date_fin_reservation between '$date_arrivee' and '$date_depart' EXCEPT (select id_chambre from chambre WHERE nombre_type<'$NbChambres'))))) ");
        }
    else if (($NbAdultes+$NbEnfants)==2){
      $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN(Select id_hotel from hotel where nom_hotel='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_depart'  INTERSECT (Select id_chambre from reservation WHERE date_fin_reservation between '$date_arrivee' and '$date_depart' EXCEPT (select id_chambre from chambre WHERE nombre_type<'$NbChambres'))))  EXCEPT (select id_chambre from chambre WHERE type_chambre = 'Single' ))");
        }
    else if (($NbAdultes+$NbEnfants)>2){
    $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN(Select id_hotel from hotel where nom_hotel='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_depart'  INTERSECT (Select id_chambre from reservation WHERE date_fin_reservation between '$date_arrivee' and '$date_depart' EXCEPT (select id_chambre from chambre WHERE nombre_type <'$NbChambres' )))) EXCEPT (select id_chambre from chambre WHERE type_chambre = 'Double simple' or type_chambre = 'Double twin' or type_chambre = 'Single')) ");
        }
}

    
else if ($_COOKIE['FilterChoice']=='Par ville'){
    if (($NbAdultes+$NbEnfants)==1){
        $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN(Select id_hotel from hotel where id_pays= (Select id_pays from ville where nom_ville='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_depart'  INTERSECT (Select id_chambre from reservation WHERE date_fin_reservation between '$date_arrivee' and '$date_depart'EXCEPT (select id_chambre from chambre WHERE nombre_type<'$NbChambres'))))))");
    }
    
     else if (($NbAdultes+$NbEnfants)==2){
     $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN (Select id_hotel from hotel where id_pays IN (Select id_pays from ville where nom_ville='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_depart'  INTERSECT (Select id_chambre from reservation WHERE date_fin_reservation between '$date_arrivee' and '$date_depart'EXCEPT (select id_chambre from chambre WHERE nombre_type<'$NbChambres')))))  EXCEPT (select id_chambre from chambre WHERE type_chambre = 'Single')) ");
    }
     else if (($NbAdultes+$NbEnfants)>2){
      $result = pg_query($conn,"(select id_chambre from chambre WHERE id_hotel IN(Select id_hotel from hotel where id_pays IN (Select id_pays from ville where nom_ville='$hotel' EXCEPT (select id_chambre from reservation WHERE date_debut_reservation between '$date_arrivee' and '$date_depart'  INTERSECT (Select id_chambre from reservation WHERE date_fin_reservation between '$date_arrivee' and '$date_depart'EXCEPT (select id_chambre from chambre WHERE nombre_type<'$NbChambres' ))))) EXCEPT (select id_chambre from chambre WHERE type_chambre = 'Double simple' or type_chambre = 'Double twin' or type_chambre = 'Single'))");
    }
    
}
}




if(!$result){
    echo 'Connexion Echouée <br>';
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
  <title>Recherhce Hotel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    

     .jumbotron {
      margin-bottom: 0;
    }
   
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Chambres '.$hotel.'</h1>      
    <p>Reservez aux meilleures prix avec nos hotels</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
       <a class="navbar-brand" href="index.php"><img src="https://img.icons8.com/ios/50/000000/s-symbol-filled.png" height="20" width="20"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="index.php">Nouvelle Recherche</a></li>
        <li><a href="ChambresASC.php?tri=1">Tri par prix Ascendant</a></li>
        <li><a href="ChambresASC.php?tri=2">Tri par prix Descendant</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">';
         if(isset($_SESSION['id'])){
                      
                
                echo'
                <li><a href="deconnexion.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <li><a href="passwordChange.php"><span class="glyphicon glyphicon-log-in"></span> mdp</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-signe-in"></span>'.$_SESSION['nom'].' '.$_SESSION['prenom'].'</a></li>';
            }else{
                echo'
                <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="inscription.php"><span class="glyphicon glyphicon-signe-in"></span> Sign-in</a></li>';
            }
      echo'</ul>
    </div>
  </div>
</nav>';


echo'<div class="container">    
  <div class="row">';

while ($row = pg_fetch_row($result)){
  $result2 = pg_query($conn,"select id_chambre,etage_chambre ,type_chambre , prix_nuit ,id_image from chambre where id_chambre ='$row[0]'"); 
      $row2 = pg_fetch_row($result2);
    $resimg = pg_query($conn,"select chemin from Images where id_image ='$row2[4]'");
    $img = pg_fetch_row($resimg);
     
echo'
     <div class="col-sm-4">
      <div class="panel panel-danger">
      <div class="panel-body"><img src="'.$img[0].'" height="200" width="330"></div>';

         echo' <div class="panel-footer" style="text-align : center;">Etage : '.$row2[1].'</div>';
         echo' <div class="panel-footer" style="text-align : center;">Type de Chambre : '.$row2[2].'</div>';
         echo' <div class="panel-footer" style="text-align : center;">Prix : '.$row2[3].' € / Nuit</div>';
        echo' <div class="panel-footer" style="text-align : center;">
      <button type="submit"  class="btn btn-default"><a href="Confirmation.php?prix='.$row2[3].'&amp id_chambre='.$row2[0].'">Reserver</a></button>';
     echo'
      </div>
      </div>
    </div>';
    }

echo'
    </div>
    </div>
   <br><br>
   </body> ';

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