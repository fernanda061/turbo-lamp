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

$consulta = "SELECT * FROM cdts_salidas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$cdts_salidas=$resultado->fetchAll(PDO::FETCH_ASSOC);
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
      
    <h3 class="text-center">CDTS Salidas</h3>
    
    <div class="container">
       <div class="row">
           <div class="col-lg-12">
            <table id="cdts_salidas" class="table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                    <th>CAC Num</th>
                    <th>Nombre Recibe</th>
                    <th>Fecha Recibo CAC</th>                               
                    <th>Hora Recibo CAC</th>  
                    <th>OT_GINP </th>
                    <th>OT_DIDT</th>
                    <th>Observaciones</th>
                    <th>Fecha de Correcciones CAC</th>
                    <th>Hora de Correcciones CAC</th>
                    <th>Fecha de Regreso CAC</th>
                </thead>
                <tbody>
                    <?php
                        foreach($cdts_salidas as $cdts_salidas){
            
                    ?>
                    <tr>
                        <td><?php echo $cdts_salidas['Id']?></td>
                        <td><?php echo $cdts_salidas['Fecha']?></td>
                        <td><?php echo $cdts_salidas['FolioCdtSalida']?></td>
                        <td><?php echo $cdts_salidas['Solicita']?></td>
                        <td><?php echo $cdts_salidas['Dirigido_a']?></td>
                        <td><?php echo $cdts_salidas['Otorga']?></td>
                        <td><?php echo $cdts_salidas['FolioCdt']?></td>
                        <td><?php echo $cdts_salidas['Firma']?></td>
                        <td><?php echo $cdts_salidas['Asunto']?></td>
                        <td><?php echo $cdts_salidas['Usuario']?></td>
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
          $('#cdts_salidas').DataTable();
            
      });
    </script>
      
      
  </body>
</html>
<?php
