<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
    <h1>Realizar pedido</h1>

    <h3>Domicilio para el envío:</h3><br>
    <form action="<?= base_url ?>order/add" method="post">
        <label for="country">País: </label>
        <input type="text" name="country">

        <label for="location">Ciudad: </label>
        <input type="text" name="location">

        <label for="adress">Dirección: </label>
        <input type="text" name="adress">

        <input type="submit" value="Confirmar">
    </form>

<?php else : ?>
    <h1>Upsss!</h1>
    <h2>Necesitas iniciar sesion para realizar tu pedido</h2>
<?php endif; ?>