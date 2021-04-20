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

<body>
    <?php
    session_start();
    
    ?>
    <?php include '../Sources/navbar.php'; ?>
    <div class="container min-vh-100 mb-3">
        <div class="card col-md-5 mx-auto">
            <div class="card-header bg-primary">
                <h2 class=" font-weight-bold text-white text-center">Enviar mensaje</h2>
            </div>
            <!--Card content-->
            <div class="card-body">
                <!-- Form -->
                <form class=" " name="loginForm " action="../Controlador/Enviar.php" method="POST" novalidate>

                    <div class=" mb-4">
                        <label class="form-label" for="cuerpo">Cuerpo del mensaje</label>
                        <input type="text" id="cuerpo" name="cuerpo" class="form-control" required />
                    </div>
                    <div class=" mb-4">
                        <label class="form-label" for="asunto">Asunto</label>
                        <input type="text" id="asunto" name="asunto" class="form-control" required />
                    </div>
                    <!-- Submit button -->
                    <button type="submit" name="mensajeBD" id="mensajeBD" class="btn btn-primary btn-block mb-5">Enviar</button>
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