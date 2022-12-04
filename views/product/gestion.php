<?php $categories = utils::getCategories(); ?>

<?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'completed') : ?>
    <div class="alert">
        Producto añadido correctamente
    </div>
<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'failed') : ?>
    <div class="alert alert-error">
        Fallo al crear el nuevo producto, introduce los datos correctamente
    </div>
<?php
endif;
utils::deleteSession('save');
?>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed') : ?>
    <div class="alert">
        Producto eliminado correctamente
    </div>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
    <div class="alert alert-error">
        falló algo al eliminar el producto
    </div>
<?php
endif;
utils::deleteSession('delete');
?>

<?php if (isset($_SESSION['update']) && $_SESSION['update'] == 'completed') : ?>
    <div class="alert">
        Informacion actualizada correctamente
    </div>
<?php elseif (isset($_SESSION['update']) && $_SESSION['update'] == 'failed') : ?>
    <div class="alert alert-error">
        falló algo al actualizar la informacion
    </div>
<?php
endif;
utils::deleteSession('update');
?>

<h1>Gestión de productos</h1>

<a class="button button-small" href="<?= base_url ?>product/create">Crear nuevo producto</a>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>IMAGEN</th>
        <th>OPCIONES</th>
    </tr>
    <?php while ($prod = $products->fetch_object()) : ?>
        <tr>
            <td><?= $prod->id ?></td>
            <td><?= $prod->name ?></td>
            <td><?= $prod->price ?></td>
            <td><?= $prod->stock ?></td>
            <?php if (isset($prod->image) && !empty($prod->image)) : ?>
                <td><img src="<?= base_url ?>uploads/images/<?= $prod->image ?>" class="table-image" alt=""></td>
            <?php else : ?>
                <td><img src="<?= base_url ?>assets/img/camiseta.png" class="table-image" alt=""></td>
            <?php endif; ?>
            <td>
                <a href="<?= base_url ?>product/edit&id=<?= $prod->id ?>"><i class="fa-solid fa-pen-to-square table-icon button"></i></a>
                <a href="<?= base_url ?>product/delete&id=<?= $prod->id ?>"><i class="fa-solid fa-trash table-icon button button-red"></i></a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>