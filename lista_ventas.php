<?php 
session_start();

include("db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Lista de Facturas</title>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section id="container" class="container" style="text-alianin: center;">
		<h1><i class='fas fa-user'></i> Listado de Facturas</h1>
        <a href="facturacion.php" class="btn btn_search btn-warning mb-2"><i class="fas fa-user-plus"></i> Nueva factura</a>
        <div class="container">
        <form action="buscar_venta.php" method="get" class="form_search">
          <input type="text" class="form-control md-4 mb-2" name="busqueda" id="busqueda" placeholder="No, factura">
          <button  type="submit" class="btn btn_search btn-warning" ><i class="fas fa-search"></i></button>
        </form>
        </div>

        <table>
            <tr>
                <th style="font-weight: bold;">No.</th>
                <th style="font-weight: bold;">Fecha/Hora</th>
                <th style="font-weight: bold;">Cliente</th>
                <th style="font-weight: bold;" class="textright">Total factura</th>
                <th style="font-weight: bold;" class="textright">Acciones</th>
                
             </tr>

          <?php 

          //paginador
          $sql_register = mysqli_query ($conn,"SELECT COUNT(*) as total FROM factura ");
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
                            <button class="btn btn-danger " id="view_factura" type="button" cl="<?php echo $data["codcliente"] ?>" f="<?php echo $data['nofactura']; ?>" >Ver</button>
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
          <li> <a href="?pagina=<?php echo 1; ?>"> |< </a></li>
          <li> <a href="?pagina=<?php echo $pagina-1; ?>"> << </a></li>
          <?php 
           }
          for ($i=1; $i <= $total_paginas; $i++) { 
            # code...
            if($i == $pagina){
              echo '<li class="pageSelected">  '.$i.' </li>';
            }else{
              echo '<li> <a href="?pagina='.$i.'"> '.$i.' </a></li>';
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