<?php include("includes/headerdash.php") ?>
<?php include("db.php")?>


<?php
$imagenFondo = 'img/DASH.jpg';
$imagenfooter = 'img/maquina.jpeg';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script type="text/javascript" src="js/icons.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <title>Transport Construction</title>

    <style>

        .descrip{
            
            text-align: justify;
        }
        h1{
            font-weight: bold;
        }
        h5{
            font-weight: bold;
        }

        section {
            padding: 60px;
            bottom: -500px; 
        }

        section .section-title {
            text-align: center;
            color: #007b5e;
            margin-bottom: 50px;
            text-transform: uppercase;
        }
        #footer {
            background: #222222 !important;
        }
        #footer h5{
            padding-left: 10px;
            border-left: 3px solid #eeeeee;
            padding-bottom: 6px;
            margin-bottom: 20px;
            color:#ffffff;
        }
        #footer a {
            color: #ffffff;
            text-decoration: none !important;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }
        #footer ul.social li{
            padding: 3px 0;
        }
        #footer ul.social li a i {
            margin-right: 5px;
            font-size:25px;
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }
        #footer ul.social li:hover a i {
            font-size:30px;
            margin-top:-10px;
        }
        #footer ul.social li a,
        #footer ul.quick-links li a{
            color:#ffffff;
        }
        #footer ul.social li a:hover{
            color:#eeeeee;
        }
        #footer ul.quick-links li{
            padding: 3px 0;
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }
        #footer ul.quick-links li:hover{
            padding: 3px 0;
            margin-left:5px;
            font-weight:700;
        }
        #footer ul.quick-links li a i{
            margin-right: 5px;
        }
        #footer ul.quick-links li:hover a i {
            font-weight: 700;
        }

        @media (max-width:767px){
            #footer h5 {
            padding-left: 0;
            border-left: transparent;
            padding-bottom: 0px;
            margin-bottom: 10px;
        }
        }

        #miFooter {
            position: absolute;
            bottom: -700px; /* Cambia el valor según el tamaño de tu footer */
            left: 0;
            right: 0;
            color: #ffffff;
            background-color: #222222;
            text-align: center;
        }

    

    .fondo {
        margin-top: 35px;
        margin-left: 40px;
        width: 250px;
        height: 150px;
        border-radius: 20px;
        background-size: cover;
        position: relative;
        /* Necesario para el posicionamiento absoluto del pseudo-elemento */
        background-color: #F4CE14;
        /* Color de fondo del div */
        box-shadow: 0 0 20px #F4CE14;
        /* Aquí establecemos la sombra amarilla */
        margin: 30px;

    }

    .dropbtn {
        background-color: #45474B;
        border-radius: 10px;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        border-radius: 10px;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #45474B;
        border-radius: 10px;
        
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        font-weight: bold;
        color: black;
        background-color: #F4CE14;
    }

    </style>

</head>
<body>
    <div>

        <div id="content" style="margin-left: 20px;">
            <br>
            
            <div class="dropdown">
                <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M151.6 469.6C145.5 476.2 137 480 128 480s-17.5-3.8-23.6-10.4l-88-96c-11.9-13-11.1-33.3 2-45.2s33.3-11.1 45.2 2L96 365.7V64c0-17.7 14.3-32 32-32s32 14.3 32 32V365.7l32.4-35.4c11.9-13 32.2-13.9 45.2-2s13.9 32.2 2 45.2l-88 96zM320 480c-17.7 0-32-14.3-32-32s14.3-32 32-32h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H320zm0-128c-17.7 0-32-14.3-32-32s14.3-32 32-32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H320zm0-128c-17.7 0-32-14.3-32-32s14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H320zm0-128c-17.7 0-32-14.3-32-32s14.3-32 32-32H544c17.7 0 32 14.3 32 32s-14.3 32-32 32H320z"/></svg> MAQUINAS</button>
                <div class="dropdown-content">
                    <a href="dashboard.php?IDF=0">TODAS LAS MAQUINAS</a>
                    <?php

