<?php
include("db.php");
session_start();
if(isset($_POST['CODIGO_USUARIO']) && isset($_POST['CONTRA']))
{
	$CODIGO_USUARIO = $_POST['CODIGO_USUARIO'];
	$CONTRASEÑA = $_POST['CONTRA'];
    $query = "SELECT * FROM usuario WHERE CODIGO_USUARIO = '$CODIGO_USUARIO' AND CONTRASEÑA = '$CONTRASEÑA'";
    $resultado = mysqli_query($conn, $query);

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
        $IDUSUARIO = $fila['ID_USUARIO'];
        $IDROL = $fila['ID_ROL'];

		$_SESSION['CODIGO_USUARIO'] = $CODIGO_USUARIO;
		$_SESSION['ID_USUARIO']= $IDUSUARIO;
		$_SESSION['ID_ROL'] = $IDROL;
		
		header("Location: menu.php"); // Redirigir a la página de bienvenida
    } else {
        
		header("Location: login.php");
    }

	
}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>TRANSPORT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body style="background-color: #222222;">
	<section class="ftco-section" style="background-color: #222222;">
		<div class="container">
			<form action="login.php"method="POST">
				<div class="row justify-content-center">
					<div class="col-md-12 col-lg-10">
						<div class="wrap d-md-flex">
							<div class="img" style="background-image: url(sistema/img/cons.jpg);">
					</div>
							<div class="login-wrap p-4 p-md-5">
						<div class="d-flex">
							<div class="w-100">
								<h3 class="mb-4">Inicio de Sesion</h3>
							</div>									
						</div>
								<form action="#" class="signin-form">
							<div class="form-group mb-3">
								<label class="label" for="name">Usuario</label>
								<input type="text" name="CODIGO_USUARIO" class="form-control" placeholder="Usuario" required>
							</div>
						<div class="form-group mb-3">
							<label class="label" for="password">Contraseña</label>
						<input type="password" name="CONTRA" class="form-control" placeholder="Contraseña" required>
						</div>
						<div class="form-group">
							<button type="submit" class="form-control btn btn-primary rounded submit px-3">Iniciar</button>
						</div>
						<div class="form-group d-md-flex">
							<div class="w-50 text-left">
						</div>
					</form>
					
					</div>
				</div>
					</div>
				</div>
			</form>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>
