<?php

require_once '../Helpers/utilities.php';
require_once 'estu.php';
require_once '../service/IServiceBase.php';
require_once '../database/EstudiantesContext.php';
require_once 'estuServiceDatabase.php';
require_once '../Helpers/FileHandler/jsonFileHandler.php';

$service = new estuServiceDatabase('../database/configuration.json');
$isContaintId = isset($_GET['id']);   

$estuId = $_GET['id'];
$element = $service->GetById($estuId);
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de estudiantes ITLA</title>
    <link href="..\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="..\assets\css\style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <script href="..\assets\js\bootstrap.min.js"></script>
</head>

<body class="cuerpo">

<header>
  <div class="navbar navbar-dark bg-info shadow-sm">
    <div class="container d-flex justify-content-between ">
      <a href="../index.php" class="navbar-brand d-flex align-items-center">
        <strong>Inicio</strong>
      </a>
    </div>
</header>

<h2 class="h2">Detalles del Pokemon</h2>



    <div class="card forma" style="width: 18rem;">

 <?php if($element->profilePhoto == "" || $element->profilePhoto == null): ?>

  <img class="card-img-top" src="<?php echo "../assets/img/default.png" ?>" width="100%" height="200">


 <?php else: ?>

  <img class="card-img-top" src="<?php echo "../assets/img/estudiantes/" . $element->profilePhoto; ?>" width="100%" height="200">

 <?php endif; ?>

     

       <label for="nombre" class="es">Nombre del pokemon:</label>
       <p class="text-muted"><?php echo $element->nombre; ?></p> 

       <label for="asignacion">Ataque:</label>
       <p class="text-muted"><?php echo $element->ataque; ?></p>
      
       <label for="region">Region:</label>
       <p class="text-muted"><?php echo $element->getRegion(); ?></p>

       <label for="tipo">Tipo:</label>
       <p class="text-muted"><?php echo $element->getTipo(); ?></p>


       <a href="../index.php" >Volver atras</a>

       </div>


<footer class="text-muted text-center">
  <div class="container">
    <p class="float-right">
      <a href="#" class="h22">Volver arriba</a>
    </p>
    <p class="p">Pokedex &copy;</p>
  </div>
</footer>
    
</body>
</html>