$sql = ("SELECT * FROM tipo_maquina");
$resultado_maquina = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($resultado_maquina)) { ?>
                    <a href="dashboard.php?IDF=<?php echo $row['ID_TIPO_MAQUINA']; ?>"><?php echo $row['DESCRIPCION']; ?>
                    </a>
                    <?php } ?>

                </div>
            </div>

        </div>

        <div class="row" style="margin-right: 20px;">


            <?php  
        
        $idmaquina = 0;

        if(isset($_GET['IDF']))
        {
            $idmaquina = $_GET['IDF'];

        }

        if($idmaquina == 0)
        {
            $query = "SELECT * FROM maquinas";
        }
        else
        {
            $query = "SELECT * FROM maquinas WHERE ID_TIPO_MAQUINA = $idmaquina ";
        }
        
                $resultado_cliente = mysqli_query($conn, $query);

             

                while($row = mysqli_fetch_array($resultado_cliente)) { ?>


            <div class="fondo"
                style="display: flex; align-items: center; justify-content: center; background-image: url('maquinas/<?php echo $row['FOTO']?>');">
                <a data-toggle="modal" data-target="#myModal"
                    onclick="modal('<?php echo $row['ID_MAQUINA']?>','<?php echo $row['PRECIO_HORA']?>')"
                    style="padding: 71px 122px; "></a>
            </div>
            <?php } ?>


            <?php



if(isset($_GET['ID_MAQUINA']))
{
    $ID_MAQUINA = intval( $_GET['ID_MAQUINA']);
    $query01 = "SELECT * FROM maquinas WHERE ID_MAQUINA = $ID_MAQUINA";
    $resultado = mysqli_query($conn, $query01);

    if(mysqli_num_rows($resultado) == 1)
    {
        $row01 = mysqli_fetch_array($resultado);
        //$ID = $row['ID'];
        $COD_MAQUINA = $row01['COD_MAQUINA'];
        $PRECIO_HORA = $row01['PRECIO_HORA'];        
    }
}
?>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Cabecera del modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Calcular Total</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Cuerpo del modal -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ID_MAQUINA">ID:</label>
                            <input type="text" class="form-control" name="id" id="id" placeholder="ID MAQUINA">
                        </div>

                        <div class="form-group">
                            <label for="cantidad">PRECIO POR HORA:</label>
                            <input type="number" class="form-control" id="precio" name="precio"
                                placeholder="Ingrese el precio.">
                        </div>
                        <div class="form-group">
                            <label for="precio">CANTIDAD:</label>
                            <input type="number" class="form-control" name="CANTIDAD" id="CANTIDAD"
                                placeholder="Ingrese la cantidad">
                        </div>
                        <div class="form-group">
                            <label for="total">Total:</label>
                            <input type="text" class="form-control" id="total" readonly>
                        </div>
                    </div>

                    <!-- Pie del modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="calcularTotal()">Calcular</button>
                    </div>

                </div>
            </div>



        </div>

    </div>

    <footer id="miFooter">
        <section id="footer">
            <div class="container">
                <div class="row text-center text-xs-center text-sm-left text-md-left">
                    <div class="col-xs-12 col-sm-4 col-md-4">                        
                        <h5>TRANSPORT CONSTRUCTION</h5>
                        <p class="descrip">Somos una empresa que se dedica al alquiler de maquinaria pesara
                            brindandole a nuestros clientes el mejor precio y el mejor servicio.
                        </p>
                        <div class="logos">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h5>NOSOTROS</h5>
                        <ul class="list-unstyled quick-links">
                            <li><a href="mision.html"><i class="fa fa-angle-double-right"></i>
                                    MISION</a></li>
                            <li><a href="vision.html"><i class="fa fa-angle-double-right"></i>
                                    VISION</a></li>                            
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h5>CONTACTO</h5>
                        <ul class="list-unstyled quick-links">
                            <li><a href=""><i class="bi bi-telephone-forward-fill"></i> TELL: 7775-5402</a></li>
                            <li><a href=""><i class="fa fa-envelope"></i></i> CORREO:
                                    transportsagt@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                        <p> TC COMPANY</p>
                        <p class="h6">PROYECTO DESARROLLO WEB<a class="text-green ml-2" href="">SISTEMA DE MAQUINAS
                        </p>
                    </div>
                    <hr>
                </div>
            </div>
        </section>
    </footer>

    </div>
    <script>
    function calcularTotal() {
        var cantidad = parseFloat(document.getElementById("precio").value);
        var precio = parseFloat(document.getElementById("CANTIDAD").value);
        var total = cantidad * precio;
        document.getElementById("total").value = total.toFixed(2);
    }
    </script>

    <script>
    function modal(id, precio) {
        // Obtener los elementos del formulario por su ID
        var idInput = document.getElementById("id");
        var precioInput = document.getElementById("precio");

        // Asignar los valores a los campos
        idInput.value = id;
        precioInput.value = precio;
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>