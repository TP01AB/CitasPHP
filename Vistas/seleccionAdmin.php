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
    ?>
    <?php include '../Sources/navbar.php'; ?>
    <div class="container min-vh-100 mb-3">
    INICIO ADMINISTRADOR
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