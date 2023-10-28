<?php
session_start();
if(isset($_SESSION['CODIGO_USUARIO'])){
include("includes/header.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        background-color: #222222;
    }

    .circle {
        width: 400px;
        height: 400px;
        border-radius: 50%;
        /* Hace que el elemento sea un círculo */
        overflow: hidden;
        background-image: url('img/machine.png');
        background-size: cover;
        background-position: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        /* Sombra para el círculo */

    }

    .text-pop-up-top {
	-webkit-animation: text-pop-up-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) forwards;
	        animation: text-pop-up-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) forwards;
            text-align: center;
        font-size: 50px;
        font-weight: bold;
        color: #F4CE14;
        margin-top: 70px;
}
@-webkit-keyframes text-pop-up-top {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
    -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
    text-shadow: none;
  }
  100% {
    -webkit-transform: translateY(-50px);
            transform: translateY(-50px);
    -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
    text-shadow: 0 1px 0 #cccccc, 0 2px 0 #cccccc, 0 3px 0 #cccccc, 0 4px 0 #cccccc, 0 5px 0 #cccccc, 0 6px 0 #cccccc, 0 7px 0 #cccccc, 0 8px 0 #cccccc, 0 9px 0 #cccccc, 0 50px 30px #78D6C6;
  }
}
@keyframes text-pop-up-top {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
    -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
    text-shadow: none;
  }
  100% {
    -webkit-transform: translateY(-50px);
            transform: translateY(-50px);
    -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
    text-shadow: 0 1px 0 #cccccc, 0 2px 0 #cccccc, 0 3px 0 #cccccc, 0 4px 0 #cccccc, 0 5px 0 #cccccc, 0 6px 0 #cccccc, 0 7px 0 #cccccc, 0 8px 0 #cccccc, 0 9px 0 #cccccc, 0 50px 30px #78D6C6;
  }
}

    .center {
        top: 50%;
        transform: translateY(0%);
        display: flex;
        justify-content: center; /* Centrado horizontal */
    }
    </style>
</head>

<body>
<div class="text-pop-up-top">Bienvenidos</div>
    <div class="center">
        <div class="circle">            
        </div>
    </div>
</body>

</html>

<?php } else { echo "<script> window.location='dashboard.php' </script>";} ?>