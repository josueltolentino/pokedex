
<?php

require_once '../Helpers/utilities.php';
require_once 'estu.php';
require_once '../service/IServiceBase.php';
require_once '../Helpers/FileHandler/IFileHandler.php';
require_once '../Helpers/FileHandler/jsonFileHandler.php';
require_once 'estuServiceDatabase.php';
require_once 'estuServiceFile.php';
require_once '../database/EstudiantesContext.php';

$service = new estuServiceDatabase('../database/configuration.json');  
$utilities = new utilities(); 


if(isset($_POST['nombre'])  && isset($_POST['region']) && isset($_POST['tipo']) && isset($_POST['ataque']) && isset($_FILES['profilePhoto'])){


  $newEstu = new estu();

  $newEstu->InicializeData(0,$_POST['nombre'],$_POST['region'],$_POST['tipo'],$_POST['ataque']);

  $service->Add($newEstu);
   
  header("Location: ../index.php");
  exit();
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <link href="..\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="..\assets\css\style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <script href="..\assets\js\bootstrap.min.js"></script>
</head>

<body class="cuerpo">

<header>
  <div class="navbar navbar-dark bg-info shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="../index.php" class="navbar-brand d-flex align-items-center">
        <strong>Inicio</strong>
      </a>
    </div>
</header>

<h2 class="h2">Pokedex</h2>

<form enctype="multipart/form-data" action="add.php" method="POST">

<div class="forma card bg-white">
    <div class="card-header ch">
    Registro de Pokedex
    </div>

        <label for="photo">Foto del pokemon</label>
        <input type="file" name="profilePhoto"  id="profilePhoto">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre"  id="nombre">

        <label for="ataque">Ataque</label>
        <input type="text" name="ataque" placeholder="Ataque"  id="ataque">

        <label for="region">Region</label>
        <select class="custom-select" id="region" name="region">

        <?php foreach($utilities->region as $id => $text): ?>

        <option value="<?php echo $id ?>"><?php echo $text; ?></option>

        <?php endforeach; ?>

        </select>

        <label for="tipo">Tipo</label>
        <select class="custom-select" id="tipo" name="tipo">

        <?php foreach($utilities->tipo as $id => $text): ?>

        <option value="<?php echo $id ?>"><?php echo $text; ?></option>

        <?php endforeach; ?>

        </select>

       
        <button type="submit" class="btn btn-primary " id="sendForm">Enviar</button> 

        
</div>

</form>

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