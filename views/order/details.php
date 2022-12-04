<h1>Detalles de orden N° <?= $order->id ?></h1>
<div class="order-details">
    <?php if (isset($order)) : ?>
        <?php if ($_SESSION['user']->rol == 'admin') : ?>
            <h3>Cambiar estado del pedido</h3>

            <form action="<?= base_url ?>order/changeStatus" method="POST">
                <select name="orderStatus">
                    <?php if ($order->status == 'En espera...') : ?>
                        <option value="<?= $order->status ?>"><?= $order->status ?></option>
                    <?php endif; ?>
                    <option value="confirmed" <?= $order->status == 'confirmed' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="in preparation" <?= $order->status == 'in preparation' ? 'selected' : '' ?>>En preparación</option>
                    <option value="ready" <?= $order->status == 'ready' ? 'selected' : '' ?>>Preparado para envíar</option>
                    <option value="send" <?= $order->status == 'send' ? 'selected' : '' ?>>Envíado</option>
                </select>

                <input type="hidden" name="orderId" value="<?= $order->id ?>">

                <input type="submit" value="Cambiar estado">
            </form>
        <?php endif; ?>

        <h3>Detalles de envío</h3>
        <ol>
            <li>
                <p>País: <?= $order->country ?></p>
            </li>
            <li>
                <p>Ciudad <?= $order->location ?></p>
            </li>
            <li>
                <p>Dirección: <?= $order->adress ?></p>
            </li>
        </ol>

        <h3>Datos del pedido</h3>
        <ol>
            <li>
                <p>Estado: <?= utils::showStatus($order->status) ?></p>
            </li>
            <li>
                <p>Numero de pedido: #<?= $order->id ?></p>
            </li>
            <li>
                <p>Total a pagar: $<?= $order->cost ?></p>
            </li>

            <li>
                <p>Productos: </p>
                <ul>
                    <table>
                        <tr>
                            <th>IMAGEN</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO</th>
                            <th>UNIDADES</th>
                        </tr>
                        <?php while ($pro = $products->fetch_object()) : ?>
                            <tr>
                                <td>
                                    <?php if (isset($pro->image) && !empty($pro->image)) : ?>
                                        <img src="<?= base_url ?>uploads/images/<?= $pro->image ?>" alt="<?= $pro->name ?>" class="table-image">
                                    <?php else : ?>
                                        <img src="<?= base_url ?>assets/img/camiseta.png" alt="<?= $pro->name ?>" class="table-image">
                                    <?php endif; ?>
                                </td>
                                <td><a href="<?= base_url ?>product/show&id=<?= $pro->id ?>"><?= $pro->name ?></a>
                                </td>
                                <td><?= $pro->price ?></td>
                                <td><?= $pro->units ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </ul>
            </li>
        </ol>
    <?php endif; ?>
</div>