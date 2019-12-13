<?php

function half_body(){
    echo' <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>


<div class="container text-center" style ="background-color: coral;width:50%;box-shadow: 0 3px 6px 0 "> 
  <h3>Search an hotel</h3>
  <div class="row" >
  <!-- form  -->
   <form name="choix_methode" method="post" action="index2.php">
    <div class="col-xs-12">
    <label for="email">Recherche</label><br>
     <select class="form-control form-control-lg" name="filtre">
       <option>Par hotel</option>
       <option>Par pays</option>
       <option>Par ville</option>

     </select><br>
        </div>
    <div class="col-xs-12"> 
       <button type="submit"  class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>Search</button>
    </div>
</form>
</div>
</div>

<h1 style="margin-left : 10%">Evadez vous avec nous<small>..jetez un coup oeil</small></h1><br>';

}
function normale_header(){

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
        <li class="active"><a href="index.php">Home</a></li>
        ';
       if(isset($_SESSION['type'])){
           if($_SESSION['type']=='client') {
                echo '<li><a href="#">Nouvelle recherche</a></li>';
           }else{
               echo '<li><a href="manip/addAdmin.php">Ajouter un admin</a></li>';
               echo '<li><a href="manip/add_chaine.php">Ajouter une chaine</a></li>';
               echo '<li><a href="manip/add_employe.php">Ajouter un employe </a></li>';
               echo '<li><a href="manip/add_chambre.php">Ajouter une chambre</a></li>';
               echo '<li><a href="manip/add_hotel.php">Ajouter un hotel</a></li>';
           }
       }
    echo'
      </ul>
      <ul class="nav navbar-nav navbar-right">
      '; 
        
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
          
    
        echo'
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol><div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="Images/header2.jpg" alt="Image" style="widht : 1200px ; height : 400px;">
        <div class="carousel-caption">
        </div>      
      </div>

      <div class="item">
       <img src="Images/header.jpg" alt="Image" style="widht : 1200px ; height : 400px;">     
      </div>
    </div>';
}

?>