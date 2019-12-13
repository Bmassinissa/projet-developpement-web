<?php
   session_start();
    include('dbConne.php');
   $connexion=  connexion(); 
    ?>
<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
  <title>B&V Hotels</title>
  <meta charset="utf-8">
  <meta name="viewport" conte
  nt="width=device-width, initial-scale=1">
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
			
			<div class="container-fluid text-left">
				<div class="row content">
					<div class="col-sm-4 collapset">
			
	    			</div>
	    			<div class="col-sm-4" style="background-color: GhostWhite">
	    				<h1 style="color: Silver">Ajouter une Chaine</h1><br>
						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<!--<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Identifiant</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="identifiant"/>
								</div>
							</div>-->
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Nom</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="nom"/>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<input type="submit" value="Ajouter" class="form-control btn btn-success" name="valider">
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-4 collapset">
			
	    			</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php 
	
	if (isset($_POST['valider'])) {
		$query= 'SELECT COUNT(*) FROM chaine_hotel';
		$result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
		$id_chaine=pg_fetch_result($result,0);
		pg_free_result($result);
		$id_chaine++;

		$nom=htmlspecialchars(trim(addslashes($_POST['nom'])));
		
		$req="INSERT INTO chaine_hotel (id_chaine_hotel, nom_chaine_hotel) VALUES ('$id_chaine','$nom')";
		//execution de la requette
		$execution=pg_query($connexion, $req);
		if($execution){
			echo'  
				<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
						<div class="alert alert-success">
							<strong> chaine ajoutée avec succes !</strong>
						</div> 
						</div>
						</div> '
					;
		}
	}	
?>