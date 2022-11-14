<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
<?php $stats = utils::statsCarrito(); ?>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>IMAGEN</th>
            <th>PRODUCTO</th>
            <th>PRECIO</th>
            <th>UNIDADES</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($_SESSION['cart'] as $index => $pro): ?>
            <tr>
                <td><?= $index+1 ?></td>
                <td>
                    <?php if(isset($pro['product']->image) && !empty($pro['product']->image)): ?>
                        <img src="<?=base_url?>uploads/images/<?= $pro['product']->image ?>" alt="<?= $pro['product']->name ?>" class="table-image">
                    <?php else: ?>
                        <img src="<?=base_url?>assets/img/camiseta.png" alt="<?= $pro['product']->name ?>" class="table-image">
                    <?php endif; ?>
                </td>
                <td><a href="<?=base_url?>?controller=product&action=show&id=<?=$pro['product']->id?>"><?= $pro['product']->name ?></a></td>
                <td><?= $pro['product']->price ?></td>
                <td><?= $pro['units'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="cart-stats-container">
    <h3 class="cart-stats">Total: $<?=$stats['price']?></h3>
    <a href='<?=base_url?>?controller=cart&action=deleteCart'><i class="fa-solid fa-trash button button-red delete-cart"></i></a>
    <a href='<?=base_url?>?controller=order&action=order' class="button button-small">Hacer pedido</a>
</div>

<?php else: ?>
<h2>Al parecer tu carrito de compra está vacío</h2>
<?php endif; ?>