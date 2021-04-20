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
    $pendientes = unserialize($_SESSION['pendientes']);
    $amigos = unserialize($_SESSION['amigos']);
    $usuarios = unserialize($_SESSION['usuarios']);
    ?>
    <?php include '../Sources/navbar.php'; ?>
    <div class="container min-vh-100 mb-3  text-center">
        <?php
        if (isset($_SESSION['mensaje'])) {
            $mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        ?>
            <p class="note note-danger">
                <strong>Error:</strong> <?php echo $mensaje; ?>
            </p>
        <?php
        }
        ?>
        <h1>pendientes</h1>
        <hr>
        <div class="row">
            <?php
            foreach ($pendientes as $i => $usuario) {
            ?>
                <div class="card m-3 col-3 " style="border: 2px solid antiquewhite">
                    <div class="card-header">
                        <?php
                        echo $usuario->get_nick();
                        ?>
                    </div>
                    <div class="card-body">
                        <form class="text-center needs-validation" action="../Controlador/controladorUsuario.php" method="POST">
                            <div class="px-4">
                                <input type="hidden" id="id" name="id" value="<?= $usuario->get_idUser() ?>">
                                <input type="hidden" id="email" name="email" value="<?= $usuario->get_email() ?>">
                                <p>Edad: <?= $usuario->get_age() ?></p>
                                <p>Telefono: <?= $usuario->get_phone() ?></p>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="hacerAmigo" class=" text-dark btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Crear admin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg>
                        </button>
                        <button type="submit" name="enviarMensaje" class=" text-dark btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Crear admin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                            </svg>
                        </button>
                    </div>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
        <h1 class="mt-5">Amigos</h1>
        <hr>
        <div class="row">
            <?php
            foreach ($amigos as $i => $usuario) {
            ?>
                <div class="card m-3 col-3 " style="border: 2px solid antiquewhite">
                    <div class="card-header">
                        <?php
                        echo $usuario->get_nick();
                        ?>
                    </div>
                    <div class="card-body">
                        <form class="text-center needs-validation" action="../Controlador/controladorUsuario.php" method="POST">
                            <div class="px-4">
                                <input type="hidden" id="id" name="id" value="<?= $usuario->get_idUser() ?>">
                                <input type="hidden" id="email" name="email" value="<?= $usuario->get_email() ?>">
                                <p>Edad: <?= $usuario->get_age() ?></p>
                                <p>Telefono: <?= $usuario->get_phone() ?></p>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="eliminar amigo" class=" text-dark btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Crear admin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                        <button type="submit" name="enviarMensaje" class=" text-dark btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Crear admin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                            </svg>
                        </button>
                    </div>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
        <h1>TODOS</h1>
        <hr>
        <div class="row">
            <?php
            foreach ($usuarios as $i => $usuario) {
            ?>
                <div class="card m-3 col-3 " style="border: 2px solid antiquewhite">
                    <div class="card-header">
                        <?php
                        echo $usuario->get_nick(); ?>
                        <?php if ($usuario->get_isOnline() == 1) { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-record-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            </svg>
                        <?php } else { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-record-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            </svg>

                        <?php
                        } ?>
                    </div>
                    <div class="card-body">
                        <form class="text-center needs-validation" action="../Controlador/controladorUsuario.php" method="POST">
                            <div class="px-4">
                                <input type="hidden" id="id" name="id" value="<?= $usuario->get_idUser() ?>">
                                <input type="hidden" id="email" name="email" value="<?= $usuario->get_email() ?>">
                                <p>Edad: <?= $usuario->get_age() ?></p>
                                <p>Telefono: <?= $usuario->get_phone() ?></p>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="hacerAmigo" class=" text-dark btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Crear admin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg>
                        </button>
                        <button type="submit" name="enviarMensaje" class=" text-dark btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Crear admin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                            </svg>
                        </button>
                    </div>
                    </form>
                </div>
            <?php
            }
            ?>
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