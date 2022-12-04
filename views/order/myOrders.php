<?php if (isset($gestion)) : ?>
    <h1>Gestión de pedidos</h1>
<?php else : ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>
<table>
    <thead>
        <tr>
            <th>N° Pedido</th>
            <th>Costo</th>
            <th>Estado</th>
            <th>Fecha de pedido</th>
            <?php if (isset($gestion)) : ?>
                <th>Opciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($orders)) : ?>
            <?php while ($order = $orders->fetch_object()) : ?>
                <tr>
                    <td><a href="<?= base_url ?>order/details&id=<?= $order->id ?>"><?= $order->id ?></a></td>
                    <td><?= $order->cost ?> $</td>
                    <td><?= $order->date ?></td>
                    <td><?= $order->status ?></td>
                    <?php if (isset($gestion)) : ?>
                        <td><a href="<?= base_url ?>order/details&id=<?= $order->id ?>">Administrar</a></td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        <?php endif ?>
    </tbody>
</table>