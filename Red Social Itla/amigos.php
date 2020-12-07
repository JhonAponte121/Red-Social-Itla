<?php

session_start();
include_once 'layout/header.php';
include_once 'layout/menu.php';

include('models/usuario.php');
include('models/publicacion.php');
include('models/comentario.php');
include('models/amigo.php');

if (isset($_SESSION['logueado'])) 
{
    $user = new usuario;
    $post = new publicacion;
    $comment = new comentario;
    $friend = new amigo;
    
    $amigos = $friend->getAmigosUsuario($_SESSION['logueado']);
    $publicaciones = $post->getPublicacionesAmigos($_SESSION['logueado']);
}
else
{
    header('location:/Social Network/login.php');
}

?>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-8">
            <div>
                <?php
                if($publicaciones != null)
                {
                    foreach ($publicaciones as $publicacion) : 
                    $usuario = $publicacion->nombre . ' ' . $publicacion->apellido . ' (' . $publicacion->usuario . ')';
                ?>
                    <div class="container-usuarios-publicaciones">

                        <div class="usuarios-publicaciones-top">

                            <div class="informacion-usuario-publico">
                                <h6 class="mb-0"><?php echo $usuario ?></h6>
                                <span><?php echo $publicacion->fecha ?></span>
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
                                <input type="hidden" name="page" value="amigos">
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
                <?php endforeach;
                    }
                    else
                    {
                    ?>

                    <h4 class="sinPublicaciones">No hay publicaciones para mostrar.</h4>

                    <?php
                    }?>
            </div>
        </div>

        <div class="col-md-4">
            <div>
                <div class="perfil-usuario-container">
                    <div class="banner">
                        <button id="btnAgregar" class="btnAgregar" data-toggle="modal" data-target="#myModal"><i class="fas fa-user-plus mr-2"></i>Agregar amigo</button>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                        
                          <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar nuevo amigo</h4>
                                <button type="button" class="close" data-dismiss="modal" onclick="$('#btnCerrarAlert').trigger('click')">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="manejadores/agregarAmigo.php" method="POST">
                                    <input type="text" class="input-usuario" name="usuario_amigo" placeholder="Nombre de usuario" maxlength="30" required>

                                    <?php if (isset($_SESSION['usuarioNoExiste'])) : ?>
                                        <div id="alerta" class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                            <?php echo $_SESSION['usuarioNoExiste'] ?>
                                            <button id="btnCerrarAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <script type="text/javascript">
                                            $('#btnAgregar').trigger('click')
                                        </script>

                                        <?php unset($_SESSION['usuarioNoExiste']);
                                        endif ?>

                                    <button id="btnRegistro" class="btn-block btn-pastel">Agregar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#btnCerrarAlert').trigger('click')">Cerrar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="container-listado-amigos">
                    <?php
                    
                    if($amigos != null)
                    {
                        foreach ($amigos as $amigo) : ?>
                                <div class="container-amigo">

                                    <span class="mr-2 mt-4"><strong><?php echo $amigo->nombre . ' ' . $amigo->apellido . ' (' . $amigo->usuario . ')'; ?></strong></span>
                                
                                    <button class="btn-icon-eliminar" onclick="window.location.href='/Social Network/manejadores/eliminarAmigo.php?id=<?php echo $amigo->id; ?>'"><i class="far fa-trash-alt"></i></button>
                                </div>
                        
                        <?php endforeach;
                    }
                    else
                    {
                    ?>

                    <p class="mt-3">No tienes ningún amigo agregado.</p>

                    <?php
                    }?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

include_once 'layout/footer.php';

?>