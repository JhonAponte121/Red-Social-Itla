<?php

session_start();
include_once 'layout/header.php';
include_once 'layout/menu.php';

include('models/usuario.php');
include('models/publicacion.php');
include('models/comentario.php');

if (isset($_SESSION['logueado'])) 
{
    $user = new usuario;
    $post = new publicacion;
    $comment = new comentario;

    $datoUsuario = $user->getUsuario($_SESSION['usuario']);
    $publicaciones = $post->getPublicacionesUsuario($_SESSION['logueado']);
    $usuario = $datoUsuario->nombre . ' ' . $datoUsuario->apellido . ' (' . $datoUsuario->usuario . ')';
}
else
{
    header('location:/Social Network/login.php');
}

?>

<div class="container mt-3">
    <div class="row">

        <div class="col-md-3">
            <div>
                <div class="perfil-usuario-container">
                    <div class="banner-perfil"></div>
                    <img class="mt-2" src="resources/img/foto.jpg" alt="">
                    <div class="separador"></div>
                    <div class="text-center nombre-perfil mt-2"><?php echo $datoUsuario->nombre . ' ' . $datoUsuario->apellido ?></div>
                    <div class="text-center usuario-perfil mb-3"><?php echo '(' . $datoUsuario->usuario . ')' ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div>
                <div class="container-publicar">
                    <form action="manejadores/home.php" method="POST" class="form-publicar ml-2">
                        <textarea name="contenido" id="contenido" class="text-publicar mb-0" name="post" placeholder="¿En qué estás pensando?" required></textarea>
                        <hr>
                        <button class="btn-pastel">Publicar</button>
                    </form>
                </div>
                <?php foreach ($publicaciones as $publicacion) : ?>

                    <div class="container-usuarios-publicaciones">

                        <div class="usuarios-publicaciones-top">

                            <div class="informacion-usuario-publico">
                                <h6 class="mb-0"><?php echo $usuario ?></h6>
                                <span><?php echo $publicacion->fecha ?></span>
                            </div>

                            <div class="acciones-publicacion-usuario">
                                <button class="btn-icon-editar" onclick="editarPublicacion(<?php echo $publicacion->id ?>)"><i class="far fa-edit"></i></button>
                                
                                <button class="btn-icon-eliminar" onclick="window.location.href='/Social Network/manejadores/eliminarPublicacion.php?id_publicacion=<?php echo $publicacion->id; ?>'"><i class="far fa-trash-alt"></i></button>
                            </div>

                        </div>

                        <div class="contenido-publicacion-usuario">
                            <form action="manejadores/editarPublicacion.php" method="POST" class="form-publicar ml-2">
                                <input type="hidden" name="id_publicacion" value="<?php echo $publicacion->id ?>">
                                <textarea id="contenidoPublicacion-<?php echo $publicacion->id ?>" name="contenidoPublicacion" class="text-publicacion" required disabled><?php echo $publicacion->contenido ?></textarea>
                                <button id="btnGuardar-<?php echo $publicacion->id ?>" class="btn-pastel btn-oculto mt-2">Guardar cambios</button>
                                <hr>
                            </form>
                        </div>

                        <div class="formulario-comentarios">
                            <form action="manejadores/comentar.php" class="form-comentar" method="POST">
                                <input type="hidden" name="page" value="home">
                                <input type="hidden" name="id_publicacion" value="<?php echo $publicacion->id ?>">
                                <input type="text" name="contenido" class="comentario-usuario" placeholder="Agregar un comentario" required>
                                <div class="btn-comentario-container">
                                    <button class="btn-pastel">Comentar</button>
                                </div>
                            </form>
                        </div>

                        <?php 

                        $comentarios = $comment->getComentariosPublicacion($publicacion->id);
                        foreach ($comentarios as $comentario) : ?>
                            <?php if ($comentario->id_publicacion == $publicacion->id) : ?>

                                <div class="container-contenido-comentarios">
                                    <img src="resources/img/comentario.png" alt="" class="imagen-comentario mt-2 ml-2 mr-3">
                                    <div class="contenido-comentario-usuario">

                                        <span class="big mr-2"><strong><?php echo $comentario->usuario ?></strong></span>

                                        <span><?php echo $comentario->fecha ?></span>
                                        <p><?php echo $comentario->contenido ?></p>

                                    </div>
                                    <hr>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>

                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>


<?php

include_once 'layout/footer.php';

?>
