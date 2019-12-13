<?php

session_start();
if(isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
  }
include('dbConne.php');
  
$dbconn =  connexion(); 
                    
                    
  if (isset($_POST['valider'])) {                  

    if (isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['adress'])&&isset($_POST['birth_day'])&&isset($_POST['nationality'])
        &&isset($_POST['email'])&&isset($_POST['login'])&&isset($_POST['password1'])) {
        $first_name= $_POST['first_name'];
        $last_name= $_POST['last_name'];
        $adress= $_POST['adress'];
        $birth_day= $_POST['birth_day'];
        $nationality= $_POST['nationality'];
        $mail= $_POST['email'];
        $login = $_POST['login'];
        $password1 = $_POST['password1'];

                     
                    $query= 'SELECT COUNT(*) 
                            FROM compte where utilisateur =\''.$login.'\'';

                    $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error()); 
                    $loginExist=pg_fetch_result($result,0);
                    if($loginExist != 0) {
                        echo' <script>login();
                        </script>
                        ';
                    }else{
                        //HASH password 
                        $options = [
                        'cost' => 12,
                        ];

                        for ($i=0 ; $i<5;$i++){
                            $passhash= password_hash($password1, PASSWORD_BCRYPT,$options);
                        }
                        $query= 'SELECT COUNT(*) 
                        FROM clients';

                        $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error()); 
                        $id_client=pg_fetch_result($result,0);
                        pg_free_result($result);
                        $id_client++;
                        $query= 'INSERT INTO clients(id_client,nom_client,prenom_client,adresse_client,date_naissance_client,nationalite_client) VALUES             (\''.$id_client.'\',\''.$first_name.'\',\''.$last_name.'\',\''.$adress.'\',\''.$birth_day.'\',\''.$nationality.'\')';
        $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
        pg_free_result($result);

        $query= 'SELECT COUNT(*) 
          FROM compte';

        $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
        $id_connexion=pg_fetch_result($result,0);
        $id_connexion++;
        pg_free_result($result);



        $query= 'INSERT INTO compte VALUES (\''.$id_connexion.'\',\''.$id_client.'\',\''.$login.'\',\''.$passhash.'\')';
        $result = pg_query($query) or die ('Echec de la requete : ' . pg_last_error());
        pg_free_result($result);
        header('Location: index.php');
        exit();
  
               

    }
    }

  }
    pg_close($dbconn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <script>
   
          function login() {
              document.getElementById("login").style.borderColor= "red";
          
              
          }
       
          function validate() {
                 
              nom=document.getElementById("last_name").value;
              prenom=document.getElementById("last_name").value;
              adresse=document.getElementById("adress").value;
              email1=document.getElementById("email").value;
              email2=document.getElementById("email1").value;
              motp1=document.getElementById("password1").value;
              motp2=document.getElementById("password2").value;
              dateN=document.getElementById("birth_day").value;
              Nation=document.getElementById("nationality").value;
            var mp = document.getElementById("password1").value;
            var mpConfirm = document.getElementById("password2").value;
            var mail = document.getElementById("email").value;
            var mailConfirm = document.getElementById("email1").value;
            if (mp!=mpConfirm || mail != mailConfirm) {
               if (mp!=mpConfirm && mail != mailConfirm ) {
                     document.getElementById("password1").style.borderColor = "red";
                     document.getElementById("password2").style.borderColor  = "red";
                   
                     document.getElementById("email").style.borderColor = "red";
                     document.getElementById("email1").style.borderColor  = "red";
                     } else if(mail != mailConfirm ) {
                   document.getElementById("email").style.borderColor = "red";
                     document.getElementById("email1").style.borderColor  = "red";
                }else if(  mp!=mpConfirm ){
                     document.getElementById("password1").style.borderColor = "red";
                     document.getElementById("password2").style.borderColor  = "red";
                }
            }else {
            
                document.getElementById("password1").style.borderColor = "green";
                document.getElementById("password2").style.borderColor  = "green";           
                document.getElementById("email").style.borderColor = "green";
                document.getElementById("email1").style.borderColor  = "green";
                document.inscription.submit();
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

       <li><a href="connexion.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
       
      </ul>    
    </div>
  </div>
</nav>

<div class="page-header">
      <center>
        <h1>Sign-In</h1>
        
      </center>
    </div>
    <div class="container">
      
      <div class="container-fluid text-left">
        <div class="row content">
          <div class="col-sm-4 collapset"></div>
      <div class="col-sm-4" style="background-color: GhostWhite">
        <h1 style="color: Silver"></h1><br>
            <form class="form-horizontal" action="inscription.php" method="post" onSubmit="return validate()">
              <!--<div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Indentifiant</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="identifiant"/>
                </div>
              </div>-->
              <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Nom</label>
                <div class="col-sm-8">
                  <input type = "text" class="form-control" name = "first_name" id = "first_name"  placeholder="First Name" required />
                </div>
              </div>
              <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Prenom</label>
                <div class="col-sm-8">
                   <input type = "text" class="form-control" name = "last_name" id = "last_name"   placeholder="Last Name" required />
                </div>
              </div>
                            <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Adresse</label>
                <div class="col-sm-8">
                   <input type = "text" class="form-control" name = "adress" id = "adress"  placeholder="Adress" required />
                </div>
              </div>
                            <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Date de Naissance</label>
                <div class="col-sm-8">
                    <input type = "date" class="form-control" name = "birth_day" id = "birth_day"  required/>
                </div>
              </div>
                            <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Nationalite</label>
                <div class="col-sm-8">
                   <input type = "text" class="form-control" name = "nationality" id = "nationality"  placeholder="Nationality" required />
                </div>
              </div>
                            <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">login</label>
                <div class="col-sm-8">
                   <input type = "text" class="form-control" name = "login" id = "login" placeholder = "Username" required/>
                </div>
              </div>
                            <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                   <input type="password" class="form-control" id="password2" name="password2"
                            minlength="8" required
                            placeholder="Password" />
                </div>
              </div>
                            <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Confirmer Password</label>
                <div class="col-sm-8">
                   <input type = "password" class="form-control" name = "password1" id = "password1"  placeholder="Password Confirm" />
                </div>
              </div>
                            <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                   <input type = "email" class="form-control" name = "email" id = "email"  placeholder="Email Address"/>
                </div>
              </div>
                            <div class="form-group row">
                <label style="color: black" class="col-sm-4 col-form-label">Email Confirm</label>
                <div class="col-sm-8">
                  <input type = "email" class="form-control" name = "email" id = "email1"  placeholder="Email Address Confirm"  />
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
