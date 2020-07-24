
<?php 

require_once 'Helpers/utilities.php';
require_once 'Students/estu.php';
require_once 'service/IServiceBase.php';
require_once 'Helpers/FileHandler/IFileHandler.php';
require_once 'Helpers/FileHandler/jsonFileHandler.php';
require_once 'Students/estuServiceDatabase.php';
require_once 'Students/estuServiceFile.php';
require_once 'database/EstudiantesContext.php';

$utilities = new utilities();
$service = new estuServiceDatabase("database/configuration.json"); 

$listadoEstu = $service->GetList();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <link href="assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets\css\style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <script href="assets\js\bootstrap.min.js"></script>
</head>

<body class="cuerpo">

<header>
  <div class="collapse bg-dark">
    <div class="container">
      <div class="row">
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-info shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="index.php" class="navbar-brand d-flex align-items-center">
        <strong>Inicio</strong>
      </a>
    </div>
  </div>
</header>


<h2 class="h2">Pokedex</h2>

<div class="text-center ">
<a href="Students\add.php" class="btn bg">Registar Pokemon</a>
</div>

<div class="row fil">

<div class="col-md-9"></div>

    <div class="col-md-3"></div>

    <a href="Students/tabla.php" class="btn bg-light">Ver en formato tabla</a>

  </div>
     
<div class="album py-5 bg-light con">
<div class="container">

<div class="row"> 

<?php if(empty($listadoEstu)): ?>

  
  <h2 class="hc ">No hay pokemones registrados</h2>


<?php else: ?>

  <?php foreach($listadoEstu as $estu): ?>
    
<div class="col-md-4">
<div class="card" style="width: 18rem;">

<?php if($estu->profilePhoto == "" || $estu->profilePhoto == null): ?>

  <img class="card-img-top" src="<?php echo "assets/img/default.png" ?>" width="100%" height="200">


<?php else: ?>

  <img class="card-img-top" src="<?php echo "assets/img/estudiantes/" . $estu->profilePhoto; ?>" width="100%" height="200">

<?php endif; ?> 

    <?php if($estu->getRegion()== "Kanto"): ?>
    <div class="card-body" style="background-color: red;"> 
    <?php elseif($estu->getRegion()== "Johto"): ?>
    <div class="card-body" style="background-color: aqua;"> 
    <?php elseif($estu->getRegion()== "Hoenn"): ?>  
    <div class="card-body" style="background-color: brown;"> 
    <?php elseif($estu->getRegion()== "Aura"): ?>  
    <div class="card-body" style="background-color: green;">   
    <?php elseif($estu->getRegion()== "Sinnoh"): ?>  
    <div class="card-body" style="background-color: cornflowerblue;"> 
    <?php endif; ?>
    <h5 class="card-title"><?php echo $estu->nombre; ?></h5>
    <h5 class="card-subtitle mb-2 text-muted"><?php echo $estu->getTipo(); ?></h5> 
    <p class="card-text"><?php echo $estu->getRegion(); ?></p>
    <a href="Students/edit.php?id=<?php echo $estu->id; ?>" class="card-link">Editar</a>
    <a href="#" onclick="preguntar(<?php echo $estu->id; ?>)"class="card-link">Eliminar</a>
    <a href="Students/detalles.php?id=<?php echo $estu->id; ?>" class="card-link">Detalles</a>
  </div>
</div>
</div> 

  <?php endforeach; ?>  


<?php endif; ?>  
</div>
</div>
</div>

<footer class="text-muted text-center">
  <div class="container">
    <p class="float-right">
      <a href="#" class="h22">Volver arriba</a>
    </p>
    <p class="p">Pokedex &copy;</p>
  </div>
</footer>

<script class="text/javascript">
function preguntar(id) {
  if(confirm('¿Esta seguro que desea eliminar el pokemon?')){
    window.location.href="Students/delite.php?id="+id;
  }
}

</script>
    
</body>
</html>