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
$isContaintId = isset($_GET['id']);


if($isContaintId){

$estuId = $_GET['id'];
$service->Delete($estuId);

}

header("Location: ../index.php");
exit();

?>