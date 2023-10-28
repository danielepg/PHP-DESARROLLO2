
$(document).ready(function(){

  //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
  // $("#foto").on("change",function(){
  // 	var uploadFoto = document.getElementById("foto").value;
  //     var foto       = document.getElementById("foto").files;
  //     var nav = window.URL || window.webkitURL;
  //     var contactAlert = document.getElementById('form_alert');
      
  //         if(uploadFoto !='')
  //         {
  //             var type = foto[0].type;
  //             var name = foto[0].name;
  //             if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
  //             {
  //                 contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es v lido.</p>';                        
  //                 $("#img").remove();
  //                 $(".delPhoto").addClass('notBlock');
  //                 $('#foto').val('');
  //                 return false;
  //             }else{  
  //                     contactAlert.innerHTML='';
  //                     $("#img").remove();
  //                     $(".delPhoto").removeClass('notBlock');
  //                     var objeto_url = nav.createObjectURL(this.files[0]);
  //                     $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
  //                     $(".upimg label").remove();
                      
  //                 }
  //           }else{
  //           	alert("No selecciono foto");
  //             $("#img").remove();
  //           }              
  // });

  // $('.delPhoto').click(function(){
  // 	$('#foto').val('');
  // 	$(".delPhoto").addClass('notBlock');
  // 	$("#img").remove();

  // });



      //buscar el cliente por medio de nit
      $('#NIT').keyup(function(e) {
        e.preventDefault();

        var cl = $(this).val();
        var action = 'searchCliente';

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: {action: action, cliente: cl},

            success: function(response) {
                console.log(response);
                if (response == 0) {
                    $('#IDCLIENTE').val('');
                    $('#CODIGO').val('');
                    $('#NOMBRE').val('');
                    $('#APELLIDO').val('');
                    $('#DPI').val('');
                    $('#TELEFONO').val('');
                    $('#DIRECCION').val('');

                    // Muestra el botón de agregar
                    $('.btn_new_cliente').slideDown();
                } else {
                    var data = $.parseJSON(response);
                    $('#IDCLIENTE').val(data.ID_CLIENTE);
                    $('#CODIGO').val(data.COD_CLIENTE);
                    $('#NOMBRE').val(data.NOMBRE);
                    $('#APELLIDO').val(data.APELLIDO);
                    $('#DPI').val(data.DPI);
                    $('#TELEFONO').val(data.TELEFONO);
                    $('#DIRECCION').val(data.DIRECCION );

                    // Oculta el botón de agregar
                    $('.btn_new_cliente').slideUp();

                    // Bloquea los campos
                    $('#CODIGO').attr('disabled', 'disabled');
                    $('#NOMBRE').attr('disabled', 'disabled');
                    $('#APELLIDO').attr('disabled', 'disabled');
                    $('#DPI').attr('disabled', 'disabled');
                    $('#TELEFONO').attr('disabled', 'disabled');
                    $('#DIRECCION').attr('disabled', 'disabled');

                    // Oculta el botón de guardar
                    $('#div_registro_cliente').slideUp();
                }
            },
            error: function(error) {
                console.error(error);
                // Aquí puedes agregar un mensaje de error o alguna acción adicional si la solicitud falla.
            }
        });
      });


            //activa los campos para registro de clientes
            $('.btn_new_cliente').click(function(e){
              e.preventDefault();
              $('#CODIGO').removeAttr('disabled');
              $('#NOMBRE').removeAttr('disabled');
              $('#APELLIDO').removeAttr('disabled');
              $('#DPI').removeAttr('disabled');
              $('#TELEFONO').removeAttr('disabled');
              $('#DIRECCION').removeAttr('disabled');

              $('#div_registro_cliente').slideDown();
            });


            //crear cliente desde formulario venta
            $('#form_new_cliente_venta').submit(function(e){
              e.preventDefault();

              $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: $('#form_new_cliente_venta').serialize(),

                success: function(response){
                  
                if (response != 'error'){
                  //agregar id a input hidden
                  $('#IDCLIENTE').val(response);
                  //bloquea los campos
                  $('#NIT').attr('disabled','disabled');
                  $('#CODIGO').attr('disabled','disabled');
                  $('#NOMBRE').attr('disabled','disabled');
                  $('#APELLIDO').attr('disabled','disabled');
                  $('#DPI').attr('disabled','disabled');
                  $('#TELEFONO').attr('disabled','disabled');
                  $('#DIRECCION').attr('disabled','disabled');

                  //oculta el boton de agregar
                  $('.btn_new_cliente').slideUp();
                  //oculta el boton de guardar
                  $('#div_registro_cliente').slideUp();
                }

                },
                error: function(error){
                }
              });
            });


  //buscar producto
  $('#txt_cod_producto').keyup(function(e){
    e.preventDefault();

    var producto = $(this).val();
    var action = 'infoProducto';
    
    if(producto != '')
    {
      $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action: action, producto: producto},

        success: function(response){

          if(response != 'error'){

            var info = JSON.parse(response);
          $('#txt_descripcion').html(info.descripcion);
          $('#txt_existencia').html(info.existencia);
          $('#txt_cant_producto').val('1');
          $('#txt_precio').html(info.precio_hora);
          $('#txt_precio_total').html(info.precio);

          //activa la caja de texto para la cantidad
          $('#txt_cant_producto').removeAttr('disabled');

          //muestra el boton de agregar
          $('#add_product_venta').slideDown();

          }else{
            $('#txt_descripcion').html('-');
            $('#txt_existencia').html('-');
            $('#txt_cant_producto').val('0');
            $('#txt_precio').val('0.00');
            $('#txt_precio_total').html('0.00');

            //bloquea la cantidad
            $('#txt_cant_producto').attr('disabled','disabled');

            //oculta el boton de agregar
            $('#add_product_venta').slideUp();


          }
          
        },
        error: function(error){
        }
      });
    }
   
  });

          //validar la cantidad del producto
          $('#txt_cant_producto').keyup(function(e){
            e.preventDefault();

            var precio_total = $(this).val() * $('#txt_precio').html();

            $('#txt_precio_total').html(precio_total);

           //ocultar el boton agregar si la cantidad es menor a 1
            //  if( ($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() ) ){
            //    $('#add_product_venta').slideUp();
            //  }else {
            //    $('#add_product_venta').slideDown();
            //  }
          });


          //agregar producto al detalle
          $('#add_product_venta').click(function(e){
            e.preventDefault();

            if($('#txt_cant_producto').val()> 0){
              
              var codproducto = $('#txt_cod_producto').val();
              var cantidad = $('#txt_cant_producto').val();
              var action = 'addProductoDetalle';

              $.ajax ({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data : {action:action, producto:codproducto, cantidad:cantidad},
                
                success: function(response){

                  if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    $('#detalle_venta').html(info.detalle);
                    $('#detalle_totales').html(info.totales);

                    $('#txt_cod_producto').val('');
                    $('#txt_descripcion').html('-');
                    $('#txt_cant_producto').val('0');
                    $('#txt_precio').html('0.00');
                    $('#txt_precio_total').html('0.00');

                    //bloque la cantidad
                    $('#txt_cant_producto').attr('disabled','disabled');

                    //oculta el boton para agregar
                    $('#add_product_venta').slideUp();

                    
                  }else{
                    console.log('no data')
                  }
                  viewProcesar();
                },
                error: function(error){

                }
              });
            }

});


