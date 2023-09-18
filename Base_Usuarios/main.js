$(document).ready(function() {
var user_id, opcion;
opcion = 4;
    
tablaUsuarios = $('#tablaUsuarios').DataTable({  
    "ajax":{            
        "url": "bd/crud.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "Id"},
        {"data": "Nombre"},
        {"data": "Usuario"},
        {"data": "Password"},
        {"data": "Area"},
        {"data": "dn"},
        {"data": "TipoDeCuenta"},
        {"data": "Registro"},
        {"data": "Fecha"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});     

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    Nombre = $.trim($('#Nombre').val());    
    Usuario = $.trim($('#Usuario').val());
    Password = $.trim($('#Password').val());    
    Area = $.trim($('#Area').val());    
    dn = $.trim($('#dn').val());
    TipoDeCuenta = $.trim($('#TipoDeCuenta').val());
    Registro = $.trim($('#Registro').val());
    Fecha = $.trim($('#Fecha').val());
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {Id:Id, Nombre:Nombre, Usuario:Usuario, Password:Password, Area:Area, dn:dn ,TipoDeCuenta:TipoDeCuenta ,Registro:Registro, Fecha:Fecha ,opcion:opcion},    
          success: function(data) {
            tablaUsuarios.ajax.reload(null, false);
           }
        });			        
    $('#modalCRUD').modal('hide');											     			
});
        
 

//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevo").click(function(){
    opcion = 1; //alta           
    user_id=null;
    $("#formUsuarios").trigger("reset");
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
    Nombre = fila.find('td:eq(1)').text();
    Usuario = fila.find('td:eq(2)').text();
    Password = fila.find('td:eq(3)').text();
    Area = fila.find('td:eq(4)').text();
    dn = fila.find('td:eq(5)').text();
    TipoDeCuenta = fila.find('td:eq(6)').text();
    Registro = fila.find('td:eq(7)').text();
    Fecha = fila.find('td:eq(8)').text();
    $("#Nombre").val(Nombre);
    $("#Usuario").val(Usuario);
    $("#Password").val(Password);
    $("#Area").val(Area);
    $("#dn").val(dn);
    $("#TipoDeCuenta").val(TipoDeCuenta);
    $("#Registro").val(Registro);
    $("#Fecha").val(Fecha);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Usuario");		
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
              tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
           }
        });	
    }
 });
     
});    