<?php
session_start();
echo '<!DOCTYPE html>
<html lang="en">
<head>
  <title>B&V Hotels</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>

  <style>
 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }


  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>

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
        <li class="active"><a href="#">Home</a></li>

        <li><a href="liste_reservation.php">Liste des Reservation</a></li>
        <li><a href="passwordChange.php">Changer le mot de passe</a></li>


        ';
        if($_SESSION["adminType"]=="Super") {
            echo'
            <li><a href="ajout_admin.php">Ajouter Un Admin</a></li>';
        }
     
    echo'
      </ul>
      <ul class="nav navbar-nav navbar-right">
      '; 
        
            if(isset($_SESSION['id'])){
                      
                
                echo'
                <li><a href="deconnexion.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-signe-in"></span>'.$_SESSION['nom'].' '.$_SESSION['prenom'].'</a></li>';
            }
          
    
        echo'
      </ul>
    </div>
  </div>
</nav>';
?>
<div class="page-header">
		<center>
			<h1>Administration</h1>
			<h4>Section Administration</h4>
		</center>
	</div>
	<div class="container">
		<div class=" row text-center" id="choix">
			<div style="background-color:GhostWhite;" class="well col-lg-6">
				<h2>Chaine Hotel</h2>
				<div class="btn btn-group-vertical">
				<a href="liste_chaine.php" class="btn btn-info">Visualiser <span class="glyphicon glyphicon-eye-open"></span></a><br>
				<a href="ajout_chaine.php" class="btn btn-success">Ajouter <span class="glyphicon glyphicon-plus-sign"></span></a>
				</div>
			</div>
			<div style="background-color:GhostWhite;" class="well col-lg-6">
				<h2>Hotels</h2>
				<div class="btn btn-group-vertical">
				<a href="liste_hotel.php" class="btn btn-info">Visualiser <span class="glyphicon glyphicon-eye-open"></span></a><br>
				<a href="ajout_hotel.php" class="btn btn-success">Ajouter <span class="glyphicon glyphicon-plus-sign"></span></a>
				</div>
			</div>
			<div style="background-color:GhostWhite;" class="well col-lg-6">
				<h2>Chambres</h2>
				<div class="btn btn-group-vertical">
				<a href="liste_chambre.php" class="btn btn-info">Visualiser <span class="glyphicon glyphicon-eye-open"></span></a>
				<br>
				<a href="ajout_chambre.php" class="btn btn-success">Ajouter <span class="glyphicon glyphicon-plus-sign"></span></a>
			</div>
			</div>
			<div style="background-color:GhostWhite;" class="well col-lg-6">
				<h2>Employés</h2>
				<div class="btn btn-group-vertical">
				<a href="liste_employe.php" class="btn btn-info">Visualiser <span class="glyphicon glyphicon-eye-open"></span></a><br>
				<a href="ajout_employe.php" class="btn btn-success">Ajouter <span class="glyphicon glyphicon-plus-sign"></span></a>
				</div>
			</div>
            <div style="background-color:GhostWhite;" class="well col-lg-6">
				<h2>Network Activity</h2>
				<div class="btn btn-group-vertical">
				<a href="liste_log.php" class="btn btn-info">Visualiser <span class="glyphicon glyphicon-eye-open"></span></a><br>
				
				</div>
			</div>
       
		</div>
	</div>
</body>
</html>
