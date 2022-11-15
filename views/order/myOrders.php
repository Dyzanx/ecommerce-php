<h1>Mis pedidos</h1>

<table>
    <thead>
        <tr>
            <th>N° Pedido</th>
            <th>Costo</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php while($order = $orders->fetch_object()): ?>
        <tr>
            <td><a href="<?=base_url?>?controller=order&action=details&id=<?= $order->id ?>"><?= $order->id ?></a></td>
            <td><?= $order->cost ?> $</td>
            <td><?= $order->date ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>