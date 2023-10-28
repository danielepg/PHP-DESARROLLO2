<?php
include("db.php");

session_start();
if ($_POST['action'] == 'searchCliente') {
    if (!empty($_POST['cliente'])) {
        $nit = mysqli_real_escape_string($conn, $_POST['cliente']);

        $query = mysqli_query($conn, "SELECT * FROM cliente WHERE NIT LIKE '$nit' ");

        if (!$query) {
            die('Error en la consulta: ' . mysqli_error($conn));
        }

        $result = mysqli_num_rows($query);

        $data = '';
        if ($result > 0) {
            $data = mysqli_fetch_assoc($query);
        } else {
            $data = 0;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}

//registrar cliente desde formulario ventas
if($_POST['action'] == 'addCliente'){
        
    $id = $_POST['IDCLIENTE'];
    $codigo = $_POST['CODIGO'];
    $nombre = $_POST['NOMBRE'];
    $nit = $_POST['NIT'];
    $apellido = $_POST['APELLIDO'];
    $direccion = $_POST['DIRECCION'];
    $telefono = $_POST['TELEFONO'];
    $dpi = $_POST['DPI'];
    $nit = $_POST['NIT'];

    $query_insert = mysqli_query($conn, "INSERT INTO cliente(ID_CLIENTE, COD_CLIENTE, NOMBRE, NIT, APELLIDO, DIRECCION, TELEFONO, DPI) 
    VALUES ('$id', '$codigo', '$nombre','$nit', '$apellido', '$direccion', '$telefono', '$dpi')");

    
    if($query_insert){
        $codCliente = mysqli_insert_id($conn);
        $msg = $codCliente;
    }else{
        $msg = 'error';
    }
    mysqli_close($conn);
    echo $msg;
    exit;
}

//extrae los datos de las maquinas

if($_POST['action'] == 'infoProducto'){

    $producto_id = $_POST['producto'];

    $query = mysqli_query ($conn, "SELECT ID_MAQUINA, descripcion, precio_hora FROM maquinas WHERE ID_MAQUINA = '$producto_id'");

                                         
     mysqli_close($conn);

     $result = mysqli_num_rows($query);

     if($result > 0){
         $data = mysqli_fetch_assoc($query);
         echo json_encode($data, JSON_UNESCAPED_UNICODE);

         exit;
     }
     echo 'error';
     exit;
 }

  //agregar maquinas a la tabla detalle_temp
  if($_POST['action'] == 'addProductoDetalle'){
   if(empty($_POST['producto']) || empty($_POST['cantidad'])){
    echo 'error';
   }else{
    $codproducto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    $token = md5("mi_token_secreto");

    $query_iva = mysqli_query($conn,"SELECT iva FROM configuracion");
    $result_iva = mysqli_num_rows($query_iva);

     
    $query_detalle_temp = mysqli_query($conn,"CALL add_detalle_temp($codproducto,$cantidad,'$token')");
    $result = mysqli_num_rows($query_detalle_temp);

    $detalleTabla = '';
     $sub_total = 0;
     $iva = 0;
     $total = 0;
     $arrayData = array();

     if($result > 0){
        if($result_iva > 0){
            $info_iva = mysqli_fetch_assoc($query_iva);
            $iva = $info_iva['iva'];
        }

        while ($data = mysqli_fetch_assoc($query_detalle_temp)){

            $precioTotal    = round($data['cantidad'] * $data['precio_venta'], 2);
             $sub_total      = round($sub_total + $precioTotal, 2);
             $total          = round($total + $precioTotal, 2);

             $detalleTabla .= '
                         <tr>
                             <td>'.$data['codmaquina'].'</td>
                             <td colspan="2">'.$data['descripcion'].'</td>
                             <td class="textcenter">'.$data['cantidad'].'</td>
                             <td class="textright">'.$data['precio_venta'].'</td>
                             <td class="textright">'.$precioTotal.'</td>
                             <td class="">
                                 <a href="#" class="link_delete" onclick="event.preventDefault(); 
                                     del_product_detalle('.$data['correlativo'].');"> <i class="far fa-trash-alt"></i> </a>
                             </td>
                         </tr>'; 
        }

        $impuesto  = round($sub_total * ($iva /100),2);
         $tl_sniva  = round($sub_total - $impuesto ,2);
         $total  = round($tl_sniva + $impuesto,2);

         $detalleTotales = '
         <tr>
                 <td colspan="5" class="textright">Subtotal Q.</td>
                 <td class="textright">'.$tl_sniva.'</td>
             </tr>
             <tr>
                 <td colspan="5" class="textright">IVA ('.$iva.'%)</td>
                 <td class="textright">'.$impuesto.'</td>
             </tr>
             <tr>
                 <td colspan="5" class="textright">Total Q.</td>
                 <td class="textright">'.$total.'</td>
          </tr>';

          $arrayData['detalle'] = $detalleTabla;
          $arrayData['totales'] = $detalleTotales;

          echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
     }else{
         echo 'error';
     }
     mysqli_close($conn);
    }
    exit;

   }

   //extrae los datos de la tabla detalle_temp
 if($_POST['action'] == 'serchForDetalle'){
    if(empty($_POST['user'])){
     echo 'error';
    }else{
        $token = md5("mi_token_secreto");

     $query = mysqli_query($conn,"SELECT tmp.correlativo,
                                             tmp.token_user,
                                             tmp.cantidad,
                                             tmp.precio_venta,
                                             p.codmaquina,
                                             p.descripcion
                                             FROM detalle_temp tmp
                                             INNER JOIN maquinas p
                                             ON tmp.codmaquina = p.ID_MAQUINA
                                             WHERE token_user = '$token' ");
    
    $result = mysqli_num_rows($query);

     $query_iva = mysqli_query($conn,"SELECT iva FROM configuracion");
     $result_iva = mysqli_num_rows($query_iva);

     $detalleTabla = '';
     $sub_total = 0;
     $iva = 0;
     $total = 0;
     $arrayData = array();

     if($result > 0){
         if($result_iva > 0){
             $info_iva = mysqli_fetch_assoc($query_iva);
             $iva = $info_iva['iva'];
         }

         while ($data = mysqli_fetch_assoc($query)){

             $precioTotal    = round($data['cantidad'] * $data['precio_venta'], 2);
             $sub_total      = round($sub_total + $precioTotal, 2);
             $total          = round($total + $precioTotal, 2);

             $detalleTabla .= '
                         <tr>
                             <td>'.$data['codmaquina'].'</td>
                             <td colspan="2">'.$data['descripcion'].'</td>
                             <td class="textcenter">'.$data['cantidad'].'</td>
                             <td class="textright">'.$data['precio_venta'].'</td>
                             <td class="textright">'.$precioTotal.'</td>
                             <td class="">
                                 <a href="#" class="link_delete" onclick="event.preventDefault(); 
                                     del_product_detalle('.$data['correlativo'].');"> <i class="far fa-trash-alt"></i> </a>
                             </td>
                         </tr>'; 
         }

         $impuesto  = round($sub_total * ($iva /100),2);
         $tl_sniva  = round($sub_total - $impuesto ,2);
         $total  = round($tl_sniva + $impuesto,2);

         $detalleTotales = '
         <tr>
                 <td colspan="5" class="textright">Subtotal Q.</td>
                 <td class="textright">'.$tl_sniva.'</td>
             </tr>
             <tr>
                 <td colspan="5" class="textright">IVA ('.$iva.'%)</td>
                 <td class="textright">'.$impuesto.'</td>
             </tr>
             <tr>
                 <td colspan="5" class="textright">Total Q.</td>
                 <td class="textright">'.$total.'</td>
          </tr>';

          $arrayData['detalle'] = $detalleTabla;
          $arrayData['totales'] = $detalleTotales;

          echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
     }else{
         echo 'error';
     }
     mysqli_close($conn);
    }
    
}


 

 //elimina los productos del detalle
 if($_POST['action'] == 'delProductoDetalle'){

    if(empty($_POST['id_detalle'])){
        echo 'error';

       }else{
        $id_detalle = $_POST['id_detalle'];

        $token = md5("mi_token_secreto");

        $query_iva = mysqli_query($conn,"SELECT iva FROM configuracion");
        $result_iva = mysqli_num_rows($query_iva);

        $query_detalle_temp = mysqli_query($conn,"CALL del_detalle_temp($id_detalle,'$token')");
        $result = mysqli_num_rows($query_detalle_temp);

        $detalleTabla = '';
        $sub_total = 0;
        $iva = 0;
        $total = 0;
        $arrayData = array();

        if($result > 0){
            if($result_iva > 0){
                $info_iva = mysqli_fetch_assoc($query_iva);
                $iva = $info_iva['iva'];
            }

            while ($data = mysqli_fetch_assoc($query_detalle_temp)){

                $precioTotal    = round($data['cantidad'] * $data['precio_venta'], 2);
                $sub_total      = round($sub_total + $precioTotal, 2);
                $total          = round($total + $precioTotal, 2);

                $detalleTabla .= '
                            <tr>
                                <td>'.$data['codmaquina'].'</td>
                                <td colspan="2">'.$data['descripcion'].'</td>
                                <td class="textcenter">'.$data['cantidad'].'</td>
                                <td class="textright">'.$data['precio_venta'].'</td>
                                <td class="textright">'.$precioTotal.'</td>
                                <td class="">
                                    <a href="#" class="link_delete" onclick="event.preventDefault(); 
                                        del_product_detalle('.$data['correlativo'].');"> <i class="far fa-trash-alt"></i> </a>
                                </td>
                            </tr>'; 
            }

            $impuesto  = round($sub_total * ($iva /100),2);
            $tl_sniva  = round($sub_total - $impuesto ,2);
            $total  = round($tl_sniva + $impuesto,2);

            $detalleTotales = '
            <tr>
                    <td colspan="5" class="textright">Subtotal Q.</td>
                    <td class="textright">'.$tl_sniva.'</td>
                </tr>
                <tr>
                    <td colspan="5" class="textright">IVA ('.$iva.'%)</td>
                    <td class="textright">'.$impuesto.'</td>
                </tr>
                <tr>
                    <td colspan="5" class="textright">Total Q.</td>
                    <td class="textright">'.$total.'</td>
             </tr>';

             $arrayData['detalle'] = $detalleTabla;
             $arrayData['totales'] = $detalleTotales;

             echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        }else{
            echo 'error';
        }
        mysqli_close($conn);
       }
       exit;
   
}

//anula la venta
if($_POST['action'] == 'anularVenta' ){

    $token = md5("mi_token_secreto");
    
    $query_del = mysqli_query($conn,"DELETE FROM detalle_temp WHERE token_user = '$token'");
    mysqli_close($conn);
    
    if($query_del){
        echo 'ok';
    }else{
        echo 'error';
    }
    exit;
}

//procesar venta
if($_POST['action'] == 'procesarVenta' ){
    if(empty($_POST['codcliente'])){
        $codcliente = '1';
    }else{
        $codcliente = $_POST['codcliente'];
    }
    $token = md5("mi_token_secreto");
    $usuario = 1;
    


    $query = mysqli_query($conn,"SELECT * FROM detalle_temp WHERE token_user = '$token' ");
    $result = mysqli_num_rows($query);

    if($result > 0){
        $query_procesar = mysqli_query($conn,"CALL procesar_venta($usuario,'$codcliente','$token')");
        $result_detalle = mysqli_num_rows($query_procesar);

        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

        }else{
            echo 'error';
        }
    }else{
        echo 'error';
    }
    mysqli_close($conn);
    exit;
}


?>
