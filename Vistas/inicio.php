<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Citas</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="../css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.css">
</head>

<body class="" onload="validacionLogin()">
    <?php
    session_start();
    include_once '../Modelo/Usuario.php';
    include_once '../Modelo/Preferencias.php';
    $usuarios = unserialize($_SESSION['usuarios']);
    ?>
    <?php include '../Sources/navbar.php'; ?>
    <div class="container min-vh-100 mb-3  text-center">
        <?php
        foreach ($usuarios as $i => $usuario) {
        ?>
            <div class="card col-3 " style="border: 2px solid antiquewhite">
                <div class="card-header">
                    <?php
                    echo $usuario->get_nick();
                    ?>
                </div>
                <div class="card-body">
                    <form class="text-center needs-validation" action="../Controlador/controladorUsuario.php" method="POST">
                        <div class="px-4">

                            <p>Edad: <?= $usuario->get_age() ?></p>
                            <p>Telefono: <?= $usuario->get_phone() ?></p>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="crearAdmin" class=" text-dark btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Crear admin">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg>
                    </button>
                </div>
                </form>
            </div>
    </div>
<?php
        }
?>
</div>
<div class="fixed-bottom">
    <?php include '../Sources/footer.php'; ?>
</div>
<!-- SCRIPT -->

<!-- jQuery -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.min.js"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript" src="../js/Validacion.js"></script>
</body>

</html>