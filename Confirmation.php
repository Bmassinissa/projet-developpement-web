<?php
session_start();
   
    $date_arrivee = $_COOKIE['arrive'];
    $date_depart =$_COOKIE['depart'];
    $prix_totale =$_GET['prix']*(abs(strtotime($date_depart)-strtotime($date_arrivee))/86400);
    $id_chambre=$_GET['id_chambre'];
   
    if(!isset($_SESSION['id'])) {
      header('Location: connexion.php');
     exit();
    }
    else{
       $id_client=$_SESSION['id'];
   }

include('dbConne.php');
   $conn=  connexion(); 
if (!$conn) {
  echo "Connexion echouée\n";
  
}
$reqCount=pg_query($conn, "select count(*) from reservation");
$count= pg_fetch_result($reqCount,0);
$count++;

$result=pg_query($conn, "insert into reservation (id_reservation,id_client, date_debut_reservation,date_fin_reservation,prix_totale,etat,id_chambre) values('$count','$id_client','$date_arrivee','$date_depart','$prix_totale','1','$id_chambre')");


if (!$result) {
  echo "Insertion incomplete.\n";
  
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
    <h1>Confirmation de votre reservation</h1>      
    <p>Merci pour avoir choisi nos hotels , a bientot !</p>
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
     echo ' </ul>
    </div>
  </div>
</nav>';

echo'<div class="container">    
  <div class="row">

 <h1 style="margin-left : 10%">Nous vous confirmons votre reservation entre '.$date_arrivee.' et '.$date_depart.' </h1><br>
 <h2 style="margin-left : 10%">Merci de nous avoir choisi, et a bientot !</h1><br>';
echo'
    
    </div>
    </div>
   <br><br>
</body>';
echo'   
<footer class="container-fluid text-center">
   <p>Inscription aux alertes</p>    
  <form class="form-inline" action="mailAlert.php" method="post">
    <input type="email" class="form-control" size="30" placeholder="Email Address" name="AdresseMail">
    <button type="submit" class="btn btn-danger">Inscription</button>
  </form>
</footer>

</html>';
?>


