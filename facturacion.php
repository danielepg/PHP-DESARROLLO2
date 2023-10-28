<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<?php session_start();
include("db.php");
include("includes/header.php");
if(isset($_SESSION['CODIGO_USUARIO'])){
if($_SESSION['ID_ROL'] != 0) { ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOEM -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">    
    <link rel="stylesheet" type="text/css" href="css/estilos.css">    
    <script src="js/functions.js"></script>
    <title>Nueva venta</title>
</head>
<body>



        <section id="container">
            <div class="title_page">
                <h1>Nueva venta</h1>
            </div>
            <div class="datos_cliente">
                <div class="action_cliente">
                    <h4>Datos del cliente</h4>
                    <a href="#" class="btn_new btn_new_cliente"> Nuevo cliente</a>
                </div>

            <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
                <input type="hidden" name="action" value="addCliente">
                <input type="hidden" name="IDCLIENTE" id="IDCLIENTE" value="" required >
                <div class="wd30">
                    <label>NIT</label>
                    <input type="text" name="NIT" id="NIT"  required>
                </div>
                <div class="wd30">
                    <label>Codigo</label>
                    <input type="text" name="CODIGO" id="CODIGO" disabled required>
                </div>
                <div class="wd30">
                    <label>Nombre</label>
                    <input type="text" name="NOMBRE" id="NOMBRE" disabled required>
                </div>
                <div class="wd30">
                    <label>Apellido</label>
                    <input type="text" name="APELLIDO" id="APELLIDO" disabled required>
                </div>
                <div class="wd30">
                    <label>DPI</label>
                    <input type="text" name="DPI" id="DPI" disabled required>
                </div>
                <div class="wd30">
                    <label>Tell</label>
                    <input type="number" name="TELEFONO" id="TELEFONO" disabled required>
                </div>
                <div class="wd30">
                    <label>Direccion</label>
                    <input type="text" name="DIRECCION" id="DIRECCION" disabled required >
                </div>
                <div id="div_registro_cliente" class="wd100">
                    <button type="submit" class="btn_save">Guardar</button>
                </div>
            </form>
            </div>
            
            <div class="datos_venta">
                <h4>Datos de venta</h4>
                <div class="datos">
                    <div class="wd50">
                        <label>Vendedor</label>
                        
                    </div>
                    <div class="wd50">
                        <label>Acciones</label>
                        <div id="acciones_venta">
                            <a href="#" class="btn_anular textcenter" id="btn_anular_venta">Anular</a>
                            <a href="#" class="btn_ok textcenter" id="btn_facturar_venta" style="display: none;">Procesar</a>
                        </div>
                    </div>
                </div>
            </div>
        <table class="tbl_venta">
            <thead>
                <tr>
                    <th width="100px">Codigo</th>
                    <th>Descripcion</th>
                    <th>Existencias</th>
                    <th width="100px">Cantidad</th>
                    <th width="textright">Precio</th>
                    <th width="textright">Precio total</th>
                    <th>Acción</th>
                </tr>
                <tr>
                    <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                    <td id="txt_descripcion">-</td>
                    <td id="txt_existencia">-</td>
                    <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                    <td id="txt_precio" class="textright">0.00</td>
                    <td id="txt_precio_total" class="textright">0.00</td>
                    <td > <a href="#" id="add_product_venta" class="link_add">Agregar</a></td>
                </tr>
                <tr>
                    <th>Código</th>
                    <th colspan="2">Descripción</th>
                    <th>Cantidad</th>
                    <th class="textright">Precio</th>
                    <th class="textright">Precio total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="detalle_venta">
               <!---CONT AJAX --->
               
            </tbody>
            <tfoot id="detalle_totales">
                <!---CONT AJAX--->
            </tfoot>
        </table>
        </section>
            
</body>
</html>

<?php } else { echo "<script> alert('fokiu'); window.location='menu.php' </script>";} ?>

<?php } else { echo "<script> window.location='dashboard.php' </script>";} ?>