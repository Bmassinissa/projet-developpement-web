<?php
session_start();
 include('dbConne.php');
 
$dbconn =   connexion(); 
    if (isset($_POST['valider'])) {                  

if(isset($_POST["passwordNewConf"]) && isset($_POST["passwordNew"]) && isset($_POST["currentPassword"])) {


    $currentPassword = $_POST["currentPassword"];
    $passwordNew = $_POST["passwordNew"];
    $passwordNewConf = $_POST["passwordNewConf"];
    
     $options = [
            'cost' => 12,
        ];

        for ($i=0 ; $i<5;$i++){
            $passhash= password_hash($passwordNew, PASSWORD_BCRYPT,$options);
        }
       //recuperer les autres info par les coockie 
    if(isset($_SESSION["id"]) && isset($_SESSION["type"])) {

    $id=$_SESSION["id"];
    $type=$_SESSION["type"];
    if($_SESSION["type"]== "client") {
           
          $query = 'SELECT  mot_de_passe
          FROM compte
          WHERE id_client_connexion = \''.$id.'\' 
                ';
        $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
        $mdp=pg_fetch_result($result,0);

         if(password_verify($currentPassword , $mdp)) {
             
             $query ='  UPDATE compte
             SET mot_de_passe = \''.$passhash.'\'
             WHERE id_connexion=\''.$id.'\' ';
            $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
               header('Location: index.php');
               exit();
         }else {
             echo'<script>
               password();
             </script>';
         }
        
    }else if($_SESSION["type"]== "admin") {
              $query = 'SELECT  pass_word
                FROM admincompte
                    WHERE id_admin = \''.$id.'\' 
                ';
        $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
        $mdp=pg_fetch_result($result,0);

         if(password_verify($currentPassword , $mdp)) {
             
             $query ='  UPDATE admincompte
             SET pass_word = \''.$passhash.'\'
             WHERE id_admin=\''.$id.'\' ';
            $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
              header('Location: accueil_admin.php');
               exit();
         }else {
             echo'<script>
               password();
             </script>';
         }
    }
        
    
    
}
}
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <script>

         function password() {
              document.getElementById("currentPassword").style.borderColor= "red";
          
              
          }
       
          function validate() {
                 
          
            var mp = document.getElementById("passwordNew").value;
            var mpConfirm = document.getElementById("passwordNewConf").value;
   
               if (mp!=mpConfirm  ) {
                     document.getElementById("passwordNew").style.borderColor = "red";
                     document.getElementById("passwordNewConf").style.borderColor  = "red";
            
            }else {
            
                document.getElementById("passwordNew").style.borderColor = "green";
                document.getElementById("passwordNewConf").style.borderColor  = "green";           
               
                document.passwordChange.submit();
            }
            return false; 
                
            }
    </script>
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

        

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
            if(isset($_SESSION['id'])){
              echo'
               <li><a href="deconnexion.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-signe-in"></span>'.$_SESSION['nom'].' '.$_SESSION['prenom'].'</a></li>';
            }
        ?>
          
        
      </ul>
    </div>
  </div>
</nav>


<div class="page-header">
			<center>
				<h1>Forgot password?</h1>
				
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
								<label style="color: black" class="col-sm-4 col-form-label">Current Password</label>
								<div class="col-sm-8">
									<input type = "password" class="form-control" name = "currentPassword" id = "currentPassword"  placeholder="currentPassword" required />
								</div>
							</div>
							<div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">New Password</label>
								<div class="col-sm-8">
									 <input type="password" class="form-control" id="passwordNew" name="passwordNew"
                            minlength="8" required
                            placeholder="New Password" />
								</div>
							</div>
                            <div class="form-group row">
								<label style="color: black" class="col-sm-4 col-form-label">Confirm New Password</label>
								<div class="col-sm-8">
									 <input type = "password" class="form-control" name = "passwordNewConf" id = "passwordNewConf"  placeholder="Password Confirm" />
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
