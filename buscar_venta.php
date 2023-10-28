<?php 
session_start();

include("db.php");

$busqueda = '';
$fecha_de = '';
$fecha_a = '';

if(isset($_REQUEST['busqueda']) && $_REQUEST['busqueda'] =='' ){
  header("location: lista_ventas.php");
}


if(!empty($_REQUEST['busqueda'])){
  if(!is_numeric($_REQUEST['busqueda'])){
    header ("location: lista_ventas.php");
  }
  $busqueda = strtolower($_REQUEST['busqueda']);
  $where = "nofactura= $busqueda";
  $buscar = "busqueda = $busqueda";
}

if(!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a']) ){
  $fecha_de = $_REQUEST['fecha_de'];
  $fecha_a = $_REQUEST['fecha_a'];

  $buscar = '';

  if($fecha_de > $fecha_a){
    header("location: lista_ventas.php");
  }else if($fecha_de == $fecha_a){

    $where = "fecha LIKE '$fecha_de%'";
    $buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";

  }else {
    $f_de = $fecha_de.' 00:00:00';
    $f_a = $fecha_a.' 23:59:59';
    $where = "fecha BETWEEN '$f_de' AND '$f_a'";
    $buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";
  }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Lista de Facturas</title>
  
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include "includes/header.php"; ?>
	<section class="container">
		<h1><i class='fas fa-user'></i> Listado de Facturas</h1>
        <a href="facturacion.php" class="btn btn_search btn-warning mb-2"><i class="fas fa-user-plus"></i> Nueva factura</a>

        <form action="buscar_venta.php" method="get" class="form_search">
          <input type="text" class="form-control md-4 mb-2" name="busqueda" id="busqueda" placeholder="No, factura">
          <button  type="submit" class="btn btn_search btn-warning mb-2" ><i class="fas fa-search"></i></button>
        </form>

        <table>
            <tr>
                <th>No.</th>
                <th>Fecha/Hora</th>
                <th>Cliente</th>
                <th class="textright">Total factura</th>
                <th class="textright">Acciones</th>
                
             </tr>

          <?php 

          //paginador
          $sql_register = mysqli_query ($conn,"SELECT COUNT(*) as total FROM factura where $where");
          $result_register = mysqli_fetch_array($sql_register);
          $total = $result_register['total'];

          $por_pagina = 10;
          
          if(empty($_GET['pagina'])){
            $pagina = 1;
          }else{
            $pagina = $_GET['pagina'];
          }

          $desde = ($pagina-1)* $por_pagina;
          $total_paginas = ceil($total / $por_pagina);

           $query = mysqli_query($conn,"SELECT f.nofactura, f.fecha, f.totalfactura,f.codcliente,
                                            cl.nombre as cliente
                                            FROM factura f
                                            INNER JOIN cliente cl
                                            ON f.codcliente = cl.ID_CLIENTE
                                            where $where
                                            ORDER BY f.fecha ASC LIMIT $desde, $por_pagina ");

                mysqli_close($conn);

            $result = mysqli_num_rows($query);
            if($result > 0)
              while ($data = mysqli_fetch_array($query)) {
                
                

          ?>
                   <tr id="row_<?php echo $data["nofactura"]; ?>"  >
                      <td><?php echo $data["nofactura"] ?></td>
                      <td><?php echo $data["fecha"]?> </td>
                      <td><?php echo $data["cliente"]?> </td>
                      <td class="textright totalfactura"><span>Q.</span><?php echo $data["totalfactura"]; ?> </td>
                  
                     <td>
                       <div class="div_acciones">
                        <div>
                            <button class="btn btn-danger" id="view_factura0" onclick="generarPDF();" type="button" cl="<?php echo $data["codcliente"]; ?>" f="<?php echo $data['nofactura']; ?>" ><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000000}</style><path d="M64 464H96v48H64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V288H336V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16zM176 352h32c30.9 0 56 25.1 56 56s-25.1 56-56 56H192v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H192v48h16zm96-80h32c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H304c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H320v96h16zm80-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z"/></svg></button>
                        </div>
                       </div>
                       </td>
                   </tr>
            <?php
                     # code...
                }
                
             ?>

        </table>
        
        <div class="paginador" ></div>
        <ul>
          <?php 
          if($pagina !=1){

          
           ?>
          <li> <a href="?pagina=<?php echo 1; ?>&<?php echo $buscar; ?>"> |< </a></li>
          <li> <a href="?pagina=<?php echo $pagina-1; ?>&<?php echo $buscar; ?>"> << </a></li>
          <?php 
           }
          for ($i=1; $i <= $total_paginas; $i++) { 
            # code...
            if($i == $pagina){
              echo '<li class="pageSelected">  '.$i.' </li>';
            }else{
              echo '<li> <a href="?pagina='.$i.'&'.$buscar.'"> '.$i.' </a></li>';
            }
          }
          if($pagina !=$total_paginas){

          
          ?>
        
          <li> <a href="?pagina=<?php echo $pagina +1; ?>"> >> </a></li>
          <li> <a href="?pagina=<?php echo  $total_paginas; ?>"> >| </a></li>
          <?php  } ?>
        </ul>

		
	</section>
	
          
</body>
          </html>