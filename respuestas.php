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

$consulta = "SELECT * FROM respuestas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$respuestas=$resultado->fetchAll(PDO::FETCH_ASSOC);
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
            background: linear-gradient(to right, #00008B, #000000);
            color:white;
        }
    </style>

  </head>
  <body>
    <h2 class="text-center">Oficios</h2>
      
    <h3 class="text-center">Respuestas</h3>
    
    <div class="container">
       <div class="row">
           <div class="col-lg-12">
            <table id="respuestas" class="table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                    <th>ID</th>
                    <th>Folio CDT</th>
                    <th>Folio CDT Respuestas</th>                               
                    <th>Destinatorio</th>  
                    <th>Fecha de Respuesta</th>
                    <th>Numero de Respuesta</th>
                    <th>Comentarios de Respuesta Area</th>
                    <th>Comentarios Respuesta UA</th>
                    <th>Fecha Revision UA</th>
                    <th>Estatus</th>
                </thead>
                <tbody>
                    <?php
                        foreach($respuestas as $respuestas){
            
                    ?>
                    <tr>
                        <td><?php echo $respuestas['Id']?></td>
                        <td><?php echo $respuestas['FolioCdt']?></td>
                        <td><?php echo $respuestas['FolioCdtRespuesta']?></td>
                        <td><?php echo $respuestas['Destinatario']?></td>
                        <td><?php echo $respuestas['FechaRespuesta']?></td>
                        <td><?php echo $respuestas['NumeroDeRespuesta']?></td>
                        <td><?php echo $respuestas['ComentariosRespuestaArea']?></td>
                        <td><?php echo $respuestas['ComentariosRespuestaUA']?></td>
                        <td><?php echo $respuestas['FechaRevisionUA']?></td>
                        <td><?php echo $respuestas['Estatus']?></td>
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
          $('#respuestas').DataTable();
            
      });
    </script>
      
      
  </body>
</html>