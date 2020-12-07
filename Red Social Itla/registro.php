<?php

session_start();
include_once 'layout/header.php';

if (isset($_SESSION['logueado'])) 
{
    header('location:/Social Network/home.php');
}

?>

<div class="container-center center">
    <div class="container-content center">
        <div class="content-action center">
            <h3 class="mb-3">Registro</h3>
            <form action="manejadores/registro.php" method="POST">

                <input type="text" name="nombre" placeholder="Nombre" maxlength="30" value="<?php if(isset($_SESSION['usuarioError'])){ echo $_SESSION['nombre'];} ?>" required>

                <input type="text" name="apellido" placeholder="Apellido" maxlength="30" value="<?php if(isset($_SESSION['usuarioError'])){ echo $_SESSION['apellido'];} ?>" required>

                <input type="tel" name="telefono" placeholder="Telefono (ej: 8093334444)" value="<?php if(isset($_SESSION['usuarioError'])){ echo $_SESSION['telefono'];} ?>" pattern="809[0-9]{7}|829[0-9]{7}|849[0-9]{7}" required>

                <input type="email" name="correo" placeholder="Correo (ej: someone@example.com)" value="<?php if(isset($_SESSION['usuarioError'])){ echo $_SESSION['correo'];} ?>" pattern="^[_A-Za-z0-9-]+(\.[_A-Za-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" required>

                <input type="text" name="usuario" placeholder="Nombre de usuario" maxlength="30" value="<?php if(isset($_SESSION['usuarioError'])){ echo $_SESSION['username'];} ?>" required>

                <?php if (isset($_SESSION['usuarioError'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <?php echo $_SESSION['usuarioError'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['usuarioError']);
                endif ?>

                <input id="contraseña" type="password" name="contraseña" placeholder="Contraseña" onkeyup="verificarCoincidencia()" required>

                <input id="confirmarContraseña" type="password" name="confirmarContraseña" placeholder="Confirmar contraseña" onkeyup="verificarCoincidencia()" required>
                
                <div id="coincidenciaResultado"></div>

                <button id="btnRegistro" class="btn-block btn-pastel">Registrarme</button>
            </form>

            <div class="row mt-5 center">
                <p class="mb-1">¿Ya tienes una cuenta?</p>
                <button class="btn-block btn-pastel" onclick="window.location='login.php'">Iniciar sesión</button></a>
            </div>
        </div>
        <div class="ml-4 center">
            <img src="resources/img/chat.png" alt="ITLA Social Network">
        </div>
    </div>
</div>

<?php

include_once 'layout/footer.php';

?>