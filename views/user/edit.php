<h1>Informacion de usuario</h1>

<?php if (isset($_SESSION['update']) && $_SESSION['update'] == 'completed') : ?>
    <div class="alert">
        Datos cambiados correctamente
    </div>
<?php elseif (isset($_SESSION['update']) && $_SESSION['update'] == 'failed') : ?>
    <div class="alert alert-error">
        Fallo al realizar el cambio, introduce datos validos para el cambio
    </div>
<?php
endif;
utils::deleteSession('update');
?>

<form action="<?= base_url ?>user/update" method="post">
    <label for="name">Nombre: </label>
    <input type="text" name="name" value="<?= $_SESSION['user']->name ?>" autocomplete="off">

    <label for="surname">Apellidos: </label>
    <input type="text" name="surname" value="<?= $_SESSION['user']->surname ?>" autocomplete="off">

    <label for="email">Correo: </label>
    <input type="email" name="email" value="<?= $_SESSION['user']->email ?>" autocomplete="off">

    <input type="submit" value="Enviar datos">
</form>