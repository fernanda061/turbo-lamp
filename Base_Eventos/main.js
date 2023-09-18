$(document).ready(function() {
var Id, opcion;
opcion = 4;
    
tablaeventos = $('#tablaeventos').DataTable({  
    "ajax":{            
        "url": "bd/crud.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "Id"},
        {"data": "Fecha"},
        {"data": "FolioCdt"},
        {"data": "FolioCdtSalida"},
        {"data": "Evento"},
        {"data": "Movimiento"},
        {"data": "Usuario"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});     

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formeventos').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    Fecha = $.trim($('#Fecha').val());    
    FolioCdt = $.trim($('#FolioCdt').val());
    FolioCdtSalida = $.trim($('#FolioCdtSalida').val());    
    Evento = $.trim($('#Evento').val());    
    Movimiento = $.trim($('#Movimiento').val());
    Usuario = $.trim($('#Usuario').val());                            
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {Id:Id, Fecha:Fecha, FolioCdt:FolioCdt, FolioCdtSalida:FolioCdtSalida, Evento:Evento, Movimiento:Movimiento ,Usuario:Usuario ,opcion:opcion},    
          success: function(data) {
            tablaeventos.ajax.reload(null, false);
           }
        });			        
    $('#modalCRUD').modal('hide');											     			
});
        
 

//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevo").click(function(){
    opcion = 1; //alta           
    Id=null;
    $("#formeventos").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Usuario");
    $('#modalCRUD').modal('show');	    
});

//Editar        
$(document).on("click", ".btnEditar", function(){		        
    opcion = 2;//editar
    fila = $(this).closest("tr");	        
    Id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    Fecha = fila.find('td:eq(1)').text();
    FolioCdt = fila.find('td:eq(2)').text();
    FolioCdtSalida = fila.find('td:eq(3)').text();
    Evento = fila.find('td:eq(4)').text();
    Movimiento = fila.find('td:eq(5)').text();
    Usuario = fila.find('td:eq(6)').text();
    $("#Fecha").val(Fecha);
    $("#FolioCdt").val(FolioCdt);
    $("#FolioCdtSalida").val(FolioCdtSalida);
    $("#Evento").val(Evento);
    $("#Movimiento").val(Movimiento);
    $("#Usuario").val(Usuario);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar eventos");		
    $('#modalCRUD').modal('show');		   
});

//Borrar
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);           
    Id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
    opcion = 3; //eliminar        
    var respuesta = confirm("¿Está seguro de borrar el registro "+Id+"?");                
    if (respuesta) {            
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {opcion:opcion, Id:Id},    
          success: function() {
              tablaeventos.row(fila.parents('tr')).remove().draw();                  
           }
        });	
    }
 });
     
});    