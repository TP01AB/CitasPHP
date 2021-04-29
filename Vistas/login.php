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
    <script src='https://www.google.com/recaptcha/api.js?render=6LdU7-QZAAAAANmiNBKJU677B_eGaE-tJsZL0TMT'>
    </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdU7-QZAAAAANmiNBKJU677B_eGaE-tJsZL0TMT', {
                    action: 'login'
                })
                .then(function(token) {
                    var recaptchaResponse = document.getElementById('recaptchaResponse');
                    recaptchaResponse.value = token;
                });
        });
    </script>
</head>

<body class="" onload="validacionLogin()">
    <?php
    session_start();
    ?>
    <?php include '../Sources/navbar.php'; ?>
    <div class="container min-vh-100 mb-3">
        <div class="card col-md-5 mx-auto" style="border: 4px solid antiquewhite">
            <div class="card-header bg-primary">
                <h2 class=" font-weight-bold text-white text-center">Inicio sesion</h2>
            </div>
            <!--Card content-->
            <div class="card-body">
                <!-- Form -->
                <form class=" " id="loginForm" name="loginForm " action="../Controlador/controlador.php" method="POST" novalidate>

                    <div class=" mb-5">
                        <label class="form-label" for="emailLogin">E-mail</label>
                        <input type="email" id="emailLogin" name="emailLogin" class="form-control" required />
                        <div id="emailError"></div>
                    </div>

                    <!-- Email input -->
                    <div class=" mb-4 mt-2">
                        <label class="form-label" for="passwordLogin">Password </label>
                        <input type="password" id="passwordLogin" name="passwordLogin" class="form-control" minlength="8" required />
                        <div id="passwordError"></div>
                    </div>
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
                    <!-- Submit button -->
                    <button type="submit" name="iniciarBD" id="iniciarBD" class="btn btn-primary btn-block mb-5 mt-2">Iniciar</button>
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