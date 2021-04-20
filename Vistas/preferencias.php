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
    include_once '../Modelo/Preferencias.php';
    include_once '../Auxiliar/gestionDatos.php';
    session_start();
    ?>
    <?php include '../Sources/navbar.php'; ?>
    <div class="container min-vh-100 mb-3">
        <div class="card col-md-5 mx-auto" style="border: 4px solid antiquewhite">
            <div class="card-header bg-primary">
                <h2 class=" font-weight-bold text-white text-center">Preferencias</h2>
            </div>
            <?php
            if (isset($_SESSION['Preferencias'])) {
                $preferencias = $_SESSION['Preferencias'];
            } else {
                $preferencias = new Preferencias(0, 50, 50, 50, 0, 0, 0);
            }
            ?>
            <!--Card content-->
            <div class="card-body">
                <!-- Form -->
                <form class="mb-1 " name="registroForm " action="../Controlador/controladorUsuario.php" method="POST" >

                    <div class=" mb-4">
                        <label for="deportes" class="form-label">Deportes</label>
                        <input type="range" list="sports" class="form-control-range" min="0" max="100" step="1" name="deportes" id="deportes" value="<?= $preferencias->get_deporte() ?>">

                        <datalist id="sports">
                            <option value="0" label="0">
                            <option value="25" label="25">
                            <option value="50" label="50">
                            <option value="75" label="75">
                            <option value="100" label="100">
                        </datalist>
                    </div>
                    <div class=" mb-4">
                        <label for="artes" class="form-label">Artes</label>
                        <input type="range" list="art" class="form-control-range" min="0" max="100" step="1" name="artes" id="artes" value="<?= $preferencias->get_arte() ?>">
                        <datalist id="art">
                            <option value="0" label="0">
                            <option value="25" label="25">
                            <option value="50" label="50">
                            <option value="75" label="75">
                            <option value="100" label="100">
                        </datalist>
                    </div>
                    <div class=" mb-4">
                        <label for="politica" class="form-label">Politica</label>
                        <input type="range" list="poli" class="form-control-range" min="0" max="100" step="1" name="politica" id="politica" value="<?= $preferencias->get_politica() ?>">
                        <datalist id="poli">
                            <option value="0" label="0">
                            <option value="25" label="25">
                            <option value="50" label="50">
                            <option value="75" label="75">
                            <option value="100" label="100">
                        </datalist>
                    </div>
                    <hr>
                    <h5 class="">Tipo de relacion:</h5>
                    <div name="tipoR" class="btn-group p-0 m-0">
                        <input type="radio" class="btn-check" name="tipoR" id="tipoR1" value="0" <?php
                                                                                                    if ($preferencias->get_tipoRelacion() == 0) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
                        <label class="btn btn-secondary m-0" for="tipoR1">Compromiso</label>

                        <input type="radio" class="btn-check" name="tipoR" id="tipoR2" value="1" <?php
                                                                                                    if ($preferencias->get_tipoRelacion() == 1) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
                        <label class="btn btn-secondary  m-0" for="tipoR2">Exporadica</label>

                    </div>
                    <h5 class="mt-3">Hijos:</h5>
                    <div name="hijos" class="btn-group">
                        <input type="radio" class="btn-check" name="hijos" id="hijos1" value="0" <?php
                                                                                                    if ($preferencias->get_hijos() == 0) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
                        <label class="btn btn-secondary  m-0" for="hijos1">Si</label>

                        <input type="radio" class="btn-check" name="hijos" id="hijos2" value="1" <?php
                                                                                                    if ($preferencias->get_hijos() == 1) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
                        <label class="btn btn-secondary  m-0" for="hijos2">No</label>
                    </div>
                    <h5 class="mt-3 ">Busco:</h5>
                    <div name="busco" class="btn-group mb-3">
                        <input type="radio" class="btn-check" name="busco" id="busco1" value="0" <?php
                                                                                                    if ($preferencias->get_busca() == 0) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
                        <label class="btn btn-secondary  m-0" for="busco1">Mujeres</label>

                        <input type="radio" class="btn-check" name="busco" id="busco2" value="1" <?php
                                                                                                    if ($preferencias->get_busca() == 1) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
                        <label class="btn btn-secondary  m-0" for="busco2">Hombres</label>
                        <input type="radio" class="btn-check" name="busco" id="busco3" value="1" <?php
                                                                                                    if ($preferencias->get_busca() == 2) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
                        <label class="btn btn-secondary  m-0" for="busco3">Ambos</label>

                    </div>
                    <?php

                    if (isset($_SESSION['mensaje'])) {
                        $mensaje = $_SESSION['mensaje'];
                        unset($_SESSION['mensaje']);
                    ?>

                        <p class="note note-success">
                            <?= $mensaje ?>
                        </p>
                    <?php
                    }
                    ?>
                    <!-- Submit button -->
                    <button type="submit" name="preferenciasBD" id="preferenciasBD" class="btn btn-primary btn-block mb-2">Guardar</button>
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
    <script type="text/javascript" src="../js/Validacion.js"></script>
</body>

</html>