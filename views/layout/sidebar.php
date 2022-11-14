<!-- Sidebar -->
<aside class="lateral">
    <div id="cart" class="block-aside">
        <h3>Mi Carrito</h3>
        <ul>
            <?php $stats = utils::statsCarrito(); ?>
            <li><a href="<?=base_url?>?controller=cart&action=index">Productos:
                    <strong>[<?=$stats['count']?>]</strong></a></li>
            <li><a href="<?=base_url?>?controller=cart&action=index">Total:
                    <strong>[$<?=$stats['price']?>]</strong></strong></a></li>
            <li><a href="<?=base_url?>?controller=cart&action=index">Ver carrito</a></li>
        </ul>
    </div>
    <div id="login" class="block-aside">
        <?php if(!isset($_SESSION['user'])): ?>
        <h3>Entrar en la web</h3>
        <form action="<?=base_url?>?controller=user&action=login" method="post">
            <label for="email">Email: </label>
            <input type="email" name="email" autocomplete="on">

            <label for="password">Contraseña: </label>
            <input type="password" name="password" autocomplete="off">

            <input type="submit" value="Entrar">
        </form>
        <ul>
            <li><a href="<?=base_url?>?controller=user&action=register">Registrate aquí</a></li>
        </ul>
        <?php else: ?>
        <h3>Bienvenido, <?= $_SESSION['user']->name ?> <?= $_SESSION['user']->surname ?> </h3>
        <ul>
            <li><a href="<?=base_url?>?controller=user&action=edit">Mis datos</a></li>
            <li><a href="">Mis pedidos</a></li>
            <?php if($_SESSION['user']->rol == 'admin'): ?>
            <li><a href="<?=base_url?>?controller=order&action=gestion">Gestionar pedidos</a></li>
            <li><a href="<?=base_url?>?controller=product&action=gestion">Gestionar productos</a></li>
            <li><a href="<?=base_url?>?controller=category&action=index">Gestionar categorias</a></li>
            <?php endif; ?>
            <li><a href="<?=base_url?>?controller=user&action=logout">Cerrar sesión</a></li>
        </ul>
        <?php endif; ?>
    </div>
</aside>

<!-- Central content -->
<div class="central">