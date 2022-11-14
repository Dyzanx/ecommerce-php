<h1>Gestion de pedidos</h1>

<table class="orders-table">
    <tr>
        <th>#</th>
        <th>USUARIO(ID)</th>
        <th>PAIS</th>
        <th>CIUDAD</th>
        <th>DIRECCION</th>
        <th>ESTADO</th>
        <th>ADMINISTRAR</th>
    </tr>
    <?php while($order = $orders->fetch_object()): ?>
        <tr>
            <td><?= $order->id ?></td>
            <td><?= $order->user_id ?></td>
            <td><?= $order->country ?></td>
            <td><?= $order->location ?></td>
            <td><?= $order->adress ?></td>
            <td><?= $order->status ?></td>
            <td><a href="<?=base_url?>?controller=order&action=edit&id=<?=$order->id?>"><i class="fa-solid fa-pen-to-square table-icon button"></i></a></td>
        </tr>
    <?php endwhile; ?>
</table>