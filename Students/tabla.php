<?php 

require_once '../Helpers/utilities.php';
require_once 'estu.php';
require_once '../service/IServiceBase.php';
require_once '../Helpers/FileHandler/IFileHandler.php';
require_once '../Helpers/FileHandler/jsonFileHandler.php';
require_once 'estuServiceDatabase.php';
require_once 'estuServiceFile.php';
require_once '../database/EstudiantesContext.php';

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
    <link href="..\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="..\assets\css\style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <script href="..\assets\js\bootstrap.min.js"></script>
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
      <a href="../index.php" class="navbar-brand d-flex align-items-center">
        <strong>Inicio</strong>
      </a>
    </div>
  </div>
</header>


<h2 class="h2">Pokedex</h2>

<div class="text-center ">
<a href="add.php" class="btn bg">Registar Pokemon</a>
</div>

<div class="row fil">

<div class="col-md-9"></div>

    <div class="col-md-3"></div>

    <a href="../index.php" class="btn bg-light">Volver a inicio</a>

  </div>
     
<div class="album py-5 bg-light con">
<div class="container">

<div class="row"> 

<?php if(empty($listadoEstu)): ?>

  
  <h2 class="hc ">No hay pokemones registrados</h2>


<?php else: ?>
  

  <div class="container" id="tablad">
       <table class="table table-bordered table-hover" id="tabla">
         <thead>
         <tr class="alert-primary">
                <th scope="col">Id</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Region</th>
                <th>Tipo</th>
                <th>Accion</th> 
            </tr> 
         </thead>
         <tbody>

  <?php foreach($listadoEstu as $estu): ?>
    <?php if($estu->getRegion()== "Kanto"): ?>
    <tr style="background-color: red">
    <?php elseif($estu->getRegion()== "Johto"): ?>
    <tr style="background-color:aqua">
    <?php elseif($estu->getRegion()== "Hoenn"): ?>  
    <tr style="background-color:brown"> 
    <?php elseif($estu->getRegion()== "Aura"): ?>  
    <tr style="background-color:green">   
    <?php elseif($estu->getRegion()== "Sinnoh"): ?>  
    <tr style="background-color:cornflowerblue"> 
    <?php endif; ?>
    <th scope="row"> <?php echo $estu->id ?> </th>
    <td>
<?php if($estu->profilePhoto == "" || $estu->profilePhoto == null): ?>

<img  src="<?php echo "../assets/img/default.png" ?>" width="100px" height="100px">

<?php else: ?>

<img  src="<?php echo "../assets/img/estudiantes/" . $estu->profilePhoto; ?>" width="100px" height="100px">

<?php endif; ?>
    </td>
    <td> <?php echo $estu->nombre ?></td>
    <td> <?php echo $estu->getRegion(); ?></td>
    <td> <?php echo $estu->getTipo(); ?></td>
    <td><a class="btn btn-danger" onclick="preguntar(<?php echo $estu->id; ?>)">Borrar</a>
    <a class="btn btn-warning" href="Students/edit.php?id=<?php echo $estu->id; ?>">Editar</a></td>
    </tr>
  <?php endforeach; ?>  

    </tbody>
    </table> 
    </div>

<?php endif; ?>  
</div>
</div>
</div>

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
    window.location.href="delite.php?id="+id;
  }
}

</script>
    
</body>
</html>