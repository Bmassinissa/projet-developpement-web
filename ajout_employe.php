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
					<div class="col-sm-4 collapset"></div>
	    <div class="col-sm-4" style="background-color: GhostWhite">
	    	<h1 style="color: Silver">Ajouter un employe</h1><br>
						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<!--<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Indentifiant</label>
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
								<label style="color: black" class="col-sm-4 col-form-label">Prenom</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="Prenom"/>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Adresse</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="adresse"/>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Telephone</label>
								<div class="col-sm-8">
									<input class="form-control" type="tel" name="telephone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Emploi</label>
								<div class="col-sm-8">
									<select class="form-control" name="emploi" size="1">
										<option>Receptionniste
										<option>Serveur
										<option>Cuisinier
										<option>Barman
										<option>Chef de rang
										<option>Voiturien
										<option>Menagere
										<option>Gestionnaire
										<option>Consierge
										<option>Directeur
										<option>Baggagiste
										<option>Gardien
										<option>Technicien
										<option>Groom
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Date d'arrivé</label>
								<div class="col-sm-8">
									<input class="form-control" type="date" name="date_debut"/>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Hotel</label>
								<div class="col-sm-8">
									<select class="form-control" name="hotel">
										<?php
											$req="SELECT * FROM hotel";
											$exec=pg_query($connexion, $req);
											$resultat=pg_fetch_all($exec);
											foreach ($resultat as $key => $value) {
												echo '<option>'.$value["nom_hotel"].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<input type="submit" value="Valider" class="form-control btn btn-success" name="valider">
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-4 collapset"></div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php 
	if (isset($_POST['valider'])) {

		$query= 'SELECT COUNT(*) FROM employe';
		$result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
		$id_employe=pg_fetch_result($result,0);
		pg_free_result($result);
		$id_employe++;

		$nom=htmlspecialchars(trim(addslashes($_POST['nom'])));
		$prenom=htmlspecialchars(trim(addslashes($_POST['Prenom'])));
		$adresse=htmlspecialchars(trim(addslashes($_POST['adresse'])));
		$tel=htmlspecialchars(trim(addslashes($_POST['telephone'])));
		$emploi=htmlspecialchars(trim(addslashes($_POST['emploi'])));
		$debut=htmlspecialchars(trim(addslashes($_POST['date_debut'])));
		$hotel=htmlspecialchars(trim(addslashes($_POST['hotel'])));

		$req1="SELECT * FROM hotel WHERE nom_hotel='$hotel'";
		$exec=pg_query($connexion, $req1);
		$resultat=pg_fetch_row($exec);

		$id_hotel=$resultat[0];
		
		$req="INSERT INTO employe (id_employe, nom_employe, prenom_employe, adresse_employe, numero_tel_employe, emploi, date_debut, id_hotel) VALUES ('$id_employe','$nom','$prenom','$adresse','$tel','$emploi','$debut','$id_hotel')";
	
		$execution=pg_query($connexion, $req);
		if($execution){
			echo'  
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4">
						<div class="alert alert-success">
							<strong> employe ajoutée avec succes !</strong>
						</div> 
					</div>
				</div> ';
		}
	}
?>