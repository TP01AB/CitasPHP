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
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="./css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/all.css">
</head>

<body class="vh-100 m-5">
    <?php
    session_start();
    ?>
    <div class="card">
        <div class="card-header">Inicio Citas</div>
        <div class="card-body">
            <form name="login" id="login" class="text-left needs-validation" action="Controlador/controlador.php" method="POST">

                <div class="text-center mb-3 pl-5 pr-5">
                    <button type="submit" name="vistaLogin" class="btn  text-dark btn-block btn-rounded my-4  z-depth-1a">Login</button>
                </div>
                <div class="text-center mb-3 pl-5 pr-5">
                    <button type="submit" name="vistaRegistro" class="btn  text-dark btn-block btn-rounded my-4  z-depth-1a">Registro</button>
                </div>
                <?php

                if (isset($_SESSION['mensaje'])) {
                    $mensaje = $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']);
                ?>

                    <p class="note note-success ">
                        <?= $mensaje ?>
                    </p>
                <?php
                }
                ?>
            </form>
        </div>
    </div>
    <?php
    // put your code here
    ?>

    <!-- SCRIPT -->

    <!-- jQuery -->
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="./js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="./js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript" src="./js/Validacion.js"></script>
</body>

</html>