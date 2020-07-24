
<?php

require_once '../Helpers/utilities.php';
require_once 'estu.php';
require_once '../service/IServiceBase.php';
require_once '../Helpers/FileHandler/IFileHandler.php';
require_once '../Helpers/FileHandler/jsonFileHandler.php';
require_once 'estuServiceDatabase.php';
require_once 'estuServiceFile.php';
require_once '../database/EstudiantesContext.php';

$service = new estuServiceDatabase("../database/configuration.json"); 
$utilities = new utilities();
$isContaintId = isset($_GET['id']);    

if(isset($_GET['id'])){

  $estuId = $_GET['id'];
  $element = $service->GetById($estuId);

  if(isset($_POST['nombre']) &&  isset($_POST['region']) && isset($_POST['tipo']) && isset($_POST['ataque']) 
  && isset($_FILES['profilePhoto'])){

    $updateEstu = new Estu();

    $updateEstu->InicializeData($estuId,$_POST['nombre'],$_POST['region'],$_POST['tipo'],$_POST['ataque']);
    
    $service->Update($estuId,$updateEstu);

    header("Location: ../index.php");
    exit();
    
   
  
  } 

}else{
  
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

<form enctype="multipart/form-data" action="edit.php?id=<?php echo $element->id; ?>" method="POST">

<div class="forma card bg-white">
    <div class="card-header ch">
    Pokedex
    </div>

    <div class="card" style="width: 18rem;">

<?php if($element->profilePhoto == "" || $element->profilePhoto == null): ?>

  <img class="card-img-top" src="<?php echo "../assets/img/default.png" ?>" width="100%" height="200">


<?php else: ?>

  <img class="card-img-top" src="<?php echo "../assets/img/estudiantes/" . $element->profilePhoto; ?>" width="100%" height="200">

<?php endif; ?>

  <div class="card-body"> 
        <label for="photo">Foto del pokemon</label>
        <input type="file" name="profilePhoto"  id="profilePhoto">
  </div>
</div>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre"  id="nombre" value="<?php echo $element->nombre; ?>">

        <label for="ataque">Ataque</label>
        <input type="text" name="ataque" placeholder="Ataque"  id="ataque" value="<?php echo $element->ataque; ?>">

        <label for="region">Region</label>

        <select class="custom-select" id="region" name="region">

        <?php foreach($utilities->region as $id => $text): ?>

        <?php if($id == $element->region): ?>

          <option selected value="<?php echo $id ?>"> <?php echo $text; ?> </option>

        <?php else: ?>

          <option value="<?php echo $id ?>"><?php echo $text; ?></option>

        <?php endif; ?>

        <?php endforeach; ?>

        </select>
        

        <label for="tipo">Tipo</label>

        <select class="custom-select" id="tipo" name="tipo">

        <?php foreach($utilities->tipo as $id => $text): ?>

        <?php if($id == $element->tipo): ?>

        <option selected value="<?php echo $id ?>"> <?php echo $text; ?> </option>

        <?php else: ?>

        <option value="<?php echo $id ?>"><?php echo $text; ?></option>

        <?php endif; ?>

        <?php endforeach; ?>

        </select>

        <button type="submit" class="btn btn-primary " id="sendForm">Enviar</button> 
       
       </div>
     
        
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