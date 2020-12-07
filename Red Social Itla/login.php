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
            <h3 class="mb-3">Iniciar sesión</h3>
            <form action="manejadores/login.php" method="POST">
                <input type="text" name="usuario" placeholder="Nombre de usuario" value="<?php if(isset($_SESSION['errorLogin'])){ echo $_SESSION['username'];} ?>" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <button class="btn-pastel btn-block">Ingresar</button>
            </form>

            <?php if (isset($_SESSION['errorLogin'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                    <?php echo $_SESSION['errorLogin'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['errorLogin']);
            endif ?>

            <?php if (isset($_SESSION['loginComplete'])) : ?>
                <div class="alert alert-success alert-dismissible fade show mt-2 mb-2" role="alert">
                    <?php echo $_SESSION['loginComplete'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['loginComplete']);
            endif ?>

            <div class="row mt-5 center">
                <p class="mb-1">¿Aún no tienes una cuenta?</p>
                <button class="btn-block btn-pastel" onclick="window.location='registro.php'">Regístrate</button></a>
            </div>
        </div>
        <div class="center">
            <img src="resources/img/social.png" alt="ITLA Social Network">
        </div>
    </div>
</div>

<?php

include_once 'layout/footer.php';

?>