//anular venta
$('#btn_anular_venta').click(function(e){
e.preventDefault();

var rows = $('#detalle_venta tr').length;
if(rows > 0){
  var action = 'anularVenta';

  $.ajax({
    url : 'ajax.php',
    type: "POST",
    async : true,
    data: {action:action},

    success: function(response)
    {
     
      if(response != 'error'){
        location.reload();
      }
    },
    error: function(error){

    }   
  });
}
});



//Facturar venta
$('#btn_facturar_venta').click(function(e){
e.preventDefault();

var rows = $('#detalle_venta tr').length;
if(rows > 0){
  var action = 'procesarVenta';
  var codcliente = $('#IDCLIENTE').val();

  $.ajax({
    url : 'ajax.php',
    type: "POST",
    async : true,
    data: {action:action,codcliente:codcliente},

    success: function(response)
    {
    
      if(response != 'error'){
        var info = JSON.parse(response);
        //console.log(info);

        generarPDF(info.codcliente,info.nofactura);

         location.reload();
       }else{
        console.log('no data');
       }
    },
    error: function(error){

    }   
  });
}
});


//muestra la factura en pdf
$('view_factura').click(function(e){
e.preventDefault();
var codcliente = $(this).attr('cl');
var noFactura = $(this).attr('f');

generarPDF(codcliente,noFactura);

});




}); //final del ready

  function generarPDF(cliente,factura){
    var ancho = 1000;
    var alto = 800;
  //calculamos la posicion de las ventanas
    var x = parseInt((window.screen.width/2) -(ancho / 2));
    var y = parseInt((window.screen.height/2) -(alto / 2));

    $url = 'factura/generaFactura.php?cl='+cliente+'&f='+factura;
    window.open($url,"Factura","left="+x+",top="+y+",height"+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
  }



//muestra y oculta el boton de procesar
function viewProcesar(){
if($('#detalle_venta tr').length> 0){

  $('#btn_facturar_venta').show();
}else{
  $('#btn_facturar_venta').hide();
}
}

function serchForDetalle(id){
var action = 'serchForDetalle';


    $.ajax ({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data : {action:action},
      
      success: function(response){

        if(response != 'error'){
        
          var info = JSON.parse(response);
          $('#detalle_venta').html(info.detalle);
          $('#detalle_totales').html(info.totales);

        }else{
          console.log('no data');
        }
        viewProcesar();
      },
      error: function(error){

      }
    });
}

function del_product_detalle(correlativo){
var action = 'delProductoDetalle';
var id_detalle = correlativo;

    $.ajax ({
      url: 'ajax.php',
      type: "POST",
      async: true,
      data : {action:action, id_detalle:id_detalle},
      
      success: function(response){

       if(response != 'error'){
        var info = JSON.parse(response);
        
        var info = JSON.parse(response);

        $('#detalle_venta').html(info.detalle);
        $('#detalle_totales').html(info.totales);

        $('#txt_cod_producto').val('');
        $('#txt_descripcion').html('-');
        $('#txt_cant_producto').val('0');
        $('#txt_precio').html('0.00');
        $('#txt_precio_total').html('0.00');

        //bloquea la cantidad
        $('#txt_cant_producto').attr('disabled','disabled');

        //oculta el boton para agregar
        $('#add_product_venta').slideUp();

       }else{
        $('#detalle_venta').html('');
        $('#detalle_totales').html('');
       }
      
       viewProcesar();

      },
      error: function(error){

      }
    });
}

