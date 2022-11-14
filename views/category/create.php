<h1>Crear nueva categoria</h1>

<form action="<?=base_url?>?controller=category&action=save" method="post">
    <label for="name">Nombre: </label>
    <input type="text" name="name" autocomplete="off">

    <input type="submit" value="Crear categoria">
</form>