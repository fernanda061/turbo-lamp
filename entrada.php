<?php 
class Conexion{	  
    public static function Conectar() {        
        define('servidor', 'localhost');
        define('nombre_bd', 'folios_cdt');
        define('usuario', 'root');
        define('password', '');					        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);			
            return $conexion;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}
?>
<?php
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM entradasua";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$entrada=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!--    Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    <title></title> 

    <style>
        table.dataTable thead {
            background: linear-gradient(to right, #00008B, #000000, #00008B);
            color:white;
        }
    </style>

  </head>
  <body>
    <h2 class="text-center">Oficios</h2>
      
    <h3 class="text-center">CDTS Entradas</h3>
    
    <div class="container">
       <div class="row">
           <div class="col-lg-12">
            <table id="entrada" class="table-striped table-bordered" style="width:50%">
                <thead class="text-center">
                    <th>ID</th>
                    <th>Fecha de Recibido</th>
                    <th>Folio CDT</th>                               
                    <th>Req CDT Salida</th>  
                    <th>Folio GINP</th>
                    <th>OT GINP</th>
                    <th>Folio Didt</th>
                    <th>OT Didt</th>
                    <th>Fecha de Requerimiento</th>
                    <th>Referencia</th>
                    <th>Descripcion</th>
                    <th>Observaciones</th>
                    <th>D1</th>
                    <th>D2</th>
                    <th>D3</th>
                    <th>D4</th>
                    <th>D5</th>
                    <th>D6</th>
                    <th>D7</th>
                    <th>D8</th>
                    <th>D9</th>
                    <th>D10</th>
                    <th>D11</th>
                    <th>Prioridad</th>
                    <th>Solicitud Para Respuesta</th>
                    <th>Solicitud para su Conocieminto</th>
                    <th>Solicitud para su Seguimiento</th>
                    <th>Sol para Tramite Conducente</th>
                    <th>Sol Tratar proximo Acuerdo</th>
                    <th>Usuario</th>
                    <th>Movimiento</th>
                    <th>Fecha de Movimiento</th>
                </thead>
                <tbody>
                    <?php
                        foreach($entrada as $entrada){
            
                    ?>
                    <tr>
                        <td><?php echo $entrada['Id']?></td>
                        <td><?php echo $entrada['FechaRecibido']?></td>
                        <td><?php echo $entrada['FolioCdt']?></td>
                        <td><?php echo $entrada['ReqCdtSalida']?></td>
                        <td><?php echo $entrada['FolioGinp']?></td>
                        <td><?php echo $entrada['OtGinp']?></td>
                        <td><?php echo $entrada['FolioDidt']?></td>
                        <td><?php echo $entrada['OtDidt']?></td>
                        <td><?php echo $entrada['FechaRequerido']?></td>
                        <td><?php echo $entrada['Referencia']?></td>
                        <td><?php echo $entrada['Descripcion']?></td>
                        <td><?php echo $entrada['Observaciones']?></td>
                        <td><?php echo $entrada['d1']?></td>
                        <td><?php echo $entrada['d2']?></td>
                        <td><?php echo $entrada['d3']?></td>
                        <td><?php echo $entrada['d4']?></td>
                        <td><?php echo $entrada['d5']?></td>
                        <td><?php echo $entrada['d6']?></td>
                        <td><?php echo $entrada['d7']?></td>
                        <td><?php echo $entrada['d8']?></td>
                        <td><?php echo $entrada['d9']?></td>
                        <td><?php echo $entrada['d10']?></td>
                        <td><?php echo $entrada['d11']?></td>
                        <td><?php echo $entrada['Prioridad']?></td>
                        <td><?php echo $entrada['Sol_ParaRespuesta']?></td>
                        <td><?php echo $entrada['Sol_ParaSuConocimiento']?></td>
                        <td><?php echo $entrada['Sol_ParaSuSeguimiento']?></td>
                        <td><?php echo $entrada['Sol_TramiteConducente']?></td>
                        <td><?php echo $entrada['Sol_TratarProximoAcuerdo']?></td>
                        <td><?php echo $entrada['Usuario']?></td>
                        <td><?php echo $entrada['Movimiento']?></td>
                        <td><?php echo $entrada['FechaMovimiento']?></td>
                        
                    </tr>
                    <?php
                        }
                    ?>
        
                </tbody>
            </table>
           </div>
       </div> 
    </div>
   
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      
      
<!--    Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
      
      
    <script>
      $(document).ready(function() {
          $('#entrada').DataTable();
            
      });
    </script>
      
      
  </body>
</html>