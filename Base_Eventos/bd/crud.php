<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
$FolioCdt = (isset($_POST['FolioCdt'])) ? $_POST['FolioCdt'] : '';
$FolioCdtSalida = (isset($_POST['FolioCdtSalida'])) ? $_POST['FolioCdtSalida'] : '';
$Evento = (isset($_POST['Evento'])) ? $_POST['Evento'] : '';
$Movimiento = (isset($_POST['Movimiento'])) ? $_POST['Movimiento'] : '';
$Usuario = (isset($_POST['Usuario'])) ? $_POST['Usuario'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO eventos (Fecha, FolioCdt, FolioCdtSalida, Evento, Movimiento, Usuario) VALUES('$Fecha', '$FolioCdt', '$FolioCdtSalida', '$Evento', '$Movimiento', '$Usuario') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM eventos ORDER BY Id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE eventos SET Fecha='$Fecha', FolioCdt='$FolioCdt', FolioCdtSalida='$FolioCdtSalida', Evento='$Evento', Movimiento='$Movimiento', Usuario='$Usuario' WHERE Id='$Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM eventos WHERE Id='$Id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM eventos WHERE Id='$Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM eventos";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;