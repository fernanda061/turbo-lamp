<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Usuario = (isset($_POST['Usuario'])) ? $_POST['Usuario'] : '';
$Password = (isset($_POST['Password'])) ? $_POST['Password'] : '';
$Area = (isset($_POST['Area'])) ? $_POST['Area'] : '';
$dn = (isset($_POST['dn'])) ? $_POST['dn'] : '';
$TipoDeCuenta = (isset($_POST['TipoDeCuenta'])) ? $_POST['TipoDeCuenta'] : '';
$Registro = (isset($_POST['Registro'])) ? $_POST['Registro'] : '';
$Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO usuarios (Nombre, Usuario, Password, Area, dn, TipoDeCuenta, Registro, Fecha) VALUES('$Nombre', '$Usuario', '$Password', '$Area', '$dn', '$TipoDeCuenta', '$Registro', '$Fecha') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM usuarios ORDER BY Id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE usuarios SET Nombre='$Nombre', Usuario='$Usuario', Password='$Password', Area='$Area', dn='$dn', TipoDeCuenta='$TipoDeCuenta', Registro='$Registro', Fecha='$Fecha' WHERE Id='$Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM usuarios WHERE Id='$Id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM usuarios WHERE Id='$Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM usuarios";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;