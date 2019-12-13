<?php
session_start();
include('dbConne.php');
$dbconn = connexion();
if(isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['valider'])) {


if(isset($_POST['user'])&&isset($_POST['password'])) {

 $username = $_POST['user'];
 $password = $_POST['password'];
 $isAdmin=0;
//HASH password 
    $options = [
    'cost' => 12,
];

//hashage du mdp
for ($i=0 ; $i<5;$i++){
    $passhash = password_hash($password, PASSWORD_BCRYPT,$options);
}
if(substr_count($username,'admin',0,5) == 1 ){
    $query = 'SELECT pass_word
          FROM admincompte 
          WHERE username_admin = \''.$username.'\'';
    $isAdmin=1;
}else {
$query = 'SELECT mot_de_passe
          FROM compte 
          WHERE utilisateur = \''.$username.'\'';
}
$hash = null;
$result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
$hash=pg_fetch_result($result,0);
    //si l'utilisateur n'est pas sur la DB
    if($hash == '') {
          echo '
            <script>
                    userDenied();
            </script>
          ';
    }else {
        //Si mdp correspond 
        if(password_verify($password , $hash)) {
            if($isAdmin == 1){
                    $query = 'SELECT id_admin
                        FROM admincompte
                        WHERE username_admin = \''.$username.'\'';
            $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
            $_SESSION['id'] =pg_fetch_result($result,0);
            $_SESSION['username'] = $username;
            $query = 'SELECT nom_admin
                    FROM admincompte
                    WHERE id_admin = \''.$_SESSION['id'].'\'';
                $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
            $_SESSION['nom'] = pg_fetch_result($result,0);
            $query = 'SELECT prenom_admin
                    FROM admincompte
                    WHERE id_admin = \''.$_SESSION['id'].'\'';
                $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
            $_SESSION['prenom'] = pg_fetch_result($result,0);
            $_SESSION['type'] = 'admin';
                $query = 'SELECT TypeAdmin
                    FROM admincompte
                    WHERE id_admin = \''.$_SESSION['id'].'\'';
                $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
                    $_SESSION["adminType"] = pg_fetch_result($result,0);
               

                
                header('Location: accueil_admin.php');
            
            
            }else {
            $query = 'SELECT id_client_connexion
                        FROM compte 
                        WHERE utilisateur = \''.$username.'\'';
            $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
            $_SESSION['id'] =pg_fetch_result($result,0);
            $_SESSION['username'] = $username;
            $query = 'SELECT nom_client
                    FROM clients
                    WHERE id_client = \''.$_SESSION['id'].'\'';
                $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
            $_SESSION['nom'] = pg_fetch_result($result,0);
            $query = 'SELECT prenom_client
                    FROM clients
                    WHERE id_client = \''.$_SESSION['id'].'\'';
                $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
            $_SESSION['prenom'] = pg_fetch_result($result,0);
                $_SESSION['type'] = 'client';
                  header('Location: index.php');

            
            }
            
        } else {
            //Si mdp incorrect 
             echo'<script>
                    passwordDenied();
                    
                  </script>';
        }
  
    }

pg_free_result($result);
}
pg_close($dbconn);

  }
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
    <script>
        function passwordDenied() {
                     document.getElementById("inputPassword").style.borderColor = "red";
        
        }
        function userDenied() {
                     document.getElementById("inputEmail").style.borderColor = "red";
        
        }
    
    
    </script>
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

        

        ';
     
    echo'
      </ul>
      <ul class="nav navbar-nav navbar-right">
    
                
          
                <li><a href="inscription.php"><span class="glyphicon glyphicon-signe-in"></span> Sign-in</a></li>';
            
          
    
        echo'
      </ul>
    </div>
  </div>
</nav>';
?>

<div class="page-header">
			<center>
				<h1>Login</h1>
				
			</center>
		</div>
		<div class="container">
			
			<div class="container-fluid text-left">
				<div class="row content">
					<div class="col-sm-4 collapset"></div>
	    <div class="col-sm-4" style="background-color: GhostWhite">
	    	<h1 style="color: Silver"></h1><br>
						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<!--<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Indentifiant</label>
								<div class="col-sm-8">
									<input class="form-control" type="text" name="identifiant"/>
								</div>
							</div>-->
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Username</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="user" id="inputEmail" placeholder="Username">
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Password</label>
								<div class="col-sm-8">
									 <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
								</div>
							</div>
							 <div class="forgot">
                        <a href="passwordForget.php">Forgot password?</a>
                        <a href="inscription.php">Subscrib</a>
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

