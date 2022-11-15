<div class="order-details">
    <h1>Tu pedido ha sido confirmado</h1>

    <?php if(isset($_SESSION['save-order']) && $_SESSION['save-order'] == "completed"): ?>
    <p class="order-details-text">
        Pedido confirmado correctamente, ha sido guardado con exito, una vez realizada la transferencia bancaria a la
        cuenta ########### con el coste del pedido, este será procesado y envíado a su destino
    </p>

    <?php if(isset($order)): ?>
    <h3>Datos del pedido</h3>

    <ol>
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
                    <?php while($pro = $products->fetch_object()): ?>
                    <tr>
                        <td>
                            <?php if(isset($pro->image) && !empty($pro->image)): ?>
                            <img src="<?=base_url?>uploads/images/<?= $pro->image ?>" alt="<?= $pro->name ?>"
                                class="table-image">
                            <?php else: ?>
                            <img src="<?=base_url?>assets/img/camiseta.png" alt="<?= $pro->name ?>" class="table-image">
                            <?php endif; ?>
                        </td>
                        <td><a
                                href="<?=base_url?>?controller=product&action=show&id=<?=$pro->id?>"><?= $pro->name ?></a>
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


    <?php elseif(isset($_SESSION['save-order']) && $_SESSION['save-order'] != "completed"): 
        var_dump($_SESSION['save-order']); ?>
    <?php endif; ?>
</div>