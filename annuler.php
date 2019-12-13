<?php
    session_start();
	 include('dbConne.php');
   $connexion=  connexion(); 
    
	 $id = $_GET['id'];
  


	$req = "SELECT * FROM reservation WHERE id_reservation='$id'";
    $resultat=pg_query($connexion, $req);

    $nbresult=pg_num_rows($resultat);
    if ($nbresult>0){
     $row = pg_fetch_row($resultat);
     $reservation = $row[0];
     $client = $row[1];
     $date_deb = $row[2];
     $date_fin = $row[3];
     $chambre = $row[5];

     $req = "SELECT * FROM clients WHERE id_client='$client'";
     $execution = pg_query($connexion, $req);

     $ligne = pg_fetch_row($execution);
     $nom = $ligne[1];
	    $prenom = $ligne[2];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Hotels</title>
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

        <li class="active"><a href="accueil_admin.php">Home</a></li>
        <?php
      echo'
        <li><a href="liste_reservation.php">Liste des Reservation</a></li>
        <li><a href="passwordChange.php">Changer le mot de passe</a></li>


        ';
        if($_SESSION["adminType"]=="Super") {
            echo'
            <li><a href="ajout_admin.php">Ajouter Un Admin</a></li>';
        }


        ?>
           </ul>
      <ul class="nav navbar-nav navbar-right">

		<?php
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
			echo'<br><br><br><br><br><br><br><br><br><br>
		<div class="container">
			<div class="col-sm-3 collapset">
	  </div>
			<div class=" panel well col-sm-6">
				<div class="panel-header">
					<h2 style="color:red"><span class="glyphicon glyphicon-warning-sign"></span> Confirmer Annulation</h2>
				</div>
				<div class="panel-body">
					<strong>Reservation de M./Mme : '.$nom.'  '.$prenom.'</strong><br>
					<h4 style="color:DarkOrange">Etes vous sure de vouloir annuler la réservation?</h4>
				</div>
				<form method="post" action="#">
				<input type="hidden" name="chambre" value="'.$chambre.'"/>
				<center><div class="btn-group">
					<a href="liste_reservation.php" class="btn btn-warning"><strong>Annuler</strong></a>
					<input type="submit" name="confirmer" value="Confirmer" class="btn btn-danger">
				</div></center>
			</form>
			</div>
			<div class="col-sm-3 collapset">
	  </div>
		</div>
			';

			if(isset($_POST['confirmer'])){
                $today= date("Y-m-d");
				
                $req4='UPDATE reservation SET date_fin_reservation = \''.$today.'\' WHERE id_reservation=\''.$id.'\'';
				$exe = pg_query($connexion, $req4);
                $req4='UPDATE reservation SET etat =  \'0\' WHERE id_reservation=\''.$id.'\'';
				$exe = pg_query($connexion, $req4);
                $_SESSION["annulation_confirme"] = $id;
			
					echo'  
						<div class="row">
							<div class="col-sm-4 col-sm-offset-4">
								<div class="alert alert-success">
									<strong> Reservation Annulée!</strong>
								</div> 
							</div>
						</div> ';
				}
                 
				//
			
		?>
	</body>
</html>