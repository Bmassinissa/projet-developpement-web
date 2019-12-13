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
					<div class="col-sm-4 collapset">
	    </div>
	    <div class="col-sm-4" style="background-color: GhostWhite">
	    	<h1 style="color: Silver">Ajouter un Hotel</h1><br>
						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<!--	<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">identifiant</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="identifiant"/>
								</div>
							</div>-->
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">nom</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="nom"/>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">adresse</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="adresse"/>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">superficie</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="superficie"/>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">nombre d'étage</label>
								<div class="col-sm-8">
									<input class="form-control" type="number" name="etage"/>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">nombre chambre</label>
								<div class="col-sm-8">
									<input class="form-control" type="number" name="chambre"/>
								</div>
							</div>
							<div class="form-group">
								<label style="color: black" class="col-sm-4 col-form-label">chaine</label>
								<div class="col-sm-8">
									<select class="form-control" name="chaine" size="1">
										<?php
											$req="SELECT * FROM chaine_hotel";
											$exec=pg_query($connexion, $req);
											$resultat=pg_fetch_all($exec);
											foreach ($resultat as $key => $value) {
												echo '<option>'.$value["nom_chaine_hotel"].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">pays</label>
								<div class="col-sm-8">
									<select class="form-control" name="pays" size="1">
										<?php
											$req="SELECT * FROM pays";
											$exec=pg_query($connexion, $req);
											$resultat=pg_fetch_all($exec);
											foreach ($resultat as $key => $value) {
												echo '<option>'.$value["nom_pays"].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<input class="form-control btn btn-success" type="submit" value="Ajouter" name="valider">
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

		$query= 'SELECT COUNT(*) FROM hotel';
		$result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
		$id_hotel=pg_fetch_result($result,0);
		pg_free_result($result);
		$id_hotel++;

		//$id=htmlspecialchars(trim(addslashes($id_hotel)));
		$nom=htmlspecialchars(trim(addslashes($_POST['nom'])));
		$adresse=htmlspecialchars(trim(addslashes($_POST['adresse'])));
		$superficie=htmlspecialchars(trim(addslashes($_POST['superficie'])));
		$etage=htmlspecialchars(trim(addslashes($_POST['etage'])));
		$chambre=htmlspecialchars(trim(addslashes($_POST['chambre'])));
		$chaine=htmlspecialchars(trim(addslashes($_POST['chaine'])));
		$pays=htmlspecialchars(trim(addslashes($_POST['pays'])));
		
		$req1="SELECT * FROM chaine_hotel WHERE nom_chaine_hotel='$chaine'";
		$exec=pg_query($connexion, $req1);
		$resultat=pg_fetch_row($exec);
		$chaine_hotel=$resultat[0];

		$req2="SELECT * FROM pays WHERE nom_pays='$pays'";
		$exe=pg_query($connexion,$req2);
		$result=pg_fetch_row($exe);
		$id_pay=$result[0];



		$req="INSERT INTO hotel (id_hotel, nom_hotel, adresse_hotel, superficie_hotel, nombre_etage_hotel, nombre_max_chambre, chaine_hotel, id_pays) VALUES ('$id_hotel','$nom','$adresse','$superficie','$etage','$chambre','$chaine_hotel','$id_pay')";
		//execution de la requette
		$execution=pg_query($connexion, $req);
		if($execution){
			echo'  
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4">
						<div class="alert alert-success">
							<strong> hotel ajoutée avec succes !</strong>
						</div> 
					</div>
				</div> ';
		}
	}
?>