<h1>Registrar un nuevo usuario</h1>

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'completed') : ?>
    <div class="alert">
        Usuario registrado satisfactoriamente
    </div>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
    <div class="alert alert-error">
        Fallo al realizar el registro el usuario, introduce los datos correctos
    </div>
<?php
endif;
utils::deleteSession('register');
?>

<form action="<?= base_url ?>user/save" method="POST">
    <label for="name">Nombre: </label>
    <input type="text" name="name" autocomplete="off">

    <label for="surname">Apellidos: </label>
    <input type="text" name="surname" autocomplete="off">

    <label for="email">Correo: </label>
    <input type="email" name="email" autocomplete="off">

    <label for="password">Contraseña: </label>
    <input type="password" name="password" autocomplete="off">

    <!-- <label for="image">Imagen: </label>
    <input type="file" name="image"> -->

    <input type="submit" value="Registrarse">
</form>