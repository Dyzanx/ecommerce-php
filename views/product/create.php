<?php if (isset($edit)) : ?>
    <h1>Editar el producto: <?= $product->name ?></h1>

    <div class="form-container">
        <form action="<?= base_url ?>product/update&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
            <label for="category_id">Categoria: </label>
            <select name="category_id">
                <?php
                $categories = utils::getCategories();
                while ($cat = $categories->fetch_object()) : ?>
                    <?php if ($cat->id == $product->category_id) : ?>
                        <option value="<?= $cat->id ?>" selected><?= $cat->name ?></option>
                    <?php endif; ?>
                    <?php if ($cat->id != $product->category_id) : ?>
                        <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                    <?php endif; ?>
                <?php endwhile; ?>
            </select>

            <label for="name">Nombre: </label>
            <input type="text" name="name" value="<?= $product->name ?>" autocomplete="off">

            <label for="description">Descripcion: </label>
            <textarea name="description" cols="30" rows="10"><?= $product->description ?></textarea>

            <label for="price">Precio: </label>
            <input type="number" name="price" value="<?= $product->price ?>" autocomplete="off">

            <label for="stock">Stock: </label>
            <input type="number" name="stock" value="<?= $product->stock ?>" autocomplete="off">

            <label for="image">Imagen (png, jpg, jpeg): </label>
            <input type="file" name="image" autocomplete="off">
            <?php if (isset($product->image) && !empty($product->image)) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->image ?>" alt="<?= $product->image ?>" class="small-image">
            <?php endif; ?>

            <input type="submit" value="Actualizar información">
        </form>
    </div>

<?php else : ?>

    <h1>Agregar nuevos productos a la tienda</h1>

    <div class="form-container">
        <form action="<?= base_url ?>product/save" method="post" enctype="multipart/form-data">
            <label for="category_id">Categoria: </label>
            <select name="category_id">
                <?php
                $categories = utils::getCategories();
                while ($cat = $categories->fetch_object()) :
                ?>
                    <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                <?php endwhile; ?>
            </select>

            <label for="name">Nombre: </label>
            <input type="text" name="name" autocomplete="off">

            <label for="description">Descripcion: </label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>

            <label for="price">Precio: </label>
            <input type="number" name="price" autocomplete="off">

            <label for="stock">Stock: </label>
            <input type="number" name="stock" autocomplete="off">

            <label for="image">Imagen (png, jpg, jpeg): </label>
            <input type="file" name="image" autocomplete="off">

            <input type="submit" value="Crear producto">
        </form>
    </div>

<?php endif; ?>