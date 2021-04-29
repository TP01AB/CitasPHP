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
    <script src='https://www.google.com/recaptcha/api.js?render=6LetBuUZAAAAAEShdy0B9r0JFMKbsKVrbGW2PbjT'>
    </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LetBuUZAAAAAEShdy0B9r0JFMKbsKVrbGW2PbjT', {
                    action: 'registro'
                })
                .then(function(token) {
                    var recaptchaResponse = document.getElementById('recaptchaResponse');
                    recaptchaResponse.value = token;
                });
        });
    </script>
</head>
<?php
include_once '../Modelo/Usuario.php';
session_start();
?>

<body class="" onload="validarRegistro()">

    <?php include '../Sources/navbar.php'; ?>
    <div class="container min-vh-100 mb-3">
        <div class="card col-md-5 mx-auto" style="border: 4px solid antiquewhite">
            <div class="card-header bg-primary">
                <h2 class=" font-weight-bold text-white text-center">Registro</h2>
            </div>
            <?php
            if (isset($_SESSION['userDatos'])) {
                $userDatos = $_SESSION['userDatos'];
                unset($_SESSION['userDatos']);
            } else {
                $userDatos = new Usuario(0, "", "", 0, "", 0, 0, 0, 0, 0);
            }
            ?>
            <!--Card content-->
            <div class="card-body">
                <!-- Form -->
                <form class=" " id="registroForm" name="registroForm " action="../Controlador/controlador.php" method="POST" novalidate>

                    <div class=" mb-5">
                        <label class="form-label" for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= $userDatos->get_email() ?>" required />
                        <div id="emailError" class="p-2"></div>
                    </div>

                    <!-- Email input -->
                    <div class=" mb-4">
                        <label class="form-label" for="password">Password </label>
                        <input type="password" id="password" name="password" class="form-control" minlength="8" required />
                        <div id="passwordError" class="p-2"></div>
                    </div>

                    <div class=" mb-4">
                        <label class="form-label" for="nombre">Nombre </label>
                        <input type="text" id="nombre" name="nombre" class="form-control" minlength="3" value="<?= $userDatos->get_nick() ?>" required />
                        <div id="nombreError"></div>
                    </div>
                    <div class=" mb-4">
                        <label class="form-label" for="dni">DNI </label>
                        <input type="text" id="dni" name="dni" class="form-control" minlength="9" pattern="^[0-9]{8}[A-Z]{1}$" value="<?= $userDatos->get_dni() ?>" required />
                        <div id="dniError"></div>
                    </div>
                    <div class=" mb-4">
                        <label class="form-label" for="telefono">Telefono </label>
                        <input type="number" id="telefono" name="telefono" class="form-control" value="<?= $userDatos->get_phone() ?>" pattern="^[0-9]{9}$" required />
                        <div id="telefonoError"></div>
                    </div>
                    <div class=" mb-4">
                        <label class="form-label" for="edad">Edad </label>
                        <input type="number" id="edad" name="edad" class="form-control" value="<?= $userDatos->get_age() ?>" min="18" required />
                        <div id="edadError"></div>
                    </div>
                    <div class=" mb-4">
                        <label class="form-label" for="sexo1">Masculino </label>
                        <input type="radio" id="sexo1" name="sexo" class="" value="1" required /><BR>
                        <label class="form-label" for="sexo0">Femenino </label>
                        <input type="radio" id="sexo0" name="sexo" class="" value="0" required />
                    </div>
                    <?php

                    if (isset($_SESSION['mensaje'])) {
                        $mensaje = $_SESSION['mensaje'];
                        unset($_SESSION['mensaje']);
                    ?>

                        <p class="note note-danger">
                            <strong>Error:</strong> <?= $mensaje ?>
                        </p>
                    <?php
                    }
                    ?>
                    <!-- Submit button -->
                    <button type="submit" name="registroBD" id="registroBD" class="btn btn-primary btn-block mb-5">Registrarse</button>
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                </form>
            </div>
        </div>
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
    <script type="text/javascript" src="../js/validar.js"></script>
</body>

</html>